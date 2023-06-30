<?php
session_start();
ini_set('display_errors', true);

function parse(string $url): array
{
    $params = [];
    $regex = "/(.+):\/\/(.+):(.+)@(.+):(\d+)\/(.*)/";
    preg_match($regex, $url, $matches);

    if ($matches[1] == "postgres") {
        $params["scheme"] = "pgsql";
    }

    $params["user"] = $matches[2];
    $params["password"] = $matches[3];
    $params["host"] = $matches[4];
    $params["port"] = $matches[5];
    $params["database"] = $matches[6];

    return $params;
}

function generateDSN(array $params): string
{
    return $params["scheme"] . ":host=" . $params["host"] . ";port=" . $params["port"] . ";dbname=" . $params["database"];
}

try {
    // Extract DATABASE_URL env variable
    $url = getenv("DATABASE_URL");

    // Parse URL
    $params = parse($url);

    // Create DSN from params
    $dsn = generateDSN($params);

    $dbh = new PDO($dsn, $params["user"], $params["password"]);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("Problem connecting to the database " . $params["database"] . " as " . $params["user"] . ": " . $e->getMessage());
}
