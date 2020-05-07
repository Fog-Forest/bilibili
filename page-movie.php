<?php

/**
 Template Name: B站追剧页面
 Template author: 老蘑菇，参考 🎉梨花镇的阿肾🎉 追番页
 */

get_header(); ?>

<meta name="referrer" content="never">
<link href="https://cdn.jsdelivr.net/gh/Fog-Forest/bilibili@1.7/page-movie.min.css" rel="stylesheet">
<div id="container" class="container" >
    <div class="page-header">
        <h1>我的追剧
         <?php
			$show_num = 11;  // 首次要展示番剧数目默认为12个
            require_once ("bilibili/bilibiliMovie.php");
            $bili=new bilibiliMovie('你的B站UID','你的B站Cookie');
            echo "<small>当前已追".$bili->sum."部，继续加油！</small></h1></div><div class=\"row\">";
            for($i=0;$i<$bili->sum;$i++)
            {
            	if($i > $show_num){
            		$more = "more";
            	}
                echo "<div class=\"bangumi-item col-md-4 col-lg-3 ".$more."\"><a class=\"no-line bangumi-link\" href=\"https://www.bilibili.com/bangumi/play/ss".$bili->season_id[$i]."/ \" target=\"_blank\"><div class=\"bangumi-banner\"><img src=\"".$bili->image_url[$i]."\"><div class=\"bangumi-des\"><p>".$bili->evaluate[$i]."</p></div></div><div class=\"bangumi-content\"><h3 class=\"bangumi-title\">".$bili->title[$i]."</h3><div class=\"bangumi-progress\" style=\"width:100%\"></div><div class=\"bangumi-progress-num\">".$bili->progress[$i]."</div></div></a></div>";
            }
			if($bili->sum > $show_num){
			    echo "<div class=\"showall\">. Show All .</div>";
			}
        ?>
    </div>
    <center><div class="showall">. Show All .</div></center>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js"></script>
<script type="text/javascript">  // 收缩展示
$(document).ready(function(){
	$(".more").hide();
	$(".showall").click(function(){
		$(".more").fadeIn();
		$(".showall").text("真的已经到头了哦~");
	});
});</script>

<?php
get_footer();
