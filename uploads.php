<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uplaod de arquivo</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="nome" placeholder="Seu nome">
        <input type="file" name="arquivo">
        <input type="submit" name="enviar">
    </form>
    <?php 
    if(isset($_POST['enviar'])){
        if(! empty($_FILES['arquivo']['name'])){
            $nomeArquivo = $_FILES['arquivo']['name'];
            $tipo = $_FILES['arquivo']['type'];
            $nomeTemporario = $_FILES['arquivo']['tmp_name'];
            $tamanho = $_FILES['arquivo']['size'];
            $erros = array();

            $tamanhoMaximo = 1024 * 1024 * 50;
            if($tamanho > $tamanhoMaximo){
                $erros[] = "Arquivo muito grande <br>";
            }
            $arquivosPermitidos = ["png", "jpg", "jpeg"];
            $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
            if (! in_array($extensao, $arquivosPermitidos)) {
                $erros[] = "Arquivo não permitido <br>";
            }

            $tiposPermitidos = ["image/png", "image/jpg", "image/jpeg"];
                if (! in_array($tipo, $tiposPermitidos)) {
                $erros[] = "Tipo de arquivo não permitido <br>";
            }
            if (! empty($erros)) {
                foreach ($erros as $erro){
                    echo $erro;
                }
            } else {
                $caminho = "uploads/";
                $hoje = date("d-m-Y_h-i");
                $novoNome = $hoje."-".$nomeArquivo;
                if(move_uploaded_file($nomeTemporario, $caminho.$nomeArquivo)){
                    echo"Upload feito";
                } else {
                    echo "erro ao enviar";
                }
            }
                
            }

        }
    


    ?>
</body>
</html>