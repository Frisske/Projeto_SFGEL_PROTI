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
        echo "<script>alert('Cadastrado com Sucesso!!!');history.go(-1);</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar!');history.go(-1);</script>";
    }

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
}
// Simulando um formulário de cadastro
$senha = '';
// Criptografando a senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
// Exemplo de inserção no banco (simulado)
echo "Senha original: " . $senha . "<br>";
echo "Senha criptografada para salvar no banco: " . $senha_hash;
?>
