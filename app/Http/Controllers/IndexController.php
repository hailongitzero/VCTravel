<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models;
use Illuminate\Support\Facades\App;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $localCode = strtoupper(App::getLocale());

        /* Load Model */
        $headerModel = new Models\HeaderModel();
        $sldModel = new Models\SliderModel();
        $cateModel = new Models\TourCategoryModel();
        $tourModel = new Models\TourModel();
        $newsModel = new Models\NewsModel();

        /* Init Data */
        $headerData = $headerModel->index($localCode);
        $sliderData = $sldModel->index($localCode);
        $cateData = $cateModel->index($localCode);
        $tourRcm = $tourModel->indexTourRecommended($localCode);
        $latestNews = $newsModel->latestNewsIndex($localCode);

        $indexData = array(
            "headerData" => $headerData,
            "sliderData" => $sliderData,
            "cateData" => $cateData,
            "tourRcm" => $tourRcm,
            "latestNews" => $latestNews,
        );

        return view('index', $indexData);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function regSubscribeEmail(Request $request){
        $commonModel = new Models\CommonModel();
        $localCode = strtoupper(App::getLocale());

        switch ($localCode){
            case "VI":
                $success = "Hoàn thành đăng ký nhận thông tin qua email.";
                $fail = "Lỗi trong quá trình đăng ký, vui lòng thử lại sau.";
                break;
            case "EN";
                $success = "Email subscribe successful!";
                $fail = "Error when subscribe email, please try again later.";
                break;
            default:
                $success = "Email subscribe successful!";
                $fail = "Error when subscribe email, please try again later.";
                break;
        };

        $email = $request->input('email');

        $insertArr = array(
            "email" => $email,
        );
        $result = $commonModel->insertSubcribeEmail($insertArr);

        if ($result){
            return response()->json(['info' => 'Success', 'Content' => $success], 200);
        }else{
            return response()->json(['info' => 'Fail', 'Content' => $fail], 200);
        }
    }

    public function notFoundPage(){
        $localCode = strtoupper(App::getLocale());

        /* Load Model */
        $headerModel = new Models\HeaderModel();

        /* Init Data */
        $headerData = $headerModel->index($localCode);

        $indexData = array(
            "headerData" => $headerData,
        );

        return view('404', $indexData);
    }
}