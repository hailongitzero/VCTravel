<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/29/2016
 * Time: 4:31 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class TourController extends Controller
{
    /** return tour list
     * @return View
     */
    public function getTourList(){
        $localCode = strtoupper(App::getLocale());

        /* Load Mode */
        $headerModel = new Models\HeaderModel();
        $tourModel = new Models\TourModel();
        $breadCrumbModel = new Models\breadCrumbsModel();

        /* Init Data */
        $headerData = $headerModel->index($localCode);
        $tourListData = $tourModel->indexTourList($localCode);
        $breadCrumbData = $breadCrumbModel->getBreadCrumbData($localCode, "tours", "M", "", $tourListData['mdTourList']->total());

        /*  set data return */
        $tourListArr = array(
            "headerData" => $headerData,
            "tourList" => $tourListData,
            "breadCrumb" => $breadCrumbData,
        );

        return view('tourList', $tourListArr);
    }

    /** return tour list by group
     * @param $groupLink
     * @return View
     */
    public function getTourListByGroup($groupLink){
        $localCode = strtoupper(App::getLocale());

        /* Load Mode */
        $headerModel = new Models\HeaderModel();
        $tourModel = new Models\TourModel();
        $breadCrumbModel = new Models\breadCrumbsModel();

        /* Init Data */
        $headerData = $headerModel->index($localCode);
        $tourListData = $tourModel->indexTourListByGroup($localCode, $groupLink);
        $breadCrumbData = $breadCrumbModel->getBreadCrumbData($localCode, "tours", "C", $groupLink, $tourListData['mdTourListGroup']->total());

        /* Init Data */
        $tourListGroupArr = array(
            "headerData" => $headerData,
            "tourListByGroup" => $tourListData,
            "breadCrumb" => $breadCrumbData,
        );

        return view('tourList', $tourListGroupArr);
    }
    /** get tour detail data
     * @param $tourLink
     * @return View
     */
    public function getTourDetail($tourLink){
        $localCode = strtoupper(App::getLocale());

        /* Load Mode */
        $headerModel = new Models\HeaderModel();
        $tourModel = new Models\TourModel();
        $breadCrumbModel = new Models\breadCrumbsModel();
        $commonModel = new Models\CommonModel();

        /* Init Data */
        $headerData = $headerModel->index($localCode);
        $tourData = $tourModel->indexTourDetail($localCode, $tourLink);
        $breadCrumbData = $breadCrumbModel->getBreadCrumbData($localCode, "tours", "T", $tourLink, null);

        /* Update Views */
        $commonModel->updateViews("tb_tours", "TOUR_TEXT_LINK", $tourLink);

        /* Init Data */
        $tourDetailArr = array(
            "headerData" => $headerData,
            "tourDetail" => $tourData,
            "breadCrumb" => $breadCrumbData,
        );

        return view('tourDetail', $tourDetailArr);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tourBooking(Request $request){
        $tourModel = new Models\TourModel();

        $id = $request->input('id');
        $name = $request->input('name');
        $tel = $request->input('tel');
        $email = $request->input('email');
        $address = $request->input('address');
        $adult = $request->input('adult');
        $child = $request->input('child');
        $departDt = $request->input('depart');
        $returnDt = $request->input('return');
        $content = $request->input('content');

        $insertArr = array(
            "TOUR_ID" => $id,
            "BK_CUST_NM" => $name,
            "BK_CUST_TEL" => $tel,
            "BK_CUST_EMAIL" => $email,
            "BK_CUST_ADDR" => $address,
            "BK_CUST_CNT" => $content,
            "BK_QTY_ADULT" => $adult,
            "BK_QTY_KID" => $child,
            "BK_DPRT_DT" => $departDt,
            "BK_RTRN_DT" => $returnDt,
            "BK_STS" => "B"
        );

        $result = $tourModel->tourBooking($insertArr);
        $localCode = strtoupper(App::getLocale());

        switch ($localCode){
            case "VI":
                $success = "Cảm ơn bạn đã đặt tour, chúng tôi sẽ liên hệ lại với bạn sớm nhất có thể.";
                $fail = "Lỗi đặt tour, Vui lòng điền lại đầy đủ thông tin và thử lại.";
                break;
            case "EN";
                $success = "Thank for booking, we will contact you asap!.";
                $fail = "Booking fail, please refill information and try again.";
                break;
            default:
                $success = "Thank for booking, we will contact you asap!.";
                $fail = "Booking fail, please refill information and try again.";
                break;
        }

        if( $result ){
            return response()->json(['info' => 'Success', 'Content' =>  $success ], 200);
        }else{
            return response()->json(['info' => 'Fail', 'Content' =>  $fail ], 200);
        }
    }

    public function tourReview(Request $request){
        $tourModel = new Models\TourModel();
        $localCode = strtoupper(App::getLocale());

        $id = $request->input('id');
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $email = $request->input('email');
        $title = $request->input('title');
        $content = $request->input('content');
        $rate = $request->input('rate');

        switch ($localCode){
            case "VI":
                $success = "Cảm ơn những chia sẽ và góp ý của bạn.";
                $fail = "Lỗi hệ thống, vui lòng thử lai sau.";
                break;
            case "EN";
                $success = "Thank for your sharing feedback.";
                $fail = "System error. Please try again later.";
                break;
            default:
                $success = "Thank for your sharing feedback.";
                $fail = "System error. Please try again later.";
                break;
        }

        $insertArr = array(
            "POST_ID" => $id,
            "FIRST_NAME" => $firstName,
            "LAST_NAME" => $lastName,
            "EMAIL" => $email,
            "COMMENT_TITLE" => $title,
            "COMMENT_CONTENT" => $content,
            "COMMENT_RATE" => $rate
        );

        $result = $tourModel->tourReview($insertArr, $rate, $id);

        if( $result ){
            return response()->json(['info' => 'Success', 'Content' =>  $success ], 200);
        }else{
            return response()->json(['info' => 'Fail', 'Content' =>  $fail ], 200);
        }
    }

}