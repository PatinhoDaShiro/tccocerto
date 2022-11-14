<?php
include  "../config.php";
include DIR_PATH."/conexao.php";
if(isset($_GET['?code'])){
    echo 'no code';
    exit();
}

$discord_code = $_GET['code'];
$payload = [
    'code'=>$discord_code,
    'client_id'=>'1040985204338204732',
    'client_secret'=>'lFiJy0zD58sHzqwA-MD_UiyWtdHbwjc4',
    'grant_type'=>'authorization_code',
    'redirect_uri'=>'http://localhost/TGE/login/loginDiscordProcess/discord-login-process-oauth.php',
    'scope'=>'identify%20guilds',
];

//print_r($payload);

$payload_string = http_build_query($payload);
$discord_token_url = "https://discordapp.com/api/oauth2/token";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $discord_token_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


$result = curl_exec($ch);

if(!$result){
    echo curl_error($ch);
}

$result = json_decode($result, true);
$access_token = $result['access_token'];


$discord_users_url = "https://discordapp.com/api/users/@me";
$header = array("Authorization: Bearer $access_token", "Content-Type: application/x-www-form-urlencoded");

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_URL, $discord_users_url);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$result = curl_exec($ch);

$result = json_decode($result, true);

session_start();

$_SESSION['sessionType'] = "LoginWithDiscord";
$_SESSION['id'] = $result['id'];
$_SESSION ['userName'] = $result['username'];
$_SESSION['imgPerf'] = $result['avatar'];
$idDisc = $_SESSION['id'];
$nomeUser = $_SESSION['userName'];
//CONFIRMA ID DISCORD EXISTENTE NO BANCO
$queryConfirmIdExists = "SELECT * FROM usuariosdiscord WHERE idDiscord = '$idDisc'";
$result = mysqli_query($conexao, $queryConfirmIdExists);
$row = mysqli_num_rows($result);
if($row == 1){
    //CASO O ID DISCORD EXISTA NO BANCO, ELE PASSA OS DADOS DE NOME E IMAGEM DE PERFIL DO BANCO PARA A SESSÃO
    $dados = mysqli_fetch_assoc($result);
    $_SESSION['userName'] = $dados['nomeUser'];
    if($dados['imgPerf'] != null){
        $_SESSION['imgPerf'] = $dados['imgPerf'];
    }
    header("Location:".URL_BASE);
    exit();
}else{
    //CASO O ID DISCORD NÃO EXISTA NO BANCO, ELE INSERE O USUARIO NO BANCO
    $query = "INSERT INTO usuariosdiscord(idDiscord, nomeUser)VALUE('$idDisc', '$nomeUser')";
    mysqli_query($conexao, $query);
    header("Location:".URL_BASE);
    exit();
}
