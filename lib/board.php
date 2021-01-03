<?php

function show_piece($x,$y) {
	global $conn;
	
	$sql = 'select * from board where x=? and y=?';
	$st = $conn->prepare($sql);
	$st->bind_param('ii',$x,$y);
	$st->execute();
	$res = $st->get_result();
	header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}

function get_piece_info($x,$y)
{
	global $conn;
	
	$sql = 'select * from board where x=? and y=?';
	$st = $conn->prepare($sql);
	$st->bind_param('ii',$x,$y);
	$st->execute();
	$res = $st->get_result();
	$piece_info = $res->fetch_assoc();
	return($piece_info);
}

function get_from_repo($token)
{
	global $conn;

	$color = current_color($token);

	$sql = 'select * from repository where color=?';
	$st = $conn->prepare($sql);
	$st->bind_param('s',$color);
	$st->execute();
	$res = $st->get_result();
	if($row=$res->fetch_assoc()) {
		return($row['pieces']);
	}
	return(null);
}


function get_phase($token)
{
	global $conn;

	$color = current_color($token);
	$sql = 'select * from repository where color=?';
	$st = $conn->prepare($sql);
	$st->bind_param('s',$color);
	$st->execute();
	$res = $st->get_result();
	if($row=$res->fetch_assoc()) {
		return($row['phase']);
	}
	return(null);
}

function change_phase($token)
{
	global $conn;

	$color = current_color($token);
	$sql = "update repository set phase='end' where color=?";
	$st = $conn->prepare($sql);
	$st->bind_param('s',$color);
	$st->execute();


}

