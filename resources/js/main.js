$(document).ready(function(){

  $(".show_user_settings").on("click",function(){
	if( $('.user-settings').hasClass('modal-hidden') ) {
		$('.user-settings').removeClass('modal-hidden');
	}
	else{
		$('.user-settings').addClass('modal-hidden');
	}
	});





$(document).mouseup(function (e) {
    var container = $('.user-settings');
    if (container.has(e.target).length === 0){
  	 $('.user-settings').addClass("modal-hidden");     
    }
});









});	