<?php

/**
 Template Name: B站追番页面
 Template author: 🎉梨花镇的阿肾🎉，老蘑菇二次修改样式
 */

get_header(); ?>

<meta name="referrer" content="never">
<link href="https://cdn.jsdelivr.net/gh/Fog-Forest/bilibili@1.4/page-anime.min.css" rel="stylesheet">
<div id="container" class="container" >
    <div class="page-header">
        <h1>我的追番
         <?php
            require_once ("bilibili/bilibiliAnime.php");
            $bili=new bilibiliAnime('你的B站UID','你的B站Cookie');
            echo "<small>当前已追".$bili->sum."部，继续加油！</small></h1></div><div class=\"row\">";
			//处理观看进度条
            function precentage($str1,$str2)
            {
                if(is_numeric($str1) && is_numeric($str2)) return $str1/$str2*100;
                elseif ($str1=="貌似还没有看呢~" || $str2=="还没开始更新呢~") return 0;
                else return 100;
            }
			//处理观看进度记录
			function record($str1,$str2)
			{
				if(is_numeric($str1) && is_numeric($str2) && $str1==$str2) return "已经追完了咯~";
				elseif (is_numeric($str1) && is_numeric($str2)) return "第".$str1."话/共".$str2."话";
				elseif (is_numeric($str1) && !is_numeric($str2)) return "第".$str1."话/".$str2;
				elseif ($str2=="还没开始更新呢~") return $str2;
				else return $str1;
			}
            for($i=0;$i<$bili->sum;$i++)
            {
            	if($i > 11){//首次要展示番剧数目默认为12个
            		$more = "more";
            	}
                echo "<div class=\"bangumi-item col-md-4 col-lg-3 ".$more."\"><a class=\"no-line bangumi-link\" href=\"https://www.bilibili.com/bangumi/play/ss".$bili->season_id[$i]."/ \" target=\"_blank\"><div class=\"bangumi-banner\"><img src=\"".$bili->image_url[$i]."\"><div class=\"bangumi-des\"><p>".$bili->evaluate[$i]."</p></div></div><div class=\"bangumi-content\"><h3 class=\"bangumi-title\">".$bili->title[$i]."</h3><div class=\"bangumi-progress\" style=\"width:100%\"><div class=\"bangumi-progress-bar\" style=\"width:".precentage($bili->progress[$i],$bili->total[$i])."%\"></div></div><div class=\"bangumi-progress-num\">进度：".record($bili->progress[$i],$bili->total[$i])."</div></div></a></div>";
            }
        ?>
    </div>
    <center><div class="showall">. Show All .</div></center>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
<script type="text/javascript">//收缩展示
$(document).ready(function(){
	$(".more").hide();
	$(".showall").click(function(){
		$(".more").show(1000);
		$(".showall").hide();
	});
});</script>

<?php
get_footer();
