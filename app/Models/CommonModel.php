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
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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

    public function searchIndex($searchStr, $locale){
        $tourList = array(
            "mdSearchList" => $this->searchMaster($searchStr, $locale)
        );

        return $tourList;
    }

    public function searchMaster($searchStr, $locale){

        $tour = DB::table('tb_tours')
            ->where ('tb_tours.TOUR_CNT_VI', 'like', $searchStr)
            ->orWhere ('tb_tours.TOUR_CNT_EN', 'like', $searchStr)
            ->where('tb_tours.TOUR_ACT_YN', '=', 'Y')
            ->select(
                'tb_tours.TOUR_ID AS ID'
                , 'tb_tours.TOUR_TEXT_LINK AS LINK'
                , 'tb_tours.TOUR_TIT_'.$locale.' AS TITLE'
                , 'tb_tours.TOUR_SHRT_CNT_'.$locale.' AS CONTENT'
                , 'tb_tours.TOUR_CREATE_TIMESTAMP AS CREATE'
                , DB::raw('"T" AS GRP')
            );

        $result = DB::table('tb_news')
            ->where('tb_news.NEWS_ACT_YN', '=', 'Y')
            ->where('tb_news.NEWS_CNT_VI' , 'like', $searchStr)
            ->orWhere('tb_news.NEWS_CNT_EN' , 'like', $searchStr)
            ->select(
                'NEWS_ID AS ID'
                , 'tb_news.NEWS_TEXT_LINK AS LINK'
                , 'tb_news.NEWS_TITLE_'.$locale.' AS TITLE'
                , 'tb_news.NEWS_SHRT_CNT_'.$locale.' AS CONTENT'
                , 'tb_news.NEWS_CREATE_TIMESTAMP AS CREATE'
                , DB::raw('"N" AS GRP')
            )
            ->unionAll($tour)
            ->orderBy('GRP', 'DESC')
            ->orderBy('CREATE', 'DESC')
            ->get();

        //Get current page form url e.g. &page=6
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        //Create a new Laravel collection from the array data
        $collection = new Collection($result);
        //Define how many items we want to be visible in each page
        $perPage = 10;
        //Slice the collection to get the items to display in current page
        $CurrentPageSearchResults = $collection-> slice (($currentPage - 1) * $perPage, $perPage) -> all ();
        //Create our paginator and pass it to the view
        $paginateRsl = new LengthAwarePaginator($CurrentPageSearchResults, count($result), $perPage, null, [
            'path' => Paginator::resolveCurrentPath(),
        ]);
        //Define search url
        $paginateRsl = $paginateRsl->setPath(url('search'));
        return $paginateRsl;
    }
}