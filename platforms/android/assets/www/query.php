<?php 
header("Access-Control-Allow-Origin: *");
mysql_connect('localhost','root','root');
mysql_select_db('in_between') or die("Unable to select database");
$type = $_REQUEST['type'];
// echo 'aw';
if($type == 'adduser') {
	$player_name = $_REQUEST['player_name'];
	$card_1 = $_REQUEST['card_1'];
	$card_2 = $_REQUEST['card_2'];
	$query = "INSERT INTO `game_table` 
	(`id`, `player_name`, `chair`, `card_1`, `card_2`) 
	VALUES ('', '".$player_name."','', '{\"num\":\"".$card_1[0]."\",\"suit\":\"".$card_1[1]."\"}', '{\"num\":\"".$card_2[0]."\",\"suit\":\"".$card_2[1]."\"}');";
	$result = mysql_query($query);
	return $result;
} elseif ($type == 'update_user') {
	$player_name = $_REQUEST['player_name'];
	$card_1 = $_REQUEST['card_1'];
	$card_2 = $_REQUEST['card_2'];
	$query = "UPDATE `game_table` SET `card_1` = '{\"num\":\"".$card_1[0]."\",\"suit\":\"".$card_1[1]."\"}',
`card_2` = '{\"num\":\"".$card_2[0]."\",\"suit\":\"".$card_2[1]."\"}' WHERE `game_table`.`player_name` = '".$player_name."' ";
	$result = mysql_query($query);

} elseif($type == 'check_user') {

	 $query = "SELECT * FROM game_table";
	$sql = mysql_query($query);
	// $result = mysql_fetch_($sql);
	// $res = mysql_fetch_all($sql);
	 // print_r($res);
	//echo $res;
	 while($row=mysql_fetch_assoc($sql)) {
       // $res[] = $row;
	 	$array[] = $row;
   }
   	die(json_encode($array));
} elseif($type == 'deal') {
	$player_name = $_REQUEST['player_name'];
	$id = ($_REQUEST['id'] + 1);
	 $query = "UPDATE `game_table` SET `turn` = '0' WHERE player_name = '".$player_name."'";
	$result = mysql_query($query);
	 $query = "UPDATE `game_table` SET `turn` = '1' WHERE id = ". $id;
	$result = mysql_query($query);
} elseif($type == 'reset') {
	 $query = "UPDATE `game_table` SET `turn` = '1' WHERE id = '1'";
	$result = mysql_query($query);
}

?>
	