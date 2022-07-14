<?php

require_once('read.php');

$id = $_POST['id'] ?? NULL;

$result = array();

foreach ($orders as $order) {
	if ($order['id'] != $id) {
		$result [] = $order;
	}
}

file_put_contents($fileName, json_encode($result));

header("Location: http://localhost/list.php");

exit();