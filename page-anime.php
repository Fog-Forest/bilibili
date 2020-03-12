<?php

/**
 Template Name: 追番页面
 */

get_header(); ?>

<link href="https://cdn.jsdelivr.net/gh/Fog-Forest/bilibili@1.0/page-anime.min.css" rel="stylesheet">
<div id="container" class="container" >
    <div class="page-header">
        <h1>我的追番
         <?php
            require_once ("anime_bili.php");
            $bili=new bilibiliAnime('8142789','');
            echo "<small>当前已追".$bili->sum."部，继续加油！</small></h1></div><div class=\"bilibili\">";
            function precentage($str1,$str2)
            {
                if(is_numeric($str1) && is_numeric($str2)) return $str1/$str2*100;
                else if ($str1=="没有记录!") return 0;
                else return 100;
            }
            for($i=0;$i<$bili->sum;$i++)
            {
                echo "<a class=\"bgm-item\" href=\"https://www.bilibili.com/bangumi/play/ss".$bili->season_id[$i]."/ \" target=\"_blank\"><div class=\"bgm-item-thumb\" style=\"background-image:url(".$bili->image_url[$i].")\"></div><div class=\"bgm-item-info\"><span class=\"bgm-item-titlemain\">".$bili->title[$i]."</span><span class=\"bgm-item-title\">".$bili->evaluate[$i]."</span></div><div class=\"bgm-item-statusBar-container\"><div class=\"bgm-item-statusBar\" style=\"width:".precentage($bili->progress[$i],$bili->total[$i])."%\"></div>进度".$bili->progress[$i]."/". $bili->total[$i]."</div></a>";
            }
        ?>
    </div>
</div>

<?php
get_footer();
