<?php

namespace App\Models;
use DB;

/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/18/2016
 * Time: 11:21 AM
 */
class HeaderModel
{
    /**
     * @param $menuID
     * @return return all main menu data
     */
    public function index($localCode){
        $menuID = 'MG01';
        $headerData = array(
            "menuInitData" => $this->getMenuInitData($menuID, $localCode),
            "menuData" => $this->getMenuData($menuID, $localCode),
        );
        return $headerData;

    }

    /**
     * get max level of menu
     * @param $menuID
     * @return menu level
     */
    public function getMenuInitData($menuID, $localCode){
        $mnLevel = DB::table('tb_menu')
            ->select(DB::raw('MAX(MN_LVL) AS mnLvl'))
            ->where('MN_GRP_ID',$menuID)
            ->first();

        $mnMaxSeq = DB::table('tb_menu')
            ->select(DB::raw('MAX(MN_SEQ) AS mnSeq'))
            ->where('MN_GRP_ID',$menuID)
            ->where('MN_PRT_ID',null)
            ->first();

        $mnInitInfo = array(
            "mnLevel" => $mnLevel->mnLvl,
            "mnMaxSeq" => $mnMaxSeq->mnSeq
        );

        return $mnInitInfo;
    }

    /**
     * get list all of main menu
     * @param $menuID
     * @return menu data
     */
    public function getMenuData($menuID, $localCode){
        return DB::table('tb_menu')
            ->where('MN_GRP_ID', $menuID)
            ->select(
                'MN_ID AS mnId'
                , 'MN_SEQ AS mnSeq'
                , 'MN_GRP_ID AS mnGrpId'
                , 'MN_LVL AS mnLvl'
                , 'MN_PRT_ID AS mnPrtId'
                , 'MN_NM_'.$localCode.' AS mnNm'
                , 'MN_NM_LINK AS mnLnk'
                , 'MN_DSP_TP AS mnDspTp'
            )
            ->orderBy('MN_LVL','ASC')
            ->orderBy('MN_SEQ', 'ASC')
            ->orderBy('MN_PRT_ID', 'ASC')
            ->get();
    }
}