<?php

namespace App\Http\Controllers;

use App\Subscribers;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function follow()
    {
        $pageDescription = 'Follow';
        return view('main.follow', compact('pageDescription'));
    }

    public function storeFollow(Request $request)
    {
        $messages = [
            'email.unique' => 'This email is subscribed yet!',
        ];

        $this->validate($request, [
            'email' => 'required|unique:subscribers'
        ], $messages);

        Subscribers::create($request->all());

        \Flash::success('You are now subscribed.');

        return redirect('/');
    }

    public function unsubscribe($hash)
    {
        $email = base64_decode($hash);
        $subscribe = Subscribers::where('email', $email)->first();
        if ($subscribe) {
            $subscribe->delete();
            \Flash::success('All done!');
        }
        return redirect('/');
    }
}
