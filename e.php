<?php
	include 'Snappy.php';
	use Snappy\query;
	$var =  new query('localhost', 'root', '', 'f17mous');
	$log = $var->to('conversations_messages')->in(['message' => 'hola'])->get();
	$row = $log->fetch_assoc();
	print_r($row['message']);
?>