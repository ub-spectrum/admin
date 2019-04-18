<?php

session_start();
include $_SERVER["DOCUMENT_ROOT"]."/ubspectrum/admin/crowdsource/model/adminModel.php";
$obj= new AdminModel();

$_SESSION['id']=$_GET['datasetid'];
$id=$_SESSION['id'];
$result=$obj->getallData($id);
$ubit=$obj->getUbitName($id);
// print_r($ubit);
$data = $obj->getDatasetData($id);
?>
<html>
<head>
    <title>UB Spectrum Admin</title>
<!--     <style>
      .panel {
        margin-right: 5%;
        margin-left: 5%;
      }
      .h1 {
        font-family: 'Open Sans', serif;
        font-size: 40px;
      }
    </style> -->

    <?php  // print_r($_SESSION['admin']);

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
      }  ?>

</head>
<body>
  <div class="heading container">
  <br><h1 align="center">Progress of <?php echo $data[0]['DATASET_NAME'] ?></h1><br>
  <h5>Total number of students signed up:  <?php echo sizeof($ubit[0]['UBIT_NAME']) ?></h5>
  <div class="panel"><div class="panel-body">
    <table class="table" id="progessDataset">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">UBIT Name</th>
           <th scope="col">Status</th>
          <th scope="col">Operation</th>
        </tr>
      </thead>

      <tbody id="progessDatasetBody"></tbody>
      <?php 
         for($i=0;$i<sizeof($ubit[$i]['UBIT_NAME']);$i++){
          ?>
          <tr>
             <th scope="row"><?php echo $i+1 ?></th>
            <td ><?php echo $ubit[$i]['UBIT_NAME']; ?></td>
            <?php if(is_null($result[$i]['FILE_SUBMITTED_TIME'])){ ?> <td>Not Reviewed</td><?php }else{?>
             <td>Reviewed</td>
           <?php }?>
            <?php if(is_null($result[$i]['FILE_SUBMITTED_TIME'])){ ?> <td>No Answers to View</td><?php }else{?>
              <td><a  href=<?php echo "/ubspectrum/admin/crowdsource/answerViewPage.php?datasetid=".$id."&ubit=".$ubit[$i]['UBIT_NAME'] ?>>View Answers</a></td>
           <?php }?> 
          </tr>
        <?php 
          }
        ?>
    </table>
  </div></div>
</div>
</body>
<!-- <script>  
 $(document).ready(function(){  
      $('#progessDataset').DataTable();    
 });   
 </script> -->

</html>