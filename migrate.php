<?php

if (php_sapi_name() != "cli") {
    die('Migrations can be initialized from PHP CLI only');
}

$config = require_once __DIR__ . '/config.php';

require_once __DIR__ . '/core/lib/files.php';
require_once __DIR__ . '/core/lib/arrays.php';
require_once __DIR__ . '/core/lib/db.php';

$migrationsDir = __DIR__ . '/migrations';

$arguments = array_slice($argv, 1);
$file = getArrayValue($arguments, 0);

if ($file) {
    $rout = "{$migrationsDir}/{$file}";
    if (!file_exists($rout)) {
        die("Migration '{$file}' is not exists");
    }

    require_once $rout;
    up();
} else {
    die("Migration is not transferred");
}
