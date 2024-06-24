<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
}

session_start();
require_once('d.php');

//$mainid=$searchid
//echo "$searchid";
$query ="SELECT * FROM registration where id=$id";
//$query="select sid from registration r,registration1 s where s.sid=r.sid";
//$query="select * from registration where =sid";
$result=mysqli_query($con,$query);
?>  





<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
  border-radius:8px;
}


/* Create four equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 20px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* On screens that are 992px wide or less, go from four columns to two columns */
@media screen and (max-width: 992px) {
  .column {
    width: 50%;

  }
}

/* On screens that are 600px wide or less, make the columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;

  }
}
</style>
</head>
<body>
    <center>
    <?php
   while($row=mysqli_fetch_assoc($result))
   //$row=mysqli_fetch_assoc($result);{}
  {
    ?>
    
    <table>
<h2>Profile page</h2>
<label for="email class=student_name"><b>student name:</b></label>
    <input type="text" placeholder=" <?php echo $row['name'];?>" name="email" id="email" required>
     <br>
    <label for="psw"><b>email:</b></label>
    <input type="password" placeholder="<?php echo $row['email'];?>" name="psw" id="psw" required>
<br>
    <label for="psw-repeat"><b>linkdin:</b></label>
    <input type="password" placeholder="<?php echo $row['linkdin'];?>" name="psw-repeat" id="psw-repeat" required>
    <h2 class="para_head">interview questions</h2>
<div class="row">
  <div class="row" style="background-color:#aaa; width:75%">
      <input type="text" placeholder="<?php echo $row['suggestions'];?>">
         <h2 class="para_head">experience</h2>
         <input type="text" placeholder="<?php echo $row['experience'];?>">
  <div class="row" style="background-color:#bbb;width:75%">
    
    <h2 class="para_head">suggestion</h2>
    <input type="text" placeholder="<?php echo $row['interview questions'];?>">
  </div>
  
  
</div>
</table>
<?php
  }
    ?>
</center>
<
<style>
     {box-sizing: border-box}

/* Add padding to containers */
.container {
  padding: 10px;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 50%;
  padding: 10px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
.student_name{
    margin-left:0px;
    
}
.para_head{
  color:maroon;
}

/* Set a style for the submit/register button */

</style>
</body>
</html>
