<?php
// $host="localhost";
//  $username="root";
//  $password="";
//  $databasename="spectrum";
 //$dbh = new PDO('mysql:host=localhost;dbname=spectrum', $username, $password);

 include "adminModel.php";
 $obj= new AdminModel();

 $host="";
 $username="";
 $password="";
 $databasename="";
 session_start(); 
 $dbh = new PDO('mysql:host=;dbname=', $username, $password);
 $transdbh = new PDO('mysql:host=;dbname=', $username, $password);
 

$did = $_POST['did'];
$did = intval($did);
$question=$obj->getDatasetQuestions($did);
$qcount = count($question);

//Getting Values from Form 
$datasetname=$_POST['name'];
$description=$_POST['description'];
$question = $_POST['question'];
$username = $_SESSION['sessionUser'];

//Updating Dataset Data in TBL_CURRENT_DATASETS
$sql = "UPDATE tbl_current_datasets SET DATASET_NAME = ?, DATASET_DESCRIPTION = ?WHERE DATASET_ID = ?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$datasetname, $description, $did]);

//Deleting and Inserting Data in tbl_dataset_question
$currentID = $did;
$questionsdelete = "DELETE from tbl_dataset_questions where dataset_id=".$currentID;
$delete = $dbh->prepare($questionsdelete);
$delete->execute();
for($i=0;$i<count($question);$i++){
        $stmtques = $dbh->prepare("insert into tbl_dataset_questions values(?,'',?)");
        $stmtques->bindParam(1,$currentID);
        $stmtques->bindParam(2,$question[$i]);
        $stmtques->execute();
    }

// if($qcount == 0){
//     for($i=0;$i<count($question);$i++){
//         $stmtques = $dbh->prepare("insert into tbl_dataset_questions values(?,'',?)");
//         $stmtques->bindParam(1,$currentID);
//         $stmtques->bindParam(2,$question[$i]);
//         $stmtques->execute();
//     }
// }else{
// 	for($i=0;$i<count($question);$i++){
//         $stmtques = $dbh->prepare("insert into tbl_dataset_questions values(?,'',?)");
//         $stmtques->bindParam(1,$currentID);
//         $stmtques->bindParam(2,$question[$i]);
//         $stmtques->execute();
//     }
// }
	


// else{
//     $questionidsql = "SELECT QUESTION_ID from tbl_dataset_questions where DATASET_ID = ".$currentID;
//     $questionid = $conn->query($questionidsql);
// 	for($i=0;$i<count($question);$i++){
//         $stmtques = $dbh->prepare("insert into tbl_dataset_questions values(?,'',?)");
//         $stmtques->bindParam(1,$currentID);
//         $stmtques->bindParam(2,$question[$i]);
//  }
// }
                


$transstmt = $transdbh->prepare("insert into tbl_transaction values('',?,?,?,?)");
$application = "CrowdSource Data Review";
$action = "Update Dataset" .$did;
$date = date("Y-m-d H:i:s");
//$user = "test@gmail.com";
$transstmt->bindParam(1,$application);
$transstmt->bindParam(2,$username);
$transstmt->bindParam(3,$action);
$transstmt->bindParam(4,$date);
$transstmt->execute();

                
 header("Location: ../datasetsView.php");
                         
    

?>