<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/18/2016
 * Time: 2:53 PM
 */

namespace App\Models;
use DB;


class SliderModel
{
    /** get All data for Slider
     * @param $localeCode
     * @return object
     */
    public function index($localeCode){
        $sliderData = array(
            'sliderContent' => $this->getSliderContent($localeCode),
            'sliderPost' => $this->getSliderPost($localeCode)
        );

        return $sliderData;
    }

    /** return Slider content
     * @param $localeCode
     * @return mixed
     */
    public function getSliderContent($localeCode){
        return DB::table('tb_slide')
            ->select(
                'SLD_ID AS sldId'
                , 'SLD_SEQ AS sldSeq'
                , 'SLD_TITLE_'.$localeCode.' AS sldTit'
                , 'SLD_CONTENT_'.$localeCode.' AS sldCnt'
                , 'SLD_IMG_URL AS sldImgUrl'
                , 'SLD_IMG_ALT AS sldImgAlt'
                , 'SLD_HTML_CODE AS sldHtmlCd'
                , 'SLD_LINK AS sldLnk'
            )
            ->orderBy('SLD_SEQ', 'ASC')
            ->get();
    }

    /** return post display in slider
     * @param $localeCode
     * @return string
     */
    public function getSliderPost($localeCode){

        $result = DB::table('tb_tours')
            ->leftJoin('tb_location', 'tb_tours.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->leftJoin('tb_img_mgmt', 'tb_tours.TOUR_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->where('tb_tours.TOUR_FTR_YN', '=', 'Y')
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
                , 'tb_tours.TOUR_RATE_TOT_SEQ AS tourRateTotSeq'
                , 'tb_tours.TOUR_DESCRIPTION_'.$localeCode.' AS TOUR_DESCRIPTION AS tourDesc'
                , 'tb_tours.TOUR_KEYWORDS_'.$localeCode.' AS TOUR_KEYWORDS AS tourKwd'
                , 'tb_location.NATIONAL_NM_'.$localeCode.' AS ntnNm'
                , 'tb_location.PROVINCE_NM_'.$localeCode.' AS prvNm'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->orderBy('TOUR_RATE_TOT_STAR', 'DESC')
            ->orderBy('TOUR_CREATE_TIMESTAMP', 'DESC')
            ->take(4)
            ->get();
        return $result;
    }
}