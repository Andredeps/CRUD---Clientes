<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    require_once "config.php";
    
    
    $sql = "SELECT * FROM clientes WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){

        $stmt->bind_param("i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                $nome = $row["nome"];
                $sobrenome = $row["sobrenome"];
                $cpf = $row["cpf"];
                $celular = $row["celular"];
                $email = $row["email"];
            } else{

                header("location: erro.php");
                exit();
            }
            
        } else{
            echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
        }
    }
     
    $stmt->close();
    
    $mysqli->close();
} else{

    header("location: erro.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ver Clientes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Ver Cliente</h1>
                    </div>
                    <div class="form-group">
                        <label>Nome:</label>
                        <p class="form-control-static"><?php echo $row["nome"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Sobrenome:</label>
                        <p class="form-control-static"><?php echo $row["sobrenome"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>CPF:</label>
                        <p class="form-control-static"><?php echo $row["cpf"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Celular:</label>
                        <p class="form-control-static"><?php echo $row["celular"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Voltar</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>