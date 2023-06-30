<?php

$statements = [
    'CREATE TABLE IF NOT EXISTS public.users (
        id integer NOT NULL,
        username character varying(12) NOT NULL,
        password character varying(80) NOT NULL,
        email character varying(40) NOT NULL,
        vkey character varying(255) NOT NULL,
        verified boolean DEFAULT false NOT NULL,
        createdat timestamp without time zone DEFAULT now() NOT NULL
    )',
    'CREATE TABLE IF NOT EXISTS public.custom (
        userid integer NOT NULL,
        kanji character varying(1) NOT NULL,
        list_name character varying(15),
        note character varying(80),
        rating character varying(4),
        rated_at timestamp without time zone
    )',
];

function parse(string $url): array
{
    $params = array();
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

function from_params(array $params): string
{
    return $params["scheme"] . ":host=" . $params["host"] . ";port=" . $params["port"] . ";dbname=" . $params["database"];
}

try {
    // Extract DATABASE_URL env variable
    $url = getenv("DATABASE_URL");

    // Parse url
    $params = parse($url);

    // Create DSN from params
    $DSN = from_params($params);

    // Make a database connection
    $db = new PDO($DSN, $params["user"], $params["password"]);

    // Set PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach ($statements as $statement) {
        $db->exec($statement);
    }

    echo "Tables created successfully.";
} catch (PDOException $e) {
    // Log the error
    error_log('Migration Error: ' . $e->getMessage());

    // Display a generic error message
    die("An error occurred during migration. Please try again later.");
} finally {
    // Close the database connection
    $db = null;
}
