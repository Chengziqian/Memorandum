# 2016-2017寒假任务

## 任务清单
1. 工程任务
  + 从 [#项目列表](#项目列表) 1-4 中任选一个，**`或自立一个课题（推荐！）`**
  + 鼓励发掘新功能
  + UI/UX 不做要求，自己觉得合适就行
1. 设计排版任务 *静态网页，不需要数据库*  
   从 [#项目列表](#项目列表) 5-6 中任选一个  
1. 根据 [#学习任务](#学习任务) 所提到的再巩固一下呗

## 任务要求
1. `功能`中除标记星号（`*`）的都必须实现
1. 代码必须同步自己Gayhub
1. 最晚于2017年2月21日（周三）把两个任务的代码同步到Gayhub并在群里发出地址
1. 2017年2月24日（周六）汇报展示
1. 未完成的将不能继续留在工作室

## 项目列表
1. 个人博客
  + 用户注册、登陆
  + 发布、编辑、删除博客
  + (\*) 评论
1. “轻笔记”
  + (咦。。想了想和博客没什么本质区别，换了个壳而已）
1. 图书管理系统
  + 用户注册、登陆
  + 管理员录入、编辑、删除书籍信息
  + 用户可查询书籍基本信息、剩余本数
  + 用户借走书本
  + 管理员还入书本
1. 论坛 BBS
  + 用户注册、登陆
  + 发帖
  + 回复
1. 个人主页设计
1. 工作室主页设计 (http://www.qkteam.com, http://www.qkteam.com/old)

## 学习任务
+ Git
+ Linux基本操作
+ HTML
+ CSS
+ PHP
+ MySQL
+ JavaScript

## 部分建议
### Git
http://www.bootcss.com/p/git-guide/

### HTML/CSS
W3Schools
[中文镜像](http://www.w3school.com.cn/)
[国内英文镜像](http://w3schools.bootcss.com/default.html)
[英文（备梯子）](http://www.w3schools.com/)

### PHP
史上最良心的官方文档 http://php.net/manual/zh/

### MySQL
首先是一些用得少的东西
```
CREATE DATABASE blog;
USE blog;
DROP DATABASE blog;
CREATE TABLE user;
DROP TABLE user;
```

然后学会下面 6 个操作，任何复杂的语句都能实现了
```
SELECT * FROM `user`;
SELECT COUNT(*) FROM `user`;
SELECT `id`, `username` FROM `user`;
INSERT INTO `user` (`username`, `email`) VALUES ("admin", "admin@admin.com");
UPDATE `user` SET `username` = "admin", `email` = "admin@admin.com" WHERE `id` = 1;
DELETE FROM `user` WHERE `id` = 1;
```

### JavaScript
JS更新换代非常快，学js需要你有很强大的自学能力，今天你可能刚把A技术学到入门，明天就可能出了一项新的B技术  
所以这部分不做要求，入门简单，后期深入的话坑很大、水太深  
如果你以后真的想从事Web前端开发，那么请自学  

## 最后几句话
+ Web水很深，但入门很简单，平时多花时间，一定要有耐心
+ 工作室不是培训班，所以永远不要指望工作室能教会你什么
+ 工作室能提供给你的只有资源和环境，自己把握好机会
+ 成功的永远只有少数人，但是大家一定不要放弃
+ 加油

## 预告
明年暑假我们仍会继续举行近两个月的暑期实践（2017年7月放假一直到8月开学）  
非强制性，但是不来的不要后悔
