<?php
// Conexão
require_once "config.php";
 
// Variaveis
$nome = $sobrenome = $cpf = $celular = $email = "";
$nome_err = $sobrenome_err = $cpf_err = $celular_err = $email_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validação nome
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Insira um nome.";
    } else{
        $nome = $input_nome;
    }
    
        // Validação sobrenome
    $input_sobrenome = trim($_POST["sobrenome"]);
    if(empty($input_sobrenome)){
        $sobrenome_err = "Insira um sobrenome.";
    } else{
        $sobrenome = $input_sobrenome;
    }
    
    // Validação cpf
    $input_cpf = trim($_POST["cpf"]);
    if(empty($input_cpf)){
        $cpf_err = "Insira o cpf.";     
    } else{
        $cpf = $input_cpf;
    }
    
  // Validação celular
    $input_celular = trim($_POST["celular"]);
    if(empty($input_celular)){
        $celular_err = "Insira o celular.";     
    } else{
        $celular = $input_celular;
    }
    
      // Validação email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Insira um email.";     
    } else{
        $email = $input_email;
    }
    
    // Verificando erros antes do insert 
    if(empty($nome_err) && empty($sobrenome_err) && empty($cpf_err) && empty($celular_err) && empty($email_err)){
        // Instruções para o insert
        $sql = "INSERT INTO clientes (nome, sobrenome, cpf, celular, email) VALUES (?, ?, ?, ?, ?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variavies 
            $stmt->bind_param("sssss", $param_nome, $param_sobrenome, $param_cpf, $param_celular, $param_email);
            
            // Definir os parametros
            $param_nome = $nome;
            $param_sobrenome = $sobrenome;
            $param_cpf = $cpf;
            $param_celular = $celular;
            $param_email = $email;
            
            // Executar
            if($stmt->execute()){
                // Foi feito os registros. volta para pagina de inicio
                header("location: index.php");
                exit();
            } else{
                echo "Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }
         
        $stmt->close();
    }
    
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Cliente</title>
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
                        <h2>Novo Cliente</h2>
                    </div>
                    <p>Preencha este formulário e envie para adicionar o registro do cliente.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                            <input type="text" name="cpf" class="form-control" value="<?php echo $cpf; ?>">
                            <span class="help-block"><?php echo $cpf_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($celular_err)) ? 'has-error' : ''; ?>">
                            <label>Celular:</label>
                            <input type="text" name="celular" class="form-control" value="<?php echo $celular; ?>">
                            <span class="help-block"><?php echo $celular_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email:</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>