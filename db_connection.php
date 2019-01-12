
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

function GetMarcacoesQuery($conn, $data) {
    $dataInicio = " " . $data . " 09:00:00";
    $dataFim = " " . $data . " 18:00:00";

    $query = "select s.id_servico as idServico, s.dataServico, c.nome as clienteNome, c.contacto, v.marca, v.modelo, v.matricula, e.tipo, f.nome as funcNome
                from servico s
                left join cliente c on s.id_cliente = c.id_cliente
                left join viatura v on s.id_viatura = v.id_viatura
                left join funcionario f on s.id_funcionario = f.id_funcionario
                left join especialidade e on f.id_especialidade = e.id_especialidade
                where dataServico >= '" . $dataInicio . "' and dataServico <= '" . $dataFim . "'";

    return $query;
}

function IsUserAuthorized($conn, $user, $pass) {

    $query = "select * from utilizador where username = '" . $user . "' and passwd = '" . $pass . "'";
    $user = null;

    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $user = $row["username"];
        }
        $result->free();
    }
    return $user;
}

function CloseCon($mysqli)
{
    $mysqli -> close();
}

function DeleteService($idService) {
    $conn = OpenCon();
    $conn->query("DELETE FROM Servico WHERE id_servico=" . $idService);
    CloseCon($conn);
    header("Location: http://localhost:63342/htdocs/index.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_start();

    $helper = array_keys($_SESSION);
    foreach ($helper as $key){
        unset($_SESSION[$key]);
    }
    header("Location: http://localhost:63342/htdocs/index.php");
    exit();
}

?>