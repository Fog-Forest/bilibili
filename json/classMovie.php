<?php
class bilibiliMovie
{
    public $total;  // 追剧总数
    public $title = array();  // 标题
    public $image_url = array();  // 图链
    public $evaluate = array();  // 简介
    public $season_id = array();  // ID号

    // 获取追剧总数
    private function getpage($uid)
    {
        $url = "https://api.bilibili.com/x/space/bangumi/follow/list?type=2&follow_status=0&pn=1&ps=15&vmid=$uid";
        $info = json_decode(file_get_contents($url), true);
        return $info['data']['total'];
    }

    public function __construct($uid)
    {
        $this->total = $this->getpage($uid);
        for ($i = 1; $i <= ceil($this->total / 15); $i++) {
            $url = "https://api.bilibili.com/x/space/bangumi/follow/list?type=2&follow_status=0&pn=$i&ps=15&vmid=$uid";
            $info = json_decode(file_get_contents($url), true);
            foreach ($info['data']['list'] as $data) {
                array_push($this->title, $data['title']);
                array_push($this->image_url, str_replace('http://', '//', $data['cover']));  // 协议跟随
                array_push($this->evaluate, $data['evaluate']);
                array_push($this->season_id, $data['season_id']);
            }
        }
    }
}
