<?php

$config = [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:../modules/yii2pjax/db/php_version.db',
        ]
    ],
];

return $config;