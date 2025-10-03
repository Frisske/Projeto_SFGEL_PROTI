<?php
include "conexao.php";
$email = $_POST["email"];
$senha = $_POST["senha"];
if (($email=="") || ($senha=="")){
    echo "<script>alert('Campos nao podem ser vazios!!!');history.go(-1);</script>";
} else {
try{
    $sgfel = $conn->prepare('INSERT INTO usuarios (email, senha) VALUES 
    (:email, :senha)');
    $sgfel->execute(array(
    ':email' => $email,
    ':senha' => $senha
    ));
    if ($sgfel->rowCount()==1){
        echo "<script>alert('Incluido com sucesso!!!');history.go(-1);</script>";
    } else {
        echo "<script>alert('Erro ao incluir');history.go(-1);</script>";
    }

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
}
?>