<?php

//import.php

if(isset($_POST["emp_code"]))
{
 $connect = new PDO("mysql:host=localhost; dbname=testing", "root", "");

 session_start();

 $file_data = $_SESSION['file_data'];

 unset($_SESSION['file_data']);

 foreach($file_data as $row)
 {
    
  //$data[] = '("'.$row[$_POST["emp_code"]].'", "'.$row[$_POST["emp_name"]].'", "'.$row[$_POST["emp_department"]].'", "'.$row[$_POST["emp_dob"]].'","'.$row[$_POST["emp_joiningdate"]].'")';
  $emp_code = $row[$_POST["emp_code"]];
  $emp_name = $row[$_POST["emp_name"]];
  $emp_department = $row[$_POST["emp_department"]];
  $emp_dob = $row[$_POST["emp_dob"]];
  $emp_dob_format = DateTime::createFromFormat('d/m/Y', $emp_dob, new DateTimeZone(('UTC')));
  $dob_emp =  $emp_dob_format->format('Y-m-d');
  //print_r($dob_emp);
  //exit;
    
  $emp_joiningdate = $row[$_POST["emp_joiningdate"]];
  $emp_jdate_format = DateTime::createFromFormat('d/m/Y', $emp_joiningdate, new DateTimeZone(('UTC')));
  $jdate_emp =  $emp_jdate_format->format('Y-m-d');



 //if(isset($data))
 //{
   
  /*$query = "
  INSERT INTO csv_file 
  (emp_code, emp_name, emp_department,emp_dob,emp_joiningdate) 
  VALUES ".implode(",", $data)."
  "; */

  $query = "
  INSERT INTO csv_file 
  (emp_code, emp_name, emp_department,emp_dob,emp_joiningdate) 
  VALUES ('$emp_code','$emp_name','$emp_department','$dob_emp','$jdate_emp')
  ";
  $statement = $connect->prepare($query);
 }
  if($statement->execute())
  {
   echo 'Data Imported Successfully';
  }
 
}



?>
