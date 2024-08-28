<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

//validate
$errors = [];
if (!Validator::email($email)) {
	$errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password, 7, 225)) {
	$errors['password'] = 'Please provide a password of at least 7 characters';
}

if (!empty($errors)) {
	return view('registration/create.view.php', [
		'errors' => $errors
	]);
}

//check user exists
//if yes redirect to login
//if not then create and save to db and logins

$db = App::resolve(Database::class);

$user = $db->query("SELECT * FROM users WHERE email = :email", [
	'email' => $email
])->find();

if ($user) {
	header('Location: /');
	exit();
} else {
	$db->query("INSERT INTO users (email, password) VALUES (:email, :password)", [
		'email' => $email,
		'password' => password_hash($password, PASSWORD_BCRYPT),
	]);

	$_SESSION['user'] = [
		'email' => $email,
	];

	header('location: /');
	exit();
}


