<?php
session_start();
unset($_SESSION['cpf']);
unset($_SESSION['id']);
unset($_SESSION['funcao']);
session_abort();
header("Location: ../LOGIN/login.html");
exit();