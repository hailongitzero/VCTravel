<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 9/15/2016
 * Time: 4:05 PM
 */

namespace App\Models;
use DB;


class GuideModel
{
    public function getGuideListIndex($localeCode){
        $guideList = array(
            "mdGuideList" => $this->getGuideListModel($localeCode)
        );

        return $guideList;
    }

    public function getGuideDetailIndex($localeCode, $guideLink){
        $guideDetail = array(
            "mdGuideDetail" => $this->getGuideDetailMode($localeCode, $guideLink),
            "mdPopularGuide" => $this->getPopularGuide($localeCode, $guideLink),
            "mdGuideComment" => $this->getGuideComment($guideLink),
        );

        return $guideDetail;
    }

    /**
     * @param $localeCode
     * @return mixed
     */
    public function getGuideListModel($localeCode){
        $result = DB::table('tb_travel_guide')
            ->join('tb_img_mgmt', 'tb_travel_guide.GUIDE_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->leftJoin(DB::raw('tb_post_grp_connect INNER JOIN tb_post_grp ON tb_post_grp_connect.POST_GRP_ID = tb_post_grp.POST_GRP_ID'), 'tb_travel_guide.GUIDE_ID', '=', 'tb_post_grp_connect.POST_ID')
            ->select(
                'tb_travel_guide.GUIDE_ID AS guideId'
                , 'tb_travel_guide.GUIDE_TITLE_'.$localeCode.' AS guideTit'
                , 'tb_travel_guide.GUIDE_SHR_CNT_'.$localeCode.' AS guideShrCnt'
                , 'tb_travel_guide.GUIDE_TEXT_LINK AS guideTxtLnk'
                , 'tb_travel_guide.GUIDE_KEYWORD_'.$localeCode.' AS guideKeyWord'
                , DB::raw('DATE_FORMAT(tb_travel_guide.GUIDE_CREATE_TIME, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TITLE AS imgTit'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->paginate(9);

        return $result;
    }

    public function getGuideDetailMode($localeCode, $guideLink){
        $result = DB::table('tb_travel_guide')
            ->join('tb_img_mgmt', 'tb_travel_guide.GUIDE_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->leftJoin(DB::raw('tb_post_grp_connect INNER JOIN tb_post_grp ON tb_post_grp_connect.POST_GRP_ID = tb_post_grp.POST_GRP_ID'), 'tb_travel_guide.GUIDE_ID', '=', 'tb_post_grp_connect.POST_ID')
            ->where('tb_travel_guide.GUIDE_TEXT_LINK', '=', $guideLink)
            ->select(
                'tb_travel_guide.GUIDE_ID AS guideId'
                , 'tb_travel_guide.GUIDE_TITLE_'.$localeCode.' AS guideTit'
                , 'tb_travel_guide.GUIDE_SHR_CNT_'.$localeCode.' AS guideShrCnt'
                , 'tb_travel_guide.GUIDE_CNT_'.$localeCode.' AS guideCnt'
                , 'tb_travel_guide.GUIDE_TEXT_LINK AS guideTxtLnk'
                , 'tb_travel_guide.GUIDE_KEYWORD_'.$localeCode.' AS guideKeyWord'
                , 'tb_travel_guide.GUIDE_TOT_STAR_RATE AS guideRateStar'
                , 'tb_travel_guide.GUIDE_TOT_STAR_SEQ AS guideRateSeq'
                , DB::raw('FORMAT((tb_travel_guide.GUIDE_TOT_STAR_RATE / tb_travel_guide.GUIDE_TOT_STAR_SEQ) *20 , 0) AS guideRate')
                , DB::raw('DATE_FORMAT(tb_travel_guide.GUIDE_CREATE_TIME, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TITLE AS imgTit'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->get();

        return $result;
    }

    public function getPopularGuide($localeCode, $guideLink){
        $result = DB::table('tb_travel_guide')
            ->join('tb_img_mgmt', 'tb_travel_guide.GUIDE_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->where('tb_travel_guide.GUIDE_TEXT_LINK', '<>', $guideLink)
            ->orderBy('VIEWS', 'DESC')
            ->orderBy('GUIDE_CREATE_TIME', 'DESC')
            ->select(
                'tb_travel_guide.GUIDE_ID AS newsId'
                , 'tb_travel_guide.GUIDE_TITLE_'.$localeCode.' AS guideTit'
                , 'tb_travel_guide.GUIDE_TEXT_LINK AS guideTxtLnk'
                , DB::raw('DATE_FORMAT(tb_travel_guide.GUIDE_CREATE_TIME, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TITLE AS imgTit'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->take(9)
            ->get();

        return $result;
    }

    public function getGuideComment($guideLink){
        $result = DB::table('tb_post_comment')
            ->join('tb_travel_guide', 'tb_post_comment.POST_ID', '=', 'tb_travel_guide.GUIDE_ID')
            ->where('tb_travel_guide.GUIDE_TEXT_LINK', '=', $guideLink)
            ->orderBy('tb_post_comment.CREATE_TIMESTAMP', 'DESC')
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
}