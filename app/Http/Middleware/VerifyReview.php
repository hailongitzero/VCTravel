<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 9/28/2016
 * Time: 2:22 PM
 */

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Closure;

class VerifyReview
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle($request, Closure $next)
    {
        $localCode = strtoupper(App::getLocale());

        $vrfArr = array('id','firstName','lastName','email', 'title', 'content');
        $verify = true;

        switch ($localCode){
            case "VI":
                $fail = "Vui lòng điền đầy đủ thông tin và thử lại.";
                break;
            case "EN";
                $fail = "Please enter fully information.";
                break;
            default:
                $fail = "Please enter fully information.";
                break;
        }

        for($i = 0; $i < count($vrfArr); $i ++){
            if($request->input($vrfArr[$i]) == null || $request->input($vrfArr[$i]) == ''){
                $verify = false;
            }
        }

        if ($verify == false){
            return response()->json(['info' => 'Fail', 'Content' =>  $vrfArr ], 200);
        }else{
            return $next($request);
        }
    }
}