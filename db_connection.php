
<?php

function OpenCon()
{
    $dbhost = "localhost:3306";
    $dbuser = "dawsql";
    $dbpass = "passwd";
    $db = "cabocauto";

    $mysqli = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $mysqli -> error);

#Exemplo para inserir elemento na BD
//$mysqli->query("INSERT INTO `entrada` (`id`) VALUES ('18')");

#Exemplo para obter valores de uma query
//    $query = "SELECT * FROM Cliente";
//
//    if ($result = $mysqli->query($query)) {
//
//        /* fetch associative array */
//        while ($row = $result->fetch_assoc()) {
//            echo $row["nome"];
//            echo "<br>";
//        }
//
//        /* free result set */
//        $result->free();
//    }
    return $mysqli;
}

function GetMarcacoesQuery($data) {
    $dataInicio = " " . $data . " 09:00:00";
    $dataFim = " " . $data . " 18:00:00";

    $query = "select s.dataServico, c.nome as clienteNome, c.contacto, v.marca, v.modelo, v.matricula, e.tipo, f.nome as funcNome
                from servico s
                left join cliente c on s.id_cliente = c.id_cliente
                left join viatura v on s.id_viatura = v.id_viatura
                left join funcionario f on s.id_funcionario = f.id_funcionario
                left join especialidade e on f.id_especialidade = e.id_especialidade
                where dataServico >= '" . $dataInicio . "' and dataServico <= '" . $dataFim . "'";

    return $query;
}

function CloseCon($mysqli)
{
    $mysqli -> close();
}

?>