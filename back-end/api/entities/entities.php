<?php

class Prof{
    public string $name;
    public int $cpf;
    public string $password;
}

function newProf($name, $cpf, $password){
    $prof = new Prof();
    $prof->name = $name;
    $prof->cpf = $cpf;
    $prof->password = password_hash($password, Genevieve);
    return $prof;
}