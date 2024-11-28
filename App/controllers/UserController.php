<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;

class UserController {
  protected $db;

  public function __construct() {
    $config = require basePath('config/db.php');
    $this->db = new Database($config);
  }

  public function create() {
    loadView('users/create');
  }

  public function login() {
    loadView('users/login');
  }

  public function store() {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['password_confirmation'];

    $errors = [];


    if (!Validation::string($firstName, 2, 50)) {
      $errors['first_name'] = 'First Name must be between 2 and 50 characters';
    }

    if (!Validation::string($lastName, 2, 50)) {
      $errors['last_name'] = 'Last Name must be between 2 and 50 characters';
    }

    if (!Validation::string($email, 2, 50)) {
      $errors['email'] = 'Please enter a valid email email address';
    }

    if (!Validation::string($password, 6, 50)) {
      $errors['password'] = 'Password must be atleast 6 characters';
    }

    if (!Validation::match($password, $passwordConfirmation)) {
      $errors['password_confirmation'] = 'Password do not match';
    }

     if (!empty($errors)) {
      loadView('users/create', data: [
        'errors'=> $errors,
        'user' => [
          'firstName' => $firstName,
          'lastName' => $lastName,
          'email' => $email,
        ]
      ]);

      exit;
    }

    // Check if email exist;
    $params = [
      'email' => $email
    ];

    $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

    if ($user) {
      $errors['email'] = 'Email already exists';
      loadView('/users/create', [
        'errors' => $errors
      ]);
      exit;
    }

     // Create user account
    $params = [
      'first_name' => $firstName,
      'last_name' => $lastName,
      'email' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT)
    ];

    $this->db->query('INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)', $params);

    // Get user ID
    $userId = $this->db->conn->lastInsertId();

    Session::set('user', [
      'id' => $userId,
      'name' => $firstName,
      'email' => $email
    ]);

    redirect('/');
  }

  /**
   * Authenticate a user with email and password
   *
   * @return void
   */
  public function authenticate() {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

    // Validation
    if (!Validation::email($email)) {
      $errors['email'] = 'Please enter a valid email';
    }

    if (!Validation::string($password, 6, 50)) {
      $errors['password'] = 'Password must be at least 6 characters';
    }

    if (!empty($errors)) {
      loadView('users/login', [
        'errors' => $errors
      ]);
      exit;
    }

    // Check for email
    $params = [
      'email' => $email
    ];

    $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

    if (!$user) {
      $errors['email'] = 'Incorrect Credentials';
      loadView('users/login', [
        'errors' => $errors
      ]);

      exit;
    }

    // Check if password is correct
    if (!password_verify($password, $user->password)) {
      $errors['password'] = 'Incorrect credentials';
      loadView('users/login', [
        'errors' => $errors
      ]);
    }

    // Set user session
    Session::set('user', [
      'id' => $user->id,
      'name' => $user->first_name,
      'email' => $user->email
    ]);

    redirect('/');
  }

  /**
   * Logout a user and kill session
   *
   * @return void
   */
  public function logout() {
    Session::clearAll();

    $params = session_get_cookie_params();
    setCookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

    redirect('/');
  }
}
