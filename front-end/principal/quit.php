<?php
session_start();
unset ($_SESSION['nomeProf']);
unset ($_SESSION['cpf']);
unset ($_SESSION['senha']);
session_destroy();
header('Location:./login/login.html');

?>