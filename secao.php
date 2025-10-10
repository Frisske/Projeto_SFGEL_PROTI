<?php
session_start();

include "conexao.php";

$email = $_POST["email"];
$senha = $_POST["senha"];

if (empty($email) || empty($senha)) {
    echo "<script>alert('Campos não podem ser vazios!'); history.go(-1);</script>";
} else {
    try {
        
        $stmt = $conn->prepare('SELECT * FROM usuarios WHERE email = :email');
        $stmt->execute(array(':email' => $email));
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            
            if (password_verify($senha, $usuario['senha'])) {
                
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['tipo'] = $usuario['tipo']; /

                
                echo "<script>alert('Login realizado com sucesso!'); window.location.href='home.php';</script>";
            } else {
                echo "<script>alert('Senha incorreta!'); history.go(-1);</script>";
            }
        } else {
            echo "<script>alert('Usuário não encontrado!'); history.go(-1);</script>";
        }
    } catch(PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}
?>
