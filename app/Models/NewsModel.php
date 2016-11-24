<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/29/2016
 * Time: 11:52 AM
 */

namespace App\Models;

use DB;

class NewsModel
{
    /**
     * @param $localeCode
     * @return latest News data
     */
    public function latestNewsIndex($localeCode){
        $latestNews = array(
            "latestNews" => $this->latestNewsData($localeCode),
        );

        return $latestNews;
    }

    /**
     * @param $localeCode
     * @return array
     */
    public function getNewsListIndex($localeCode){
        $newsList = array(
            "mdNewsList" => $this->getNewsListModel($localeCode),
        );

        return $newsList;
    }

    /**
     * @param $localeCode
     * @param $groupLink
     * @return array
     */
    public function getNewsListGroupIndex($localeCode, $groupLink){
        $newsGroupList = array(
            "mdNewsListGroup" => $this->getNewsListGroupModel($localeCode, $groupLink),
        );

        return $newsGroupList;
    }

    /**
     * @param $localeCode
     * @param $newsLink
     * @return array
     */
    public function getNewsDetailIndex($localeCode, $newsLink){
        $newsDetail = array(
            "mdNewsDetail" => $this->getNewsDetailModel($localeCode, $newsLink),
            "mdNewsPopular" => $this->getPopularNews($localeCode, $newsLink),
            "mdNewsComment" => $this->getNewsComment($newsLink),
        );

        return $newsDetail;
    }

