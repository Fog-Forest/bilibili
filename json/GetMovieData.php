<?php
$array = array();
$limit = $_GET["limit"];
$page = $_GET["page"];

// 判断获取的参数
if (empty($limit)) {
    die('limit 为必须参数');
} elseif (empty($page)) {
    $page = 0;
}

require_once("bilibiliAcconut.php");
require_once("classMovie.php");
$biliM = new bilibiliMovie($UID);
$total = $biliM->total;  // 追剧总数
$total_page = intdiv($total, $limit);  // 分页总数
$pagenum = $page * $limit;  // 第一页为 page = 0

// 构造请求接口
for ($i = 0; $i < $total; $i++) {
    // limit
    if ($i == $limit || $biliM->season_id[$pagenum] == NULL) {
        break;
    }
    $array[$i]['num'] = $i;
    $array[$i]['title'] = $biliM->title[$pagenum];
    $array[$i]['image_url'] = $biliM->image_url[$pagenum];
    $array[$i]['evaluate'] = $biliM->evaluate[$pagenum];
    $array[$i]['id'] = $biliM->season_id[$pagenum];
    $pagenum++;
}
echo '{"total": ' . $total . ',"total_page": ' . $total_page . ', "limit": ' . $limit . ', "page": ' . $page . ', "data":' . json_encode($array, true) . '}';
