<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/31/2016
 * Time: 2:50 PM
 */

namespace App\Models;

use DB;


class BreadCrumbsModel
{
    /** return breadcrumb
     * @param $localeCode
     * @param $bcType
     * @param $postLink
     * @return array
     */
    public function getBreadCrumbData($localeCode, $masterRoute, $bcType,  $postLink, $postCount){

        /* $bcType-bread crumb type: M-Master cate, C-Category, T-Tour Detail, N-News Detail, B-Booking, P-Pages, G-Guide*/
        switch ($bcType){
            case "M":
                $breadData = array(
                    "mdBreadCrumb" => array(
                        (object)array(
                        "grp" => $masterRoute,
                        "grpLnk" => $masterRoute,

                        )
                    ),
                    "postCount" => $postCount,
                );
                break;
            case "C":
                $breadData = array(
                    "mdBreadCrumb" => $this->getGroupBreadCrumb($localeCode, $masterRoute, $postLink),
                    "postCount" => $postCount,
                );
                break;
            case "T":
                $breadData = array(
                    "mdBreadCrumb" => $this->getTourBreadCrumb($localeCode, $masterRoute, $postLink),
                    "postCount" => $postCount,
                );
                break;
            case "N":
                $breadData = array(
                    "mdBreadCrumb" => $this->getNewsBreadCrumb($localeCode, $masterRoute, $postLink),
                    "postCount" => $postCount,
                );
                break;
            case "B":
                $breadData = array(
                    "mdBreadCrumb" => "",
                    "postCount" => $postCount,
                );
                break;
            case "P":
                $breadData = array(
                    "mdBreadCrumb" => $this->getPageBreadCrumb($localeCode, $masterRoute, $postLink),
                    "postCount" => $postCount,
                );
                break;
            case  "G":
                $breadData = array(
                    "mdBreadCrumb" => $this->getGuideBreadCrumb($localeCode, $masterRoute, $postLink),
                    "postCount" => $postCount,
                );
                break;
        }

        return $breadData;
    }

    /** get group breadcrumb
     * @param $localeCode
     * @param $postLink
     * @return mixed
     */
    public function getGroupBreadCrumb($localeCode, $masterRoute, $postLink){
        $result = DB::table('tb_post_grp')
            ->where('tb_post_grp.POST_LINK', '=', $postLink)
            ->select(
                DB::raw('"'.$masterRoute.'" AS grp')
                , DB::raw('"'.$masterRoute.'" AS grpLnk')
                , 'tb_post_grp.POST_NM_'.$localeCode.' AS pstGrpNm'
                , 'tb_post_grp.POST_LINK AS pstGrpLnk'
            )
            ->get();

        return $result;
    }

    /** Create Tour Detail breadcrumb
     * @param $localeCode
     * @param $postLink
     * @return mixed
     */
    public function getTourBreadCrumb($localeCode, $masterRoute, $postLink){
        $result = DB::table('tb_post_grp')
            ->leftJoin(DB::raw('tb_post_grp_connect INNER JOIN tb_tours ON tb_post_grp_connect.POST_ID = tb_tours.TOUR_ID'),
                'tb_post_grp.POST_GRP_ID', '=', 'tb_post_grp_connect.POST_GRP_ID')
            ->where('tb_tours.TOUR_TEXT_LINK', '=', $postLink)
            ->select(
                DB::raw('"'.$masterRoute.'" AS grp')
                , DB::raw('"'.$masterRoute.'" AS grpLnk')
                , 'tb_post_grp.POST_NM_'.$localeCode.' AS pstGrpNm'
                , 'tb_post_grp.POST_LINK AS pstGrpLnk'
                , 'tb_tours.TOUR_TIT_'.$localeCode.' AS pstTit'
                , 'tb_tours.TOUR_TEXT_LINK AS pstLnk'
            )
            ->get();

        return $result;
    }

    /** Create News Detail breadcrumb
     * @param $localeCode
     * @param $postLink
     * @return mixed
     */
    public function getNewsBreadCrumb($localeCode, $masterRoute, $postLink){
        $result = DB::table('tb_post_grp')
            ->leftJoin(DB::raw('tb_post_grp_connect INNER JOIN tb_news ON tb_post_grp_connect.POST_ID = tb_news.NEWS_ID'),
                'tb_post_grp.POST_GRP_ID', '=', 'tb_post_grp_connect.POST_GRP_ID')
            ->where('tb_news.NEWS_TEXT_LINK', '=', $postLink)
            ->select(
                DB::raw('"'.$masterRoute.'" AS grp')
                , DB::raw('"'.$masterRoute.'" AS grpLnk')
                , 'tb_post_grp.POST_NM_'.$localeCode.' AS pstGrpNm'
                , 'tb_post_grp.POST_LINK AS pstGrpLnk'
                , 'tb_news.NEWS_TITle_'.$localeCode.' AS pstTit'
                , 'tb_news.NEWS_TEXT_LINK AS pstLnk'
            )
            ->get();

        return $result;
    }

    /** Create News Detail breadcrumb
     * @param $localeCode
     * @param $postLink
     * @return mixed
     */
    public function getGuideBreadCrumb($localeCode, $masterRoute, $postLink){
        $result = DB::table('tb_travel_guide')
            ->where('tb_travel_guide.GUIDE_TEXT_LINK', '=', $postLink)
            ->select(
                DB::raw('"'.$masterRoute.'" AS grp')
                , DB::raw('"'.$masterRoute.'" AS grpLnk')
                , 'tb_travel_guide.GUIDE_TITle_'.$localeCode.' AS pstTit'
                , 'tb_travel_guide.GUIDE_TEXT_LINK AS pstLnk'
            )
            ->get();

        return $result;
    }

    /** create pages breadcrumb
     * @param $localeCode
     * @param $masterRoute
     * @param $postLink
     * @return mixed
     */
    public function getPageBreadCrumb($localeCode, $masterRoute, $postLink){
        $result = DB::table('tb_menu')
            ->where('tb_menu.MN_NM_LINK', '=', $postLink)
            ->select(
                DB::raw('"'.$masterRoute.'" AS grp')
                , DB::raw('"'.$masterRoute.'" AS grpLnk')
                , 'tb_menu.MN_NM_'.$localeCode.' AS pstGrpNm'
                , 'tb_menu.MN_NM_LINK AS pstGrpLnk'
            )
            ->get();

        return $result;
    }
}