    /** get latest news data
     * @param $localeCode
     * @return latest News data
     */
    public function latestNewsData($localeCode){
        $result = DB::table('tb_news')
            ->leftJoin('tb_img_mgmt', 'tb_news.NEWS_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->where('tb_news.NEWS_HOT_YN', '=', 'Y')
            ->where('tb_news.NEWS_ACT_YN', '=', 'Y')
            ->orderBy('NEWS_CREATE_TIMESTAMP', 'DESC')
            ->select(
                'tb_news.NEWS_ID AS nwsId'
                , 'tb_news.NEWS_TITLE_'.$localeCode.' AS nwsTit'
                , 'tb_news.NEWS_SHRT_CNT_'.$localeCode.' AS nwsShtCnt'
                , 'tb_news.NEWS_HOT_YN AS nwsHotYn'
                , 'tb_news.NEWS_ACT_YN AS nwsActYn'
                , 'tb_news.NEWS_KEYWORD_'.$localeCode.' AS nwsKwd'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
                , DB::raw('DATE_FORMAT(tb_news.NEWS_CREATE_TIMESTAMP, "%a, %d-%m-%Y") AS crtDt')
            )
            ->take(5)
            ->get();

        return $result;
    }

    /**
     * @param $localeCode
     * @return mixed
     */
    public function getNewsListModel($localeCode){
        $travelNews = DB::table('tb_news')
            ->join('tb_img_mgmt', 'tb_news.NEWS_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->join('tb_location', 'tb_news.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->leftJoin(DB::raw('tb_post_grp_connect INNER JOIN tb_post_grp ON tb_post_grp_connect.POST_GRP_ID = tb_post_grp.POST_GRP_ID'), 'tb_news.NEWS_ID', '=', 'tb_post_grp_connect.POST_ID')
            ->where('tb_post_grp.POST_GRP_ID', '=', 'N00001')
            ->orderBy('tb_news.NEWS_CREATE_TIMESTAMP', 'DESC')
            ->select(
                'tb_news.NEWS_ID AS newsId'
                , 'tb_news.NEWS_TITLE_'.$localeCode.' AS newsTit'
                , 'tb_news.NEWS_SHRT_CNT_'.$localeCode.' AS newsShrCnt'
                , 'tb_news.NEWS_TEXT_LINK AS newsTxtLnk'
                , 'tb_news.NEWS_KEYWORD_'.$localeCode.' AS newsKeyWord'
                , DB::raw('DATE_FORMAT(tb_news.NEWS_CREATE_TIMESTAMP, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_location.NATIONAL_NM_'.$localeCode.' AS ntnNm'
                , 'tb_location.PROVINCE_NM_'.$localeCode.' AS prvNm'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TITLE AS imgTit'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->take(6)
            ->get();

        $promotionNews = DB::table('tb_news')
            ->join('tb_img_mgmt', 'tb_news.NEWS_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->join('tb_location', 'tb_news.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->leftJoin(DB::raw('tb_post_grp_connect INNER JOIN tb_post_grp ON tb_post_grp_connect.POST_GRP_ID = tb_post_grp.POST_GRP_ID'), 'tb_news.NEWS_ID', '=', 'tb_post_grp_connect.POST_ID')
            ->where('tb_post_grp.POST_GRP_ID', '=', 'N00002')
            ->orderBy('tb_news.NEWS_CREATE_TIMESTAMP', 'DESC')
            ->select(
                'tb_news.NEWS_ID AS newsId'
                , 'tb_news.NEWS_TITLE_'.$localeCode.' AS newsTit'
                , 'tb_news.NEWS_SHRT_CNT_'.$localeCode.' AS newsShrCnt'
                , 'tb_news.NEWS_TEXT_LINK AS newsTxtLnk'
                , 'tb_news.NEWS_KEYWORD_'.$localeCode.' AS newsKeyWord'
                , DB::raw('DATE_FORMAT(tb_news.NEWS_CREATE_TIMESTAMP, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_location.NATIONAL_NM_'.$localeCode.' AS ntnNm'
                , 'tb_location.PROVINCE_NM_'.$localeCode.' AS prvNm'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TITLE AS imgTit'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->take(6)
            ->get();

        $generalNews = DB::table('tb_news')
            ->join('tb_img_mgmt', 'tb_news.NEWS_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->join('tb_location', 'tb_news.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->leftJoin(DB::raw('tb_post_grp_connect INNER JOIN tb_post_grp ON tb_post_grp_connect.POST_GRP_ID = tb_post_grp.POST_GRP_ID'), 'tb_news.NEWS_ID', '=', 'tb_post_grp_connect.POST_ID')
            ->where('tb_post_grp.POST_GRP_ID', '=', 'N00003')
            ->orderBy('tb_news.NEWS_CREATE_TIMESTAMP', 'DESC')
            ->select(
                'tb_news.NEWS_ID AS newsId'
                , 'tb_news.NEWS_TITLE_'.$localeCode.' AS newsTit'
                , 'tb_news.NEWS_SHRT_CNT_'.$localeCode.' AS newsShrCnt'
                , 'tb_news.NEWS_TEXT_LINK AS newsTxtLnk'
                , 'tb_news.NEWS_KEYWORD_'.$localeCode.' AS newsKeyWord'
                , DB::raw('DATE_FORMAT(tb_news.NEWS_CREATE_TIMESTAMP, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_location.NATIONAL_NM_'.$localeCode.' AS ntnNm'
                , 'tb_location.PROVINCE_NM_'.$localeCode.' AS prvNm'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TITLE AS imgTit'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->take(6)
            ->get();

        $travel = array(
            "newsGroup" => $this->getNewsGroup($localeCode, 'N00001'),
            "newsList" => $travelNews,
        );
        $promotion = array(
            "newsGroup" => $this->getNewsGroup($localeCode, 'N00002'),
            "newsList" => $promotionNews,
        );
        $general = array(
            "newsGroup" => $this->getNewsGroup($localeCode, 'N00003'),
            "newsList" => $generalNews,
        );

        $result = array(
            "travelNews" => $travel,
            "promotionNews" => $promotion,
            "general" => $general,
        );

        return $result;
    }

    /**
     * @param $localeCode
     * @param $groupLink
     * @return mixed
     */
    public function getNewsListGroupModel($localeCode, $groupLink){
        $result = DB::table('tb_news')
            ->join('tb_img_mgmt', 'tb_news.NEWS_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->join('tb_location', 'tb_news.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->leftJoin(DB::raw('tb_post_grp_connect INNER JOIN tb_post_grp ON tb_post_grp_connect.POST_GRP_ID = tb_post_grp.POST_GRP_ID'), 'tb_news.NEWS_ID', '=', 'tb_post_grp_connect.POST_ID')
            ->where('tb_post_grp.POST_LINK', '=', $groupLink)
            ->select(
                'tb_news.NEWS_ID AS newsId'
                , 'tb_news.NEWS_TITLE_'.$localeCode.' AS newsTit'
                , 'tb_news.NEWS_SHRT_CNT_'.$localeCode.' AS newsShrCnt'
                , 'tb_news.NEWS_TEXT_LINK AS newsTxtLnk'
                , 'tb_news.NEWS_KEYWORD_'.$localeCode.' AS newsKeyWord'
                , DB::raw('DATE_FORMAT(tb_news.NEWS_CREATE_TIMESTAMP, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_location.NATIONAL_NM_'.$localeCode.' AS ntnNm'
                , 'tb_location.PROVINCE_NM_'.$localeCode.' AS prvNm'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TITLE AS imgTit'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->paginate(9);

        return $result;
    }

    /**
     * @param $localeCode
     * @param $newsLink
     * @return mixed
     */
    public function getNewsDetailModel($localeCode, $newsLink){
        $result = DB::table('tb_news')
            ->join('tb_img_mgmt', 'tb_news.NEWS_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->join('tb_location', 'tb_news.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->leftJoin(DB::raw('tb_post_grp_connect INNER JOIN tb_post_grp ON tb_post_grp_connect.POST_GRP_ID = tb_post_grp.POST_GRP_ID'), 'tb_news.NEWS_ID', '=', 'tb_post_grp_connect.POST_ID')
            ->where('tb_news.NEWS_TEXT_LINK', '=', $newsLink)
            ->select(
                'tb_news.NEWS_ID AS newsId'
                , 'tb_news.NEWS_TITLE_'.$localeCode.' AS newsTit'
                , 'tb_news.NEWS_SHRT_CNT_'.$localeCode.' AS newsShrCnt'
                , 'tb_news.NEWS_CNT_'.$localeCode.' AS newsCnt'
                , 'tb_news.NEWS_TEXT_LINK AS newsTxtLnk'
                , 'tb_news.NEWS_KEYWORD_'.$localeCode.' AS newsKeyWord'
                , DB::raw('DATE_FORMAT(tb_news.NEWS_CREATE_TIMESTAMP, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_location.NATIONAL_NM_'.$localeCode.' AS ntnNm'
                , 'tb_location.PROVINCE_NM_'.$localeCode.' AS prvNm'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TITLE AS imgTit'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->get();

        return $result;
    }

    /**
     * @param $localeCode
     * @param $grpId
     * @return mixed
     */
    public function getNewsGroup($localeCode, $grpId){
        $newsGroup = DB::table('tb_post_grp')
            ->where('tb_post_grp.POST_GRP_ID', '=', $grpId)
            ->select(
                'tb_post_grp.POST_GRP_ID AS grpId'
                , 'tb_post_grp.POST_NM_'.$localeCode.' AS grpNm'
                , 'tb_post_grp.POST_INTRO_'.$localeCode.' AS grpIntro'
                , 'tb_post_grp.POST_RPV_IMG_ID AS grpImg'
                , 'tb_post_grp.POST_LINK AS grpLink'
            )
            ->get();

        return $newsGroup;
    }

    /**
     * @param $localeCode
     * @param $newsLink
     * @return mixed
     */
    public function getPopularNews($localeCode, $newsLink){
        $result = DB::table('tb_news')
            ->join('tb_post_grp_connect', 'tb_news.NEWS_ID', '=', 'tb_post_grp_connect.POST_ID')
            ->join('tb_img_mgmt', 'tb_news.NEWS_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->join('tb_location', 'tb_news.LOCATION_ID', '=', 'tb_location.LOCATION_ID')
            ->where('tb_post_grp_connect.POST_GRP_ID', '='
                , DB::raw('(SELECT
                                tb_post_grp_connect.POST_GRP_ID
                            FROM
                                tb_post_grp_connect
                            WHERE
                                tb_post_grp_connect.POST_ID = (
                                    SELECT
                                        tb_news.NEWS_ID
                                    FROM
                                        tb_news
                                    WHERE
                                        tb_news.NEWS_TEXT_LINK = "'.$newsLink.'"))'))
            ->where('tb_news.NEWS_TEXT_LINK', '<>', $newsLink)
            ->orderBy('VIEWS', 'DESC')
            ->select(
                'tb_news.NEWS_ID AS newsId'
                , 'tb_news.NEWS_TITLE_'.$localeCode.' AS newsTit'
                , 'tb_news.NEWS_TEXT_LINK AS newsTxtLnk'
                , DB::raw('DATE_FORMAT(tb_news.NEWS_CREATE_TIMESTAMP, "%a, %d-%m-%Y") AS crtDt')
                , 'tb_location.NATIONAL_NM_'.$localeCode.' AS ntnNm'
                , 'tb_location.PROVINCE_NM_'.$localeCode.' AS prvNm'
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TITLE AS imgTit'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->take(6)
            ->get();

        return $result;
    }

    /**
     * @param $postLink
     * @return mixed
     */
    public function getNewsComment($postLink){
        $result = DB::table('tb_post_comment')
            ->join('tb_news', 'tb_post_comment.POST_ID', '=', 'tb_news.NEWS_ID')
            ->where('tb_news.NEWS_TEXT_LINK', '=', $postLink)
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