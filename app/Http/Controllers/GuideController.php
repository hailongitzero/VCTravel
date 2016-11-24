<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 9/15/2016
 * Time: 4:04 PM
 */

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Support\Facades\App;


class GuideController extends Controller
{
    public function getGuideList(){
        $localCode = strtoupper(App::getLocale());

        /* Load Mode */
        $headerModel = new Models\HeaderModel();
        $breadCrumbModel = new Models\breadCrumbsModel();
        $guideMode = new Models\GuideModel();

        /* Init Data */
        $headerData = $headerModel->index($localCode);
        $guideListData = $guideMode->getGuideListIndex($localCode);

        $breadCrumbData = $breadCrumbModel->getBreadCrumbData($localCode, "guide", "M", "", $guideListData['mdGuideList']->total());

        $guideListArr = array(
            "headerData" => $headerData,
            "breadCrumb" => $breadCrumbData,
            "guideList" => $guideListData,
        );

        return view('guideList', $guideListArr);
    }

    public function getGuideDetail($guideLink){
        $localCode = strtoupper(App::getLocale());

        /* Load Mode */
        $headerModel = new Models\HeaderModel();
        $breadCrumbModel = new Models\breadCrumbsModel();
        $guideMode = new Models\GuideModel();

        /* Init Data */
        $headerData = $headerModel->index($localCode);
        $guideDetailData = $guideMode->getGuideDetailIndex($localCode, $guideLink);

        $breadCrumbData = $breadCrumbModel->getBreadCrumbData($localCode, "guide", "G", $guideLink, null);

        $guideDetailArr = array(
            "headerData" => $headerData,
            "breadCrumb" => $breadCrumbData,
            "guideDetail" => $guideDetailData,
        );

        return view('guideDetail', $guideDetailArr);
    }
}