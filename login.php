<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Login simples
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    
    if ($usuario == 'admin' && $senha == 'senha_admin') {
        $_SESSION['logado'] = true;
        header('Location: painel.php');
        exit;
    } else {
        echo "Usuário ou senha incorretos.";
    }
}
?>
<form method="POST">
    <input type="text" name="usuario" placeholder="Usuário" required><br>
    <input type="password" name="senha" placeholder="Senha" required><br>
    <button type="submit">Login</button>
</form>
