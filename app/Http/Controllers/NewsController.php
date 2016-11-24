<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 9/8/2016
 * Time: 4:24 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * @param $localeCode
     * @return array
     */
    public function getNewsList(){
        $localCode = strtoupper(App::getLocale());

        /* Load Mode */
        $headerModel = new Models\HeaderModel();
        $breadCrumbModel = new Models\breadCrumbsModel();
        $newsModel = new Models\NewsModel();

        /* Init Data */
        $headerData = $headerModel->index($localCode);
        $newsListData = $newsModel->getNewsListIndex($localCode);

        $breadCrumbData = $breadCrumbModel->getBreadCrumbData($localCode, "news", "M", "", null);

        $newsListArr = array(
            "headerData" => $headerData,
            "breadCrumb" => $breadCrumbData,
            "newsList" => $newsListData,
        );

        return view('newsList', $newsListArr);
    }

    /**
     * @param $localeCode
     * @param $groupLink
     * @return array
     */
    public function getNewsListGroup($groupLink){
        $localCode = strtoupper(App::getLocale());

        /* Load Mode */
        $headerModel = new Models\HeaderModel();
        $breadCrumbModel = new Models\breadCrumbsModel();
        $newsModel = new Models\NewsModel();

        /* Init Data */
        $headerData = $headerModel->index($localCode);
        $newsListGroupData = $newsModel->getNewsListGroupIndex($localCode, $groupLink);

        $breadCrumbData = $breadCrumbModel->getBreadCrumbData($localCode, "news", "C", $groupLink, $newsListGroupData['mdNewsListGroup']->total());

        $newsListArr = array(
            "headerData" => $headerData,
            "breadCrumb" => $breadCrumbData,
            "newsListGroup" => $newsListGroupData,
        );

        return view('newsList', $newsListArr);
    }

    /**
     * @param $newsLink
     * @return array
     */
    public function getNewsDetail($newsLink){
        $localCode = strtoupper(App::getLocale());

        /* Load Mode */
        $headerModel = new Models\HeaderModel();
        $breadCrumbModel = new Models\breadCrumbsModel();
        $newsModel = new Models\NewsModel();
        $commonModel = new Models\CommonModel();

        /* Init Data */
        $headerData = $headerModel->index($localCode);
        $newsDetailData = $newsModel->getNewsDetailIndex($localCode, $newsLink);

        $breadCrumbData = $breadCrumbModel->getBreadCrumbData($localCode, "news", "N", $newsLink, null);

        /* Update Views */
        $commonModel->updateViews("tb_news", "NEWS_TEXT_LINK", $newsLink);

        $newsListArr = array(
            "headerData" => $headerData,
            "breadCrumb" => $breadCrumbData,
            "newsDetail" => $newsDetailData,
        );

        return view('newsDetail', $newsListArr);
    }
}