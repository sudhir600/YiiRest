<?php
$serverIP = $_SERVER['SERVER_ADDR'];
if(!empty($serverIP) && $serverIP !== '127.0.0.1') {
	$dbParams = require __DIR__ . '/../environments/prod.php';
}
else {
	$dbParams = require __DIR__ . '/../environments/dev.php';
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.$dbParams['host'].';dbname='.$dbParams['dbName'],
    'username' => $dbParams['userName'],
    'password' => $dbParams['password'],
    'charset' => $dbParams['charset'],

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
