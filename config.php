<?php

$url = getenv("DATABASE_URL");

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
    $params = parse($url);
    $dsn = generateDSN($params);
    $pdo = new PDO($dsn, $params["user"], $params["password"], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $currentDir = getcwd();
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
