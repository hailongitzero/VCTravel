<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class PhotoController extends Controller
{
    public function insertImage($url, $imgTp, $title){
        $commonModel = new Admin\CommonModel();
        $photoModel = new Admin\AdminPhotoModel();
        $imgID = $commonModel->createPostId('tb_img_mgmt', 'IMG_ID','IMG');

        $imgArr = array(
            "IMG_ID" => $imgID,
            "IMG_TP" => $imgTp,
            "IMG_TITLE" => $title,
            "IMG_URL" => $url,
            "IMG_ALT" => $title
        );

        $result = $photoModel->insertImage($imgArr);
        if ($result  == true){
            return $imgID;
        }else{
            return "Fail";
        }
    }
}
