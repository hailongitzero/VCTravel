<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/28/2016
 * Time: 10:42 AM
 */

namespace App\Models\Admin;

Use DB;
use App\Models\Admin;
use Mockery\CountValidator\Exception;


class AdminNewsModel
{
    public function getNewsListIndexModel(){
        $newsList = array(
            "adminNewsList" => $this->getNewsList()
        );

        return $newsList;
    }

    public function getNewsDetailIndex($newsId){
        $cmModel = new Admin\CommonModel();

        $categoryList = $cmModel->getCategoryListByGroup('N');

        $newsDetail = array(
            "newsDetail" => $this->getNewsDetail($newsId),
            "categoryList" => $categoryList
        );

        return $newsDetail;
    }

    public function getNewsList(){
        $result = DB::table('tb_news')
            ->select()
            ->orderBy('NEWS_CREATE_TIMESTAMP', 'DESC')
            ->get(
                'NEWS_ID',
                'NEWS_TITLE_VI',
                'NEWS_TEXT_LINK',
                'NEWS_HOT_YN',
                'NEWS_ACT_YN'
            );

        return $result;
    }

    public function newsInitData(){
        $cmModel = new Admin\CommonModel();

        $categoryList = $cmModel->getCategoryListByGroup('N');

        $newsInitData = array(
            "categoryList" => $categoryList,
        );

        return $newsInitData;
    }

    public function getNewsDetail($newsId){
        $result = DB::table('tb_news')
            ->leftJoin('tb_img_mgmt', 'tb_news.NEWS_RPV_IMG_ID', '=', 'tb_img_mgmt.IMG_ID')
            ->leftJoin('tb_post_grp_connect', 'tb_news.NEWS_ID', '=', 'tb_post_grp_connect.POST_ID')
            ->where('NEWS_ID', '=', $newsId)
            ->select(
                'tb_news.NEWS_ID'
                , 'tb_news.NEWS_TITLE_VI'
                , 'tb_news.NEWS_TITLE_EN'
                , 'tb_news.NEWS_SHRT_CNT_VI'
                , 'tb_news.NEWS_SHRT_CNT_EN'
                , 'tb_news.NEWS_CNT_VI'
                , 'tb_news.NEWS_CNT_EN'
                , 'tb_news.NEWS_TEXT_LINK'
                , 'tb_news.NEWS_RPV_IMG_ID'
                , 'tb_news.NEWS_HOT_YN'
                , 'tb_news.NEWS_KEYWORD_VI'
                , 'tb_news.NEWS_KEYWORD_EN'
                , 'tb_img_mgmt.IMG_URL'
                , 'tb_img_mgmt.IMG_ALT'
                , 'tb_img_mgmt.IMG_TP'
                , 'tb_post_grp_connect.POST_GRP_ID'
            )
            ->get();

        return $result;
    }

    public function updateNews($newsId, $newsArr){
        $result = true;
        try{
            DB::table('tb_news')
                ->where('NEWS_ID', '=', $newsId)
                ->update($newsArr);
        }catch (Exception $e){
            $result = false;
        }

        return $result;
    }

    public function createNews($newsArr){
        $result = true;
        try{
            DB::table('tb_news')
                ->insert($newsArr);
        }catch (Exception $e){
            $result = false;
        }

        return $result;
    }
}