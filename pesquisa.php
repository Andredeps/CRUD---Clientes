<?php
$mysqli = new mysqli("localhost", "root", "", "crud");
 
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
 
if(isset($_REQUEST["term"])){
    $sql = "SELECT * FROM clientes WHERE nome LIKE ?";
    
    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("s", $param_term);
        
        $param_term = $_REQUEST["term"] . '%';
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows > 0){
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    echo "<p>" . $row["nome"] . "</p>";
                }
            } else{
                echo "<p>Nenhum resultado encontrado</p>";
            }
        } else{
            echo "ERRO: Não foi possível executar $sql. " . mysqli_error($link);
        }
    }
     
    $stmt->close();
}
 
$mysqli->close();
?>