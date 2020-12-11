<?php

function show_board() {
	
	global $conn;
	
	$sql = 'select * from board';
	$st = $conn->prepare($sql);

	$st->execute();
	$res = $st->get_result();

	header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);

}

function reset_board() {
	global $conn;
	
	$sql = 'call clean_board()';
	$conn->query($sql);
	show_board();
}
?>