<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 12/28/2016
 * Time: 3:01 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;


class PagesController extends Controller
{
    public function getPagesList(){
        $pageModel = new Admin\AdminPagesModel;

        $pageListData = $pageModel->getPageListIndex();

        $pageList = array(
            "pageList" => $pageListData,
        );

        return view('admin.pages.pageList', $pageList);
    }

    public function createPage(){
        return view('admin.pages.pageEdit');
    }

    public function pageDetail($pageId){
        $pageMode = new Admin\AdminPagesModel();

        $pageDetailData = $pageMode->getPageDetailIndex($pageId);

        $pageDetail = array(
            "pageDetail" => $pageDetailData
        );

        return view('admin.pages.pageEdit', $pageDetail);
    }

    public function pageReview(){
        $localCode = strtoupper(App::getLocale());

        $headerModel = new Models\HeaderModel();
        $breadCrumbModel = new Models\BreadCrumbsModel();

        /* Init Data */
        $headerData = $headerModel->index($localCode);

        $breadCrumbData = $breadCrumbModel->getBreadCrumbData($localCode, "pages", "P", "page-review", null);

        $pageViewArr = array(
            "headerData" => $headerData,
            "breadCrumb" => $breadCrumbData,
            //"pageCode" => $request->input('pageCode'),
        );

//        $pageCode = array(
//            "htmlCode" =>$request->input('pageCode')
//        );
//        $pageCode = $request->input('pageCode');

        return view('pageView', $pageViewArr);
    }
}