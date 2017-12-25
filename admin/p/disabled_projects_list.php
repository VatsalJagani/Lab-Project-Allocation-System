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

?>



<html>
    <head>
        <title>Project Allocation</title>
        <link rel='icon' href="../../favicon.ico">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Robot" content="index,follow,project,allocation,distribution,subject"/>
        <meta name="Description" content="Online Project Allocation is available over here"/>
        <link rel="stylesheet" type="text/css" href="../../main.css">
    </head>
    <body>
        <h1 align="center">Project Allocation</h1>
        <h3 align="left"><a href="../project.php" class="back shadow"><= Back</a></h3>
        <h3 align="right"><?php if(isset($_SESSION['admin'])){echo 'ADMIN';}else{echo 'FACULTY';} ?>   &emsp;    Id: <?php echo $_SESSION['faculty']; ?>  &emsp;       Name : <?php echo $_SESSION['faculty_name']; ?>&emsp;<a href="../admin_logout.php" class="log_out shadow">Logout</a>&emsp;</h3>
        <h4 class="msg"><?php if(isset($_GET['msg']))
        {
            echo $_GET['msg'];
        }
            ?></h4>
        <br>
        
        <form>
            <table align="center" border="1">
                <tr>
                    <th>Project Id</th>
                    <th>Definition</th>
                    <th>Description</th>
                    <th>Update project details</th>        
                    <th>Enable Project</th>
                    <th>Delete</th>
                    
                </tr>
                <?php
                $count=0;
                    try{
                        $dbhandler=new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');
                        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql='select * from projects where enable=0';
                        
                        $query=$dbhandler->query($sql);                 //   there is some problem here
                        
                        while($r=$query->fetch())
                        {
            
                                echo '<tr>'
                                . '<td>'.$r['project_id'].'</td>'
                                . '<td>'.$r['definition'].'</td>'
                                . '<td>'.$r['description'].'</td>'
        
                                . '<td><a href="update_project.php?id='.$r['project_id'].'">update</a></td>'
                                . '<td><a href="enable_project_sql.php?id='.$r['project_id'].'">enable</a></td>'
                                . '<td><a href="delete_project_sql.php?id='.$r['project_id'].'">delete</a></td>'
                                        .'</tr>';
                            $count++;
                        }
                        
                    } catch (Exception $ex) {
                        echo 'hello! There is some error!';
                    }
                    echo '<tr>
                    <td colspan="6"><br></td>
                    </tr>

                    <tr>
                        <td colspan="6"><b>DISABLED PROJECTS</b></td>
                    </tr>
                    <tr>
                        <td colspan="6">Total : '.$count.'</td>
                    </tr>';
                ?>
               
                
            </table>
        </form>
    </body>
</html>
