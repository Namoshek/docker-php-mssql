<?php

function test_sqlsrv_connection(&$errors)
{
    $host = getenv('MSSQL_HOST');
    $port = getenv('MSSQL_PORT');

    $connection = sqlsrv_connect("{$host},{$port}", [
        'UID' => getenv('MSSQL_USERNAME'),
        'PWD' => getenv('MSSQL_PASSWORD'),
        'Database' => getenv('MSSQL_DATABASE'),
    ]);

    if ($connection === false) {
        $errors[] = json_encode(sqlsrv_errors());

        return false;
    }

    $success = sqlsrv_query($connection, 'SELECT 1');

    if ($success === false) {
        $errors[] = json_encode(sqlsrv_errors());

        return false;
    }

    return true;
}

function test_pdo_sqlsrv_connection(&$errors)
{
    $host = getenv('MSSQL_HOST');
    $port = getenv('MSSQL_PORT');
    $database = getenv('MSSQL_DATABASE');
    $username = getenv('MSSQL_USERNAME');
    $password = getenv('MSSQL_PASSWORD');

    try {
        $connection = new PDO("sqlsrv:server={$host},{$port};Database={$database};ConnectionPooling=0;Encrypt=no", $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $success = $connection->query('SELECT 1');

        if ($success === false) {
            return false;
        }
    } catch (PDOException $e) {
        $errors[] = json_encode($e->getMessage());

        return false;
    }

    return true;
}

echo '== PHP extensions ==' . PHP_EOL;
echo 'sqlsrv version: ' . phpversion('sqlsrv') . PHP_EOL;
echo 'pdo_sqlsrv version: ' . phpversion('pdo_sqlsrv') . PHP_EOL;
echo PHP_EOL;

echo '== Environment variables ==' . PHP_EOL;
echo 'MSSQL_HOST: ' . getenv('MSSQL_HOST') . PHP_EOL;
echo 'MSSQL_PORT:' . getenv('MSSQL_PORT') . PHP_EOL;
echo 'MSSQL_USERNAME:' . getenv('MSSQL_USERNAME') . PHP_EOL;
echo 'MSSQL_PASSWORD:' . getenv('MSSQL_PASSWORD') . PHP_EOL;
echo 'MSSQL_DATABASE:' . getenv('MSSQL_DATABASE') . PHP_EOL;
echo PHP_EOL;

$errors = [];

echo '== Testing `sqlsrv` extension ==' . PHP_EOL;
$sqlsrvSuccess = test_sqlsrv_connection($errors);
echo 'Establishing connection ' . ($sqlsrvSuccess ? 'successful!' : 'failed.') . PHP_EOL;

echo '== Testing `pdo_sqlsrv` extension ==' . PHP_EOL;
$pdoSqlsrvSuccess = test_pdo_sqlsrv_connection($errors);
echo 'Establishing connection ' . ($pdoSqlsrvSuccess ? 'successful!' : 'failed.') . PHP_EOL;

if ($sqlsrvSuccess && $pdoSqlsrvSuccess) {
    exit(0);
}

var_dump($errors);
exit(1);
