<?php
	
	$db_host='iebulletin';
	$db_user='iebulletin';
	$db_passwd='dlwl6414';
	$db_name='iebulletin';
	$conn=mysqli_connect($db_host, $db_user, $db_passwd, $db_name);

	if(mysqli_connect_errno($conn)){
		echo "\tFail to connect DB".mysqli_connect_error()."\n";
	}
	else{
		echo "\tSuccess to connect DB"."\n";
	}
	
	$id=$_POST["id"];
	$data=$_GET["phone"];
	$date=date('w');
	echo "\t".$_SERVER['REQUEST_METHOD']."\n";

	if(strcmp($_SERVER['REQUEST_METHOD'], 'POST')==0){
		$myquery='select tel from USER where id="'.$id.'"';
		$result=mysqli_query($conn, $myquery);

		if(!$result){
			echo "Error:".mysqli_error($conn);
			exit();
		}
		else{
			echo "\ttel query Success\n";
		}

		while($row = mysqli_fetch_array($result)){
			$tel = $row['tel'];
		}
		$date_query = 'select description from DAY_NOTI where day_id = "'.$date.'"';
		$result = mysqli_query($conn, $date_query);
		if(!$result) {
			echo "Error :".mysqli_error($conn);
			exit();
		}
		else echo "\tdate query success\n";

		while($row = mysqli_fetch_array($result)){
			$date_noti = $row['description'];
		}

		$mysql = 'select description from NOTIFICATION where noti_id=2';
		$result=mysqli_query($conn, $mysql);

		if(!$result){
			echo "Error:".mysqli_error($conn);
			exit();
		}
		else{
			echo "\ttotal noti query Success\n";
		}

		while($row = mysqli_fetch_array($result)){
			$msg1 = $row['description'];
		}
		$indinoti_query = 'select description from INDI_NOTI, USER_NOTI_INT where user_id="'.$id.'" and indinoti_id=noti_id';

		$result = mysqli_query($conn, $indinoti_query);
		if(!$result) {
			echo "Error: ".mysqli_error($conn);
			exit();
		}
		else echo "\tindi noti query success\n";

		while($row = mysqli_fetch_array($result)) {
			$indi=$row['description'];
		}
		$data=shell_exec('python send_sms.py "'.$tel.'" "'.$date_noti.'" "'.$msg1.'" "'.$indi.'"');
		echo $data;
	}
	else{	
		$db_host='iebulletin';
		$db_user='iebulletin';
		$db_passwd='dlwl6414';
		$db_name='iebulletin';
		$conn=mysqli_connect($db_host, $db_user, $db_passwd, $db_name);

		if(mysqli_connect_errno($conn)){
			echo "Fail to connect DB".mysqli_connect_error()."\n";
		}
		else{
			echo "\tSuccess to connect DB\n";
		}

		if(strcmp(substr($data, 0, 1), '0')==0){
			
			$data='82'.substr($data, 1);
		}
		else{
				$data='82'.$data;
		}
		echo $data."\n";
	//	$myquery='insert into USER(id, tel) values("[1]", '.$data.')';
		$myquery='update USER set tel='.$data.'  where id="[229, 134, 214, 101, 208]"';
		$result=mysqli_query($conn, $myquery);

		if(!$result){
			echo "Error:".mysqli_error($conn);
			exit();
		}
		else{
			echo "\tQuery Success\n";
		}
	}
?>
