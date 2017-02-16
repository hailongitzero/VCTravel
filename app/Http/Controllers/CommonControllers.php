<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class CommonControllers extends Controller
{
    /*
     *
     */
    public function search(Request $request){

        /* Load Mode */
        $headerModel = new Models\HeaderModel();
        $breadCrumbModel = new Models\BreadCrumbsModel();
        $cmModel = new Models\CommonModel();

        $localCode = strtoupper(App::getLocale());

        $searchStr = '%';
        $searchCnt = $request->input('txtSearch');

        $str = explode(' ', $searchCnt);

        if (count($str) > 0){
            for ($i = 0; $i < count($str); $i++){
                $searchStr = $searchStr.$str[$i].'%';
            }
            $searchResult = $cmModel->searchIndex($searchStr, $localCode);

        } else{
            $searchResult = null;
        }

        $headerData = $headerModel->index($localCode);
        $breadCrumbData = $breadCrumbModel->getBreadCrumbData($localCode, trans('common.searchResult'), "M", "", count($searchResult['mdSearchList']));
        /*  set data return */
        $searchListArr = array(
            "headerData" => $headerData,
            "searchResult" => $searchResult,
            "breadCrumb" => $breadCrumbData,
        );

        return view('searchResult', $searchListArr);
    }
}
