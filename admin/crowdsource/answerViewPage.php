<?php


session_start();

include $_SERVER["DOCUMENT_ROOT"]."/ubspectrum/admin/crowdsource/model/adminModel.php";
include $_SERVER["DOCUMENT_ROOT"]."/ubspectrum/crowdsource/model/studentModel.php";

$host="";
$username="";
$password="";
$databasename="";
$dbh = new PDO('mysql:host=;dbname=', $username, $password);
$obj= new AdminModel();
$stuObj = new studentModel();

$_SESSION['id']=$_GET['datasetid'];
$id=$_SESSION['id'];

$_SESSION['ubit']=$_GET['ubit'];
$ubit_name=$_SESSION['ubit'];

$split = $obj->getSplitFile($id,$ubit_name);

$split= $split[0]['SPLIT_FILE_ID'];

// print_r($ubit_name);
// print_r($split);

$result=$obj->getallData($id);

//print_r($result);


//$ansresult = $stuObj->displayReviewedAnswers($ubit_name,$id,$split);

 // $sql = "select DISTINCT SPLIT_FILE_ID from tbl_splitted_datasets where DATASET_ID=".$dataset_id." and UBIT_NAME='".$ubit_name."'";


$sql = "SELECT ANSWER from tbl_review_answers WHERE DATASET_ID=".$id." and  split_file_id=".$split." and UBIT_NAME='".$ubit_name."'" ;
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1,$did , PDO::PARAM_INT);
$stmt->bindParam(2,$splitId , PDO::PARAM_INT);
$stmt->bindParam(3,$ubit_name , PDO::PARAM_STR,12);
$stmt->execute();
$ansresult = $stmt->fetchAll();
//print_r($ansresult);
$qresult = $stuObj->displayQuestions($id);
//$ubit_name=strval($ubit_name);

//$sql = "select DISTINCT SPLIT_FILE_ID from tbl_splitted_datasets where DATASET_ID=".$id." and UBIT_NAME='".$ubit_name."'";


?>

<html>
<head>
<?php


     if(isset($_SESSION['admin'])){

      $admin=$_SESSION['admin'];
     

      if($admin['ROLE']=='super'){
        include $_SERVER["DOCUMENT_ROOT"]."/ubspectrum/admin/superHeader.php";
      }
      else if($admin['ROLE']=='crowd'){
         include $_SERVER["DOCUMENT_ROOT"]."/ubspectrum/admin/crowdHeader.php";
      }
     }
      else{
        header("Location: /ubspectrum/admin/user/signin.php");
      }   ?>
    <title>Answer Page</title>
   
</head>
<body>
  <div class="heading container">
  <br><h5 align="center">Answers of Dataset reviewed by <?php echo $ubit_name ?></h5><br>
  <div class="panel"><div class="panel-body">
      <div class="form-group heading">
  <?php 
         for($i=0;$i<sizeof($ansresult);$i++){
          ?>
<h6 ><?php echo $qresult[$i]['QUESTION'] ?></h6>

<div  role="alert"><?php  echo $ansresult[$i]['ANSWER'] ?></div><br><br><br>
<?php }?>

  </div></div>
</div>
</body>
<!-- <script>  
 $(document).ready(function(){  
      $('#answerPage').DataTable();    
 });   
 </script> -->
</html>