<?php

/**
 Template Name: B站追番页面
 Template author: 🎉梨花镇的阿肾🎉，老蘑菇二次开发
 */

get_header(); ?>

<meta name="referrer" content="never">
<link href="https://cdn.jsdelivr.net/gh/Fog-Forest/bilibili@1.7.2/col.min.css" rel="stylesheet">
<style>
    /* B站追番 */
    .row {
        margin: 0 10px;
    }

    .bangumi-item {
        margin: 20px 0;
        padding-top: 0;
        padding-bottom: 0;
        border: none
    }

    .bangumi-link {
        padding: 0;
        border: none
    }

    .bangumi-banner {
        position: relative;
        overflow: hidden
    }

    .bangumi-banner img {
        display: block;
        width: 100%;
        height: 220px;
        margin: 15px auto;
        border-radius: 3px
    }

    .bangumi-des {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(255, 255, 255, 0.8);
        padding: 6px;
        opacity: 0;
        transition: .3s;
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        overflow: auto
    }

    .bangumi-des p {
        margin: 0
    }

    .bangumi-banner:hover .bangumi-des {
        opacity: 1
    }

    .bangumi-title {
        margin: 5px 0;
        border: none !important;
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: 'Ubuntu', sans-serif
    }

    .bangumi-progress,
    .bangumi-progress-bar {
        border-radius: 4px;
        height: 8px
    }

    .bangumi-progress {
        background: #ddd
    }

    .bangumi-progress-bar {
        background: gray
    }

    .page-header {
        text-align: center;
        border-bottom: 1px solid #a773c3
    }

    .page-header h1 small {
        font-size: 18px;
        color: #e42c64
    }

    .page-header h1 {
        color: #63707e;
        font-weight: 800
    }

    .bangumi-item a {
        text-decoration: none;
        color: #000
    }

    @media (max-width:1000px) {

        /*平板适配*/
        .bangumi-banner img {
            height: 265px
        }
    }

    @media (max-width:500px) {

        /*手机适配*/
        .bangumi-banner img {
            height: auto
        }
    }

    /* AJAX请求等待图 */
    img.loading_dsasd {
        width: 200px;
        margin: 50px 0 50px 50%;
        transform: translateX(-50%);
    }

    /* 分页模块 */
    #next {
        margin: 15px 0;
        width: 100%;
        color: #ffaa00;
        font-size: 20px;
        text-align: center;
        transition: all .6s
    }

    #next:hover {
        color: #e67474
    }
</style>
<?php
$sum = json_decode(file_get_contents(home_url() . "/json/GetAnimeData.php?limit=1&page=0"), true);
echo "<div class=\"page-header\"><h1>我的追番 <small>当前已追" . $sum['total'] . "部，继续加油！</small></h1></div><div id=\"bilibiliAnime\" class=\"row\"></div><div id=\"next\">. NEXT .</div>"
?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var pagenum = 0;
        var limit = 12; //单页展示数
        GetAnimeData(limit, 0);
        $("div#next").click(function() {
            GetAnimeData(limit, ++pagenum);
            console.log("第 " + pagenum + " 页");
        });
    });

    function GetAnimeData(limit, page) {
        $.ajax({
            type: "get",
            url: "/json/GetAnimeData.php",
            data: {
                "limit": limit, // 每页个数
                "page": page // 页号,第一页 page = 0
            },
            dataType: "json",
            beforeSend: function() {
                $("#bilibiliAnime").append("<img class=\"loading_dsasd\" src=\"https://cdn.jsdelivr.net/gh/Fog-Forest/Steam-page@1.2/json/loading.svg\">");
            },
            complete: function() {
                $(".loading_dsasd").remove();
            },
            success: function(data) {
                var i;
                if (data.total_page == page && page == 0) {
                    $("div#next").hide();
                } else if (data.total_page == page) { // 判断是否最后一页
                    $("div#next").text("真的没有更多了哦~");
                }
                for (i = 0; i < data.data.length; i++) {
                    $("#bilibiliAnime").append("<div class=\"bangumi-item col-md-4 col-lg-3 col-sm-6\"><a class=\"no-line bangumi-link\" href=\"https://www.bilibili.com/bangumi/play/ss" + data.data[i].id + "/ \" target=\"_blank\"><div class=\"bangumi-banner\"><img class=\"lazy\" src=\"https://cdn.jsdelivr.net/gh/Fog-Forest/Steam-page@1.2/json/loading.svg\" data-src=\"" + data.data[i].image_url + "\"><div class=\"bangumi-des\"><p>" + data.data[i].evaluate + "</p></div></div><div class=\"bangumi-content\"><h3 class=\"bangumi-title\">" + data.data[i].title + "</h3><div class=\"bangumi-progress\" style=\"width:100%\"><div class=\"bangumi-progress-bar\" style=\"width:" + data.data[i].progress_bar + "\"></div></div><div class=\"bangumi-progress-num\">进度：" + data.data[i].progress + "</div></div></a></div>");
                    // console.log(data); // 查看AJAX获取的数据
                }
                $("img.lazy").lazyload(); // 图片懒加载
            },
            error: function(data) {
                alert(data.result);
            }
        });
    }
</script>

<?php
get_footer();
