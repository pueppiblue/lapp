# lapp
======

[![Build Status](https://travis-ci.org/pueppiblue/lapp.svg?branch=master)](https://travis-ci.org/pueppiblue/lapp)   [![SensioLabsInsight](https://insight.sensiolabs.com/projects/beff7846-286f-405f-8326-4a504e284b49/small.png)](https://insight.sensiolabs.com/projects/beff7846-286f-405f-8326-4a504e284b49)


Installation notes:
--------------
### Install composer and npm
```bash
curl -sS https://getcomposer.org/installer | php
curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.31.0/install.sh | bash
source ~/.nvm/nvm.sh && nvm install 5.10.1
```

###give webserver access to cache and logs
```bash
$ HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
>$ sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
>$ sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
```

###create user for mysql
```bash
mysql -uroot  -p -e "grant all on lapp.* to lapp@'localhost' identified by 'lapp';flush privileges;"
```

### run composer script to initialize the application
```bash
php composer.phar run-script project-init
```
