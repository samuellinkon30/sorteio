<?php
// include 'connection.php';
$id = $_SESSION['id'];
$sql = "SELECT nome,cpf,imgurl FROM usuario WHERE id = ".$id;
$result = $conexao->query($sql);
$nome = "";
$cpf = "";
$imgurl="";
if($result) {
  $row = $result->fetch_assoc();
  $nome = $row['nome'];
  $cpf = $row['cpf'];
  $imgurl = $row['imgurl'];
}
$sql = "SELECT codigo_sorteio FROM dados_sorteio WHERE usuario_id = ".$_SESSION['id'];
$participa = false;
$codigo_sorteio = "";
$result = $conexao->query($sql);
$row = $result->fetch_assoc();
if($row) {
  $participa = true;
  $codigo_sorteio = $row['codigo_sorteio'];
}
?>
<div class="desktop">
  <div class="sidenav">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <div>
      <img id="ft"src="assets/logo.png">
    </div>

    <img src="<?php echo $imgurl; ?>" alt="Avatar" class="avatar">
    <a href="editarperfil.php">Editar perfil</a>
    <br>
    <div class= "perfil">
      <a>  </a>
    </div>
    <div id="texts">
      <div class= "text">
       <div class = "inf"><p class="negrito"><i class="fas fa-user-alt"></i> Nome: <?php echo " $nome" ?> </p> </div>
        <div class = "inf"><p class="negrito"> <i class="fas fa-id-card-alt"></i> CPF: <?php echo "$cpf" ?> </p> </div>

        <?php if(!isset ($_SESSION['adm'])) { ?>
          <?php if($participa) {
            echo "<div class = 'inf'><p class='negrito'> <i class='fas fa-sync-alt'></i> Nº do Sorteio: $codigo_sorteio </p></div>";

          } ?>
          <div class = "inf"><p><a href='usuario.php'><i class="fas fa-home"></i> Principal </a></p></div>
        <?php } ?>

        <div class="link">
          <div class="link">
            <?php
            if(isset($_SESSION['adm']) && $_SESSION['adm'] == true){
              echo "<div class = 'inf'><p><a href='relatorio.php'><i class='far fa-file-alt'></i> Relatório</a></p></div>";
              echo "<div class = 'inf'><p><a href='administrador.php'> <i class='fas fa-user-circle'></i> Página do Administrador</a></p></div>";
            }
            ?>
          </div>
        </div>


        <div class = "inf"><a href="?deslogar"> <i class="fas fa-sign-out-alt"></i> Sair</a></div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="mobile">
  <div class="topnav" id="myTopnav">

    <a href="#home" class="active"> <img src="assets/logo.jpg" class="ft" width="28px">    ASPCRE</a>
      <a href="editarperfil.php"><i class="fas fa-user-edit"></i> Editar Perfil</a>
      <a href=""><p class="negrito"><i class="fas fa-user-alt"></i> Nome : <?php echo " $nome" ?> </p>
      <a href=""><p class="negrito"> <i class="fas fa-id-card-alt"></i> CPF : <?php echo "$cpf" ?> </p></a>
      <?php if(!isset ($_SESSION['adm'])) { ?>
          <?php if($participa) {
            echo "<a><p class='negrito'><i class='fas fa-sync-alt'></i> Nº do Sorteio: $codigo_sorteio </p></a>";
          } ?>
          
        <?php } ?>
      <?php

      if(isset($_SESSION['adm']) && $_SESSION['adm'] == true){
        // header("Content-Type: text/html; charset=iso-8859-1",true);
              echo "<a href='administrador.php'> <i class='fas fa-user-circle'></i> Página do Administrador</a>";

        echo "<a href='relatorio.php'><i class='far fa-file-alt'></i> Relatório</a>";
      }
      ?>
      <?php if(!isset ($_SESSION['adm'])){ ?>
      <a href='usuario.php'><i class="fas fa-home"></i> Principal </a>
      <?php } ?>
      <a href="?deslogar"> <i class="fas fa-sign-out-alt"></i> Sair</a>

      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>

    </div>
  </div>
  <style>
  .ft
  {
    border-radius: 50%;
  }
  .active
  {
    padding: 0;
  }
  @media only screen and (min-width: 769px){
    .mobile{display:none;}
  }
  @media only screen and (max-width: 769px)
  {


    .desktop
    {
      display: none;
    }
    .btn.mes
    {
      width: 28%;
    }
    .topnav {
      overflow: hidden;
      background-color: #ffc107!important;
    }
    .topnav a {
      float: left;
      display: block;
      color: black;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
    }
    .topnav a:hover {
      background-color: #ffc107!important;
      color: black;
    }
    .active {
      color: white;
      padding: 0;
    }
    .topnav .icon {
      display: none;
    }
    @media screen and (max-width: 769px) {
      .topnav a:not(:first-child) {display: none;}
      .topnav a.icon {
        float: right;
        display: block;
      }
    }
    @media screen and (max-width: 769px) {
      .topnav.responsive {position: relative;}
      .topnav.responsive .icon {
        position: absolute;
        right: 0;
        top: 0;
      }
      .topnav.responsive a {
        float: none;
        display: block;
        text-align: left;
      }
    }
  }
</style>

<script>
  function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }
</script>
<style>
.sidenav {
  height: 100%; /* Full-height: remove this if you want "auto" height */
  width: 216px; /* Set the width of the sidebar */
  position: fixed; /* Fixed Sidebar (stay in place on scroll) */
  z-index: 1; /* Stay on top */
  top: 0; /* Stay at the top */
  left: 0;
  text-align: center;
  background-color:#fdca01;
  overflow-x: hidden; /* Disable horizontal scroll */
}
.text{
  text-align: left;
  margin-left: 5px;
}
p
{
  margin:0px 0px 1px;
}
.p1:hover
{
  background-color: black;
  color: white;
  border-radius: 10px 10px 10px 10px;
}
/* The navigation menu links */
.sidenav a{
  text-decoration: none;
  font-size: 15px;
  color: black;
  display: block;
}
.sidenav p{
  font-size: 15px;
  color: #000000;
}
.perfil{
  padding-left: 15px;
  height: 25px;
  text-align: left;
  background-color: #e2b40d;
  color: #000000;
}
#texts{
  padding-top: 5%;
}
#teste{
  font-size: 15px;
  color:#000000;
}
.caixa
{
  border-color: black;
  border-style: solid;
  border-width: 1px 1px 1px 1px;
  margin-left: 5%;
  margin-right: 5%;
  border-radius: 10px 10px 10px 10px;
  margin-bottom: 7%;
}
.caixa-button
{
  border-color: black;
  border-style: solid;
  border-width: 1px 1px 1px 1px;
  margin-left: 5%;
  margin-right: 5%;
  border-radius: 10px 10px 10px 10px;
  margin-bottom: 7%;
  padding: 0;
}
/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: #f1f1f1;
}
.caixa-button:hover
{
  background-color: black;
  color: white;
}
.avatar {
  vertical-align: middle;
  width: 100px;
  height: 100px;
  border-radius: 25%;
  margin-top: 5%;
}
.inf
{
  padding: 3%;
  margin: 3%;
  border-radius: 5%;
  background-color: #f7cd52;
}
</style>
<style>
#ft
{
  width: 125px;
  height: 125px;
}
#title
{
  color: white;
}
#sub-title
{
  font-size: 15px;
  padding-right: 2%;
  padding-left: 2%;
  color: white;
}
</style>
