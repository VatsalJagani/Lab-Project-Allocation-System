
<?php
/*
 * ****************************************************************************
 * ****************************************************************************

  HEllo, THis projecT of PHP
  subject - Project Allocation

  c3 Batch sem-4

  CE046	HireN ItaliyA
  CE047	JaganI VatsaL
  CE048	MohiT JaiN
  CE049	AkshiT JariwalA     #

 * ****************************************************************************
 * ****************************************************************************
 */

?>


<?php
session_start();
if(!isset($_SESSION['faculty']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}

if(isset($_GET['id']))     
{
    $temp=0;
    try{
        
        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql='update projects SET enable=0 where project_id=?';
        
        $query=$dbhandler->prepare($sql);
        $query->execute(array($_GET['id']));
        
        $temp=1;
        header("location:../project.php?msg=project with id ".$_GET['id']." is now disabled");
        
    } catch (Exception $ex) {
        if($temp==0){
            header("location:../project.php?msg=sorry! provided project id not found");
        }
    }
}
else{
    header("location:../project.php?msg=please provide proper project id");
}
?>
