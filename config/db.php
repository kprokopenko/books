<?php

$heroku = getenv("CLEARDB_DATABASE_URL");

if ($heroku) {
    $url = parse_url($heroku);

    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=' . $url['host'] . ';dbname=' . substr($url["path"],1),
        'username' => $url['user'],
        'password' => $url['pass'],
        'charset' => 'utf8',
    ];
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=db;dbname=books',
    'username' => 'books',
    'password' => 'secret',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
];
