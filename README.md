# WordPress博客 B站追番/追剧页面模板

### 本项目为 [bilibili](https://github.com/TaylorLottner) 的二开（原项目已被作者删除，备份见本项目 V1.2），已获原作者授权！

### 使用说明
1. 下载本项目，将 `json` 整个目录扔到你的站点**根目录**，将 `page-anime.php` 和 `page-movie.php` 文件扔到你的**WP主题根目录**

2. 按照注释，修改 `json` 里的 `bilibiliAcconut.php` 文件，填入你的信息（参考下方获取你的信息）
![](https://cdn.jsdelivr.net/gh/Fog-Forest/Picture-Bed/blog/20200528153655.jpg)

3. 最后在 WP后台 新建页面时选择相应的模板，创建页面即可。

### 获取信息
#### 获取B站UID 
打开[哔哩哔哩](https://www.bilibili.com/)，登入后进入个人空间，红框处为你的 B站UID【不要忘记把番剧设置成公开哦~】

![](https://cdn.jsdelivr.net/gh/Fog-Forest/Picture-Bed/blog/20200528154041.jpg)

#### 获取B站Cookie
登入后进入个人空间，按 **F12** 进入浏览器调试工具，打开 `Network` 再次刷新页面，找到与你 UID 相同的文件并打开，找到 `cookie` 一栏，**完全复制**，每个人的 Cookie 都不一样，建议用浏览器的 **无痕模式** 操作，这里用谷歌浏览器演示，如下图：

![](https://cdn.jsdelivr.net/gh/Fog-Forest/Picture-Bed/blog/20200528154355.png)

举例：`_uuid=XXXXXXX-XXXX-XXXX-XXXX-82C16AFEC65E68468infoc; buvid3=8A0CA4AF-XXXX-XXXX-XXXX-8357010EB5F3155827infoc; sid=iwqx36hz; DedeUserID=8142789; DedeUserID__ckMd5=02832b48fef34f47; SESSDATA=fed39455%2C1606203773%2C8731e*51; bili_jct=58ba9ab942399022c6d85195c26f15e3`

### 补充说明
得知B站的防盗链根据 `referrer` 来判断请求是不是来自B站，那好办了在 head 中添加一行代码，把 `referrer` 去掉就行【加在追番模版的 `get_header(); ?>` 下面就行了，我的修改版已经添加】

```html
<meta name="referrer" content="never">
```

### 效果预览
#### 原版
![4](https://cdn.jsdelivr.net/gh/Fog-Forest/Picture-Bed/blog/H6a94bdf90ddb40a9b417d3405e73393dg.jpg)

#### 我的修改版
![5](https://cdn.jsdelivr.net/gh/Fog-Forest/Picture-Bed/blog/H8b85865e4ca0489cb0542c2358526f05i.jpg)
