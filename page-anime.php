<?php

/**
 Template Name: B站追番页面
 Template author: 🎉梨花镇的阿肾🎉，老蘑菇二次修改样式
 */

get_header(); ?>

<meta name="referrer" content="never">
<link href="https://cdn.jsdelivr.net/gh/Fog-Forest/bilibili@1.3/page-anime.min.css" rel="stylesheet">
<div id="container" class="container" >
    <div class="page-header">
        <h1>我的追番
         <?php
            require_once ("bilibiliAnime.php");
            $bili=new bilibiliAnime('你的B站UID','你的B站Cookie不填没观看记录');
            echo "<small>当前已追".$bili->sum."部，继续加油！</small></h1></div><div class=\"row\">";
            function precentage($str1,$str2)
            {
                if(is_numeric($str1) && is_numeric($str2)) return $str1/$str2*100;
                else if ($str1=="没有记录!") return 0;
                else return 100;
            }
            for($i=0;$i<$bili->sum;$i++)
            {
                echo "<div class=\"bangumi-item col-md-4 col-lg-3\"><a class=\"no-line bangumi-link\" href=\"https://www.bilibili.com/bangumi/play/ss".$bili->season_id[$i]."/ \" target=\"_blank\"><div class=\"bangumi-banner\"><img src=\"".$bili->image_url[$i]."\"><div class=\"bangumi-des\"><p>".$bili->evaluate[$i]."</p></div></div><div class=\"bangumi-content\"><h3 class=\"bangumi-title\">".$bili->title[$i]."</h3><div class=\"bangumi-progress\" style=\"width:100%\"><div class=\"bangumi-progress-bar\" style=\"width:".precentage($bili->progress[$i],$bili->total[$i])."%\"></div></div><div class=\"bangumi-progress-num\">进度：".$bili->progress[$i]." / ". $bili->total[$i]."</div></div></a></div>";
            }
        ?>
    </div>
</div>

<?php
get_footer();
