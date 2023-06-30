<?php

$tables = [
    'users' => [
        'id integer NOT NULL',
        'username character varying(12) NOT NULL',
        'password character varying(80) NOT NULL',
        'email character varying(40) NOT NULL',
        'vkey character varying(255) NOT NULL',
        'verified boolean DEFAULT false NOT NULL',
        'createdat timestamp without time zone DEFAULT now() NOT NULL'
    ],
    'custom' => [
        'userid integer NOT NULL',
        'kanji character varying(1) NOT NULL',
        'list_name character varying(15)',
        'note character varying(80)',
        'rating character varying(4)',
        'rated_at timestamp without time zone'
    ]
];

try {
    $databaseName = getenv('DB_NAME');
    $databaseUser = getenv('DB_USER');
    $databasePassword = getenv('DB_PASS');
    $databaseHost = getenv('DB_HOST');
    $connectionString = "pgsql:dbname=$databaseName;host=$databaseHost";


    $db = new PDO($connectionString, $databaseUser, $databasePassword);

    // Set PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach ($tables as $tableName => $columns) {
        $createTableQuery = "CREATE TABLE IF NOT EXISTS public.$tableName (\n";
        $createTableQuery .= implode(",\n", $columns);
        $createTableQuery .= "\n);";

        $db->exec($createTableQuery);
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
