<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\User;
class UserController extends Controller
{
    /**
     *  check wheather user is guest
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function isGuest(Request $request)
    {
        $is_guest = Auth::guest() ? 'true' : 'false';
        return response()->json(
            [
                'isGuest' => $is_guest
            ]
        );
    }

    /**
     *  get user name
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUserName(Request $request)
    {
        $user = Auth::user();

        $name = '';
        if(!is_null($user)){
            $name = $user->last_name;
            
        }
        return response()->json(
            [
                'name' => $name,
            ]
        , 200);
    }
    
}
