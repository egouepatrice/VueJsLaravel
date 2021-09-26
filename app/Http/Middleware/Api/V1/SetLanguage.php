<?php

namespace App\Http\Middleware\Api\V1;

use Closure;
use Illuminate\Support\Facades\App;

class SetLanguage
{
    private $err_code = "SL-";
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $err_code_function = "H";
        $lan = $request->input('lan');
        if($lan=="fr"){
            App::setLocale("fr");
        }else if($lan=="en"){
            App::setLocale("en");
        }else{
            $response['status'] = 0;
            $response['err_title'] =__('api_auth.incorrect_datas');
            $response['err_msg'] = __('api_auth.incorrect_language');
            $response['err_code'] = $this->err_code.$err_code_function."1";
            $response['search']=$request->input('search');
            return response()->json($response, 404);
        }
        return $next($request);
    }
}
