
<?php
$databaseName = getenv('DB_NAME');
$databaseUser = getenv('DB_USER');
$databasePassword = getenv('DB_PASS');
$databaseHost = getenv('DB_HOST');

$connectionString = "pgsql:dbname=$databaseName;host=$databaseHost";
try {
    $database = new PDO($connectionString, $databaseUser, $databasePassword);
    $currentDirectory = getcwd();
} catch (PDOException $exception) {
    echo 'Failed to establish a connection: ' . $exception->getMessage();
}
?>
<!-- # -->
