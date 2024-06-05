<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "biblioteca";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn){
        die("Conexão falhou:". mysqli_connect_error());
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //Obter os dados do formlário e escapá-los para prevenir SQL Injection
        $titulo=mysqli_real_escape_string($conn,$_POST["titulo"]);
        $autor=mysqli_real_escape_string($conn,$_POST["autor"]);
        $disponivel=isset($_POST["disponivel"])? 1:0;
        //Esta linha atribui o caminho do diretório onde as imagens serão armazenadas a uma variável chamada   $diretorio_imagens.
        $diretorio_imagens="uploads/";
        //Esta linha extrai o nome do arquivo de iamgem enviado pelo formulário e atribui-o à variável, pega o nome original da imagem.
        $imagem_nome=$_FILES["imagem"]["name"];
        //Esta linha concatena o caminho do diretório de destino com o mnome do arquivo de imagem.
        $destino = $diretorio_imagens.$imagem_nome;
       
        //Esta linha move o arquivo de iamgem temporário para o destino final especificado.
        // Mover o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $destino)) {
             // Inserir os dados no banco de dados
             $sql = "INSERT INTO livros (titulo, autor, disponivel, imagem) VALUES ('$titulo', '$autor', '$disponivel', '$destino')";
        if (mysqli_query($conn, $sql)) {
            echo "Livro cadastrado com sucesso!";
        }else {
            echo "Erro ao cadastrar o livro: " . mysqli_error($conn);
        }
        }else {
            echo "Erro ao fazer upload da imagem.";
        }
    }  
    //Fechar a conexão
    mysqli_close($conn);

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar Livro</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1 class="titulo">BEM VINDO A BIBLIOTECA</h1>
    <?php include 'cabecalho.php'?>
    <h1>Cadastrar de livro</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" requered>
        <label for="autor">Autor</label>
        <input type="text" id="autor" name="autor" requered>
        <label for="disponivel">Disponível</label>
        <input type="checkbox" id="disponivel" name="disponivel">
        <label for="imagem">Imagem do livro</label>
        <input type="file" id="imagem" name="imagem" required>
        <button type="submit">Cadastrar</button>

    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

</body>

</html>