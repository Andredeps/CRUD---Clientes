<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 70%;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">   
            <div class="row">
                <div class="col-md-20">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Cadastro de Clientes</h2>
                        <a href="adicionar.php" class="btn btn-success pull-right">Adicionar Novo Cliente</a>
                    </div>
                    <?php
        
                    require_once "config.php";
                    
                    $sql = "SELECT * FROM clientes";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Nome</th>";
                                        echo "<th>Sobrenome</th>";
                                        echo "<th>CPF</th>";
                                        echo "<th>Celular</th>";
                                        echo "<th>E-mail</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['nome'] . "</td>";
                                        echo "<td>" . $row['sobrenome'] . "</td>";
                                        echo "<td>" . $row['cpf'] . "</td>";
                                        echo "<td>" . $row['celular'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='leitura.php?id=". $row['id'] ."' title='ver' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='atualizar.php?id=". $row['id'] ."' title='editar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='excluir' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            
                            $result->free();
                        } else{
                            echo "<p class='lead'><em>Nenhum registro foi encontrado.</em></p>";
                        }
                    } else{
                        echo "ERRO: Não foi possível executar $sql. " . $mysqli->error;
                    }
                    
                    $mysqli->close();
                    ?>
                
                </div>
            </div>        
        </div>
    </div>
</body>
</html>