<?php
include 'connvar.php';

function Path() {
    return "Location: index.php";
}

function LogOut() {

        $helper = array_keys($_SESSION);
        foreach ($helper as $key){
            unset($_SESSION[$key]);
        }
        header(Path());
        exit();
}

function OpenCon() {

    $vars = Conns();

    $dbhost = $vars[0];
    $dbuser = $vars[1];
    $dbpass = $vars[2];
    $db = $vars[3];

    $mysqli = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $mysqli -> error);

    $mysqli->set_charset("utf8");

    return $mysqli;
}

function GetAppointmentsQuery($data) {
    $dataInicio = " " . $data . " 09:00:00";
    $dataFim = " " . $data . " 18:00:00";

    $query = "select s.id_servico as idServico, s.dataServico, c.nome as clienteNome, c.contacto, v.marca, v.modelo, v.matricula, e.tipo, f.nome as funcNome
                from Servico s
                left join Cliente c on s.id_cliente = c.id_cliente
                left join Viatura v on s.id_viatura = v.id_viatura
                left join Funcionario f on s.id_funcionario = f.id_funcionario
                left join Especialidade e on f.id_especialidade = e.id_especialidade
                where dataServico >= '" . $dataInicio . "' and dataServico <= '" . $dataFim . "'
                order by s.dataServico, c.nome;";

   return $query;
}

function IsUserAuthorized($conn, $user, $pass) {

    $query = "select * from Utilizador where username = '" . $user . "' and passwd = '" . $pass . "'";
    $user = null;

    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $user = $row["username"];
        }
        $result->free();
    }
    return $user;
}

function CloseCon($mysqli) {
    $mysqli -> close();
}

function DeleteService($idService) {
    $conn = OpenCon();
    $conn->query("DELETE FROM Servico WHERE id_servico=" . $idService);
    CloseCon($conn);
    header(Path());
    exit();
}

function InsertNewClient($nome, $contacto, $email, $morada, $nif) {
    $conn = OpenCon();
    $conn->query("INSERT INTO Cliente values (0, '" . $nome . "', '" . $contacto . "', '" . $email . "', '" . $morada . "', '" . $nif . "');");
    CloseCon($conn);
    header(Path());
    exit();
}

function InsertNewVehicle($marca, $modelo, $matricula, $idCliente) {
    $conn = OpenCon();
    $conn->query("INSERT INTO Viatura values (0, '" . $marca . "', '" . $modelo . "', '" . $matricula . "', '" . $idCliente . "');");
    CloseCon($conn);
    header(Path());
    exit();
}

function InsertNewEmployee($nome, $espec) {
    $conn = OpenCon();
    $conn->query("INSERT INTO Funcionario values (0, '" . $nome . "', " . $espec . ")");
    CloseCon($conn);
    header(Path());
    exit();
}

function InsertNewIntervention($data, $cliente, $viatura, $funcionario) {
    $conn = OpenCon();
    $conn->query("INSERT INTO Servico values (0, '" . $data . "', " . $cliente . ", " . $viatura . ", " . $funcionario . ")");
    CloseCon($conn);
    header(Path());
    exit();
}

function SendMail($to, $title, $subject) {
    // use wordwrap() if lines are longer than 70 characters
    $subject = wordwrap($subject,70);
    // send email
    mail($to, $title, $subject);
}
?>