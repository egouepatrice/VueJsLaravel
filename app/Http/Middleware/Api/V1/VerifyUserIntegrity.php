<?php

namespace App\Http\Middleware\Api\V1;

use App\Helpers\Api\V1\AuthenticationHelper;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Closure;
use RuntimeException;

class VerifyUserIntegrity
{
    use AuthenticationHelper;
    private $err_code = "VU-";
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $err_code_function = "HUI";
        try{

            $search = $request->input('search');

            $fair_user = $this->userIntegrity($search,$err_code_function);
            if(!$fair_user['status']){
                $response['status'] = 0;
                $response['err_title'] = __('api_auth.error');
                $response['err_msg'] = $fair_user['err_msg'];
                $response['err_code'] = $fair_user['err_code'];
                $response['search']=$request->input('search');
                return response()->json($response, 404);
            }
            $request = $request->merge(["fair_user" => $fair_user]);

            return $next($request);

        }catch (\Exception $exception){
            Bugsnag::notifyException(new RuntimeException($exception));
            $response['status'] = 0;
            $response['err_title'] = __('api_auth.server_error_title');
            $response['err_msg'] = __('api_auth.server_error_msg');
            $response['err_code'] = $this->err_code.$err_code_function."EX";
            $response['search']=$request->input('search');

            return response()->json($response, 500);
        }


    }
}
