<?php
session_start();

if ($_SESSION['usuario_admin']) {
    unset($_SESSION['usuario_admin']);
  

}elseif ($_SESSION['usuario_lector']) {
    unset($_SESSION['usuario_lector']);
  
}

header('location: login_form.php');