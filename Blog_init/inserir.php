<?php
    session_start();

    if ($_POST) {
        try {
            require 'req/conexao.php';

            if (empty($_FILES["imagem"]["name"])) {
                $url_imagem = 'img/blog/default.jpg';  //se o cara não coloca uma foto ele coloca a foto padrao definida
            } else if ($_FILES["imagem"]["error"] == 0) { //se nao tiver nenhum erro na foto que o cara escolheu executa isso
                $nomeArquivo = $_FILES["imagem"]["name"];
                $nomeTemp = $_FILES["imagem"]["tmp_name"]; 
                $url_imagem = 'img/blog/' . $nomeArquivo; //salvar o caminho da img com o nome dela

                move_uploaded_file($nomeTemp, './' . $url_imagem); 
            }

            //campos que serão preenchidos, que receberam um valor do post
            $insert = $conexao->prepare("INSERT INTO posts (titulo, texto, data, url_img, categoria, id_escritor) VALUES (:tituloP, :textoP, :dataP, :urlP, :categoriaP, :id_escritorP)");
            $inseriu = $insert->execute([ //ira receber os campos submetidos
                ':tituloP' => $_POST["titulo"],
                ':textoP' => $_POST["texto"],
                ':dataP' => date('Y-m-d'), //nao usa post pq vc nao subimeteu um post, ele vai pegar a data no proprio sql
                ':urlP' => $url_imagem,
                ':categoriaP' => $_POST["categoria"],
                ':id_escritorP' => $_POST["id_escritor"]
            ]);

            if ($inseriu) { //se ele mandou tudo certinho vai redirecionar para o painel
                header('Location: painel.php');
            }
        } catch(PDOException $erro) {
            echo $erro->getMessage(); // se tiver algum erro no banco de dados ele ira impriomir na tela
            exit;
        }
    }

    include 'layouts/head.php';
    include 'layouts/header_admin.php';
?>
     <div class="container d-flex justify-content-center align-items-center" style="height: 90vh">
        <div class="col-8 border rounded p-4" style="background-color: #f8f8f8">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="tituloInput">Título do post</label>
                    <input id="tituloInput" name="titulo" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="textoInput">Texto do post</label>
                    <textarea id="textoInput" name="texto" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="categoriaInput">Categoria do post</label>
                    <select name="categoria" id="categoriaInput" class="form-control">
                        <option selected disabled>Escolha a categoria</option>
                        <option value="Esporte">Esporte</option>
                        <option value="Viagem">Viagem</option>
                        <option value="Gastronomia">Gastronomia</option>
                        <option value="Relacionamento">Relacionamento</option>
                        <option value="Música">Música</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="imagemInput" class="btn btn-secondary col-12">Imagem do post</label>
                    <input type="file" class="d-none" id="imagemInput" name="imagem">
                </div>
                <input type="hidden" name="id_escritor" value="<?= $_SESSION["escritorLogado"]["id"] ?>"> <!-- ira pegar o id do escritor logado pra quando ele for fazer um post já ter o id dele -->
                <button type="submit" class="btn btn-success mt-3 col-12">Postar</button>
            </form>
        </div>
    </div>
<?php
    include 'layouts/footer.php';
?>