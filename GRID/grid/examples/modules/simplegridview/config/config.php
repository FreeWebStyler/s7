<?php

$config = [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:../modules/simplegridview/db/category.db',
        ]
    ],
];

return $config;