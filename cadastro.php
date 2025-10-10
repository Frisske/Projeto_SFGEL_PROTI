<?php
include "conexao.php";

$email = $_POST["email"];
$senha = $_POST["senha"];
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

if (empty($email) || empty($senha)) {
    echo "<script>alert('Campos não podem ser vazios!'); history.go(-1);</script>";
} else {
    try {
        $chekaremail = $conn->prepare('SELECT * FROM usuarios WHERE email = :email');
        $chekaremail->execute(array(':email' => $email));
        $usuario = $chekaremail->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            echo "<script>alert('E-mail já cadastrado! Tente outro.'); history.go(-1);</script>";
        } else {
            $stmt = $conn->prepare('INSERT INTO usuarios (email, senha) VALUES (:email, :senha)');
            $stmt->execute(array(
                ':email' => $email,
                ':senha' => $senha_hash
            ));

            if ($stmt->rowCount() == 1) {
                echo "<script>alert('Cadastrado com sucesso!'); history.go(-1);</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar!'); history.go(-1);</script>";
            }
        }
    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}
?>
