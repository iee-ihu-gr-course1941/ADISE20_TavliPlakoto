var me={};
var game_status={};

$(function ()
 {
	draw_empty_board();
	fill_board();

	$('#tavli_login').click(login_to_game);
	$('tavli_reset').click(reset_board);
	$('#do_move').click( do_move);
	$('#move_div').hide();
	game_status_update();

});

function draw_empty_board() {
	var t='<table id="tavli_table">';
	for(var i=2;i>0;i--) {
		t += '<tr>';
		for(var j=12;j>0;j--) {
			t += '<td class="tavli_square" id="square_'+j+'_'+i+'">' + j +','+i+'</td>'; 
		}
		t+='</tr>';
	}
	t+='</table>';
	
	$('#tavli_board').html(t);
}

function fill_board() {
	$.ajax({url: "tavli.php/board/", success: fill_board_by_data });
	
}


function reset_board() {
	$.ajax({url: "tavli.php/board/", method: 'POST',  success: fill_board_by_data });
	$('#move_div').hide();
	$('#game_initializer').show(2000);
}

function fill_board_by_data(data) {
	for(var i=0;i<data.length;i++) {
		var o = data[i];
		var id = '#square_'+ o.y +'_' + o.x;
		var c = (o.first_piece!=null)?o.first_piece:"";
		var d = (o.second_piece!=null)?o.second_piece:"";
		var s = o.pieces;
		//var im = (o.piece!=null)?'<img class="piece" src="images/'+c+'.png">':'';
		var im = d+"<br>"+c+"<br>"+s+" pieces";
	    
		$(id).addClass(o.b_color+'_square').html(im);
		
	}
}	

	function login_to_game() {
		if($('#username').val()=='') {
			alert('You have to set a username');
			return;
		}
		var p_color = $('#pcolor').val();
		draw_empty_board(p_color);
		fill_board();
		
		$.ajax({url: "tavli.php/players/"+p_color, 
				method: 'PUT',
				dataType: "json",
				contentType: 'application/json',
				data: JSON.stringify( {username: $('#username').val(), piece_color: p_color}),
				success: login_result,
				error: login_error});
	}

	function login_result(data) {
		me = data[0];
		$('#game_initializer').hide();
		update_info();
		game_status_update();
	}
	
	function login_error(data,y,z,c) {
		var x = data.responseJSON;
		alert(x.errormesg);
	}

	function game_status_update() {
		$.ajax({url: "tavli.php/status/", success: update_status });
	}


	function update_status(data) {
		game_status=data[0];
		update_info();
		if(game_status.p_turn==me.piece_color &&  me.piece_color!=null) {
			x=0;
			// do play
			$('#move_div').show(1000);
			setTimeout(function() { game_status_update();}, 15000);
		} else {
			// must wait for something
			$('#move_div').hide(1000);
			setTimeout(function() { game_status_update();}, 4000);
		}
		 
	}
	

	function update_info(){
		$('#game_info').html("I am Player: "+me.piece_color+", my name is "+me.username +'<br>Token='+me.token+'<br>Game state: '+game_status.status+', '+ game_status.p_turn+' must play now.');
		
	}
