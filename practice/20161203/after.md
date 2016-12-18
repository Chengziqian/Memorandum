所有讲课内容都在 https://github.com/GuessEver/memorandum

## 20161203 - 20161210 作业：
1. 用BootStrap-CSS美化完善网站UI
2. 上传到Github并自学Git相关操作
3. 本机部署好服务器环境

## 服务器相关
1. 部署  
   附Ubuntu部署方法  
   ```bash
   $ sudo apt install apache2 php7.0 libapache2-mod-php7.0 mysql-server php7.0-mysql
   ```
   (非ubuntu16.04用户请使用`apt-get`）  
   安装mysql-server过程中会弹出对话框设置密码（为了便于开发和调试，建议设置本地数据库密码为root）
   
2. 检验Apache  
   浏览器打开 `http://localhost`
   
3. 检验php  
   在Apache主目录（自己找）下新建如下文件并保存  
   hello.php
   ```php
   <?php
   echo 'hello world';
   ```
   
   info.php
   ```php
   <?php
   echo phpinfo();
   ```
   
   浏览器分别打开 `http://localhost/hello.php`, `http://localhost/info.php`
   
4. 检验mysql  
   打开终端输入
   ```bash
   $ mysql -uroot -p                          **** 然后会提示输入安装时设置的密码
   >>> show databases;
   >>> quit()
   ```
   
   
## 20161210 预告：
+ 14:30-15:00   每人5分钟汇报展示
+ 15:00-16:00   MySQL讲解
+ 16:00-17:00   PHP讲解
+ 17:00-18:00   备忘录二期工程

## 汇报展示：
1. 展示自己已美化的作品
2. 确保自己装好了服务器环境
3. 自愿报名讲Git（没人讲我也不讲 = =）
4. 鼓励自学并分享一些Web黑科技
