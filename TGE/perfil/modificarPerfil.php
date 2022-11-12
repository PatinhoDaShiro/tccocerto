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
  <script src="bootstrap.min.js"></script>
  <script src="croppie.js"></script>
  <link rel="stylesheet" href="croppie.css" />

 
    

</head>

<?php

include TEMPLATE_BASE.'/nav.php';

include TEMPLATE_BASE.'/opcoes.php';

?>
   <link rel="stylesheet" href="<?php echo URL_BASE?>/csspaginas/editarperfil.css" alt=""/>

  
 
 
 <body>  

<ul class="collapsible">

<li>
<div class="collapsible-header">
  <p class="editPerf" >Alterar imagem<p>
</div>
<div class="collapsible-body">
<form action="upload.php" method="post">
  <label id="lblArq" for="upload_image">Selecione a nova imagem</label>
   <input type="file" name="upload_image" id="upload_image" accept="image/*" />
   <br />
   <img id="imgPerf" src="<?php if(isset($_SESSION['imgPerf'])){
        echo URL_BASE."/profilePics/".$_SESSION['imgPerf'];
    }else{
        echo URL_BASE."/profilePics/icon.png";

    }?>">
    </br>
    <button class="btnSub" type="submit">Confirmar</button>
    
  </div>
</li>



<li>
<div class="collapsible-header">
  <p class="editPerf" >Alterar nome<p>
</div>
<div class="collapsible-body"> 
<form action="upload.php" method="post">
<h3 class="flow-text" >Alterar nome:</h3>
<input name="alterarNome" data-ls-module="charCounter" minLength="4" maxLength="16"></input>
<button class="btnSub" type="submit">Confirmar</button>
</form>
</div>
</li>

<li>
<div class="collapsible-header">
  <p class="editPerf" >Trocar E-mail<p>
</div>
<div class="collapsible-body"> 
<form action="upload.php" method="post">
<h3 class="flow-text" >Alterar Email:</h3>
<input name="alterarEmail" type="email" minLength="1" maxLength="140"></input>
<button class="btnSub" type="submit">Confirmar</button>
</form>
</div>
</li>


<li>
<div class="collapsible-header">
  <p class="editPerf" >Trocar senha<p>
</div>
<div class="collapsible-body"> 
<form action="upload.php" method="post">
<h3 class="flow-text">Nova Senha:</h3>
<input name="alterarSenha" type="password" data-ls-module="charCounter" minLength="8" maxLength="32"></input>
<button class="btnSub" type="submit">Confirmar</button>
</form>
</div>
</li>

<li>
<div class="collapsible-header">
  <p class="editPerf" >Editar descricão<p>
</div>

<div class="collapsible-body"> 
<form action="upload.php" method="post">
  <h3 class="flow-text" >Alterar descrição:</h3>
<textarea name="descriptionChange" id="textDescr" minLength="1" maxLength="1000" style="resize: none; height:22vh; color:black; padding:4px 4px 4px 4px; background-color:aliceblue;"></textarea>
<button class="btnSub" type="submit">Confirmar</button>
</form>
</div>

</li>
</ul>

<script>
$(document).ready(function(){

$('.collapsible').collapsible();
})
</script>



<div id="uploadimageModal" class="modal" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
      <button class="btnSub" type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Upload & Crop Image</h4>
    </div>
    <div class="modal-body">
      <div class="row">
   <div class="col-md-8 text-center">
    <div id="image_demo" style="width:350px; margin-top:30px"></div>
   </div>
   <div class="col-md-4" style="padding-top:30px;">
    <br />
    <br />
    <br/>
    <a href="perfil.php"><button class="btn btn-success crop_image">Crop & Upload Image</button></a>
 </div>
</div>
    </div>
    <div class="modal-footer">
      <button class="btnSub" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
 </div>
</div>
</div>

<script>  
$(document).ready(function(){

$image_crop = $('#image_demo').croppie({
enableExif: true,
viewport: {
  width:200,
  height:200,
  type:'circle' //circle
},
boundary:{
  width:300,
  height:300
}
});

$('#upload_image').on('change', function(){
var reader = new FileReader();
reader.onload = function (event) {
  $image_crop.croppie('bind', {
    url: event.target.result
  }).then(function(){
    console.log('jQuery bind complete');
  });
}
reader.readAsDataURL(this.files[0]);
$('#uploadimageModal').modal('show');
});

$('.crop_image').click(function(event){
$image_crop.croppie('result', {
  type: 'canvas',
  size: 'viewport'
}).then(function(response){
  $.ajax({
    url:"upload.php",
    type: "POST",
    data:{"image": response},
    success:function(data)
    {
      $('#uploadimageModal').modal('hide');
    }   
  });
})
});

});  
</script>


</body>  




