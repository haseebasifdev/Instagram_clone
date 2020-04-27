<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Like;
use App\Follower;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $users = User::where('id', '!=', $user->id)->get();
        return ($users);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $friends1 = Follower::where('user_id', $user->id)->pluck('follower_id');
        $friends2 = Follower::where('follower_id', $user->id)->pluck('user_id');
        $friends2->push($user->id);
        // if ($friends1->count() > 0) {

        //     $friends2 = array_merge($friends2, $friends1);
        // }
        $postlikes = Like::where('user_id', $user->id)->get();
        $notFolloew =  User::whereNotIn('id', $friends2)->get();
        $post = Post::where('user_id', $user->id)->latest()->get();
        return [$user, $post, $notFolloew, $postlikes, $friends1, $friends2];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }
    public function updateprofilepicture(Request $request, User $user)
    {
        // return [$user];
        $exploded = explode(',', $request->profile);
        $decode = base64_decode($exploded[1]);
        if (str_contains($exploded[0], 'jpeg')) {
            $extension = 'jpg';
        } else {
            $extension = 'png';
        };
        $filename = str_random() . '.' . $extension;
        $path = public_path() . '\profiles/' . $filename;
        file_put_contents($path, $decode);
        $user->profile = $filename;
        $user->save();
        return ['Success' => 'Profile Picture Updated'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'username' => ['required', 'string', 'alpha_dash', 'max:255', Rule::unique('users')->ignore($user)],
            'bio' => ['max:255']
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->bio = $request->bio;
        $user->gender = $request->gender;
        $user->save();
        return ($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
