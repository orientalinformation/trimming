<?php
 include_once("mp3.php");

 // Set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
	
	if (!empty($_POST["fromTime"]) && !empty($_POST["toTime"])) {
		$fromTime = $_POST["fromTime"];
		$toTime = $_POST["toTime"];
		$fileName = $_POST["fileName"];
		$fileTime = date('YmdHis');

		//Extract 30 seconds starting after 10 seconds.
		$path = 'uploads/'.$fileName;
		$mp3 = new MP3($path);
		$mp3_1 = $mp3->extract($fromTime, $toTime);
		$mp3_1->save($fileTime.'.mp3');
	
		echo json_encode([
				'status' => true,
				'message' => 'Trim file successfully'
			]);

	} else {
		echo json_encode([
					'status' => false,
					'message' => 'Trim file error.'
				]);
	}
?>

