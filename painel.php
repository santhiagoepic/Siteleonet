<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
    exit;
}
include('conexao.php'); // Conectar ao banco de dados

// Recuperar informações do banco de dados
$sql = "SELECT * FROM conteudo";
$result = mysqli_query($conn, $sql);
$conteudo = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Atualizar conteúdo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $descricao = $_POST['descricao'];
    $imagem = $_POST['imagem'];
    $sql = "UPDATE conteudo SET descricao='$descricao', imagem='$imagem' WHERE id=$id";
    mysqli_query($conn, $sql);
    header('Location: painel.php');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <header class="text-center py-3">
        <h1>Painel de Administração - Leoneth Modas</h1>
    </header>

    <section class="container my-4">
        <h2>Editar Conteúdo</h2>
        <div class="row">
            <?php foreach ($conteudo as $item): ?>
                <div class="col-md-4">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                        <img src="<?php echo $item['imagem']; ?>" class="img-fluid mb-2">
                        <textarea name="descricao" rows="4" class="form-control mb-2"><?php echo $item['descricao']; ?></textarea>
                        <input type="text" name="imagem" class="form-control mb-2" value="<?php echo $item['imagem']; ?>" placeholder="Novo URL da Imagem">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer class="text-center py-4">
        <p>&copy; 2024 Leoneth Modas</p>
    </footer>
</body>
</html>
