<?php

/**
 Template Name: 追番页面
 */
 
get_header();
?>
<link href="https://cdn.jsdelivr.net/gh/Fog-Forest/cdn@1.9.6/Sakura/css/page-anime.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/mdui@0.4.3/dist/css/mdui.min.css" rel="stylesheet">
<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">
<?php while(have_posts()) : the_post(); 
get_template_part( 'tpl/content', 'page' );
?>
<?php
$uid = 8142789;// 你的B站UID
$brief_file_contents = file_get_contents('https://api.bilibili.com/x/space/bangumi/follow/list?type=1&vmid='.$uid);
$origin = json_decode($brief_file_contents,true);
$total = $origin['data']['total'];
echo "<span style=\"text-align: center\"><p>朋友一生一起走，谁先弃番谁是狗~ 当前共追了<font color=\"#00d1bf\">" . $total . "</font>部番剧！</p></span>";
?>
<div id="moe-body">
<div class="mdui-container">
<div class="mdui-row-sm-2 mdui-row-md-4">
<?php
// 利用 while 循环和 foreach 遍历数据，逐个获取需要的信息并输出
while ($total > 0) {
	$full_file_contents = file_get_contents('https://api.bilibili.com/x/space/bangumi/follow/list?type=1&vmid='.$uid.'&pn='.$pn.'&ps=50');
	$arr = json_decode($full_file_contents, true);
	foreach ($arr as $obj) {
		if (is_array($obj)) {
			foreach ($obj['list'] as $result) {
				$url = $result['cover'];
				$path = 'cache/';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
				$img = curl_exec($ch);
				curl_close($ch);
				$filename = pathinfo($url, PATHINFO_BASENAME);
				if (file_exists('cache/' . $filename)) {
					if ($result['is_finish'] == 1) {
						echo "<div class=\"mdui-col\">
  <a href=\"" . $result[ 'url'] . "\" class=\"moe-bangumi-href bangumi-link\" title=\"" . $result[ 'title'] . "\" target=\"_blank\">
    <div class=\"mdui-card moe-bangumi-card moe-card-t\">
      <div class=\"mdui-card-media\" style=\"overflow: hidden;\">
		<div class=\"bangumi-banner\">
		<img src=\"/cache/" . $filename . "\" data-original=\"/cache/" . $filename . "\">
			<div class=\"bangumi-des\">
				<p>" . $result['evaluate'] . "</p>
			</div>
		</div>
      </div>
	<div class=\"bangumi-content\">
		<span class=\"bangumi-title\" title=\"" . $result[ 'title'] . "\">" . $result['title'] . "</span>
	</div>
	<div class=\"mdui-card-actions\">
		<div class=\"mdui-float-right\">已完结共" . $result['total_count'] . "话</div>
		<div class=\"mdui-progress\">
			<div class=\"mdui-progress-determinate\" style=\"width: 100%;\"></div>
		</div>
	</div>
    </div>
  </a>
</div>";
					} else {
						echo "<div class=\"mdui-col\">
  <a href=\"" . $result[ 'url'] . "\" class=\"moe-bangumi-href bangumi-link\" title=\"" . $result[ 'title'] . "\" target=\"_blank\">
    <div class=\"mdui-card moe-bangumi-card moe-card-t\">
      <div class=\"mdui-card-media\" style=\"overflow: hidden;\">
		<div class=\"bangumi-banner\">
		<img src=\"/cache/" . $filename . "\" data-original=\"/cache/" . $filename . "\">
			<div class=\"bangumi-des\">
				<p>" . $result['evaluate'] . "</p>
			</div>
		</div>
      </div>
	<div class=\"bangumi-content\">
		<span class=\"bangumi-title\" title=\"" . $result[ 'title'] . "\">" . $result['title'] . "</span>
	</div>
	<div class=\"mdui-card-actions\">
		<div class=\"mdui-float-right\">更新至第" . $result['new_ep']['title'] . "话</div>
		<div class=\"mdui-progress\">
			<div class=\"mdui-progress-determinate\" style=\"width: 100%;\"></div>
		</div>
	</div>
    </div>
  </a>
</div>";
					}
				} else {
					$resource = fopen($path . $filename, 'a');
					fwrite($resource, $img);
					fclose($resource);
					if ($result['is_finish'] == 1) {
						echo "<div class=\"mdui-col\">
  <a href=\"" . $result[ 'url'] . "\" class=\"moe-bangumi-href\" title=\"" . $result[ 'title'] . "\" target=\"_blank\">
    <div class=\"mdui-card moe-bangumi-card moe-card-t\">
      <div class=\"mdui-card-media\" style=\"overflow: hidden;\">
		<div class=\"bangumi-banner\">
		<img src=\"/cache/" . $filename . "\" data-original=\"/cache/" . $filename . "\">
			<div class=\"bangumi-des\">
				<p>" . $result['evaluate'] . "</p>
			</div>
		</div>
      </div>
	<div class=\"bangumi-content\">
		<span class=\"bangumi-title\" title=\"" . $result[ 'title'] . "\">" . $result['title'] . "</span>
	</div>
	<div class=\"mdui-card-actions\">
		<div class=\"mdui-float-right\">" . $result['total_count'] . "</div>
		<div class=\"mdui-progress\">
			<div class=\"mdui-progress-determinate\" style=\"width: 100%;\"></div>
		</div>
	</div>
    </div>
  </a>
</div>";
					} else {
						echo "<div class=\"mdui-col\">
  <a href=\"" . $result[ 'url'] . "\" class=\"moe-bangumi-href\" title=\"" . $result[ 'title'] . "\" target=\"_blank\">
    <div class=\"mdui-card moe-bangumi-card moe-card-t\">
      <div class=\"mdui-card-media\" style=\"overflow: hidden;\">
		<div class=\"bangumi-banner\">
		<img src=\"/cache/" . $filename . "\" data-original=\"/cache/" . $filename . "\">
			<div class=\"bangumi-des\">
				<p>" . $result['evaluate'] . "</p>
			</div>
		</div>
      </div>
	<div class=\"bangumi-content\">
		<span class=\"bangumi-title\" title=\"" . $result[ 'title'] . "\">" . $result['title'] . "</span>
	</div>
	<div class=\"mdui-card-actions\">
		<div class=\"mdui-float-right\">" . $result['new_ep']['title'] . "</div>
		<div class=\"mdui-progress\">
			<div class=\"mdui-progress-determinate\" style=\"width: 100%;\"></div>
		</div>
	</div>
    </div>
  </a>
</div>";
					}
				}
			}
		}
	}
	$pn = $pn + 1;
	$total = $total - 50;
}
?>
</div>
</div>
</div>
</main>
<?php endwhile; ?>
</div>
<br><br><br>
<?php
get_footer();
