#### 简单的读写freeswitch配置文件的web，restful风格，无使用框架

#### 5个目录

1. gateway
   /usr/local/freeswitch/conf/sip_profiles/external/

2. queue
   /usr/local/freeswitch/conf/queues/

3. user
   /usr/local/freeswitch/directory/default/

4. agent
   /usr/local/freeswitch/conf/agents/

5. tier
   /usr/local/freeswitch/conf/tiers/


#### 4种方法

1. get
```
curl -X GET http://192.168.1.184:8000/gateway/trunk.3.xml
```

2. post
```
curl -X POST -H '{Content-Type: text/xml}' http://192.168.1.184:8000/gateway/trunk.1.xml -d '<include></include>'
```

3. put
```
curl -X PUT -H '{Content-Type: text/xml}' http://192.168.1.184:8000/gateway/trunk.1.xml -d '<include></include>'
```

4. delete
```
curl -X DELETE  http://192.168.1.184:8000/gateway/trunk.1.xml
```

#### nginx配置
```
server {
    listen      8000;
    server_name localhost;
    root        /var/www/fsxml;
    index       index.php index.html;
    charset     utf-8;

    if ( $remote_addr !~* "192.168.1.185") {
        return 403;
    }

    location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        try_files       $uri =404;

        fastcgi_pass    127.0.0.1:9000;
        fastcgi_index   index.php;

        include fastcgi_params;
        fastcgi_split_path_info       ^(.+\.php)(/.+)$;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht {
        deny all;
    }
}
```
