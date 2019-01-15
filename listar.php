<?php
require_once('authenticate.php');
include 'server.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST["listarPor"])) {
        $listarPor = $_POST["listarPor"];
        header("Location: listar.php?lista=" . $listarPor);
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
                            <a class='nav-link' href='viatura.php'>Viatura</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='funcionario.php'>Funcionário</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='listar.php'>Listar</a>
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
    <h2 class="row h-100 justify-content-center align-items-center">Listar</h2>

    <form id='listar' method='post'>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="listarPor">Listar por:</label>
                <select class="form-control" id="listarPor" name="listarPor">
                    <option selected="selected">Cliente</option>
                    <option>Viatura</option>
                    <option value="Func">Funcionário</option>
                    <option>Especialidade</option>
                </select>
            </div>
        </div>
        <button class='btn btn-outline-success my-2 my-sm-0' type = 'submit'>Listar</button>
    </form>

    <div class="form-row" style="margin-top: 40px">
    <?php
    if (isset($_GET['lista'])) {
        $conn = OpenCon();

        $query = GetList($_GET["lista"]);

        if ($result = $conn->query($query)) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li style='list-style-type: none;'>" . $row["chave"]  . " &nbsp " . $row["valor"] . "</li>";
            }
            $result->free();
        }
        echo "</ul>";
        CloseCon($conn);
    }
    ?>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
</body>
</html>