-<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}
$sql = "SELECT * FROM livros";
$result = mysqli_query($conn, $sql);
?>
 
 
 
 
 
 
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">   
</head>
<body>
<h1 class="titulo"> BEM VINDO A BIBLIOTECA2</h1>  
<?php include 'cabecalho.php';?>
 
<h1>Lista de Livros</h1>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Disponível</th>
                <th>Imagem</th>
            </tr>
        </thead>
        <tbody>
            <?php           
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["titulo"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["autor"]) . "</td>";
                    echo "<td>" . ($row["disponivel"] ? "Sim" : "Não") . "</td>";
                    echo "<td><img src='" . htmlspecialchars($row["imagem"]) 
                    . "' alt='Imagem do Livro' width='100'></td>";
                    echo "</tr>";
                }
            } 
            else {
                echo "<tr><td colspan='4'>Nenhum livro encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
 
<?php
// Fechar a conexão
mysqli_close($conn);
?>