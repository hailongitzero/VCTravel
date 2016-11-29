<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/1/2016
 * Time: 1:15 PM
 */

namespace App\Models\Admin;

Use DB;
use App\Models\Admin;
use Mockery\CountValidator\Exception;

class AdminTourModel
{
    public function getTourListIndexModel(){
        $tourList = array(
            "adminTourList" => $this->getTourListModel()
        );

        return $tourList;
    }

    public function tourInitData(){
        $cmModel = new Admin\CommonModel();

        $nationalList = $cmModel->getNationList();
        $locationList = $cmModel->getLocationList();
        $categoryList = $cmModel->getCategoryListByGroup('T');

        $tourInitData = array(
            "nationalList" => $nationalList,
            "locationList" => $locationList,
            "categoryList" => $categoryList,
        );

        return $tourInitData;
    }

    public function getTourDetailIndexModel($tourId){
        $cmModel = new Admin\CommonModel();
        $photoModel = new Admin\AdminPhotoModel();

        $nationalList = $cmModel->getNationList();
        $locationList = $cmModel->getLocationList();
        $photoList = $photoModel->getImgReferList('tb_tours', $tourId, 'TOUR_ID');
        $categoryList = $cmModel->getCategoryListByGroup('T');

        $tourDetail = array(
            "adminTourDetail" => $this->getTourDetailMode($tourId),
            "nationalList" => $nationalList,
            "locationList" => $locationList,
            "photoList" => $photoList,
            "categoryList" => $categoryList,
        );

        return $tourDetail;
    }

    /**
     * @return mixed
     */
    public function getTourListModel(){

        $result = DB::table('tb_tours')
            ->leftJoin('tb_location', 'tb_tours.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->leftJoin('tb_img_mgmt', 'tb_tours.TOUR_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->select(
                'tb_tours.TOUR_ID AS tourId'
                , 'tb_tours.TOUR_TEXT_LINK AS tourTxtLnk'
                , 'tb_tours.TOUR_TIT_VI AS tourTit'
                , 'tb_tours.TOUR_LENGTH_VI AS tourLgt'
                , 'tb_tours.TOUR_PRM_PRICE AS tourPrmPrc'
                , 'tb_tours.TOUR_FTR_YN AS tourFeature'
                , 'tb_tours.TOUR_RCM_YN AS tourRecommend'
                , 'tb_tours.TOUR_ACT_YN AS tourActive'
                , 'tb_tours.TOUR_RATE_TOT_STAR AS tourRateStar'
                , 'tb_tours.TOUR_RATE_TOT_SEQ AS tourRateSeq'
            )
            ->orderBy('TOUR_CREATE_TIMESTAMP', 'DESC')
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->get();

        return $result;
    }

    /**
     * @param $tourId
     * @return mixed
     */
    public function getTourDetailMode($tourId){
        $result = DB::table('tb_tours')
            ->leftJoin('tb_location', 'tb_tours.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->leftJoin('tb_img_mgmt', 'tb_tours.TOUR_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->leftJoin('tb_post_grp_connect', 'tb_tours.TOUR_ID', '=', 'tb_post_grp_connect.POST_ID')
            ->where('tb_tours.TOUR_ID', '=', $tourId)
            ->select(
                'tb_tours.TOUR_ID'
                , 'tb_tours.TOUR_FTR_YN'
                , 'tb_tours.TOUR_RCM_YN'
                , 'tb_tours.TOUR_TEXT_LINK'
                , 'tb_tours.TOUR_TIT_VI'
                , 'tb_tours.TOUR_TIT_EN'
                , 'tb_tours.TOUR_SHRT_CNT_VI'
                , 'tb_tours.TOUR_SHRT_CNT_EN'
                , 'tb_tours.TOUR_CNT_VI'
                , 'tb_tours.TOUR_CNT_EN'
                , 'tb_tours.TOUR_SCHEDULE_VI'
                , 'tb_tours.TOUR_SCHEDULE_EN'
                , 'tb_tours.TOUR_LENGTH_VI'
                , 'tb_tours.TOUR_LENGTH_EN'
                , 'tb_tours.TOUR_PRICE_VI'
                , 'tb_tours.TOUR_PRICE_EN'
                , 'tb_tours.TOUR_PRM_PRICE'
                , 'tb_tours.TOUR_ACT_YN'
                , 'tb_tours.TOUR_DESCRIPTION_VI'
                , 'tb_tours.TOUR_DESCRIPTION_EN'
                , 'tb_tours.TOUR_KEYWORDS_VI'
                , 'tb_tours.TOUR_KEYWORDS_EN'
                , 'tb_tours.LOCATION_ID'
                , 'tb_location.NATIONAL_CD'
                , 'tb_location.NATIONAL_NM_VI'
                , 'tb_location.PROVINCE_NM_VI'
                , 'tb_img_mgmt.IMG_URL'
                , 'tb_img_mgmt.IMG_ALT'
                , 'tb_img_mgmt.IMG_TP'
                , 'tb_post_grp_connect.POST_GRP_ID'
            )
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->orderBy('TOUR_CREATE_TIMESTAMP', 'DESC')
            ->get();
        return $result;
    }

    public function createTour($tourArr){
        $result = true;
        try{
            DB::table('tb_tours')
                ->insert($tourArr);
        }catch (Exception $e){
            $result = false;
        }

        return $result;
    }

    public function updateTour($tourArr, $tourId){
        $result = true;
        try{
            DB::table('tb_tours')
                ->where('TOUR_ID', '=', $tourId)
                ->update($tourArr);
        }catch (Exception $e){
            $result = false;
        }

        return $result;
    }
}