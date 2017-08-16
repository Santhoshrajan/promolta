<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use MyFuncs;
use JWTAuth;

class TokenAuth
{
    public function handle($request, Closure $next)
    {
        try {
            // $iat = JWTAuth::parseToken()->getPayload()->get('iat');
            if ( !$user = JWTAuth::parseToken()->authenticate() ) {
                return response()->json(['status' => -1, 'message' => 'Can\'t find the user' ], 404);
            }
            else{
                if(count($request->json()->all())) {
                    $postjson = $request->json()->all();
                    $request->replace(['json' => $postjson]);
                }

                $request->merge([ 'user_id' => $user->id ]);
                return $next($request);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['status' => -2, 'message' => 'Authentication Token Expired' ], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['status' => -3, 'message' => 'Authentication Token Not Valid' ], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['status' => -4, 'message' => 'Authentication Token Absent' ], $e->getStatusCode());
        }
    }
}