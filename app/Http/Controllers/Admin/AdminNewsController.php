<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/28/2016
 * Time: 10:43 AM
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Controllers\Controller;

class AdminNewsController extends Controller
{
    public function getNewsList(){
        $mdNewsAdmin = new Admin\AdminNewsModel();

        $newsistData = $mdNewsAdmin->getNewsListIndexModel();

        $newsListArr = array(
            "newsList" => $newsistData,
        );

        return view('admin.pages.newsList', $newsListArr);
    }

    public function createNews(){
        $mdNewsAdmin = new Admin\AdminNewsModel();

        $newsInitData = $mdNewsAdmin->newsInitData();

        $newsInitData = array(
            "newsInit" => $newsInitData,
        );
        return view('admin.pages.newsEditor', $newsInitData);
    }

    public function newsDetail($newsId){
        $mdNewsAdmin = new Admin\AdminNewsModel();

        $newsDetailData = $mdNewsAdmin->getNewsDetailIndex($newsId);

        $newsDetail = array(
            "newsDetail" => $newsDetailData,
        );

        return view('admin.pages.newsEditor', $newsDetail);
    }

    public function newsEditor(Request $request){
        $CommonModel = new Admin\CommonModel();
        $adminNewsModel = new Admin\AdminNewsModel();
        $photoModel = new Admin\AdminPhotoModel();
        $photoCtrl = new PhotoController();

        if( $request->input('formAction') == "Save"){
            $this->validate($request, [
                'newsTextLink' => 'required|unique:tb_tours,TOUR_TEXT_LINK|max:150',
            ]);
        }

        $this->validate($request, [
            'newsTitleVi' => 'required|max:150',
            'newsTitleEn' => 'required|max:150',
            'newsTextLink' => 'required',
            'newsShrtCntVi' => 'required',
            'newsShrtCntEn' => 'required',
            'newsCntVi' => 'required',
            'newsCntEn' => 'required',
            'newsKeywordVi' => 'required',
            'newsKeywordEn' => 'required',
        ]);

        $newsId = $request->input('formAction') == "Save" ? $CommonModel->createPostId('tb_news','NEWS_ID','N'): $request->input('newsId');

        $newsArr = array(
            'NEWS_ID' => $newsId,
            'NEWS_TITLE_VI' => $request->input('newsTitleVi'),
            'NEWS_TITLE_EN' => $request->input('newsTitleEn'),
            'NEWS_SHRT_CNT_VI' => $request->input('newsShrtCntVi'),
            'NEWS_SHRT_CNT_EN' => $request->input('newsShrtCntEn'),
            'NEWS_CNT_VI' => $request->input('newsCntVi'),
            'NEWS_CNT_EN' => $request->input('newsCntEn'),
            'NEWS_TEXT_LINK' => $request->input('newsTextLink'),
            'NEWS_HOT_YN' => $request->input('newsHot'),
            'NEWS_KEYWORD_VI' => $request->input('newsKeywordVi'),
            'NEWS_KEYWORD_EN' => $request->input('newsKeywordEn'),
        );

        $cateId = $request->input('newsCategory');
        $action = $request->input('formAction');

        if($action == "Save"){  //Save: Insert --- Update: Update
            $status = $adminNewsModel->createNews($newsArr);
            if ($status == true){
                $cateStatus = $CommonModel->insertPostCategory($newsId, $cateId);
            }
        }else{
            $status = $adminNewsModel->updateNews($newsId, $newsArr);
            if ($status == true){
                $cateStatus = $CommonModel->updateCategory($newsId, $cateId);
            }
        }

        if ($status == true){
            if ($request->hasFile('rpvImg')){       //insert representative image
                $file = $request->file('rpvImg');
                $path = '/resources/assets/img/uploads/'.$file->getClientOriginalName();
                if (strlen($photoModel->getImgId($path)) < 1) {   //check if image not exist
                    $request->rpvImg->move('resources/assets/img/uploads', $file->getClientOriginalName());
                    $imgId = $photoCtrl->insertImage($path, 'U', $request->input('newsTitleVi'));
                    if ($imgId != 'Fail'){
                        $changeImg = $photoModel->updateRpvImg('tb_news', $newsId, $imgId,'NEWS_ID', 'NEWS_RPV_IMG_ID');
                        if($changeImg == false)
                            return response()->json(['info' => 'Fail', 'Content' =>  'Update representative image fail.', 'newsId' => $newsId ],200);
                    }else{
                        return response()->json(['info' => 'Fail', 'Content' =>  'Update representative image fail.', 'newsId' => $newsId ],200);
                    }
                }else{
                    $imgId = $photoModel->getImgId($path);
                    $changeImg = $photoModel->updateRpvImg('tb_news', $newsId, $imgId,'NEWS_ID', 'NEWS_RPV_IMG_ID');
                    if($changeImg == false)
                        return response()->json(['info' => 'Fail', 'Content' =>  'Update representative image fail.', 'newsId' => $newsId ],200);
                }
            }elseif ( strlen($request->input('rpvTxtLink')) > 5 ){
                if (strlen($photoModel->getImgId($request->input('rpvTxtLink'))) < 1){   //check if image not exist
                    $imgId = $photoCtrl->insertImage($request->input('rpvTxtLink'), 'R', $request->input('newsTitleVi'));
                    if ($imgId != 'Fail'){
//                      Change representative image
                        $changeImg = $photoModel->updateRpvImg('tb_news', $newsId, $imgId,'NEWS_ID', 'NEWS_RPV_IMG_ID');
                        if($changeImg == false)
                            return response()->json(['info' => 'Fail', 'Content' =>  'Update representative image fail.', 'newsId' => $newsId ],200);
                    }
                }else{ //if image already exist
                    $imgId = $photoModel->getImgId($request->input('rpvTxtLink'));    //get Image Id
                    $changeImg = $photoModel->updateRpvImg('tb_news', $newsId, $imgId,'NEWS_ID', 'NEWS_RPV_IMG_ID');
                    if($changeImg == false)
                        return response()->json(['info' => 'Fail', 'Content' =>  'Update representative image fail.', 'newsId' => $newsId ],200);
                }
            }
            return response()->json(['info' => 'Success', 'Content' =>  'Update news complete.', 'newsId' => $newsId ], 200);
        }else{
            return response()->json(['info' => 'Fail', 'Content' =>  'Update news fail.', 'newsId' => $newsId ], 200);
        }
    }

    public function newsUpdate(Request $request){
        $adminNewsModel = new Admin\AdminNewsModel();

        $newsId = $request->input('newsId');

        $updateArr = array(
            "NEWS_HOT_YN" => $request->input('newsHot'),
            "NEWS_ACT_YN" => $request->input('newsAct'),
        );

        $status = $adminNewsModel->updateNews($newsId, $updateArr);

        if ($status == true){
            return response()->json(['info' => 'Success', 'Content' =>  'Update tour complete.', 'newsId' => $newsId ], 200);
        }else{
            return response()->json(['info' => 'Fail', 'Content' =>  'Update tour fail.', 'newsId' => $newsId ], 200);
        }
    }
}