<?php

// Conexão
require_once "config.php";
 
// Variaveis
$nome = $sobrenome = $cpf = $celular = $email = "";
$nome_err = $sobrenome_err = $cpf_err = $celular_err = $email_err = "";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];
    
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Insira um nome.";
    } else{
        $nome = $input_nome;
    }
    
    $input_sobrenome = trim($_POST["sobrenome"]);
    if(empty($input_sobrenome)){
        $sobrenome_err = "Insira um sobrenome.";
    } else{
        $sobrenome = $input_sobrenome;
    }
    
    $input_cpf = trim($_POST["cpf"]);
    if(empty($input_cpf)){
        $cpf_err = "Insira o cpf.";     
    } else{
        $cpf = $input_cpf;
    }
    
    $input_celular = trim($_POST["celular"]);
    if(empty($input_celular)){
        $celular_err = "Insira o celular.";     
    } else{
        $celular = $input_celular;
    }
    
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Insira um email.";     
    } else{
        $email = $input_email;
    }
    
    if(empty($nome_err) && empty($sobrenome_err) && empty($cpf_err) && empty($celular_err) && empty($email_err)){
        
        $sql = "UPDATE clientes SET nome=?, sobrenome=?, cpf=?, celular=?, email=? WHERE id=?";
 
        if($stmt = $mysqli->prepare($sql)){

            $stmt->bind_param("sssssi", $param_nome, $param_sobrenome, $param_cpf, $param_celular, $param_email, $param_id);
            
            $param_nome = $nome;
            $param_sobrenome = $sobrenome;
            $param_cpf = $cpf;
            $param_celular = $celular;
            $param_email = $email;
            $param_id = $id;
            
            if($stmt->execute()){

                header("location: index.php");
                exit();
            } else{
                echo "Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }
         
        $stmt->close();
    }
    
    $mysqli->close();
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM clientes WHERE id = ?";
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("i", $param_id);
            
            $param_id = $id;
            
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
    }  else{
        header("location: erro.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
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
                        <h2>Editar Cliente</h2>
                    </div>
                    <p>Insira os dados novamente para editar o cliente.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
                            <label>Nome:</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $nome_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($sobrenome_err)) ? 'has-error' : ''; ?>">
                            <label>Sobrenome:</label>
                            <input type="text" name="sobrenome" class="form-control" value="<?php echo $sobrenome; ?>">
                            <span class="help-block"><?php echo $sobrenome_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($cpf_err)) ? 'has-error' : ''; ?>">
                            <label>CPF:</label>
                            <input type="text" name="cpf" class="form-control" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $cpf_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($celular_err)) ? 'has-error' : ''; ?>">
                            <label>Celular:</label>
                            <input type="text" name="celular" class="form-control" value="<?php echo $celular; ?>">
                            <span class="help-block"><?php echo $celular_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>E-mail:</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Editar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>