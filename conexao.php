<?php
$servidor='localhost';
$db = "sgfel";
$user = 'root';
$pass = ''; 
try {
  $conn = new PDO('mysql:host='.$servidor.';dbname='.$db ,  $user, $pass);

} catch (PDOException $e) {
    echo 'Erro número : ' . $e->getMessage();
}
?>