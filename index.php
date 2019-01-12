<?php
include 'db_connection.php';
session_start();
$conn = OpenCon();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $auth = IsUserAuthorized($conn, $username, $password);

        if ($auth) {
            $_SESSION["authenticated"] = true;
            $_SESSION["user"] = $auth;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CabocAuto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        h2 {
            padding-top: 25px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 12px;
        }
        h4 {
            padding: 25px 20px;

        }
        i {
            padding: 0px 10px;
        }
        .changeDate {
            margin: 0px 10px;
        }
        .dateContainer {
            margin: 40px 0px;
        }
        .navbar {
            border-radius: 0px;
            padding-bottom: 14px;
        }
        .navbar-brand {
            padding: 4px 0px 0px 15px;
        }
        .form-inline {
            float: right;
            padding: 4px 0px 0px 0px;
        }
        .userWelcome {
            color: white;
            height: 25px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><img src="./images/cabocauto.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">Marcações</a>
            </li>
            <?php
            if (!empty($_SESSION["authenticated"]) && $_SESSION["authenticated"]) {
                echo
                "<li class='nav-item'>
                            <a class='nav-link' href='agendar.php'>Intervenção</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='cliente.php'>Cliente</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href=\"viatura.php\">Viatura</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='funcionario.php'>Funcionário</a>
                        </li>";
            }

            if (empty($_SESSION["authenticated"]) || !$_SESSION["authenticated"]) {
                echo "</ul>
                        <form class='form-inline my-2 my-lg-0' id = 'login' method = 'post' >
                            <input id = 'username' name = 'username' type = 'text' required class='form-control mr-sm-2' placeholder = 'Username' >
                            <input id = 'password' name = 'password' type = 'password' required class='form-control mr-sm-2'placeholder = 'Password' >
                            <button class='btn btn-outline-success my-2 my-sm-0' type = 'submit'> Login</button >
                        </form >";
            } else if (!empty($_SESSION["authenticated"]) && $_SESSION["authenticated"]) {
                echo "</ul>
                            <div class='userWelcome'>
                                <span>Olá " . ucfirst($_SESSION["user"]) . ", bem-vindo(a) </span> &nbsp;
                                <a href='db_connection.php?logout=true'>logout</a>
                            </div>
                        ";
            }
            ?>
    </div>
</nav>
<div class="container h-100">
    <h2 class="row h-100 justify-content-center align-items-center">Marcações</h2>

    <div class="dateContainer row h-100 justify-content-center align-items-center">
        <input class="form-control col-md-2" type="date" name="marcacao">
        <input class="changeDate btn btn-primary" type="button" value="Procurar">
    </div>

    <div class="row h-100 justify-content-center align-items-center">
        <table>
            <tr>
                <th>Horário</th>
                <th>Cliente</th>
                <th>Contacto</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Matrícula</th>
                <th>Intervenção</th>
                <th>Técnico</th>
                <th>Opções</th>
            </tr>

            <?php
            $conn = OpenCon();

            // cria a tabela de marcaçoes
            $query = GetMarcacoesQuery($conn, "2019-01-10");

            if ($result = $conn->query($query)) {

                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<th>" . $row["dataServico"] . "</th>";
                    echo "<td>" . $row["clienteNome"] . "</td>";
                    echo "<td>" . $row["contacto"] . "</td>";
                    echo "<td>" . $row["marca"] . "</td>";
                    echo "<td>" . $row["modelo"] . "</td>";
                    echo "<td>" . $row["matricula"] . "</td>";
                    echo "<td>" . $row["tipo"] . "</td>";
                    echo "<td>" . $row["funcNome"] . "</td>";
                    echo "<td>";
                    echo "<div class='row justify-content-center align-items-center'>";
                    echo "<a href='editar.php'><i class='fas fa-user-edit'></i></a>";
                    echo "<a href='apagar.php'><i class='fas fa-user-times'></i></a>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
                $result->free();
            }

            CloseCon($conn);
            ?>

        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
</body>
</html>