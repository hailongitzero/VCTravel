<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/30/2016
 * Time: 9:09 AM
 */

namespace App\Models\Admin;

Use DB;
use App\Models\Admin;
use Mockery\CountValidator\Exception;


class AdminSlideModel
{
    public function getSlideListIndexModel(){
        $slideList = array(
            "slideList" => $this->getSlideList(),
        );

        return $slideList;
    }

    public function getSlideList(){
        $result = DB::table('tb_slide')
            ->select(
                'SLD_ID'
                , 'SLD_SEQ'
                , 'SLD_TITLE_VI'
                , 'SLD_LINK'
            )
            ->orderBy('SLD_SEQ')
            ->limit(5)
            ->get();

        return $result;
    }

    public function getSlideDetail($sldId){
        $result = DB::table('tb_slide')
            ->where('SLD_ID', '=', $sldId)
            ->select(
                'SLD_ID'
                , 'SLD_SEQ'
                , 'SLD_TITLE_VI'
                , 'SLD_TITLE_EN'
                , 'SLD_CONTENT_VI'
                , 'SLD_CONTENT_EN'
                , 'SLD_BG_EFF'
                , 'SLD_CNT_EFF'
                , 'SLD_IMG_URL'
                , 'SLD_IMG_ALT'
                , 'SLD_HTML_CODE'
                , 'SLD_LINK'
            )
            ->get();

        return $result;
    }

    public function slideUpdate($slideId, $slideArr){
        $result = true;
        try{
            DB::table('tb_slide')
                ->where('SLD_ID', '=', $slideId)
                ->update($slideArr);

        }catch (Exception $e){
            $result = false;
        }

        return $result;
    }

    public function updateSlideSeq($oldSeq, $newSeq){
        $result = true;
        try{
            DB::table('tb_slide')
                ->where('SLD_SEQ', '=', $oldSeq)
                ->update(["SLD_SEQ"=>$newSeq]);

        }catch (Exception $e){
            $result = false;
        }

        return $result;
    }

    public function slideInsert($slideArr){
        $result = true;
        try{
            DB::table('tb_slide')
                ->insert($slideArr);

        }catch (Exception $e){
            $result = false;
        }

        return $result;
    }
}