<?php
require_once('authenticate.php');
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST["dia"]) && !empty($_POST["hora"]) && !empty($_POST["cliente"]) && !empty($_POST["viatura"]) && !empty($_POST["funcionario"])) {
        $dia = $_POST["dia"];
        $hora = $_POST["hora"];
        $cliente = $_POST["cliente"];
        $viatura = $_POST["viatura"];
        $funcionario = $_POST["funcionario"];

        $data =

        InsertNewIntervention($data, $cliente, $viatura, $funcionario);
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
    <h2 class="row h-100 justify-content-center align-items-center">Agendar Intervenção</h2>

    <form id='viatura' method='post'>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="dia">Dia</label>
                <input style="margin-right: 30px" class="form-control" type="date" id='dia' name='dia' required>
            </div>
            <div class="form-group col-md-4">
                <label for="hora">Hora</label>
                <select class="form-control" id="hora" name="hora">
                    <option>09:00:00</option>
                    <option>10:00:00</option>
                    <option>11:00:00</option>
                    <option>12:00:00</option>
                    <option>13:00:00</option>
                    <option>14:00:00</option>
                    <option>15:00:00</option>
                    <option>16:00:00</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="cliente">Cliente</label>
                <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Cliente" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="viatura">Viatura</label>
                <input type="text" class="form-control" id="viatura" name="viatura" placeholder="Viatura" required>
            </div>
            <div class="form-group col-md-6">
                <label for="funcionario">Funcionario</label>
                <input type="text" class="form-control" id="funcionario" name="funcionario" placeholder="Funcionario" required>
            </div>
        </div>
        <button class='btn btn-outline-success my-2 my-sm-0' type = 'submit'>Agendar</button>
    </form>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
</body>
</html>