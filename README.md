
# SQLite exploration

Apparently... you can just make a file - and it's a database... and it's already built into PHP. But The docs are not very friendly or clear.

* PDO overview (introduction) https://www.php.net/manual/en/class.pdo.php
* setAttribute() method https://www.php.net/manual/en/pdo.setattribute.php
* PDO attributes and constants https://www.php.net/manual/en/pdo.constants.php
* PDO error modes https://www.php.net/manual/en/pdo.error-handling.php
* SQLite-specific PDO docs https://www.php.net/manual/en/ref.pdo-sqlite.php

Take some time to look at that. Were you able to create a database and access it yet?

On a scale from 1-10, how easy would it be for a your average developer to figure this out?

---

## What is SQLite

Created by D. Richard Hipp to be an embedded SQL database requiring minimal setup / 2000. Soon adopted in Python, PHP, and OS projects. It's used in a wide range of applications.

Zero setup, no configuration, it's just a file (well, not really) (it has a built-in engine that executes SQL), fast, you can just copy it and move it, [ACID](https://en.wikipedia.org/wiki/ACID) compliant - but uses a single write lock. MySQL and PostgresSQL support multi-thread.

When you're first learning these database concepts and tools - you're really not concerned with high-traffic situations - so, you may as well choose something that lets you focus on _learning_.

## We're using PHP - so, how do you use SQLite in that context?

You'll see "PDO" (which stands for **P**HP **D**ata **O**bjects apparently). It's a built-in PHP extension that provides a unified, object-oriented interface for interacting with databases. It acts as a database abstraction layer, meaning you can use the same functions to work with MySQL, PostgreSQL, SQLite, and other databases without changing much of your code.

### Why not just write raw SQL queries?

### Use any database with the same interface

Raw queries are tied to the specific database and PDO works for all / and you could switch types later. Gives you a unified way to fetch data.

```js
function getRecordById($table, $id) {
	// who cares how it works
	// like making any reusable things
}
```

### Security

```php
$name = $_GET['name']; 
$query = "SELECT * FROM users WHERE name = '$name'";
$result = $db->query($query);
```
Someone could mess you up! The data and the query are together. (SQL injection)

### Prepared statements / easier to read and maintain

```php
$stmt = $db->prepare("SELECT * FROM users WHERE name = ?");
$stmt->execute([$name]);
```

PDO prepares the query and the data seperatly and automatically escapes the possibly dangerous input.

(and there are some other benefits too, but you get the point)

---

## Using PDO

```php
$myAmazingDatabase = new PDO('sqlite:database-name.sqlite');

$db = new PDO('sqlite:database-name.sqlite');

// for simplicity, you might choose to use $db (but it's just a variable, right?)
```

What does this object/interface offer us?

```php
$db->setAttribute(options);
```
Customizes how PDO behaves when interacting with a database. How errors are handled, how query results are returned, etc

```php
$db->exec($sql);
```
Executes a SQL command when you don’t need results back, creating tables, inserting data, deleting things.

```php
$db->query($sql);
```
Executes a SQL query and returns results (for SELECT statements).

```php
$db->prepare($sql);
```
Prepares a SQL statement to safely accept user input.



