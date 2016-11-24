<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/3/2016
 * Time: 2:44 PM
 */

namespace App\Models\Admin;

use DB;

class CommonModel
{
    public function getNationList(){
        $result = DB::table('tb_location')
            ->select(
                'NATIONAL_CD'
                , 'NATIONAL_NM_VI'
            )
            ->groupBy("NATIONAL_CD")
            ->groupBy("NATIONAL_NM_VI")
            ->get()
        ;

        return $result;
    }

    public function getLocationByNationCd($nationCd){
        $result = DB::table('tb_location')
            ->where('NATIONAL_CD', '=', $nationCd)
            ->select(
                'LOCATION_ID'
                , 'PROVINCE_NM_VI'
            )
            ->orderBy("PROVINCE_NM_VI")
            ->get()
        ;

        return $result;
    }

    public function getLocationList(){
        $result = DB::table('tb_location')
            ->select(
                'LOCATION_ID'
                , 'NATIONAL_CD'
                , 'NATIONAL_NM_VI'
                , 'PROVINCE_NM_VI'
            )
            ->orderBy("PROVINCE_NM_VI")
            ->get()
        ;

        return $result;
    }

    public function createPostId($tableName, $colId, $prefix){
        $maxId = DB::table($tableName)
            ->where($colId, 'like', $prefix.'%')
            ->max($colId);
        $codeLength = strlen($maxId) - strlen($prefix);
        $codeNumber = substr($maxId,strlen($prefix),$codeLength);
        $newNumber = $codeNumber+1;
        $newCode = substr($maxId,0,strlen($maxId) - strlen($newNumber)).$newNumber;

        return $newCode;
    }
}