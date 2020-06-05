<?php
class bilibiliAnime
{
    public $total;  // 追番总数
    public $title = array();  // 标题
    public $image_url = array();  // 图链
    public $fan_number = array();  // 番剧总集数
    public $progress = array();  // 观看进度
    public $evaluate = array();  // 简介
    public $season_id = array();  // ID号


    // 获取追番总数
    private function getpage($uid)
    {
        $url = "https://api.bilibili.com/x/space/bangumi/follow/list?type=1&follow_status=0&pn=1&ps=15&vmid=$uid";
        $info = json_decode(file_get_contents($url), true);
        return $info['data']['total'];
    }

    // 处理观看记录的函数
    private function process($content)
    {
        if (stripos($content, "第")) {
            $start = stripos($content, "第");
            $end = stripos($content, "话");
            return substr($content, $start + 3, $end - $start - 3);
        } elseif (strpos($content, "OAD")) {
            return "已经追完了咯~";
        } elseif ($content == null) {
            return "貌似还没有看呢~";
        } else {
            return preg_replace('/(\d:)?\d{2}:\d{2}/', '', $content);
        }
    }
    private function fan_number($content)
    {
        if ($content == null) {
            return "还没开始更新呢~";
        } else {
            return $content;
        }
    }

    public function __construct($uid, $cookie)
    {
        $this->total = $this->getpage($uid);
        for ($i = 1; $i <= ceil($this->total / 15); $i++) {
            $url = "https://api.bilibili.com/x/space/bangumi/follow/list?type=1&follow_status=0&pn=$i&ps=15&vmid=$uid";
            $ch = curl_init();  // 初始化curl模块
            curl_setopt($ch, CURLOPT_URL, $url);  // 登录提交的地址
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // 获取到的数据以文件流的方式返回
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(  // 发送请求头
                "User-Agent:  Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36",
                "Referer: https://www.bilibili.com/",
                "Cookie: $cookie",
            ));
            $info = json_decode(curl_exec($ch), true);
            curl_close($ch);  // 关闭连接
            foreach ($info['data']['list'] as $data) {
                array_push($this->title, $data['title']);
                array_push($this->image_url, str_replace('http://', '//', $data['cover']));  // 协议跟随
                array_push($this->fan_number, $this->fan_number($data['new_ep']['title']));
                array_push($this->progress, $this->process($data['progress']));
                array_push($this->evaluate, $data['evaluate']);
                array_push($this->season_id, $data['season_id']);
            }
        }
    }
}
