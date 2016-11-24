<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/25/2016
 * Time: 10:12 AM
 */

namespace App\Models;

use DB;
use Illuminate\Database\QueryException;


class TourModel
{
    /*=============================== Index Method ===========================*/

    /** return tour list data
     * @param $localeCode
     * @return array
     */
    public function indexTourList($localeCode){
        $tourList = array(
            "mdTourList" => $this->tourList($localeCode)
        );

        return $tourList;
    }

    public function indexTourListByGroup($localeCode, $groupLink){
        $tourListGroup = array(
            "mdTourListGroup" => $this->tourListByGroup($localeCode, $groupLink),
        );

        return $tourListGroup;
    }

    /** return tour recommended data
     * @param $localeCode
     * @return mixed
     */
    public function indexTourRecommended($localeCode){
        $tourRecommended = array(
            "mdTourRecommended" => $this->tourRecommended($localeCode),
        );

        return $tourRecommended;
    }

    /** return tour detail data
     * @param $localeCode, $tourID
     * @return mixed
     */
    public function indexTourDetail($localeCode, $tourLink){
        $tourDetail = array(
            "mdTourDetail" => $this->tourDetail($localeCode, $tourLink),
            "mdTourDetailImage" => $this->getTourDetailImage($tourLink),
            "mdTourComment" => $this->getTourComment($tourLink),
            "mdTourRelate" => $this->getRelateTour($tourLink, $localeCode),
        );

        return $tourDetail;
    }

    /*================================ Function =====================*/