function move_piece($x,$y,$x2,$y2,$dice1,$dice2,$token) {
	global $conn;

	$color = current_color($token);

	$dice_sum = $dice1 + $dice2;
	$steps_count = 0;

	if($color=='B')
	{
		$index = array("1.1", "1.2", "1.3", "1.4", "1.5", "1.6", "1.7", "1.8", "1.9", "1.10", "1.11", "1.12", "2.12", "2.11", "2.10", "2.9", "2.8", "2.7", "2.6", "2.5", "2.4", "2.3", "2.2", "2.1");
	}
	else
	{
		$index = array("2.1", "2.2", "2.3", "2.4", "2.5", "2.6", "2.7", "2.8", "2.9", "2.10", "2.11", "2.12", "1.12", "1.11", "1.10", "1.9", "1.8", "1.7", "1.6", "1.5", "1.4", "1.3", "1.2", "1.1");
	}	



	if($token==null || $token=='') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"token is not set."]);
		exit;
	}
	
	if($color==null ) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"You are not a player of this game."]);
		exit;
	}
	$status = read_status();
	if($status['status']!='started') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"Game is not in action."]);
		exit;
	}
	if($status['p_turn']!=$color) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"It is not your turn."]);
		exit;
	}

	if($x==0 && $y==0)
	{
		$phase = get_phase($token);
		$pieces_in_repo = get_from_repo($token);


		if($color=='B')
		{
			$source_index = array_search("1.1", $index);
			$destination_index = array_search("$x2.$y2", $index);

		}
		else
		{
			$source_index = array_search("2.1", $index);
			$destination_index = array_search("$x2.$y2", $index);
		}


		if($phase=='start')
		{
			$destination = get_piece_info($x2,$y2);
			$destination_pieces = $destination['pieces'];

			$new_destination_pieces = $destination_pieces + 1;
			$new_repo_pieces = $pieces_in_repo - 1;


			for($i=$source_index+1; $i<=$destination_index; $i++)
			{
				$steps_count++;
			}

			if($steps_count>$dice_sum)
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"Your dice sum is less from what you played"]);
				exit;
			}
			elseif($steps_count!=$dice_sum && $steps_count!=$dice1 && $steps_count!=$dice2)
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"Play a move allowed by your dice"]);
				exit;
			}


			if($destination_pieces==0)
				{	
					$sql = "update board set first_piece='".$color."', pieces=".$new_destination_pieces." where x=".$x2." and y=".$y2;
					$st = $conn->prepare($sql);
					$r = $st->execute();
				}
				elseif($destination_pieces==1)
				{
					$sql = "update board set second_piece='".$color."', pieces=".$new_destination_pieces." where x=".$x2." and y=".$y2;
					$st = $conn->prepare($sql);
					$r = $st->execute();
				}
				else
				{
					if($color!=$destination['second_piece'])
					{
						header("HTTP/1.1 400 Bad Request");
						print json_encode(['errormesg'=>"This move is not allowed"]);
						exit;
					}
					$sql = "update board set pieces=".$new_destination_pieces." where x=".$x2." and y=".$y2;
					$st = $conn->prepare($sql);
					$r = $st->execute();
				}
			$sql2 = "update repository set pieces=".$new_repo_pieces." where color='".$color."'";
			$st2 = $conn->prepare($sql2);
			$r2 = $st2->execute();

			if($new_repo_pieces==0)
			{
				change_phase($token);
			}

			header('Content-type: application/json');
			print json_encode(read_board(), JSON_PRETTY_PRINT);
			change_turn();
			exit;
		}
		else
		{
			$source = get_piece_info($x2,$y2);
			$source_pieces = $source['pieces'];


			if($color=='B')
			{
				if($x2==1)
				{
					header("HTTP/1.1 400 Bad Request");
					print json_encode(['errormesg'=>"You cant put a piece in the repository from this position"]);
					exit;
				}
			}
			else
			{
				if($x2==2)
				{
					header("HTTP/1.1 400 Bad Request");
					print json_encode(['errormesg'=>"You cant put a piece in the repository from this position"]);
					exit;
				}
			}



			for($i=$source_index; $i<=$destination_index; $i++)
			{
				$steps_count++;
			}

			if($steps_count>$dice_sum)
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"Your dice sum is less from what you played"]);
				exit;
			}
			elseif($steps_count!=$dice_sum && $steps_count!=$dice1 && $steps_count!=$dice2)
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"Play a move allowed by your dice"]);
				exit;
			}


			if($source_pieces==0)
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"There are no pieces in "+$x2+","+$y2]);
				exit;
			}

			$new_source_pieces = $source_pieces - 1;
			$new_repo_pieces = $pieces_in_repo + 1;

			if($source_pieces==1)
			{	
				$sql2 = "update board set first_piece=null, pieces=".$new_source_pieces." where x=".$x2." and y=".$y2;
				$st2 = $conn->prepare($sql2);
				$r2 = $st2->execute();
			}
			elseif($source_pieces==2)
			{
				$sql2 = "update board set second_piece=null, pieces=".$new_source_pieces." where x=".$x2." and y=".$y2;
				$st2 = $conn->prepare($sql2);
				$r2 = $st2->execute();
			}
			else
			{
				$sql2 = "update board set pieces=".$new_source_pieces." where x=".$x2." and y=".$y2;
				$st2 = $conn->prepare($sql2);
				$r2 = $st2->execute();	
			}

			$sql = "update repository set pieces=".$new_repo_pieces." where color='".$color."'";
			$st = $conn->prepare($sql);
			$r = $st->execute();

			header('Content-type: application/json');
			print json_encode(read_board(), JSON_PRETTY_PRINT);
			change_turn();
			exit;
		}	

	}
	else
	{

		$source_index = array_search("$x.$y", $index);
		$destination_index = array_search("$x2.$y2", $index);

		if($color=='B')
		{
			if($x>$x2)
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"You cant go backwards"]);
				exit;
			}
			if($x==1 && $y>=$y2)
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"You cant go backwards"]);
				exit;
			}
			if($x==2 && $y<=$y2)
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"You cant go backwards"]);
				exit;
			}
		}
		if($color=='W')
		{
			if($x<$x2)
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"You cant go backwards"]);
				exit;
			}
			if($x==2 && $x2==2 && $y>=$y2)
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"You cant go backwards"]);
				exit;
			}
			if($x==1 && $y<=$y2)
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"You cant go backwards"]);
				exit;
			}
		}
		

		$source = get_piece_info($x,$y);
		$destination = get_piece_info($x2,$y2);

		$source_pieces = $source['pieces'];
		$destination_pieces = $destination['pieces'];

		for($i=$source_index+1; $i<=$destination_index; $i++)
		{
			$steps_count++;
		}

		if($steps_count>$dice_sum)
		{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"Your dice sum is less from what you played"]);
				exit;
		}
		elseif($steps_count!=$dice_sum && $steps_count!=$dice1 && $steps_count!=$dice2)
		{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"Play a move allowed by your dice"]);
				exit;
		}

		if($source_pieces==0)
		{
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"There are no pieces in "+$x+","+$y]);
			exit;
		}

		$new_destination_pieces = $destination_pieces + 1;
		$new_source_pieces = $source_pieces - 1;

		if($source_pieces==1)
		{
			if($color!=$source['first_piece'])
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"This is not your piece"]);
				exit;
			}
			if($destination_pieces==0)
			{	
				$sql = "update board set first_piece='".$source['first_piece']."', pieces=".$new_destination_pieces." where x=".$x2." and y=".$y2;
				$st = $conn->prepare($sql);
				$r = $st->execute();
			}
			elseif($destination_pieces==1)
			{
				$sql = "update board set second_piece='".$source['first_piece']."', pieces=".$new_destination_pieces." where x=".$x2." and y=".$y2;
				$st = $conn->prepare($sql);
				$r = $st->execute();
			}
			else
			{
				if($color!=$destination['second_piece'])
				{
					header("HTTP/1.1 400 Bad Request");
					print json_encode(['errormesg'=>"This move is not allowed"]);
					exit;
				}
				$sql = "update board set pieces=".$new_destination_pieces." where x=".$x2." and y=".$y2;
				$st = $conn->prepare($sql);
				$r = $st->execute();
			}
			$sql2 = "update board set first_piece=null, pieces=".$new_source_pieces." where x=".$x." and y=".$y;
			$st2 = $conn->prepare($sql2);
			$r2 = $st2->execute();
		}
		elseif($source_pieces==2)
		{
			if($color!=$source['second_piece'])
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"This is not your piece"]);
				exit;
			}
			if($destination_pieces==0)
			{	
				$sql = "update board set first_piece='".$source['second_piece']."', pieces=".$new_destination_pieces." where x=".$x2." and y=".$y2;
				$st = $conn->prepare($sql);
				$r = $st->execute();
			}
			elseif($destination_pieces==1)
			{
				$sql = "update board set second_piece='".$source['second_piece']."', pieces=".$new_destination_pieces." where x=".$x2." and y=".$y2;
				$st = $conn->prepare($sql);
				$r = $st->execute();
			}
			else
			{
				if($color!=$destination['second_piece'])
				{
					header("HTTP/1.1 400 Bad Request");
					print json_encode(['errormesg'=>"This move is not allowed"]);
					exit;
				}
				$sql = "update board set pieces=".$new_destination_pieces." where x=".$x2." and y=".$y2;
				$st = $conn->prepare($sql);
				$r = $st->execute();
			}
			$sql2 = "update board set second_piece=null, pieces=".$new_source_pieces." where x=".$x." and y=".$y;
			$st2 = $conn->prepare($sql2);
			$r2 = $st2->execute();
		}
		else
		{
			if($color!=$source['second_piece'])
			{
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"This is not your piece"]);
				exit;
			}
			if($destination_pieces==0)
			{	
				$sql = "update board set first_piece='".$source['second_piece']."', pieces=".$new_destination_pieces." where x=".$x2." and y=".$y2;
				$st = $conn->prepare($sql);
				$r = $st->execute();
			}
			elseif($destination_pieces==1)
			{
				$sql = "update board set second_piece='".$source['second_piece']."', pieces=".$new_destination_pieces." where x=".$x2." and y=".$y2;
				$st = $conn->prepare($sql);
				$r = $st->execute();
			}
			else
			{
				if($color!=$destination['second_piece'])
				{
					header("HTTP/1.1 400 Bad Request");
					print json_encode(['errormesg'=>"This move is not allowed"]);
					exit;
				}
				$sql = "update board set pieces=".$new_destination_pieces." where x=".$x2." and y=".$y2;
				$st = $conn->prepare($sql);
				$r = $st->execute();
			}
			$sql2 = "update board set pieces=".$new_source_pieces." where x=".$x." and y=".$y;
			$st2 = $conn->prepare($sql2);
			$r2 = $st2->execute();
		}
		header('Content-type: application/json');
		print json_encode(read_board(), JSON_PRETTY_PRINT);
		change_turn();
		exit;
	}

	header("HTTP/1.1 400 Bad Request");
	print json_encode(['errormesg'=>"This move is illegal."]);
	exit;
}


function read_board() {
	global $conn;
	$sql = 'select * from board';
	$st = $conn->prepare($sql);
	$st->execute();
	$res = $st->get_result();
	return($res->fetch_all(MYSQLI_ASSOC));
}





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