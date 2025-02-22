<?php

echo "First users";

$db = new PDO('sqlite:database.sqlite');

// ^ this is you object that allows you to interact with this database instance.

$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    age INTEGER
)");

$db->exec("INSERT INTO users (name, age) VALUES ('Andy', 32)");