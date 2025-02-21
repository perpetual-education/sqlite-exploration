<?php

echo "Hi";

$myAmazingDatabase = new PDO('sqlite:database.sqlite');

// ^ this is you object that allows you to interact with this database instance.

$myAmazingDatabase->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    age INTEGER
)");
