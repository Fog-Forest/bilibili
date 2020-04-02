# WordPress博客 B站追番页面

### 本项目为 [bilibili](https://github.com/TaylorLottner/bilibili) 项目的二次修改，已获原作者授权！

### 使用说明
1. 下载上面我的修改版并解压，将 `bilibiliAnime.php` 文件扔到到站点根目录

2. 将 `page-anime.php` 文件扔到 **主题根目录** ，修改里面的这串数字，换成各位同学的B站UID
!{1}(https://ae01.alicdn.com/kf/Hdf0b238d228a4a40ae75733cede7a7af8.jpg)

3. 接着打开哔哩哔哩，登入后进入个人空间，红线处为你的B站 UID【不要忘记把番剧设置成公开哦~】
!{2}(https://ae01.alicdn.com/kf/He8a786ec71184ffd8432f647c3e628354.jpg)

4. 按F12进入浏览器调试工具，打开 `Network` 并刷新页面，找到与你UID相同的文件并打开，这里用谷歌浏览器演示，如下图
!{3}(https://ae01.alicdn.com/kf/Hd2adbe5fac084d51b6f3f9a3f02fe54cP.jpg)

找到 `cookie` 一栏，**完全复制**，每个人的Cookie都不一样，建议用浏览器的 **无痕模式** 操作

举例：`_uuid=4A7B58DE-6C3C-BF5E-B8C6-5D48489749688infoc; buvid3=53283E1E-E010-473E-B1AC-AC56B35C8D78155813infoc; sid=ifh97oa5; DedeUserID=8142789; DedeUserID__ckMd5=02832b48fef34f47; SESSDATA=f03c9edc%2C1599568237%2C2b113*31; bili_jct=761c41464fa5ccd3f681f6b8c07976f0; LIVE_BUVID=AUTO5815840214807981; CURRENT_FNVAL=16; PVID=1`

5. 回到 `page-anime.php` 文件，按照第二步的说明，在里面填入你的Cookie保存

6. 最后在WP后台新建页面时选择模板，创建页面，即可显示成功

#### 补充说明
有没有发现你的追番页面没有小绿锁（HTTPS），因为B站的JSON返回的图片URL是HTTP，而且B站的图片还有防盗链~

得知B站的防盗链根据 **referrer** 来判断请求是不是来自B站，那好办了在head中添加一行代码，把 **referrer** 去掉就行【加在追番模版的`get_header(); ?>`下面就行了，我的修改版已经添加】

```html
<meta name="referrer" content="never">
```
然后把 `bilibiliAnime.php` 文件的第76行改为 `array_push($this->image_url, str_replace('http://', '//', $data['cover']));` 就可以了
![4](https://ae01.alicdn.com/kf/H9dfccaff67e446998351f95ea3c9e2f5J.jpg)

### 效果预览
#### 原版
已修复居中，你想一行展示更多自行修改CSS吧

![4](https://ae01.alicdn.com/kf/H6a94bdf90ddb40a9b417d3405e73393dg.jpg)

#### 我的修改版
![5](https://ae01.alicdn.com/kf/H8b85865e4ca0489cb0542c2358526f05i.jpg)

### 授权证书
![证书](https://ae01.alicdn.com/kf/Hea6f129fa173478991cea6b0e36a2b78b.png)
