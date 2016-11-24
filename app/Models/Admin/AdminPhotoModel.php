<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/16/2016
 * Time: 11:14 AM
 */

namespace App\Models\Admin;

use DB;
use Illuminate\Database\QueryException;

class AdminPhotoModel
{
    /**
     * @param $imgArr
     * @return bool
     */
    public function insertImage($imgArr){
        $result = true;
        try{
            DB::table('tb_img_mgmt')
                ->insert($imgArr);
        }catch (Exception $e){
            $result = false;
        }

        return $result;
    }

    /**
     * @param $imgId
     * @param $postId
     * @return bool
     */
    public function addImgPostRefer($imgId, $postId){
        $insertArr = array(
            "POST_ID" => $postId,
            "IMG_ID" => $imgId
        );
        $result = true;
        try{
            DB::table('tb_post_img_grp')
                ->insert($insertArr);
        }catch (Exception $e){
            $result = false;
        }

        return $result;
    }

    /**
     * @param $imgLink
     * @return bool
     */
    public function checkImgExist($imgLink){
        $imgCnt = DB::table('tb_img_mgmt')
            ->where('IMG_URL', '=', $imgLink)
            ->count();
        if ($imgCnt > 0 ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $imgLink
     * @return mixed
     */
    public function getImgId($imgLink){
        $imgId = DB::table('tb_img_mgmt')
            ->where('IMG_URL', '=', $imgLink)
            ->max('IMG_ID');
        return $imgId;
    }

    /**
     * @param $imgId
     * @param $postId
     * @return bool
     */
    public function checkImgRefExist($imgId, $postId){
        $imgCnt = DB::table('tb_post_img_grp')
            ->where('IMG_ID', '=', $imgId)
            ->where('POST_ID', '=', $postId)
            ->count();
        if ($imgCnt > 0 ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $table
     * @param $postId
     * @param $imgId
     * @param $colId
     * @param $colImgId
     * @return bool
     */
    public function updateRpvImg($table, $postId, $imgId, $colId, $colImgId){
        $result = true;
        try{
            DB::table($table)
                ->where($colId, '=', $postId)
                ->update([$colImgId => $imgId]);
        }catch (Exception $e){
            $result = false;
        }
        return $result;
    }

    public function getImgReferList($table, $postId, $colId){
        $result = DB::table('tb_img_mgmt')
            ->leftJoin(DB::raw('(tb_post_img_grp INNER JOIN '.$table.' ON '.$table.'.'.$colId.' = tb_post_img_grp.POST_ID)'), 'tb_img_mgmt.IMG_ID', '=', 'tb_post_img_grp.IMG_ID')
            ->where($table.'.'.$colId, '=', $postId)
            ->select(
                'tb_img_mgmt.IMG_ID'
                , 'tb_img_mgmt.IMG_TP'
                , 'tb_img_mgmt.IMG_TITLE'
                , 'tb_img_mgmt.IMG_URL'
                , 'tb_img_mgmt.IMG_ALT'
            )
            ->get();
        return $result;
    }

    public function deleteImgRefByPostId($postId){
        $result = true;
        try{
            DB::table('tb_post_img_grp')
                ->where('POST_ID', '=', $postId)
                ->delete();
        }catch (Exception $e){
            $result = false;
        }

        return $result;
    }
}