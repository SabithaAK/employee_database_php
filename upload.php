<?php

//upload.php

session_start();

$error = '';

$html = '';

if($_FILES['file']['name'] != '')
{
 $file_array = explode(".", $_FILES['file']['name']);

 $extension = end($file_array);

 if($extension == 'csv')
 {
  $file_data = fopen($_FILES['file']['tmp_name'], 'r');

  $file_header = fgetcsv($file_data);

  $html .= '<table class="table table-bordered"><tr>';

  for($count = 0; $count < count($file_header); $count++)
  {
   $html .= '
   <th>
    <select name="set_column_data" class="form-control set_column_data" data-column_number="'.$count.'">
     <option value="">Select Column</option>
     <option value="emp_code">Employee code</option>
     <option value="emp_name">Employee Name</option>
     <option value="emp_department">Department</option>
     <option value="emp_dob">Date of Birth </option>
     <option value="emp_joiningdate">Joining Date</option>
    </select>
   </th>
   ';
  }

  $html .= '</tr>';

  $limit = 0;

  while(($row = fgetcsv($file_data)) !== FALSE)
  {
   $limit++;

   if($limit < 6)
   {
    $html .= '<tr>';

    for($count = 0; $count < count($row); $count++)
    {
     $html .= '<td>'.$row[$count].'</td>';
    }

    $html .= '</tr>';
   }

   $temp_data[] = $row;
  }

  $_SESSION['file_data'] = $temp_data;

  $html .= '
  </table>
  <br />
  <div align="right">
   <button type="button" name="import" id="import" class="btn btn-success" disabled>Import</button>
  </div>
  <br />
  ';
 }
 else
 {
  $error = 'Only <b>.csv</b> file allowed';
 }
}
else
{
 $error = 'Please Select CSV File';
}

$output = array(
 'error'  => $error,
 'output' => $html
);

echo json_encode($output);


?>