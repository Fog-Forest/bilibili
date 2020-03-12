# WordPress博客 B站追番页面

本项目为 [bilibili](https://github.com/TaylorLottner/bilibili) 项目的备份，如有侵权请告知

### 将 **anime_bili.php** 文件放到站点根目录!

### 说明
1. 首先修改 **page-anime.php** 里面的这串数字，换成各位同学的uid


2. 其次打开bilibili，登入后进入个人空间【不要忘记把番剧设置成公开~】


![1.jpg](https://ae01.alicdn.com/kf/He8a786ec71184ffd8432f647c3e628354.jpg)

**箭头处即你的UID**

3. 打开F12的**Network**并刷新，找到与你UID相同的文件并打开
![2.jpg](https://ae01.alicdn.com/kf/Hd2adbe5fac084d51b6f3f9a3f02fe54cP.jpg)

找到cookie一栏，**完全复制**


举例：_uuid=4A7B58DE-6C3C-BF5E-B8C6-5D48489749688infoc; buvid3=53283E1E-E010-473E-B1AC-AC56B35C8D78155813infoc; sid=ifh97oa5; DedeUserID=8142789; DedeUserID__ckMd5=02832b48fef34f47; SESSDATA=f03c9edc%2C1599568237%2C2b113*31; bili_jct=761c41464fa5ccd3f681f6b8c07976f0; LIVE_BUVID=AUTO5815840214807981; CURRENT_FNVAL=16; PVID=1


4. 回到 **page-anime.php** ，发现你修改的uid后方有预留的格子，里面填入你的cookie保存，并放入你的主题根目录即可


5. 对于图片不显示问题应当在你的主题文件header.php中插入代码
```
<meta name="referrer" content="same-origin">
```
从而解决bilibili防盗链问题


6. 在WP后台新建页面时选择模板，创建页面，即可显示成功。


### 效果展示
原版效果
![3](https://ae01.alicdn.com/kf/Hebb5ee75ce30443aa72c6e58cefd284cb.png)


自用版效果
![4](https://ae01.alicdn.com/kf/H2dcbc1229f7d48a380fdd20ff706b39bC.jpg)
