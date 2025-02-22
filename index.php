<?php

$db = new PDO('sqlite:database.sqlite');

// ^ this is you object that allows you to interact with this database instance.

$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    age INTEGER
)");

$errors = []; // there might be many errors

function showError($name) {
	global $errors;

	if ($errors[$name]) {
		$message = $errors[$name];
		return "<p class='error'>$message</p>";
	}
}

function createUser($db, $name, $age) {
	// somehow you need to have the reference to the database available in this scope

	global $errors; // a different way to get an outside variable in this scope

	if ( !empty($name) ) {
		$db->exec("INSERT INTO users (name, age) VALUES ('$name', '$age')");
	} else {
		$errors['first_name'] = "Please add a name before we can save this record";
	}

	if (!is_numeric($age) || $age < 0) {
    	$errors['age'] = "Please enter a valid age.";
	}

	// should it have some sort of return value?
	// could it fail?
	// weird that those variables need quotes... '$name' : /
}

// if the post was submitted (re-requesting the page now... )
if ( isset( $_POST['create_user']) ) {
	createUser( $db, $_POST['first_name'], $_POST['age'] );
}

$people = $db->query("SELECT * FROM users")->fetchAll();


?>

<form method='POST'>
	<h2>Create user</h2>

	<label>
		<span>First name</span>
		<input type='text' name='first_name'>

		<?=showError('first_name');?>
	</label>

	<label>
		<span>Age</span>
		<input type='number' name='age'>

		<?=showError('age');?>
	</label>

	<!-- anything that gets too complicated to look at can be moved to it's own file -->
	<?php include('error-list.php'); ?>

	<div class='actions'>
		<button type='submit' name='create_user'>Add</button>
	</div>
</form>



<?php include('people-list.php'); ?>























<style>
	form {
		display: grid;
		gap: 10px;
		max-width: 300px;
		label {
			display: grid;
		}
		input[type='text'], input[type='number'] {
			display: block;
			font: unset;
			font-size: 1rem;
			padding: 0.5em;
		}
		.actions {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;

			margin-top: 10px;
		}
		.error {
			color: red;
		}
	}
</style>