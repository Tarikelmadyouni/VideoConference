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

    public function authenticate(Request $request){

          $socketId = $request->socket_id;
          $channelName =$request->channel_name;

          $pusher = new Pusher('23897c6556c8a57f7d73',  '73bd6af584248617fc54', '1005329', [

            'cluster' => 'eu',
            'useTLS' => true

          ]);

          $presence_data =['name' => auth()->user()->name];
          $key =$pusher->presence_auth($channelName,$socketId,auth()->id(),$presence_data);

          return response($key);

    }

}
