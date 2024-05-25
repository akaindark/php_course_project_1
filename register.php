<?php
  session_start();
  include 'functions.php';
  
  $email = $_POST['email'];
  $password = $_POST['password'];
  $pass_hash = password_hash($password, PASSWORD_DEFAULT);
  
  $user = getUser($email);
  
  if (!empty($user)){
    setFlashMessage('danger', '<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.');
    redirectTo('page_register.php');
    die();
  }
  
  addUser($email, $pass_hash);
  
  setFlashMessage('success', "Регистрация прошла успешно");
  redirectTo('page_login.php');