init_click_handlers();

$("#gridview").on("pjax:success", function() {
  init_click_handlers(); 
});

function init_click_handlers(){
	$('.modalButton').click(function (e){    
		e.preventDefault();
		$('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
	return false;
        
	});
        
};
