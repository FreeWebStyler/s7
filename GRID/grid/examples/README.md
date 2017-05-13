Yii 2 Framework Usage Examples
============================

Based on Yii 2 Basic Project Template this application includes different examples based on modules.

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install from an Archive File

Extract the archive file downloaded from [BitBucket project page](https://bitbucket.org/p0vidl0/yii2-examples) to
a directory named `examples` that is directly under the Web root.

You can then access the application through the following URL:

~~~
http://localhost/examples/web/
~~~


### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
composer global require "fxp/composer-asset-plugin:~1.0.0"
composer create-project --prefer-dist --stability=dev p0vidl0/yii2-examples-app examples
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

If you use Apache directive Alias to access web folder - specify path to it in RewriteBase. For more see .htaccess file.

~~~
http://localhost/examples/web/
~~~