    /** get tour list
     * @param $localeCode
     * @return mixed
     */
    public function tourList($localeCode){
        $result = DB::table('tb_tours')
            ->leftJoin('tb_location', 'tb_tours.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->leftJoin('tb_img_mgmt', 'tb_tours.TOUR_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->where('tb_tours.TOUR_ACT_YN', '=', 'Y')
            ->select(
                'tb_tours.TOUR_ID AS tourId'
                , 'tb_tours.TOUR_TEXT_LINK AS tourTxtLnk'
                , 'tb_tours.TOUR_TIT_'.$localeCode.' AS tourTit'
                , 'TOUR_SHRT_CNT_'.$localeCode.' AS tourShtCnt'
                , 'tb_tours.TOUR_LENGTH_'.$localeCode.' AS tourLgt'
                , DB::raw('FORMAT(tb_tours.TOUR_PRICE_'.$localeCode.', 0) tourPrc')
                , DB::raw('IF( \''.$localeCode.'\' = \'VI\', \'VND\', \'USD\' ) AS tourCurrUnt')
                , 'tb_tours.TOUR_PRM_PRICE AS tourPrmPrc'
                , 'tb_tours.TOUR_RATE_TOT_STAR AS tourRateStar'
                , 'tb_tours.TOUR_RATE_TOT_SEQ AS tourRateSeq'
                , DB::raw('FORMAT((tb_tours.TOUR_RATE_TOT_STAR / tb_tours.TOUR_RATE_TOT_SEQ) *20 , 0) AS tourRate')
                , DB::raw('DATE_FORMAT(tb_tours.TOUR_CREATE_TIMESTAMP, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_tours.TOUR_DESCRIPTION_'.$localeCode.' AS tourDesc'
                , 'tb_tours.TOUR_KEYWORDS_'.$localeCode.' AS tourKwd'
                , 'tb_location.NATIONAL_NM_'.$localeCode.' AS ntnNm'
                , 'tb_location.PROVINCE_NM_'.$localeCode.' AS prvNm'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->orderBy('TOUR_CREATE_TIMESTAMP', 'DESC')
            ->paginate(9);

        return $result;
    }

    /** get tour list
     * @param $localeCode, $groupLink
     * @return mixed
     */
    public function tourListByGroup($localeCode, $groupLink){
        $result = DB::table('tb_tours')
            ->leftJoin('tb_location', 'tb_tours.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->leftJoin('tb_img_mgmt', 'tb_tours.TOUR_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->leftJoin(DB::raw('tb_post_grp_connect INNER JOIN tb_post_grp ON tb_post_grp_connect.POST_GRP_ID = tb_post_grp.POST_GRP_ID'), 'tb_tours.TOUR_ID', '=', 'tb_post_grp_connect.POST_ID')
            ->where('tb_tours.TOUR_ACT_YN', '=', 'Y')
            ->where('tb_post_grp.POST_LINK', '=', $groupLink)
            ->select(
                'tb_tours.TOUR_ID AS tourId'
                , 'tb_tours.TOUR_TEXT_LINK AS tourTxtLnk'
                , 'tb_tours.TOUR_TIT_'.$localeCode.' AS tourTit'
                , 'TOUR_SHRT_CNT_'.$localeCode.' AS tourShtCnt'
                , 'tb_tours.TOUR_LENGTH_'.$localeCode.' AS tourLgt'
                , DB::raw('FORMAT(tb_tours.TOUR_PRICE_'.$localeCode.', 0) tourPrc')
                , DB::raw('IF( \''.$localeCode.'\' = \'VI\', \'VND\', \'USD\' ) AS tourCurrUnt')
                , 'tb_tours.TOUR_PRM_PRICE AS tourPrmPrc'
                , 'tb_tours.TOUR_RATE_TOT_STAR AS tourRateStar'
                , 'tb_tours.TOUR_RATE_TOT_SEQ AS tourRateSeq'
                , DB::raw('FORMAT((tb_tours.TOUR_RATE_TOT_STAR / tb_tours.TOUR_RATE_TOT_SEQ) *20 , 0) AS tourRate')
                , DB::raw('DATE_FORMAT(tb_tours.TOUR_CREATE_TIMESTAMP, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_tours.TOUR_DESCRIPTION_'.$localeCode.' AS tourDesc'
                , 'tb_tours.TOUR_KEYWORDS_'.$localeCode.' AS tourKwd'
                , 'tb_location.NATIONAL_NM_'.$localeCode.' AS ntnNm'
                , 'tb_location.PROVINCE_NM_'.$localeCode.' AS prvNm'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->orderBy('TOUR_CREATE_TIMESTAMP', 'DESC')
            ->paginate(9);

        return $result;
    }

    /** get tour recommended
     * @param $localeCode
     * @return mixed
     */
    public function tourRecommended($localeCode){
        $result = DB::table('tb_tours')
            ->leftJoin('tb_location', 'tb_tours.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->leftJoin('tb_img_mgmt', 'tb_tours.TOUR_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->where('tb_tours.TOUR_RCM_YN', '=', 'Y')
            ->where('tb_tours.TOUR_ACT_YN', '=', 'Y')
            ->select(
                'tb_tours.TOUR_ID AS tourId'
                , 'tb_tours.TOUR_TEXT_LINK AS tourTxtLnk'
                , 'tb_tours.TOUR_TIT_'.$localeCode.' AS tourTit'
                , 'TOUR_SHRT_CNT_'.$localeCode.' AS tourShtCnt'
                , 'tb_tours.TOUR_LENGTH_'.$localeCode.' AS tourLgt'
                , DB::raw('FORMAT(tb_tours.TOUR_PRICE_'.$localeCode.', 0) tourPrc')
                , DB::raw('IF( \''.$localeCode.'\' = \'VI\', \'VND\', \'USD\' ) AS tourCurrUnt')
                , 'tb_tours.TOUR_PRM_PRICE AS tourPrmPrc'
                , 'tb_tours.TOUR_RATE_TOT_STAR AS tourRateStar'
                , 'tb_tours.TOUR_RATE_TOT_SEQ AS tourRateSeq'
                , DB::raw('FORMAT((tb_tours.TOUR_RATE_TOT_STAR / tb_tours.TOUR_RATE_TOT_SEQ) *20 , 0) AS tourRate')
                , DB::raw('DATE_FORMAT(tb_tours.TOUR_CREATE_TIMESTAMP, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_tours.TOUR_DESCRIPTION_'.$localeCode.' AS tourDesc'
                , 'tb_tours.TOUR_KEYWORDS_'.$localeCode.' AS tourKwd'
                , 'tb_location.NATIONAL_NM_'.$localeCode.' AS ntnNm'
                , 'tb_location.PROVINCE_NM_'.$localeCode.' AS prvNm'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->orderBy('VIEWS', 'DESC')
            ->orderBy('TOUR_CREATE_TIMESTAMP', 'DESC')
            ->take(9)
            ->get();

        return $result;
    }

    /** get tour Detail
     * @param $localeCode, $tourLink
     * @return mixed
     */
    public function tourDetail($localeCode, $tourLink){
        $result = DB::table('tb_tours')
            ->leftJoin('tb_location', 'tb_tours.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->leftJoin('tb_img_mgmt', 'tb_tours.TOUR_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->where('tb_tours.TOUR_TEXT_LINK', '=', $tourLink)
            ->where('tb_tours.TOUR_ACT_YN', '=', 'Y')
            ->select(
                'tb_tours.TOUR_ID AS tourId'
                , 'tb_tours.TOUR_TEXT_LINK AS tourTxtLnk'
                , 'tb_tours.TOUR_TIT_'.$localeCode.' AS tourTit'
                , 'TOUR_SHRT_CNT_'.$localeCode.' AS tourShtCnt'
                , 'TOUR_CNT_'.$localeCode.' AS tourCnt'
                , 'TOUR_SCHEDULE_'.$localeCode.' AS tourSchedule'
                , 'tb_tours.TOUR_LENGTH_'.$localeCode.' AS tourLgt'
                , DB::raw('FORMAT(tb_tours.TOUR_PRICE_'.$localeCode.', 0) AS tourPrc')
                , DB::raw('IF( \''.$localeCode.'\' = \'VI\', \'VND\', \'USD\' ) AS tourCurrUnt')
                , 'tb_tours.TOUR_PRM_PRICE AS tourPrmPrc'
                , DB::raw('FORMAT(tb_tours.TOUR_PRICE_'.$localeCode.' * (100 - tb_tours.TOUR_PRM_PRICE) / 100, 0) AS tourFnlPrc')
                , 'tb_tours.TOUR_RATE_TOT_STAR AS tourRateStar'
                , 'tb_tours.TOUR_RATE_TOT_SEQ AS tourRateSeq'
                , DB::raw('FORMAT((tb_tours.TOUR_RATE_TOT_STAR / tb_tours.TOUR_RATE_TOT_SEQ) *20 , 0) AS tourRate')
                , DB::raw('DATE_FORMAT(tb_tours.TOUR_CREATE_TIMESTAMP, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_tours.TOUR_DESCRIPTION_'.$localeCode.' AS tourDesc'
                , 'tb_tours.TOUR_KEYWORDS_'.$localeCode.' AS tourKwd'
                , 'tb_location.NATIONAL_NM_'.$localeCode.' AS ntnNm'
                , 'tb_location.PROVINCE_NM_'.$localeCode.' AS prvNm'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->orderBy('TOUR_CREATE_TIMESTAMP', 'DESC')
            ->get();
        return $result;
    }

    /** get tour detail image
     * @param $tourLink
     * @return mixed
     */
    public function getTourDetailImage($tourLink){
        $result = DB::table('tb_img_mgmt')
            ->leftJoin(DB::raw('(tb_post_img_grp INNER JOIN tb_tours ON tb_tours.TOUR_ID = tb_post_img_grp.POST_ID)'), 'tb_img_mgmt.IMG_ID', '=', 'tb_post_img_grp.IMG_ID')
            ->where('tb_tours.TOUR_TEXT_LINK', '=', $tourLink)
            ->select(
                'tb_img_mgmt.IMG_ID AS imgId'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
                , 'tb_img_mgmt.IMG_TITLE AS imgTit'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_tours.TOUR_ID AS tourId'
                , 'tb_tours.TOUR_TEXT_LINK AS tourTxtLnk'
            )
            ->get();
        return $result;
    }

    /**
     * @param $tourLink
     * @return mixed
     */
    public function getTourComment($tourLink){
        $result = DB::table('tb_post_comment')
            ->join('tb_tours', 'tb_tours.TOUR_ID', '=', 'tb_post_comment.POST_ID')
            ->where('tb_tours.TOUR_TEXT_LINK', '=', $tourLink)
            ->orderBy('CREATE_TIMESTAMP', 'DESC')
            ->select(
                'tb_post_comment.COMMENT_ID AS cmId'
                , 'tb_post_comment.POST_ID AS cmPostId'
                , 'tb_post_comment.FIRST_NAME AS cmFName'
                , 'tb_post_comment.LAST_NAME AS cmLName'
                , 'tb_post_comment.EMAIL AS cmEmail'
                , 'tb_post_comment.COMMENT_TITLE AS cmTit'
                , 'tb_post_comment.COMMENT_CONTENT AS cmCnt'
                , 'tb_post_comment.COMMENT_RATE AS cmRate'
                , DB::raw('DATE_FORMAT(tb_post_comment.CREATE_TIMESTAMP, "%a, %d-%m-%Y") AS cmCrtDt')
            )
            ->paginate(5);

        return $result;
    }

    /**
     * @param $bookingArray
     * @return bool
     */
    public function tourBooking($bookingArray){
        $result = true;
        try{
            DB::table('tb_tour_booking')
                ->insert($bookingArray);
        }catch (QueryException $e){
            $result = false;
        }

        return $result;
    }

    /**
     * @param $reviewArray
     * @return bool
     */
    public function tourReview($reviewArray, $rate, $id){
        $result = true;
        try{
            DB::table('tb_tours')
                ->where("TOUR_ID", "=", $id)
                ->increment('TOUR_RATE_TOT_SEQ');
            DB::table('tb_tours')
                ->where("TOUR_ID", "=", $id)
                ->increment('TOUR_RATE_TOT_STAR', $rate);

            DB::table('tb_post_comment')
                ->insert($reviewArray);
        }catch (QueryException $e){
            $result = false;
        }

        return $result;
    }

    /**
     * @param $tourLink
     * @param $localeCode
     * @return mixed
     */
    public function getRelateTour($tourLink, $localeCode){
        $result = DB::table('tb_tours')
            ->leftJoin('tb_location', 'tb_tours.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->leftJoin('tb_img_mgmt', 'tb_tours.TOUR_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->where('tb_tours.LOCATION_ID', '=', $this->getTourLocation($tourLink))
            ->where('tb_tours.TOUR_TEXT_LINK', '<>', $tourLink)
            ->where('tb_tours.TOUR_RCM_YN', '=', 'Y')
            ->where('tb_tours.TOUR_ACT_YN', '=', 'Y')
            ->select(
                'tb_tours.TOUR_ID AS tourId'
                , 'tb_tours.TOUR_TEXT_LINK AS tourTxtLnk'
                , 'tb_tours.TOUR_TIT_'.$localeCode.' AS tourTit'
                , 'tb_tours.TOUR_LENGTH_'.$localeCode.' AS tourLgt'
                , DB::raw('FORMAT(tb_tours.TOUR_PRICE_'.$localeCode.', 0) tourPrc')
                , DB::raw('IF( \''.$localeCode.'\' = \'VI\', \'VND\', \'USD\' ) AS tourCurrUnt')
                , 'tb_tours.TOUR_PRM_PRICE AS tourPrmPrc'
                , 'tb_tours.TOUR_RATE_TOT_STAR AS tourRateStar'
                , 'tb_tours.TOUR_RATE_TOT_SEQ AS tourRateSeq'
                , DB::raw('FORMAT((tb_tours.TOUR_RATE_TOT_STAR / tb_tours.TOUR_RATE_TOT_SEQ) *20 , 0) AS tourRate')
                , DB::raw('DATE_FORMAT(tb_tours.TOUR_CREATE_TIMESTAMP, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_location.NATIONAL_NM_'.$localeCode.' AS ntnNm'
                , 'tb_location.PROVINCE_NM_'.$localeCode.' AS prvNm'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->orderBy('TOUR_CREATE_TIMESTAMP', 'DESC')
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->take(9)
            ->get();

        return $result;
    }

    /**
     * @param $tourLink
     * @return mixed
     */
    public function getTourLocation($tourLink){
        $result = DB::table('tb_tours')
            ->where('tb_tours.TOUR_TEXT_LINK', '=', $tourLink)
            ->select(
                'tb_tours.LOCATION_ID AS localId'
            )
            ->get();
        foreach ($result as $rs){
            $localId = $rs->localId;
        }

        return $localId;
    }
}