<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 9/23/2016
 * Time: 2:41 PM
 */

namespace App\Http\Middleware;

use App\Models;
use Closure;
use Illuminate\Support\Facades\App;


class VerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $localCode = strtoupper(App::getLocale());
        $commonModel = new Models\CommonModel();

        switch ($localCode){
            case "VI":
                $fail = "Vui lòng nhập email và thử lại.";
                $fail1 = "Email của bạn quá dài, vui lòng nhập lại.";
                $fail2 = "Email của bạn đã được đăng ký.";
                break;
            case "EN";
                $fail = "Please input your email!";
                $fail1 = "Your email is too long!";
                $fail2 = "This email already subscribe";
                break;
            default:
                $fail = "Please input your email!";
                $fail1 = "Your email is too long!";
                $fail2 = "This email already subscribe";
                break;
        }

        if($request->input('email') == null || $request->input('email') == '' ){
            return response()->json(['info' => 'Fail', 'Content' =>  $fail ], 200);
        }elseif(strlen($request->input('email')) > 50){
            return response()->json(['info' => 'Fail', 'Content' =>  $fail1 ], 200);
        }else{
            $exist = $commonModel->checkExistEmail($request->input('email'));
            if($exist > 0){
                return response()->json(['info' => 'Fail', 'Content' =>  $fail2 ], 200);
            }else{
                return $next($request);
            }
        }
    }
}