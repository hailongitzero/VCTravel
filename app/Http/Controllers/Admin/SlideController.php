<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlideController extends Controller
{
    public function getSlideList(){
        $slideModel = new Admin\AdminSlideModel();

        $slideArr = array(
            "slideList" => $slideModel->getSlideListIndexModel(),
        );

        return view('admin.pages.slideList', $slideArr);
    }

    public function slideUpdate(Request $request){
        $slideModel = new Admin\AdminSlideModel();

        $this->validate($request, [
            'slideId' => 'required',
            'slideSeq' => 'required|numeric',
            'slideLink' => 'required',
        ]);

        $slideId = $request->input('slideId');

        $updateArr = array(
            "SLD_SEQ" => $request->input('slideSeq'),
            "SLD_LINK" => $request->input('slideLink'),
        );

        if ($request->input('slideSeq') < 6){
            $seqRsl = $slideModel->updateSlideSeq($request->input('slideSeq'), 6);
            if ($seqRsl == true){
                $result = $slideModel->slideUpdate($slideId, $updateArr);

                if ($result == true){
                    return response()->json(['info' => 'Success', 'Content' =>  'Update slide success.', 'slideId' => $slideId ],200);
                }else{
                    return response()->json(['info' => 'Fail', 'Content' =>  'Update slide fail.', 'slideId' => $slideId ],200);
                }
            }else{
                return response()->json(['info' => 'Fail', 'Content' =>  'Cập nhật thứ tự slide lỗi. Vui lòng thử lại.', 'slideId' => $slideId ],200);
            }
        }
    }

    public function slideDetail($slideId){
        $slideModel = new Admin\AdminSlideModel();

        $slideDetail = array(
            "slideDetail" => $slideModel->getSlideDetail($slideId),
        );

        return view('admin.pages.slideEditor', $slideDetail);
    }

    public function createSlide(){
        return view('admin.pages.slideEditor');
    }

    public function slideEditor(Request $request){
        $CommonModel = new Admin\CommonModel();
        $photoModel = new Admin\AdminPhotoModel();
        $slideModel = new Admin\AdminSlideModel();
        $photoCtrl = new PhotoController();

        $this->validate($request, [
            'titleVi' => 'required|max:150',
            'titleEn' => 'required|max:150',
            'textLink' => 'required',
            'slideSeq' => 'required',
            'slideCntVi' => 'required',
            'slideCntEn' => 'required',
        ]);

        $slideId = $request->input('formAction') == "Save" ? $CommonModel->createPostId('tb_slide','SLD_ID','SL'): $request->input('slideId');

        $slideArr = array(
            "SLD_ID" => $slideId,
            "SLD_TITLE_VI" => $request->input('titleVi'),
            "SLD_TITLE_EN" => $request->input('titleEn'),
            "SLD_LINK" => $request->input('textLink'),
            "SLD_SEQ" => $request->input('slideSeq'),
            "SLD_CONTENT_VI" => $request->input('slideCntVi'),
            "SLD_CONTENT_EN" => $request->input('slideCntEn'),
            "SLD_IMG_ALT" => $request->input('sldImgAlt'),
        );

        if ($request->input('formAction') == "Save"){
            $result = $slideModel->slideInsert($slideArr);
        }else{
            $result = $slideModel->slideUpdate($slideId, $slideArr);
        }
        if( $result == true){
            if ($request->hasFile('rpvImg')){       //insert representative image
                $file = $request->file('rpvImg');
                $path = '/resources/assets/img/uploads/'.$file->getClientOriginalName();
                if (strlen($photoModel->getImgId($path)) < 1) {   //check if image not exist
                    $request->rpvImg->move('resources/assets/img/uploads', $file->getClientOriginalName());
                    $imgArr = array("SLD_IMG_URL" => $path);
                    $imgRsl = $slideModel->slideUpdate($slideId, $imgArr);
                    if ($imgRsl == true){
                        return response()->json(['info' => 'Success', 'Content' =>  'Edit slide success.', 'slideId' => $slideId ],200);
                    }else{
                        return response()->json(['info' => 'Success', 'Content' =>  'Edit slide success, but background image change fail.', 'slideId' => $slideId ],200);
                    }
                }else{
                    $imgArr = array("SLD_IMG_URL" => $path);
                    $imgRsl = $slideModel->slideUpdate($slideId, $imgArr);
                    if ($imgRsl == true){
                        return response()->json(['info' => 'Success', 'Content' =>  'Edit slide success.', 'slideId' => $slideId ],200);
                    }else{
                        return response()->json(['info' => 'Success', 'Content' =>  'Edit slide success, but background image change fail.', 'slideId' => $slideId ],200);
                    }
                }
            }elseif ( strlen($request->input('rpvTxtLink')) > 5 ){
                $imgArr = array("SLD_IMG_URL" => $request->input('rpvTxtLink'));
                $imgRsl = $slideModel->slideUpdate($slideId, $imgArr);
                if ($imgRsl == true){
                    return response()->json(['info' => 'Success', 'Content' =>  'Edit slide success.', 'slideId' => $slideId ],200);
                }else{
                    return response()->json(['info' => 'Success', 'Content' =>  'Edit slide success, but background image change fail.', 'slideId' => $slideId ],200);
                }
            }
        }else{
            return response()->json(['info' => 'Fail', 'Content' =>  'Edit slide fail.', 'slideId' => $slideId ],200);
        }
    }
}
