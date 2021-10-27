<?php require_once('includes/connect.php');

$output= array();

$sql = "SELECT `title`, `firstName`, `lastName`, `email`, `phoneNumber`, `txLimit`, `created` FROM `accounts` ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE firstName like '%".$search_value."%'";
	$sql .= " OR lastName like '%".$search_value."%'";
	$sql .= " OR email like '%".$search_value."%'";
	$sql .= " OR phoneNumber like '%".$search_value."%'";
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
	$sub_array[] = $row['title'];
	$sub_array[] = $row['firstName'];
	$sub_array[] = $row['lastName'];
	$sub_array[] = $row['email'];
	$sub_array[] = $row['phoneNumber'];
	$sub_array[] = number_format($row['txLimit'], 2, '.', '');
	$sub_array[] = $row['created'];
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
