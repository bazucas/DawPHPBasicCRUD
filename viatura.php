<?php
require_once('authenticate.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>CabocAuto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
        }
        .navbar-brand {
            padding: 4px 0px 0px 15px;
        }
        .form-inline {
            float: right;
            padding: 4px 0px 0px 0px;
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
                <a class="nav-link" href="index.php">Marcações</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="agendar.php">Intervenção</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cliente.php">Cliente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="viatura.php">Viatura</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="funcionario.php">Funcionário</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="login.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Username">
            <input class="form-control mr-sm-2" type="password" placeholder="Password">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
        </form>
    </div>
</nav>

<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <h2>Agendar Viatura</h2>
    </div>
</div>

<!---->
<?php
//echo "My first PHP script!";
//?>
<!---->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</body>
</html>
