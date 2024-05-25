<?php
  
  session_start();
  // PDO
  $host = 'localhost';
  $db = 'my_project_php';
  $user = 'root';
  $pass = '';
  $dns = "mysql:host=$host;dbname=$db";
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ];
  $pdo = new PDO($dns, $user, $pass, $options);
  
//  REGISTRATE
  function getUser($email){
    $pdo = new PDO("mysql:host=localhost;dbname=my_project_php;", 'root', '');
    $sql = 'SELECT * FROM users where email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    return $user;
  }
  
  function addUser($email, $password)
  {
    $pdo = new PDO("mysql:host=localhost;dbname=my_project_php;", 'root', '');
    $sql = 'INSERT INTO users (email, password) VALUES (:email, :password)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'email' => $email,
      'password' => $password
    ]);
  }
  
  function setFlashMessage($name, $message)
  {
    $_SESSION[$name] = $message;
  }
  
  function displayFlashMessage($name)
  {
    if(isset($_SESSION[$name])){
      echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
      unset($_SESSION[$name]);
    }
  }
  
  function redirectTo($path)
  {
    header("Location: ./$path");
  }
  
  // LOGIN
  
  function login($email, $password)
  {
    $pdo = new PDO("mysql:host=localhost;dbname=my_project_php", 'root', '');
    $sql = 'SELECT * FROM users WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
  }
  
  // USERS

function isNotLoggedIn()
{

}

function isAdmin()
{

}

function getUsers()
{
  $pdo = new PDO("mysql:host=localhost;dbname=my_project_php", 'root', '');
  $sql = 'SELECT * FROM users';
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $users;
}

function getCurrentUser($email, $password)
{
  $pdo = new PDO("mysql:host=localhost;dbname=my_project_php", 'root', '');
  $sql = 'SELECT * FROM users where email = :email AND password = :password';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    'email' => $email,
    'password' => $password
  ]);
  $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $user;
}