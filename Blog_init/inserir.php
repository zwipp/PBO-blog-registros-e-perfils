<?php

    session_start();

    include 'layouts/head.php';
    include 'layouts/header_admin.php';

    
?>

    <div class="container d-flex justify-content-center align-items-center" style="height:90vh">
        <div class="col-8 border rounded p-4" style="background-color: #f8f8f8">
         <form action="" method="POST" enctype="multipart/form-data"> <!-- subir foto -->
         
            <div class="form-group">
                <label for="tituloInput">Titulo</label>
                <input id="tituloInput" name="titulo" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="textoInput">Descrição</label>
                <textarea id="textoInput" name="texto" type="text" class="form-control" rows="5"> </textarea>
            </div>
            <div class="form-group">
                <label for="categoriaInput"></label>
                <select name="categoria" id="categoriaInput" class="form-control">
                    <option selected disabled>Escolha uma categoria</option>
                    <option value="esporte">esporte</option>
                    <option value="viagem">viagem</option>
                    <option value="gastronomia">gastronomia</option>
                    <option value="relacionamento">relacionamento</option>
                    <option value="musica">musica</option>
                </select>
            </div>
            <div class="form-group">
                <label for="imgInput" class="btn btn-secondary col-12">Imagem do post</label>
                <input type="file" class="d-none" id="imgInput">
            </div>
            <input type="hidden" name="id_escritor" value="<?= $_SESSION["escritorLogado"]["id"] ?>">

            <button type="submit" class="btn btn-success mt-3 col-12">Postar</button>
         </form>
        </div>
    </div>

<?php
    include 'layouts/footer.php';
?>