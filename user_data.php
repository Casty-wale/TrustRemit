<?php require_once('includes/connect.php');
// include './utils.php';

function flag($arr, $user){
    $totalAppearance = 0;
    foreach ($arr as $ar) {
      if($user == $ar){
        $totalAppearance++;
      }
    }
    return $totalAppearance;
}

$output= array();
$details = array();
$checker = array();

$sql = "SELECT `userdetails`.`id` AS Uid, `accounts`.`title` AS Atitle, `accounts`.`firstName` AS Afname, `accounts`.`lastName` AS Alname, `userdetails`.`dob` AS Udob, `userdetails`.`idType` AS Uidtype, `userdetails`.`idNumber` AS Uidnumber, `accounts`.`phoneNumber` AS ApNumber, `userdetails`.`city` AS Ucity, `userdetails`.`region` AS Uregion, `userdetails`.`countryLong` AS Ucountrylong, `userdetails`.`createdAt` AS Ucreate FROM `userdetails` LEFT JOIN `accounts` ON `accounts`.`id` = `userdetails`.`accountId`";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE `accounts`.`firstName` like '%".$search_value."%'";
	$sql .= " OR `userdetails`.`id` like '%".$search_value."%'";
	$sql .= " OR `accounts`.`lastName` like '%".$search_value."%'";
	$sql .= " OR `userdetails`.`idNumber` like '%".$search_value."%'";
	$sql .= " OR `accounts`.`phoneNumber` like '%".$search_value."%'";
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
while($row = mysqli_fetch_assoc($query))
{
	array_push($details, [
		'id'=>$row['Uid'],
		'fn'=>$row['Atitle'].'. '.$row['Afname'].' '.$row['Alname'],
		'id_type'=>$row['Uidtype'],
		'id_num'=>$row['Uidnumber'],
		'dob'=>$row['Udob'],
		'phoneNumber'=>$row['ApNumber'],
		'city'=>$row['Ucity'],
		'region'=>$row['Uregion'],
		'countryLong'=>$row['Ucountrylong'],
		'createdAt'=>$row['Ucreate']
	  ]);
	  $data2 = $row['Atitle'].'. '.$row['Afname'].' '.$row['Alname'].$row['Uidnumber'].$row['Udob'];
	  $data2 = strtolower($data2);
	  array_push($checker, $data2);
}
	foreach ($details as $key => $detail) {
	  $user = $detail['fn'].$detail['id_num'].$detail['dob'];
	  $user = strtolower($user);
	  $totalAppearance = flag($checker, $user);
	  if($totalAppearance > 1){
		$sub_array = array();
		// $sub_array[] = ++$key;
		$sub_array[] = $detail['id'];
		$sub_array[] = $detail['fn'];
		$sub_array[] = $detail['dob'];
		$sub_array[] = $detail['id_type'];
		$sub_array[] = $detail['id_num'];
		$sub_array[] = $detail['phoneNumber'];
		$sub_array[] = $detail['city'];
		$sub_array[] = $detail['region'];
		$sub_array[] = $detail['countryLong'];
		$sub_array[] = $detail['createdAt'];
		$sub_array[] = '<a href="#" class="btn btn-danger btn-sm deleteBtn" >Duplicate</a>';
		$data[] = $sub_array;
	  }else{
		$sub_array = array();
		// $sub_array[] = ++$key;
		$sub_array[] = $detail['id'];
		$sub_array[] = $detail['fn'];
		$sub_array[] = $detail['dob'];
		$sub_array[] = $detail['id_type'];
		$sub_array[] = $detail['id_num'];
		$sub_array[] = $detail['phoneNumber'];
		$sub_array[] = $detail['city'];
		$sub_array[] = $detail['region'];
		$sub_array[] = $detail['countryLong'];
		$sub_array[] = $detail['createdAt'];
		// $sub_array[] = '<a href="#" class="btn btn-danger btn-sm deleteBtn" >Duplicate</a>';
		$data[] = $sub_array;
	  }
	}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
