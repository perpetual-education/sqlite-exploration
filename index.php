<?php

$db = new PDO('sqlite:database.sqlite');

// ^ this is you object that allows you to interact with this database instance.

$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    age INTEGER
)");



function createUser($db, $name, $age) {
	// somehow you need to have the reference to the database available in this scope

	$db->exec("INSERT INTO users (name, age) VALUES ('$name', '$age')");

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
	</label>
	
	<label>
		<span>Age</span>
		<input type='number' name='age'>
	</label>

	<div class='actions'>
		<button type='submit' name='create_user'>Add</button>
	</div>
</form>


<ul>
	<?php foreach ($people as $person) { ?>
		<li>
			<article>
				<?=$person['name']?>
			</article>
		</li>
	<?php } ?>
</ul>

























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
	}
</style>