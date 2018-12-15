##  名称：
小灿框架
### 说明：
刚刚搭建一个mvc框架，使用自动加载机制
利用composer自动上传
nginx不支持pathinfo模式，需要手动创建
### 使用方法：
      1. 安装composer
      2. 下载项目到本地
      3. 执行命令composer update
      4. 如果你的服务器是nignx麻烦配置一下pathinfo模式（下面有pathinfo），在本地host添加xiaocan.localhost.com
      5. 配置项目Config/Db.php,支持主从多台数据库的配置
      6. 建立数据库，建立表如test
      7. 在浏览器输入 /index/index,可见内容hello chinaArray ( [0] => Array ( [id] => 1 [name] => I am Mysql ) ) hello china1
### nginx的pathinfo的配置
server {
    listen 80;  IPv4
    server_name xiaocan.localhost.com

    access_log logs/localhost_access.log;
    error_log logs/localhost_error.log;

    root D:/Wnmp/html/example/public/;
    index  index.php index.html index.htm;

    location = /favicon.ico {
        try_files $uri =204;
        log_not_found off;
        access_log off;
    }
        
    location = /robots.txt {
        allow all;
        log_not_found off;
        access_log off;
    }

        location / {
                if (!-e $request_filename) {
                        rewrite  ^/(.*)$  /index.php/$1  last;
                        break;
                }
        }

        location ~ \.php
        {
                #fastcgi_pass  unix:/tmp/php-cgi.sock;
                fastcgi_pass  php_processes;
                fastcgi_index index.php;
                include        fastcgi_params;
                set $real_script_name $fastcgi_script_name;
                if ($fastcgi_script_name ~ "^(.+?\.php)(/.+)$") {
                        set $real_script_name $1;
                        set $path_info $2;
                }
                fastcgi_param SCRIPT_FILENAME $document_root$real_script_name;
                fastcgi_param SCRIPT_NAME $real_script_name;
                fastcgi_param PATH_INFO $path_info;
        }

} 
### 联系方式：843665303@qq.com