<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include '../conexao.php';
include '../config.php';
if(isset($_SESSION['userName'])){
}else{
    Header("Location:".URL_BASE."/login/loginPage.php");
}
include TEMPLATE_BASE.'/head.php';
include TEMPLATE_BASE.'/nav.php';
include TEMPLATE_BASE.'/opcoes.php';


$user = $_SESSION['userName'];
if($_SESSION['sessionType'] == "LoginWithTGE"){
 $query = "select * from usuariostge where usuario = '$user'";
 //envia os dados e compara no banco
 $result = mysqli_query($conexao, $query);
 $row = mysqli_num_rows($result);
 if($row == 1){
     $dados = mysqli_fetch_assoc($result);
     $SessionUser = $dados;
     $_SESSION['userName'] = $SessionUser['usuario'];
     $user = $_SESSION['userName'];
     $_SESSION['imgPerf'] = $SessionUser['imgPerf'];
     $imgPerf = $_SESSION['imgPerf'];
     $_SESSION['description'] = $SessionUser['descricao'];
     $descricao = $_SESSION['description'];
 }
}else if($_SESSION['sessionType'] == "LoginWithDiscord"){
$discord_id = $_SESSION['id'];
//QUERY QUE as infos do usuario do banco
$query = "SELECT * FROM usuariosdiscord WHERE idDiscord = '$discord_id'";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);
if($row == 1){
   $dados = mysqli_fetch_assoc($result);
    $_SESSION['userName'] = $dados['nomeUser'];
    if($dados['imgPerf'] != null){
        $_SESSION['imgPerf'] = $dados['imgPerf'];
    }else{
        $avatar_discord = $_SESSION['imgPerf'];
        $avatar_discord_url = "https://cdn.discordapp.com/avatars/$discord_id/$avatar_discord.jpg?size=256";
    }

}

}

?>
<link rel="stylesheet" href="<?php echo URL_BASE?>/csspaginas/perfil.css" alt="">
<img class="circle responsive-img" src="<?php 
if($_SESSION['sessionType'] == "LoginWithDiscord"){
    echo $avatar_discord_url;
}else if($_SESSION['sessionType'] == "LoginWithTGE"){
    echo $imgPerf;
}?>
" alt="">
