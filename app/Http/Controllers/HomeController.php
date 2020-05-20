<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Pusher\Pusher;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function authenticale(Request $request){

          $socketId = $request->socket_id;
          $channelName =$request->channel_name;

          $pusher = new Pusher('bcec8ee6a59627ab4a9d', '751ea079c875fa8570b2', '1004541',[
            'cluster' => 'ap2',
            'encrypted' => true

          ]);

          $presence_data =['name' => auth()->user()->name];
          $key =$pusher->presence_auth($channelName,$socketId,auth()->id(),$presence_data);

          return response($key);

    }

}
