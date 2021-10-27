<?php require_once('includes/connect.php');


$output= array();
$sql = "SELECT `transactions`.`id` AS Tid, `accounts`.`title` AS Atitle, `accounts`.`firstName` AS Afname, `accounts`.`lastName` AS Alname, `transactions`.`invoiceID` AS TinVoice, `transactions`.`orderID` AS Torder, `transactions`.`amountPaid` AS Tpaid, `transactions`.`fees` AS Tfee, `transactions`.`volumeReceived` AS Treceived, `transactions`.`status` AS Tstatus, `transactions`.`CreatedAt` AS Tcreated, `receivers`.`firstName` AS Rfname, `receivers`.`lastName` AS Rlname FROM `transactions` LEFT JOIN `accounts` ON `accounts`.`id` = `transactions`.`accountId` LEFT JOIN `fxrates` ON `fxrates`.`id` = `transactions`.`fxRateId` LEFT JOIN `receivers` ON `receivers`.`id` = `transactions`.`receiverId` WHERE `transactions`.`status` ='completed' OR `transactions`.`status` ='failed' OR `transactions`.`status` ='processing' ORDER BY `transactions`.`CreatedAt` DESC";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

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
        $sub_array = array();
        $sub_array[] = $row['Tid'];
        $sub_array[] = $row['Atitle'].". ".$row['Afname']." ".$row['Alname'];
        $sub_array[] = $row['TinVoice'];
        $sub_array[] = $row['Torder'];
        $sub_array[] = number_format($row['Tpaid'], 2, '.', '');
        $sub_array[] = number_format((number_format($row['Tfee'], 2, '.', '')/100)*number_format($row['Tpaid'], 2, '.', ''), 2, '.', '');
        $sub_array[] = number_format($row['Treceived'], 2, '.', '');
        $sub_array[] = $row['Tstatus'];
        $sub_array[] = $row['Tcreated'];
        $sub_array[] = $row['Rfname']." ".$row['Rlname'];
        $data[] = $sub_array;
    }


$output = array(
	// 'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
