Yii 2 Gridview sort and filter on related data example
============================

INSTALLATION
------------

~~~
php composer.phar global require "fxp/composer-asset-plugin:~1.1.1"
php composer.phar create-project --prefer-dist --stability=dev yii2-gridview-filter-and-sort-example basic
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~

Configure database access in `config/db.php` file.

Apply migration to create database tables buy run

~~~
./yii migrate
~~~

Related page: http://nix-tips.ru/yii2-sortirovka-i-filtr-gridview-po-svyazannym-i-vychislyaemym-polyam.html