<?php

    include 'layouts/head.php';
    include 'layouts/header.php';

    if ($_POST) {
        try {
            require 'req/conexao.php';

            //irá manda o dados que o cara digitar
            $select = $conexao -> prepare("SELECT * FROM escritores WHERE email = :emailPost AND senha = :senhaPost");
            $select -> execute([  //oque for escrito em cima será executado
                ':emailPost' => $_POST["email"],
                ':senhaPost' => $_POST["senha"]
            ]);

            $escritor = $select->fetch(PDO::FETCH_ASSOC); //traforma as irformações de sql para array associativo
            $conexao = null;

            if($escritor){ // só ira entrar se os dados que ele escreveu foram certos
                session_start();
                $_SESSION["escritorLogado"] = $escritor;


                header("Location: inserir.php");
            }

        } catch(PDOException $erro) {
            echo $erro->getMessage();
        }
    }

?>
    <div class="container d-flex justify-content-center align-items-center" style="height:90vh">
        <div class="col-8 border rounded p-4" style="background-color: #f8f8f8">
         <form action="" method="POST">
         
            <div class="form-group">
                <label for="emailInput">Email</label>
                <input id="emailInput" name="email" type="email" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="senhaInput">Senha</label>
                <input id="senhaInput" name="senha" type="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-secondary mt-3 col-12">Entrar</button>
         </form>
        </div>
    </div>
<?php

    include 'layouts/footer.php'

?>