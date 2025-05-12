<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Comment;

class OrganizationController extends Controller
{
    public function GetOrganizations (Request $request)
    {
        if (!request()->filled('name'))
        {
            $organizations = Organization::where('city', $request->city)->get();
        }
        else if (!request()->filled('city'))
        {
            $organizations = Organization::where('name', $request->name)->get();
        }
        else
        {
            $organizations = Organization::where('name', $request->name)->where('city', $request->city)->get();
        }

        return view('search', compact('organizations'));
    }
    public function CreateOrganization (Request $request)
    {
        if (!request()->has('name') || !request()->has('city'))
        {
            return view('create_organization');
        }
        $organization = new Organization();
        $organization->name = $request->name;
        $organization->city = $request->city;
        $organization->status = 'pending';
        $organization->score = 0;
        $organization->number_of_raters = 0;
        $organization->save();
        return redirect()->route('search')->with('success' , 'سازمان با موفقیت ثبت شد');
    }
    public function TopOrganizations ()
    {
        $organizations = Organization::orderBy('score', 'desc')->limit(5)->get();
        return view('main', compact('organizations'));
    }

    public function GetOrganization ($id)
    {
        session(['previous_url' => '/organization/'. $id]);
        $organization = Organization::find($id);
        $comments = Comment::where('organization_id', $id)->where('status', 'public')->get()->reverse();
        return view('organization', compact('organization', 'comments'));
    }

}
