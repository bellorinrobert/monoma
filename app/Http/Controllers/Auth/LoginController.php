<?php
/**
 * Summary of namespace App\Repositories
 * @author Robert Bellorin <bellorinrobert@gmail.com>
 * @date 2024-09-15
 * 
 */
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\LoginResource;
use App\Repositories\UserRepository;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {

        $this->userRepository = $userRepository;

        // $this->middleware('auth:api', [
        //     'except' => ['__invoke']
        //     ]
        // );


    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $credentials = $request->only(['username', 'password']);
        
        $token = Auth::attempt($credentials);

        if(!$token) {
            
            $user = $this->userRepository
                            ->getByUserName($credentials['username']);

            $reponse = [
                'meta' => [
                    'success' => false
                    , 'errors' => [
                        "Password incorrect for: " . $user->username
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
                'token' => $token
                // 'token' => "TOOOOOKEN"
                , "minutes_to_expire" => auth()->factory()->getTTL() * 24
            ]
        ];

        return new LoginResource($reponse);

    }
}
