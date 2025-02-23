<?php


function getDatabaseConnection() {
    $db = new PDO('sqlite:database.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

// in helpers.php
function clearForm() {
	header("Location: " . $_SERVER['PHP_SELF']);
	exit;
}

function initializeDatabase($database) {
	$database->exec("CREATE TABLE IF NOT EXISTS users (
    	id INTEGER PRIMARY KEY AUTOINCREMENT,
    	name TEXT NOT NULL,
    	age INTEGER
	)");
}

function validateUser($name, $age) {
	$errors = [];

	if ( empty($name) ) {
		$errors['first_name'] = "Please add a name before we can save this record";
	}

	if (!is_numeric($age) || $age < 0) {
    	$errors['age'] = "Please enter a valid age.";
	}

	return $errors;
}

function showError($errors, $name) {
	if ( isset($errors[$name]) ) {
		$message = $errors[$name];
		return "<p class='error'>$message</p>";
	}

	return "";
}

function createUser($db, $name, $age) {
	$errors = validateUser($name, $age);

	if ( !empty($errors) ) {
		return $errors;
	}

    try {
        $db->exec("INSERT INTO users (name, age) VALUES ('$name', $age)");
        return []; // no errors means success, right?
    } catch (Exception $error) {
        return ['database' => "Database error: " . $error->getMessage()];
    }
}

function postForm($name) {
	return $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[$name]);
	// there are other request types, so - it's nice
	// to make sure you aren't just assuming what it is
}
