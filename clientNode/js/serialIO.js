$(function(){ 
	serialIo.notify(".warn-disp", "WARNING!!!");
	
});

var serialIo = {
	notify: function(_id, _msg ){
		$(_id).text(_msg);
	}
}