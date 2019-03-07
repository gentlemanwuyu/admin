## 项目概述
* 产品名称：企业管理系统
* 官方地址：https://admin.gentlemanwuyu.top

## 功能模块
- (Auth)用户认证 —— 注册、登录、退出；
- (Organization)企业结构 —— 部门；
- (Entrust)权限 —— permission、role；
- (Category)分类 —— 产品分类、商品分类；

## 运行环境要求
- Nginx 1.12
- PHP 7.0.28
- Mysql 5.6
- Redis 3.2

## 开发环境部署/安装

本项目代码使用 PHP 框架 [Laravel 5.2](https://d.laravel-china.org/docs/5.2/) 开发，本地开发环境使用 [Docker](https://github.com/gentlemanwuyu/dockerproject)。

### 基础安装

#### 1. 克隆源代码

克隆 `admin` 源代码到本地：

     git clone git@github.com:gentlemanwuyu/admin.git

#### 2. 安装扩展包依赖

     composer install

#### 3. 生成配置文件

```
cp .env.example .env
```

你可以根据情况修改 `.env` 文件里的内容，如数据库连接、缓存、邮件设置等：

### 前端框架安装

1). 安装 node 和 npm

直接去官网 [https://nodejs.org/en/](https://nodejs.org/en/) 下载安装最新版本。

2). 安装 gulp

    npm install --global gulp

如果是mac或linux系统，执行 `npm install`；如果是win系统执行`npm install --no-bin-links`

3). 编译前端内容

```shell
// 运行所有gulp编译任务...
gulp

// 运行所有gulp编译任务并缩小输出，一般是正式环境使用。
gulp --production
```

4). 监控修改并自动编译

```shell
gulp watch
```
