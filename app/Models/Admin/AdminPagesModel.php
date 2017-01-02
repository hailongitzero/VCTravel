<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 12/28/2016
 * Time: 3:05 PM
 */

namespace App\Models\Admin;

use DB;


class AdminPagesModel
{
    public function getPageListIndex(){
        $pageList = array(
            "pageList" => $this->getPageList(),
        );

        return $pageList;
    }

    public function getPageDetailIndex($pageId){
        $pageDetail = array(
            "pageDetail" => $this->getPageDetail($pageId)
        );

        return $pageDetail;
    }

    public function getPageList(){
        $result = DB::table('tb_pages_code')
            ->leftJoin('tb_menu', 'tb_pages_code.MENU_ID', '=', 'tb_menu.MN_ID')
            ->select(
                'tb_pages_code.MENU_ID',
                'tb_pages_code.PAGE_ID',
                'tb_menu.MN_NM_VI',
                'tb_menu.MN_NM_LINK'
            )
            ->orderBy('tb_menu.MN_NM_VI', 'ASC')
            ->get();

        return $result;
    }

    public function getPageDetail($pageId){
        $result = DB::table('tb_pages_code')
            ->leftJoin('tb_menu', 'tb_pages_code.MENU_ID', '=', 'tb_menu.MN_ID')
            ->where('tb_pages_code.PAGE_ID', '=', $pageId)
            ->select(
                'tb_pages_code.MENU_ID',
                'tb_pages_code.PAGE_ID',
                'tb_pages_code.PAGE_NAME',
                'tb_pages_code.HTML_CODE_VI',
                'tb_pages_code.HTML_CODE_EN',
                'tb_menu.MN_NM_VI',
                'tb_menu.MN_NM_EN',
                'tb_menu.MN_NM_LINK'
            )
            ->get();

        return $result;
    }
}