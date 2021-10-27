<?php require_once('includes/connect.php');

$output= array();

$sql = "SELECT * FROM feedbacks ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= "WHERE name like '%".$search_value."%'";
	$sql .= " OR email like '%".$search_value."%'";
	$sql .= " OR subject like '%".$search_value."%'";
}

// if(isset($_POST['order']))
// {
// 	$column_name = $_POST['order'][0]['column'];
// 	$order = $_POST['order'][0]['dir'];
// 	$sql .= " ORDER BY ".$column_name." ".$order."";
// }
// else
// {
// 	$sql .= " ORDER BY id desc";
// }

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
$count = 1;
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $count;
	$sub_array[] = $row['name'];
	$sub_array[] = $row['email'];
	$sub_array[] = $row['subject'];
	$sub_array[] = $row['message'];
	$sub_array[] = $row['createdAt'];
	$sub_array[] = $row['updatedAt'];
	$data[] = $sub_array;

    $count = $count + 1;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
