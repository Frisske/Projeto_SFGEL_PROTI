<?php
include "conexao.php";

$email = $_POST["email"];
$senha = $_POST["senha"];

if (($email == "") || ($senha == "")){
    echo "<script>alert('Campos não podem ser vazios!');history.go(-1);</script>";
} else {
    try {
        $stmt = $conn->prepare('SELECT * FROM usuarios WHERE email = :email');
        $stmt->execute(array(':email' => $email));
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if (password_verify($senha, $usuario['senha'])) {
                echo "<script>alert('Login realizado com sucesso!');</script>";
            } else {
                echo "<script>alert('Senha incorreta!');history.go(-1);</script>";
            }
        } else {
            echo "<script>alert('Usuário não encontrado!');history.go(-1);</script>";
        }
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
?>
