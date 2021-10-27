<?php require_once('includes/connect.php');

$output= array();

$sql = "SELECT `amountPaid`,`volumeReceived`, `doneAt`, `receivers`.`firstName` AS Rfname, `receivers`.`lastName`AS Rlname, `receivers`.`email` AS Remail, `receivers`.`phoneNumber` AS RPnumber, `receivers`.`countryLong` AS RcountryLong, `accounts`.`title` AS Atitle, `accounts`.`firstName` AS Afname, `accounts`.`lastName` AS Alname FROM `transactions` LEFT JOIN `accounts` ON `accounts`.`id` = `transactions`.`accountId` LEFT JOIN `fxrates` ON `fxrates`.`id` = `transactions`.`fxRateId` LEFT JOIN `receivers` ON `receivers`.`id` = `transactions`.`receiverId` WHERE `receivers`.`firstName` IS NOT NULL AND `receivers`.`lastName` IS NOT NULL ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= "AND `receivers`.`firstName` like '%".$search_value."%'";
	$sql .= " OR `receivers`.`lastName` like '%".$search_value."%'";
	$sql .= " OR `receivers`.`email` like '%".$search_value."%'";
	$sql .= " OR `receivers`.`phoneNumber` like '%".$search_value."%'";
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
	$sub_array[] = $row['Rfname']." ".$row['Rlname'];
	$sub_array[] = $row['Remail'];
	$sub_array[] = $row['RPnumber'];
	$sub_array[] = $row['RcountryLong'];
	$sub_array[] = $row['Atitle'].". ".$row['Afname']." ".$row['Alname'];
	$sub_array[] = number_format($row['amountPaid'], 2, '.', '');
	$sub_array[] = number_format($row['volumeReceived'], 2, '.', '');
	$sub_array[] = $row['doneAt'];
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
