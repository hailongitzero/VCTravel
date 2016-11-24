<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 9/14/2016
 * Time: 10:10 AM
 */

namespace App\Models;

Use DB;
use Illuminate\Database\QueryException;

class CommonModel
{
    /**
     * @param $tableName
     * @param $colName
     * @param $textLink
     */
    public function updateViews($tableName, $colName, $textLink){
        DB::table($tableName)
            ->where($colName, '=', $textLink)
            ->increment('VIEWS', 1);
    }

    /**
     * @param $emailArr
     * @return bool
     */
    public function insertSubcribeEmail($emailArr){
        $result = true;
        try{
            DB::table('tb_subcribe_email')
                ->insert($emailArr);
        }catch (QueryException $e){
            $result = false;
        }

        return $result;
    }

    public function checkExistEmail($email){
        $result = DB::table('tb_subcribe_email')
            ->where('email', '=', $email)
            ->count();
        return $result;
    }
}