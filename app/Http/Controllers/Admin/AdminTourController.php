<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/1/2016
 * Time: 11:01 AM
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Controllers\Controller;

class AdminTourController extends Controller
{

    public function getTourList(){
        $mdTourAdmin = new Admin\AdminTourModel();

        $tourListData = $mdTourAdmin->getTourListIndexModel();

        $tourListArr = array(
            "tourList" => $tourListData,
        );

        return view('admin.pages.tourList', $tourListArr);
    }

    public function createTour(){
        $mdTourAdmin = new Admin\AdminTourModel();

        $tourInitData = $mdTourAdmin->tourInitData();

        $tourInitData = array(
            "tourInit" => $tourInitData,
        );
        return view('admin.pages.tourEditor', $tourInitData);
    }

    public function getTourDetail($tourId){
        $mdTourAdmin = new Admin\AdminTourModel();

        $tourDetailData = $mdTourAdmin->getTourDetailIndexModel($tourId);

        $tourDetailArr = array(
            "tourEditor" => $tourDetailData,
        );

        return view('admin.pages.tourEditor', $tourDetailArr);
    }

    public function tourEditor(Request $request){
        $mdCommonModel = new Admin\CommonModel();
        $mdAdminTourModel = new Admin\AdminTourModel();
        $photoModel = new Admin\AdminPhotoModel();
        $photoCtrl = new PhotoController();

        if( $request->input('formAction') == "Save"){
            $this->validate($request, [
                'tourTextLink' => 'required|unique:tb_tours,TOUR_TEXT_LINK|max:150',
            ]);
        }
        $this->validate($request, [
            'tourTitleVi' => 'required|max:150',
            'tourTitleEn' => 'required|max:150',
            'tourShrtCntVi' => 'required',
            'tourShrtCntEn' => 'required',
            'tourCntVi' => 'required',
            'tourCntEn' => 'required',
            'tourScheduleVi' => 'required',
            'tourScheduleEn' => 'required',
            'tourLengthVi' => 'required',
            'tourLengthEn' => 'required',
            'tourPriceVi' => 'required|numeric',
            'tourPriceEn' => 'required|numeric',
            'tourPrmPrice' => 'required|numeric    ',
            'tourDescVi' => 'required',
            'tourDescEn' => 'required',
            'tourKeywordVi' => 'required',
            'tourKeywordEn' => 'required',
        ]);

        $tourId = $request->input('formAction') == "Save" ? $mdCommonModel->createPostId('tb_tours','TOUR_ID','T'): $request->input('tourId');
        $tourArr = array(
            "TOUR_ID" => $tourId,
            "TOUR_FTR_YN" => $request->input('tourFrt'),
            "TOUR_RCM_YN" => $request->input('tourRcm'),
            "LOCATION_ID" => $request->input('tourLocation'),
            "TOUR_TIT_VI" => $request->input('tourTitleVi'),
            "TOUR_TIT_EN" => $request->input('tourTitleEn'),
            "TOUR_TEXT_LINK" => $request->input('tourTextLink'),
            "TOUR_SHRT_CNT_VI" => $request->input('tourShrtCntVi'),
            "TOUR_SHRT_CNT_EN" => $request->input('tourShrtCntEn'),
            "TOUR_CNT_VI" => $request->input('tourCntVi'),
            "TOUR_CNT_EN" => $request->input('tourCntEn'),
            "TOUR_SCHEDULE_VI" => $request->input('tourScheduleVi'),
            "TOUR_SCHEDULE_EN" => $request->input('tourScheduleEn'),
            "TOUR_LENGTH_VI" => $request->input('tourLengthVi'),
            "TOUR_LENGTH_EN" => $request->input('tourLengthEn'),
            "TOUR_PRICE_VI" => $request->input('tourPriceVi'),
            "TOUR_PRICE_EN" => $request->input('tourPriceEn'),
            "TOUR_PRM_PRICE" => $request->input('tourPrmPrice'),
            "TOUR_DESCRIPTION_VI" => $request->input('tourDescVi'),
            "TOUR_DESCRIPTION_EN" => $request->input('tourDescEn'),
            "TOUR_KEYWORDS_VI" => $request->input('tourKeywordVi'),
            "TOUR_KEYWORDS_EN" => $request->input('tourKeywordEn'),
        );
        $fileUploadCnt = $request->input('imgUploadListCnt');
        $cateId = $request->input('tourCategory');

        $action = $request->input('formAction');
        if($action == "Save"){  //Save: Insert --- Update: Update
            $status = $mdAdminTourModel->createTour($tourArr);
            if ($status == true){
                $cateStatus = $mdCommonModel->insertPostCategory($tourId, $cateId);
            }
        }else{
            $status = $mdAdminTourModel->updateTour($tourArr, $tourId);
            if ($status == true){
                $cateStatus = $mdCommonModel->updateCategory($tourId, $cateId);
            }
        }

        if ($status == true){
            if ($request->hasFile('rpvImg')){       //insert representative image
                $file = $request->file('rpvImg');
                $path = '/resources/assets/img/uploads/'.$file->getClientOriginalName();
                if (strlen($photoModel->getImgId($path)) < 1) {   //check if image not exist
                    $request->rpvImg->move('resources/assets/img/uploads', $file->getClientOriginalName());
                    $imgId = $photoCtrl->insertImage($path, 'U', $request->input('tourTitleVi'));
                    if ($imgId != 'Fail'){
                        $changeImg = $photoModel->updateRpvImg('tb_tours', $tourId, $imgId,'TOUR_ID', 'TOUR_RPV_IMG_ID');
                        if($changeImg == false)
                            return response()->json(['info' => 'Fail', 'Content' =>  'Update representative image fail.', 'tourId' => $tourId ],200);
                    }else{
                        return response()->json(['info' => 'Fail', 'Content' =>  'Update representative image fail.', 'tourId' => $tourId ],200);
                    }
                }else{
                    $imgId = $photoModel->getImgId($path);
                    $changeImg = $photoModel->updateRpvImg('tb_tours', $tourId, $imgId,'TOUR_ID', 'TOUR_RPV_IMG_ID');
                    if($changeImg == false)
                        return response()->json(['info' => 'Fail', 'Content' =>  'Update representative image fail.', 'tourId' => $tourId ],200);
                }
            }elseif ( strlen($request->input('rpvTxtLink')) > 5 ){
                if (strlen($photoModel->getImgId($request->input('rpvTxtLink'))) < 1){   //check if image not exist
                    $imgId = $photoCtrl->insertImage($request->input('rpvTxtLink'), 'R', $request->input('tourTitleVi'));
                    if ($imgId != 'Fail'){
//                      Change representative image
                        $changeImg = $photoModel->updateRpvImg('tb_tours', $tourId, $imgId,'TOUR_ID', 'TOUR_RPV_IMG_ID');
                        if($changeImg == false)
                            return response()->json(['info' => 'Fail', 'Content' =>  'Update representative image fail.', 'tourId' => $tourId ],200);
                    }
                }else{ //if image already exist
                    $imgId = $photoModel->getImgId($request->input('rpvTxtLink'));    //get Image Id
                    $changeImg = $photoModel->updateRpvImg('tb_tours', $tourId, $imgId,'TOUR_ID', 'TOUR_RPV_IMG_ID');
                    if($changeImg == false)
                        return response()->json(['info' => 'Fail', 'Content' =>  'Update representative image fail.', 'tourId' => $tourId ],200);
                }
            }
//            insert image list
            if (strlen($request->input('imgLinkList')) > 5){
                $imgLinkArr = explode(",", $request->input('imgLinkList'));
                $delImgRef = $photoModel->deleteImgRefByPostId($tourId);
                if ($delImgRef == true) {
                    for ($i = 0; $i < count($imgLinkArr) - 1; $i++) {
                        //                    check link exist
                        if (strlen($photoModel->getImgId($imgLinkArr[$i])) < 1) { //if image not exist
                            $imgId = $photoCtrl->insertImage($imgLinkArr[$i], 'R', $request->input('tourTitleVi'));
                            if ($imgId != 'Fail') {
                                //                            insert img post grp
                                if ($photoModel->checkImgRefExist($imgId, $tourId) == false) { //if not exist
                                    $imgRef = $photoModel->addImgPostRefer($imgId, $tourId);
                                    if ($imgRef == false) return response()->json(['info' => 'Fail', 'Content' => 'Update image list fail.', 'tourId' => $tourId], 200);
                                }
                            }
                        } else { // if image exist
                            $imgId = $photoModel->getImgId($imgLinkArr[$i]);
                            if ($photoModel->checkImgRefExist($imgId, $tourId) == false) {
                                $imgRef = $photoModel->addImgPostRefer($imgId, $tourId);
                                if ($imgRef == false)
                                    return response()->json(['info' => 'Fail', 'Content' => 'Update image list fail.', 'tourId' => $tourId], 200);
                            }
                        }
                    }
                }
            }

            if ($fileUploadCnt > 0){
                for ($i = 0; $i< $fileUploadCnt; $i++){
                    if ($request->hasFile('imgUploadList'.($i+1))){
                        $fileName = 'imgUploadList'.($i+1);
                        $file = $request->file($fileName);
                        $path = '/resources/assets/img/uploads/'.$file->getClientOriginalName();
                        if (strlen($photoModel->getImgId($path)) < 1) {   //check if image not exist
                            $request->$fileName->move('resources/assets/img/uploads', $file->getClientOriginalName());
                            $imgId = $photoCtrl->insertImage($path, 'U', $request->input('tourTitleVi'));
                            if ($imgId != 'Fail'){
//                            insert img post grp
                                $imgRef = $photoModel->addImgPostRefer($imgId,$tourId);
                                if ($imgRef == false){
                                    return response()->json(['info' => 'Fail', 'Content' =>  'Update refer image gallery fail.', 'tourId' => $tourId ],200);
                                }
                            }else{
                                return response()->json(['info' => 'Fail', 'Content' =>  'Update image gallery fail.'.$path, 'tourId' => $tourId ],200);
                            }
                        }else{
                            $imgId = $photoModel->getImgId($path);
                            if($photoModel->checkImgRefExist($imgId, $tourId) == false){
                                $imgRef = $photoModel->addImgPostRefer($imgId,$tourId);
                                if($imgRef == false)
                                    return response()->json(['info' => 'Fail', 'Content' =>  'Update image gallery fail.'.$imgId, 'tourId' => $tourId ],200);
                            }
                        }
                    }
                }
            }
            return response()->json(['info' => 'Success', 'Content' =>  'Update tour complete.', 'tourId' => $tourId ], 200);
        }else{
            return response()->json(['info' => 'Fail', 'Content' =>  'Update tour fail.', 'tourId' => $tourId ], 200);
        }
    }

    public function tourUpdate(Request $request){
        $mdAdminTourModel = new Admin\AdminTourModel();

        $tourId = $request->input('tourId');

        $updateArr = array(
            "TOUR_FTR_YN" => $request->input('tourRpv'),
            "TOUR_RCM_YN" => $request->input('tourRcm'),
            "TOUR_ACT_YN" => $request->input('tourAct'),
        );

        $status = $mdAdminTourModel->updateTour($updateArr, $tourId);

        if ($status == true){
            return response()->json(['info' => 'Success', 'Content' =>  'Update tour complete.', 'tourId' => $tourId ], 200);
        }else{
            return response()->json(['info' => 'Fail', 'Content' =>  'Update tour fail.', 'tourId' => $tourId ], 200);
        }
    }

    public function getTourImage($tourId){
        $photoModel = new Admin\AdminPhotoModel();

        $imgList = $photoModel->getImgReferList('tb_tours', $tourId, 'TOUR_ID');


        return view('','');
    }
}