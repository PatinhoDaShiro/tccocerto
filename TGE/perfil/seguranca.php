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
 <script src="jquery.min.js"></script>  
</head>
<?php
include TEMPLATE_BASE.'/nav.php';
include TEMPLATE_BASE.'/opcoes.php';
?>
<link rel="stylesheet" href="<?php echo URL_BASE?>/csspaginas/seguranca.css" alt="">

    <body> 

    <ul class="collapsible">

<li>


<div class='collapsible-header'>
  <p class='editPerf' >Trocar E-mail<p>
</div>

<div class='collapsible-body'> 
<form action='upload.php' method='post'>
<h3 class='flow-text' >Email atual:</h3>
<input name='alterarEmail' type='email' minLength='1' maxLength='140'></input>
<h3 class='flow-text' >Novo email:</h3>
<input name='alterarEmail' type='email' minLength='1' maxLength='140'></input>
<h3 class='flow-text' >Senha:</h3>
<input name='alterarEmail' type='email' minLength='1' maxLength='140'></input>
<button class='btnSub' type='submit'>Confirmar</button>
</form>
</div>
</li>

<li>
  <div class='collapsible-header'>
    <p class='editPerf' >Trocar senha<p>
  </div>
  <div class='collapsible-body'> 
  
  
  <form action='upload.php' method='post'>
  <h3 class='flow-text'>Senha atual:</h3>
  <input name='alterarSenha' type='password' data-ls-module='charCounter' minLength='8' maxLength='32'></input>
  <h3 class='flow-text'>Nova Senha:</h3>
  <input name='alterarSenha' type='password' data-ls-module='charCounter' minLength='8' maxLength='32'></input>
  <button class='btnSub' type='submit'>Confirmar</button>
  </form>
  
  </div>
  </li>
</ul>
<script>
$(document).ready(function(){

$('.collapsible').collapsible();
})
</script>


</body>  


