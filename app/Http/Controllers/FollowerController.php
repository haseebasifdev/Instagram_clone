<?php

namespace App\Http\Controllers;

use App\Follower;
use App\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkfollower = Follower::where('user_id', $request->userid)->where('follower_id', $request->followerid);
        if ($checkfollower->exists()) {
            $checkfollower->delete();
        } else {

            Follower::create([
                'user_id' => $request->userid,
                'follower_id' => $request->followerid
            ]);
        };
        $following = Follower::where('user_id', $request->followerid)->get();
        $follower = Follower::where('follower_id', $request->followerid)->get();
        return ([$following, $follower]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $friends1 = Follower::where('user_id', $user->id)->pluck('follower_id');
        $friends2 = Follower::where('follower_id', $user->id)->pluck('user_id');
        $friends2->push($user->id);
        if ($friends1->count() > 0) {

            $friends2 = array_merge($friends2, $friends1);
        }
        $notFolloew =  User::whereNotIn('id', $friends2)->get();

        return ($notFolloew);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function edit(Follower $follower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follower $follower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follower $follower)
    {
        //
    }
}
