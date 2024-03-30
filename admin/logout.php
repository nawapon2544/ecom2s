<?php
@session_start();
if(isset($_SESSION['username']) && isset($_SESSION['employee_fname']) ){
  unset($_SESSION['username']);
  unset($_SESSION['employee_fname']);
}

if(!isset($_SESSION['username']) && !isset($_SESSION['employee_fname'])){
  header('location:./index.php');
}
