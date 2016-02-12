<?php
if (isset($_GET['niveau']) && isset($_GET['techno'])){
    session_start();
    $idUser = $_SESSION['iduser'];
    $niveau = $_GET['niveau'];
    $techno = $_GET['techno'];


try
{
    $connect = new PDO('mysql:host=localhost; dbname=simplonsite; charset=utf8', 'root', 'root');
}
catch (Exception $e){
    die('Erreur : '.$e->getMessage());
}


$request = $connect->prepare( "SELECT * FROM `techno` WHERE `techno`=:techno");
$request->bindParam(':techno', $techno, PDO::PARAM_STR);
$request->execute();
$data = $request->fetch();
$idt = $data['id'];

$select = $connect->prepare("SELECT * FROM `competences` WHERE `ida`=:idUser AND `idt`=:idt");
$select->bindParam(':idUser', $idUser, PDO::PARAM_INT);
$select->bindParam(':idt', $idt, PDO::PARAM_INT);
$select->execute();
$count = $select->rowCount();

if($count < 1){

    $request2 = $connect->prepare("INSERT INTO `competences`(`ida`, `idt`, `niveau`) VALUES (:idUser,:idt,:niveau)");
    $request2->bindParam(':ida', $idUser, PDO::PARAM_INT);
    $request2->bindParam(':idt', $idt, PDO::PARAM_INT);
    $request2->bindParam(':niveau', $niveau, PDO::PARAM_INT );
    $request2->execute();
}else{
        $request2 = $connect->prepare("UPDATE `competences` SET `niveau` = :niveau WHERE `idt` =:idt AND `ida`=:idUser");
        $request2->bindParam(':idt', $idt, PDO::PARAM_INT);
        $request2->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $request2->bindParam(':niveau', $niveau, PDO::PARAM_INT);
        $request2->execute();
};
} else{
    echo "0";
}
?>
