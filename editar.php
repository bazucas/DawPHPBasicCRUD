<?php
require_once('authenticate.php');
include 'server.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST["dia"]) && !empty($_POST["hora"]) && !empty($_POST["cliente"]) && !empty($_POST["viatura"]) && !empty($_POST["funcionario"])) {
        $dia = $_POST["dia"];
        $hora = $_POST["hora"];
        $cliente = $_POST["cliente"];
        $viatura = $_POST["viatura"];
        $funcionario = $_POST["funcionario"];
        $email = $_POST["email"];

        $data = "" . $_POST["dia"] . " " . $_POST["hora"] . ":00";

        if (!empty($_POST["email"])) {
            SendMail($email, "CabocAuto", "A intervenção na sua viatura foi remarcada para dia " . $dia . " às " . $hora . " horas. Obrigado. CabocAuto Lda.");
        }

        UpdateIntervention($data, $cliente, $viatura, $funcionario);
    }

    if (!empty($_POST["logout"]) && $_POST["logout"] === "logout") {
        $logout = $_POST["logout"];
        LogOut();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CabocAuto</title>
    <link rel="icon" type="image/png" href="images/caricon.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
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
                            <form class='form-inline my-2 my-lg-0' id = 'logout' method = 'post' >
                            <span class='userWelcome'>Olá " . ucfirst($_SESSION["user"]) . ", bem-vindo(a) </span> &nbsp;
                            <input type='hidden' name='logout' id='logout' value='logout' />
                            <button class='btn btn-outline-success my-2 my-sm-0' type = 'submit'>Logout</button >
                            </form >";
            }
            ?>
    </div>
</nav>
<div class="container h-100">
    <h2 class="row h-100 justify-content-center align-items-center">Editar Marcação</h2>

    <form id='remarcar' method='post'>

        <?php

        if (isset($_GET['id'])) {
        $conn = OpenCon();
        // cria a tabela de servicos
        $query = GetServices($_GET["id"]);
        if ($result = $conn->query($query)) {
        /* fetch associative array */
        while ($row = $result->fetch_assoc()) {
        ?>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="dia">Dia</label>
                <input class="form-control" type="date" id='dia' name='dia' value="<?php echo explode(" ", $row["dataServico"])[0]; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="hora">Hora</label>
                <?php $hora = substr(explode(" ", $row["dataServico"])[1], 0, -3); ?>
                <select class="form-control" id="hora" name="hora">
                    <option <?php if($hora == '09:00') echo "selected='selected'"; ?> >09:00</option>
                    <option <?php if($hora == '10:00') echo "selected='selected'"; ?> >10:00</option>
                    <option <?php if($hora == '11:00') echo "selected='selected'"; ?> >11:00</option>
                    <option <?php if($hora == '12:00') echo "selected='selected'"; ?> >12:00</option>
                    <option <?php if($hora == '13:00') echo "selected='selected'"; ?> >13:00</option>
                    <option <?php if($hora == '14:00') echo "selected='selected'"; ?> >14:00</option>
                    <option <?php if($hora == '15:00') echo "selected='selected'"; ?> >15:00</option>
                    <option <?php if($hora == '16:00') echo "selected='selected'"; ?> >16:00</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="cliente">Cliente</label>
                <input type="text" class="form-control" id="cliente" name="cliente" value="<?php echo $row['clienteNome']; ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="viatura">Viatura</label>
                <input type="text" class="form-control" id="viatura" name="viatura" value="<?php echo $row['matricula']; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="funcionario">Funcionario</label>
                <input type="text" class="form-control" id="funcionario" name="funcionario" value="<?php echo $row['funcNome']; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
            </div>
        </div>
        <button class='btn btn-outline-success my-2 my-sm-0' type = 'submit'>Remarcar</button>
    </form>
    <?php
    }}}
    ?>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
</body>
</html>