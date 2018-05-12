<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FriendshipController extends Controller
{
    //
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loggedUser = Auth::user();

        $friendUser = User::find($request->user_id);

        $loggedUser->befriend($friendUser);

        // return qualcosa
        return back();
    }


    public function showLoggedUserFriends( Request $request ){
        $loggedUser = Auth::user();
        $myFriendsRelationships = $loggedUser->getAllFriendships();
        
        $myFriends = [];
        foreach ($myFriendsRelationships as $friend) {
            $parsedFriend = User::find($friend->recipient_id);
            if (stripos($parsedFriend->firstname, $request->q) !== false) {
                $myFriends[] = $parsedFriend;
            }
        }
        echo json_encode($myFriends);
    }
}
