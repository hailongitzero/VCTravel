<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 2/14/2017
 * Time: 3:25 PM
 */
?>
<div class="content-body">
    <div class="container page">
        <div class="row">
            <div class="col-md-12">
            @if(isset($mdSearchList))
                @foreach($mdSearchList as $rsl)
                    <div class="rsl-item">
                        <span> {{ $rsl->GRP == 'N' ? '[News]' : '[Tour]' }}</span>
                        <a href="{{ url(($rsl->GRP == 'N'?'news-detail' : 'tour-detail').'/'.$rsl->LINK) }}"> {{ $rsl->TITLE }}</a>
                        <p>{{ $rsl->CONTENT }}</p>
                    </div>
                    <!-- Recomended item-->
                @endforeach
            @endif
            </div>
        </div>
        <div class="row">
        <div class="col-md-12 mb-md-50" style="text-align: center">
            <!-- pagination-->
            @if(isset($mdSearchList))
                {{ $mdSearchList->render() }}
            @endif
            </div>
        </div>
    </div>
</div>
