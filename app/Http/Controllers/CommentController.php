<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Organization;

class CommentController extends Controller
{
    public function CreateComment(Request $request)
    {
        $user = User::find(session('UserID'));
        if (!$user) return redirect()->route('login')->with('error' , 'دسترسی ندارید ');

        $comment = new Comment();
        $comment->author = $user->name;
        $comment->author_email = $user->email;
        $comment->organization_id = $request->organization_id;
        $comment->comment = $request->comment;
        $comment->organization_score = $request->score;
        $comment->likes_count = 0;
        $comment->dislikes_count = 0;
        $comment->status = 'pending';
        $comment->save();

        $this->new_score($request->organization_id , $request->score);
        return redirect()->route('main')->with('success' , 'نظر شما با موفقیت ثبت شد');
    }

    function new_score($id , $score)
    {
        $organization = Organization::find($id);
        $organization->score = ($organization->score * $organization->number_of_raters + $score) / ($organization->number_of_raters + 1);
        $organization->number_of_raters++;
        $organization->save();
    }
    
    public function feedbackComment(Request $request)
    {
        $user = User::find(session('UserID'));
        $comment = Comment::find($request->comment_id);

        $feedback = Feedback::where('email', $user->email)->where('comment_id', $request->comment_id)->first() ;
        if (!$feedback)
        {
            $feedback = new Feedback();
            $feedback->email = $user->email;
            $feedback->comment_id = $request->comment_id;
            $feedback->feedback = $request->feedback;
            $feedback->save();
            if ($request->feedback == true) $comment->likes_count++;
            else $comment->dislikes_count++;
            $comment->save();
            return redirect()->route('organization' , ['id' => $comment->organization_id])->with('success' , 'بازخورد شما با موفقیت ثبت شد');
        }
        else
        {
            
            if ($request->feedback == true && $feedback->feedback == false) 
            {$comment->likes_count++ ; $comment->dislikes_count--;}

            else if ($request->feedback == false && $feedback->feedback == true) 
            {$comment->dislikes_count++ ; $comment->likes_count--;}

            $feedback->feedback = $request->feedback;
            $feedback->save();
            $comment->save();
            return redirect()->route('organization' , ['id' => $comment->organization_id])->with('success' , 'بازخورد شما با موفقیت ثبت شد');
        }
    }
    
    // public function editComment(Request $request)
    // {
    //     $user = User::find(session('UserID'));
    //     $comment = Comment::find($request->comment_id);
    //     if ($user->email != $comment->author_email)
    //     {
    //         return response()->json(['message' => 'You are not authorized to edit a comment'], 403);
    //     }
    //     $comment->comment = $request->comment;
    //     $comment->save();
    //     return response()->json(['message' => 'Comment edited successfully'], 200);
    // }
}
