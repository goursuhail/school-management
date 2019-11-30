<?php require_once('db.php'); ?>

<?php
try{
  //echo '<pre>'; print_r($_POST); echo '</pre>';
  $query = "INSERT INTO `student`(`name`, `fname`, `class_name`, `dob`, `address`, `phone`) values(:nam, :fname, :cid, :dob, :addr, :mob)";
  $stmt = $conn->prepare($query);
  //print_r($stmt);

  $stmt->bindValue('nam', $_POST['sname'] );
  $stmt->bindValue('fname', $_POST['paname'] );
  $stmt->bindValue('cid', $_POST['choose'] );
  $stmt->bindValue('dob', $_POST['sdob'] );
  $stmt->bindValue('addr', $_POST['addss'] );
  $stmt->bindValue('mob', $_POST['pho'] );
  $stmt->execute();


  header('location: stu-display.php');
  //print_r($_POST);
  //echo "New Record Added Succesfully";

}catch(PDOException $e){
  echo"Error:". $e->getMessage();
  die('fdf');
}
?>
