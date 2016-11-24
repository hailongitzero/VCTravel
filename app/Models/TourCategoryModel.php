<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/24/2016
 * Time: 3:20 PM
 */

namespace App\Models;
use DB;

class TourCategoryModel
{
    /**
     * get all information of Tour Category
     */
    public function index($localCode){
        $tourCate = array(
            'rpvCate' => $this->getCategory($localCode),
        );

        return $tourCate;
    }
    /**
     * get all representative tour category
     * @param $localCode
     */
    public function getCategory($localCode){

        $result = DB::table('tb_post_grp')
            ->leftJoin('tb_img_mgmt', 'tb_post_grp.POST_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->where('tb_post_grp.POST_RPV_YN', '=', 'Y')
            ->where('tb_post_grp.POST_GRP_ID' , 'like', 'T%')
            ->select(
                'tb_post_grp.POST_GRP_ID AS pstGrpId'
                , 'tb_post_grp.POST_NM_'.$localCode.' AS pstNm'
                , 'tb_post_grp.POST_INTRO_'.$localCode.' AS pstIntro'
                , 'tb_post_grp.POST_LINK AS pstLnk'
                , 'tb_post_grp.POST_RPV_YN AS pstRpvYn'
                , DB::raw('(SELECT count(*) FROM tb_post_grp_connect where POST_GRP_ID = tb_post_grp.POST_GRP_ID) AS pstTot')
                , 'tb_img_mgmt.IMG_URL AS imgUrl'
                , 'tb_img_mgmt.IMG_ALT AS imgAlt'
                , 'tb_img_mgmt.IMG_TP AS imgTp'
            )
            ->orderBy('pstTot', 'DESC')
            ->take(8)
            ->get();

        return $result;
    }

}