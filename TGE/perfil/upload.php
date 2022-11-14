<?php
session_start();
$user = $_SESSION['userName'];
$id = $_SESSION['id'];
include '../conexao.php';
include '../config.php';
error_reporting(E_ALL ^ E_NOTICE);


if(isset($_POST["image"])){
    $data = $_POST["image"];

    $image_array_1 = explode(";", $data);
   
    $image_array_2 = explode(",", $image_array_1[1]);
   
    $data = base64_decode($image_array_2[1]);
   
    $imageName = md5(time()) . '.png';
    $pasta = DIR_PATH."/profilePics/";
    file_put_contents($imageName, $data);
    $pastaImgs = "$pasta/$imageName";
    rename($imageName, $pastaImgs);
    if($_SESSION['sessionType'] == "LoginWithTGE"){
    $sql_code = "UPDATE usuarios SET imgPerf = '$imageName' WHERE usuario = '$user'";
    mysqli_query($conexao, $sql_code);
    }else if($_SESSION['sessionType'] == "LoginWithDiscord"){
    $sql_code = "UPDATE usuariosdiscord SET imgPerf = '$imageName' WHERE idDiscord = '$id'";
    mysqli_query($conexao, $sql_code);
    }
    header("Location:".URL_BASE."perfil/modificarPerfil.php");
}

if(isset($_POST["descriptionChange"])){
    $descricao = $_POST["descriptionChange"];
    if($descricao != "" || $descricao != null){
        if($_SESSION['sessionType'] == 'LoginWithTGE'){
            $query = "UPDATE usuarios SET descricao = '$descricao' where usuario = '$user'";
            mysqli_query($conexao, $query);
            header("Location:".URL_BASE."perfil/modificarPerfil.php");
        }else if($_SESSION['sessionType'] == 'LoginWithDiscord'){
            $query = "UPDATE usuariosdiscord SET descricao = '$descricao' where idDiscord = '$id'";
            mysqli_query($conexao, $query);
            header("Location:".URL_BASE."perfil/modificarPerfil.php");
        }
    }   
}

if(isset($_POST["alterarSenha"])){
    $senha = $_POST["alterarSenha"];
    if($senha != "" || $senha != null){
        if($_SESSION['sessionType'] == 'LoginWithTGE'){
            $query = "UPDATE usuarios SET senha = md5('$senha') where usuario = '$user'";
            mysqli_query($conexao, $query);
            header("Location:".URL_BASE."perfil/modificarPerfil.php");
        }else if($_SESSION['sessionType'] == 'LoginWithDiscord'){
            header("Location:".URL_BASE."perfil/modificarPerfil.php");
        }
    }
}

if(isset($_POST["alterarNome"])){
    $nome = $_POST["alterarNome"];
    if($nome != "" || $nome != null){
        if($_SESSION['sessionType'] == 'LoginWithTGE'){
            $query = "UPDATE usuarios SET usuario = '$nome' where usuario = '$user'";
            mysqli_query($conexao, $query);
            header("Location:".URL_BASE."perfil/modificarPerfil.php");
            $_SESSION['userName'] = $nome;
            $user = $nome;
        }else if($_SESSION['sessionType'] == 'LoginWithDiscord'){
            $query = "UPDATE usuariosdiscord SET nomeUser = '$nome' where idDiscord = '$id'";
            mysqli_query($conexao, $query);
            header("Location:".URL_BASE."perfil/modificarPerfil.php");
            $_SESSION['userName'] = $nome;
        $user = $nome;
        }
    }
}

if(isset($_POST["alterarEmail"])){
    $email = $_POST["alterarEmail"];
    if($email != "" || $email != null){
        if($_SESSION['sessionType'] == 'LoginWithTGE'){
            $query = "UPDATE usuarios SET email = '$email' where usuario = '$user'";
            mysqli_query($conexao, $query);
            header("Location:".URL_BASE."perfil/modificarPerfil.php");
        }else if($_SESSION['sessionType'] == 'LoginWithDiscord'){
            header("Location:".URL_BASE."perfil/modificarPerfil.php");
        }
    }
}

?>
