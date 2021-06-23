<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            $user = JWTAuth::parseToken()->authenticate();

            if(!$user) return response_api_error('Kami tidak memiliki catatan akun anda. Silahkan lakukan pendaftaran', 'user_not_found');

        }catch(\Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
            return response_api_error($e->getMessage(), 'token_expired');
        }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response_api_error($e->getMessage(), 'token_invalid');
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response_api_error($e->getMessage(), 'token_required');
        } catch (\Exception $e) {
            return response_api_server_error($e->getMessage());
        }
        return $next($request);
    }
}
