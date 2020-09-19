<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client as OClient; 
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
   
    public $successStatus = 200;

    public function login(Request $request) { 
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) { 
            $oClient = DB::Table('oauth_clients')->where('password_client', 1)->first();
            $clientId = $oClient->id;
            $clientSecret = $oClient->secret;

            return $this->getTokenAndRefreshToken($clientId,$clientSecret, $user->email, $password);
        } 
        else { 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function register(Request $request) { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email|unique:users', 
            'password' => 'required', 
            'confirm_password' => 'required|same:password', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
   
        
        $password = $request->password;
        $input = $request->all(); 
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input); 
        $oClient = DB::Table('oauth_clients')->where('password_client', 1)->first();
        $clientId = $oClient->id;
        $clientSecret = $oClient->secret;
        


        return $this->getTokenAndRefreshToken($clientId,$clientSecret, $user->email, $password);
    }

    public function getTokenAndRefreshToken($clientId,$clientSecret, $email, $password) { 

      
        $http =  new Client([
            'connect_timeout' => false,
            'timeout'         => 30.0, 
        ]);

        try {
            $response = $http->post(env('APP_URL').env('AUTH_ENDPOINT'),[
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                    'username' => $email,
                    'password' => $password,
                    // 'scope' => '',
                ],
            ]);
        
            return $response->getBody();
        
            } catch (\GuzzleHttp\Exception\BadResponseException $e) {
                if ($e->getCode() == 401) {
                    return response()->json(['message' => 'This action can\'t be perfomed at this time. Please try later.'], $e->getCode());
                } else if ($e->getCode() == 400) {
                    return response()->json(['message' => 'These credentials do not match our records.'], $e->getCode());
                }
        
                return response()->json('Something went wrong on the server. Please try letar.', $e->getCode());
            }


    }

}
