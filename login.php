<?php
  session_start();
  include 'functions.php';
  
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  $user = login($email, $password);
  
  $pass_verify = password_verify($password, $user['password']);
  
  if ($email === $user['email'] && $pass_verify){
    $_SESSION['user'] = $user;
    redirectTo('users.php');
    die();
  }
  setFlashMessage('danger', 'Неверный емейл или пароль');
  redirectTo('page_login.php');
  