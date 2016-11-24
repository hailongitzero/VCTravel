<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 9/7/2016
 * Time: 3:14 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class PagesController extends Controller
{
    /** pages navigator controller
     * @param $pageLink
     * @return View
     */
    public function getPagesRedirect($pageLink)
    {
        $localCode = strtoupper(App::getLocale());

        /* Load Mode */
        $headerModel = new Models\HeaderModel();
        $breadCrumbModel = new Models\breadCrumbsModel();
        $pageModel = new Models\PagesModel();

        /* Init Data */
        $headerData = $headerModel->index($localCode);
        $pageData = $pageModel->getPageIndex($localCode, $pageLink);

        $breadCrumbData = $breadCrumbModel->getBreadCrumbData($localCode, "pages", "P", $pageLink, null);

        $pageArray = array(
            "headerData" => $headerData,
            "breadCrumb" => $breadCrumbData,
            "pages" => $pageData,
        );

        return view('pages',$pageArray);
    }
}