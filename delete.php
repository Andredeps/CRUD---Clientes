<?php

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
require_once "config.php";
    
    $sql = "DELETE FROM clientes WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        
        $stmt->bind_param("i", $param_id);
        
        $param_id = trim($_POST["id"]);
        
        if($stmt->execute()){
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Alguma coisa deu errado Tente novamente mais tarde.";
        }
    }
     
    $stmt->close();
    
    $mysqli->close();
} else{
    if(empty(trim($_GET["id"]))){
        header("location: erro.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Cliente</title>
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
                        <h1>Excluir Cliente</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Você tem certeza que deseja excluir o cliente?</p><br>
                            <p>
                                <input type="submit" value="Sim" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">Não</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>