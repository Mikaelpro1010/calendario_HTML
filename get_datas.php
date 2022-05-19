<?php
    include_once "conexao.php";

$query_datas = "SELECT data, tipo FROM `datas` WHERE tipo = 'Feriado'";
$result_datas = $conn->prepare($query_datas);
$result_datas->execute();

$dados = [];
while($row_data = $result_datas->fetch(PDO::FETCH_ASSOC)){
    extract($row_data);
    $dados[] = $data;
}

return $dados;
