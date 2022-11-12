<?php
session_start();
include '../conexao.php';
include '../config.php';
if(isset($_SESSION['userName'])){
}else{
    Header("Location:".URL_BASE."/login/loginPage.php");
}
include TEMPLATE_BASE.'/head.php';

?>
<link rel="stylesheet" href="<?php echo URL_BASE?>/csspaginas/seguranca.css" alt="">
</head>
<?php
include TEMPLATE_BASE.'/nav.php';
include TEMPLATE_BASE.'/opcoes.php';
?>


    <body> 
