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
require_once("classAnime.php");
$biliA = new bilibiliAnime($UID, $Cookie);
$total = $biliA->total;  // 追番总数
$total_page = intdiv($total, $limit);  // 分页总数
$pagenum = $page * $limit;  // 第一页为 page = 0

// 观看进度
function progress($str1, $str2)
{
    if (is_numeric($str1) && is_numeric($str2) && $str1 == $str2) {
        return "已经追完了咯~";
    } elseif (is_numeric($str1) && is_numeric($str2)) {
        return "第" . $str1 . "话/共" . $str2 . "话";
    } elseif (is_numeric($str1) && !is_numeric($str2)) {
        return "第" . $str1 . "话/" . $str2;
    } elseif ($str2 == "还没开始更新呢~") {
        return $str2;
    } else {
        return $str1;
    }
}
// 观看进度条
function progress_bar($str1, $str2)
{
    if (is_numeric($str1) && is_numeric($str2)) {
        return ($str1 / $str2 * 100) . "%";
    } elseif ($str1 == "貌似还没有看呢~" || $str2 == "还没开始更新呢~") {
        return "0%";
    } else {
        return "100%";
    }
}

// 构造请求接口
for ($i = 0; $i < $total; $i++) {
    // limit
    if ($i == $limit || $biliA->season_id[$pagenum] == NULL) {
        break;
    }
    $array[$i]['num'] = $i;
    $array[$i]['title'] = $biliA->title[$pagenum];
    $array[$i]['image_url'] = $biliA->image_url[$pagenum];
    $array[$i]['evaluate'] = $biliA->evaluate[$pagenum];
    $array[$i]['id'] = $biliA->season_id[$pagenum];
    $array[$i]['progress'] = progress($biliA->progress[$pagenum], $biliA->fan_number[$pagenum]);
    $array[$i]['progress_bar'] = progress_bar($biliA->progress[$pagenum], $biliA->fan_number[$pagenum]);
    $pagenum++;
}
echo '{"total": ' . $total . ',"total_page": ' . $total_page . ', "limit": ' . $limit . ', "page": ' . $page . ', "data":' . json_encode($array, true) . '}';
