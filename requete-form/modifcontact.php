<?php

session_start();
$iduser=$_SESSION["iduser"];
$tel=$_GET["tel"];
echo $tel;
$mail=$_GET["mail"];
echo $tel;


try {
  $connexion=new PDO('mysql:host=localhost;dbname=simplonsite;charset=utf8','root','');
}
  catch (Exception $e){
die ('erreur : '.$e->getMessage());
}

       $requete="UPDATE `lien` SET `tel`= '$tel' WHERE id=1";
echo $requete;
       $reponses  = $connexion->query($requete);
      //  $reponses->closeCursor();

      $requete="UPDATE lien SET mail='$mail' WHERE id=1";
      $reponses  = $connexion->query($requete);
      $reponses->closeCursor();


?>
