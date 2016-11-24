<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 9/8/2016
 * Time: 10:25 AM
 */

namespace App\Models;

use DB;

class PagesModel
{
    public function getPageIndex($localCode, $pageLink){
        $result = DB::table('tb_pages_code')
            ->join('tb_menu', 'tb_pages_code.MENU_ID', '=', 'tb_menu.MN_ID')
            ->where('tb_menu.MN_NM_LINK', '=', $pageLink)
            ->select(
                'tb_pages_code.PAGE_ID AS pageId'
                , 'tb_pages_code.MENU_ID AS menuId'
                , 'tb_pages_code.HTML_CODE_'.$localCode.' AS pageCode'
            )
            ->get();

        return $result;
    }
}