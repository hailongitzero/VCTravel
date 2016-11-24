<?php

/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 10/12/2016
 * Time: 9:21 AM
 */

namespace App\Models\Admin;

use Illuminate\Database\QueryException;
Use DB;

class AdminUserModel
{
    public function loginModel($username){
        $pass = "";
        $result = DB::table('tb_admin')
            ->where("AD_USER_NAME", "=", $username)
            ->select("AD_USER_PASS")
            ->get();
        foreach ($result as $rs){
            $pass = $rs->AD_USER_PASS;
        }

        return $pass;
    }

    /**
     * @param $userArr
     * @return bool
     */
    public function addUserModel($userArr){
        $result = true;
        try{
            DB::table('tb_admin')->insert($userArr);
        }catch (QueryException $e){
            $result = false;
        }
        return $result;
    }
}