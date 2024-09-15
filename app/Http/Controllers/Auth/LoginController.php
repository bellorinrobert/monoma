<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\LoginResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $credentials = request(['username', 'password']);

        if(!$token = auth()->attempt($credentials)) {
            
            $user = \App\Models\User::where(
                'username',
                $credentials['username']
                )->first();

            $reponse = [
                'meta' => [
                    'success' => false
                    , 'errors' => [
                        "Password incorrect for: " . $credentials['username']
                    ]
                    ]
            ];
            
            return response()->json($reponse, 401);
            
        }


        $reponse = [
            'meta' => [
                'success' => true
                , 'errors' => []
            ], 'data' => [
                // 'token' => $token
                'token' => "TOOOOOKEN"
                , "minutes_to_expire" => auth()->factory()->getTTL() * 24
            ]
        ];

        return new LoginResource($reponse);

    }
}
