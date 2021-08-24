<?php

$start_date = $_GET['startDate'];
$end_date = $_GET['endDate'];
$channel = $_GET['channel'];


$data = array(
			array(
				'start_date' => $start_date,
				'end_date' => $end_date,
				'channel' => $channel
				)
			);

$param = base64_encode(json_encode($data));
$command = escapeshellcmd("python main.py"." ".$param);

// echo "python main.py"." ".$param;
// die;

$output = shell_exec($command);

// header("Location: ".$filename);
// die;
$output1 = str_replace(array('.', ' ', "\n" , "\t", "
	// r"),'',$output);

// print($output1);
// die;
$output = (json_decode($output,true));

$output = array('data' => $output );

// if($output[0]['code'] == 'SUCCESS'){
// echo $output;
echo json_encode($output);
// }else{
	// echo "Failed";
// }
?>