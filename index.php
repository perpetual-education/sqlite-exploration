<?php

require('helpers.php');

$db = getDatabaseConnection();

initializeDatabase($db);

// put the values back in the form / set defaults
$n = $_POST['first_name'] ?? "";
$a = $_POST['age'] ?? "";

$errors = [];

if ( postForm("create_user") ) {
	$name = $_POST['first_name'];
	$age = $_POST['age'];

    $errors = createUser($db, $name, $age);

    if ( empty($errors) ) {
        clearForm();
    }
}

?>


<form method='POST'>
	<h2>Create user</h2>

	<label>
		<span>First name</span>
		<input type='text' name='first_name' value='<?=$n?>' />

		<?=showError($errors, 'first_name')?>
	</label>

	<label>
		<span>Age</span>
		<input type='number' name='age' value='<?=$a?>' />

		<?=showError($errors, 'age');?>
	</label>

	<?=showError($errors, 'database')?>

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