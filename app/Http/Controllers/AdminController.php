<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use App\Models\Comment;

class AdminController extends Controller
{
    public function PublishComment(Request $request)
    {
        $user = User::find(session('UserID'));
        if ($user->role != 'admin')
        {
            return redirect()->route('login')->with('error' , 'دسترسی ندارید ');
        }
        $comment = Comment::find($request->comment_id);
        $comment->status = 'public';
        $comment->save();

        return redirect()->route('admin/dashboard');
    }
    public function PublishOrganization (Request $request)
    {
        $user = User::find(session('UserID'));
        if (!$user || $user->role != 'admin')
        {
            return redirect()->route('login')->with('error' , 'دسترسی ندارید ');
        }

        $organization = Organization::find($request->organization_id);
        $organization->status = 'active';
        $organization->save();
        return redirect()->route('admin/dashboard');
    }
    private function GetUnpublishedComments ()
    {
        $user = User::find(session('UserID'));
        if ($user->role != 'admin')
        {
            return redirect()->route('login')->with('error' , 'دسترسی ندارید ');
        }
        $comments = Comment::where('status', 'pending')->get();
        return $comments ;
    }
    private function GetUnpublishedOrganizations ()
    {
        $user = User::find(session('UserID'));
        if ($user->role != 'admin')
        {
            return redirect()->route('login')->with('error' , 'دسترسی ندارید ');
        }
        $organizations = Organization::where('status', 'pending')->get();
        return $organizations ;
    }
    public function dashboard()
    {
        $user = User::find(session('UserID'));
        if (!$user || $user->role != 'admin')
        {
            return redirect()->route('login')->with('error' , 'دسترسی ندارید ');
        }
        else
        {
            $unpublishedComments = $this->GetUnpublishedComments();
            $unpublishedOrganizations = $this->GetUnpublishedOrganizations();
            return view('admin_panel' , ['unpublishedComments' => $unpublishedComments , 'unpublishedOrganizations' => $unpublishedOrganizations]);
        }
    }
    public function DeleteComment(Request $request)
    {
        $user = User::find(session('UserID'));
        if (!$user || $user->role != 'admin')
        {
            return redirect()->route('login')->with('error' , 'دسترسی ندارید ');
        }
        $comment = Comment::find($request->comment_id);
        $comment->delete();
        return redirect()->route('admin/dashboard');
    }
    public function DeleteOrganization(Request $request)
    {
        $user = User::find(session('UserID'));
        if (!$user || $user->role != 'admin')
        {
            return redirect()->route('login')->with('error' , 'دسترسی ندارید ');
        }
        $organization = Organization::find($request->organization_id);
        $organization->delete();
        return redirect()->route('admin/dashboard');
    }

}
