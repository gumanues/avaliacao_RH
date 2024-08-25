<?php 

session_start();

unset($_SESSION['usureferencia']);
unset($_SESSION['login']);
unset($_SESSION['id']);
unset($_SESSION['setorid']);
unset($_SESSION['setor']);
unset($_SESSION['ano_vigente']);

header("Location: login.php");
