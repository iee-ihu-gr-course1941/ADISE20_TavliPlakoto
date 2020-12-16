$(function ()
 {
	draw_empty_board();
	fill_board();
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