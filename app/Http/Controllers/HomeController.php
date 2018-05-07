<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        $loggedUser = Auth::user();
        $myFriendsRelationships = $loggedUser->getAllFriendships();

        $myFriends = [];
        foreach ($myFriendsRelationships as $friend) {
          $myFriends[] = User::find($friend->recipient_id);
        }
        return view('home', compact('users', 'myFriends'));
    }
}
