function init_click_handlers(){
	$('.modalButton').click(function modal(e){    
		e.preventDefault();
		$('#modal').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	return false;
	});
};
  

init_click_handlers();
$("#some_pjax_id").on("pjax:success", function() {
  init_click_handlers(); //reactivate links in grid after pjax update
});
  
//  $(document).ready(function(){
//	$('.modalButton').click(function modal(e){    
//		e.preventDefault();
//		$('#modal').modal('show')
//			.find('#modalContent')
//			.load($(this).attr('value'));
//	return false;
//	});
//});
  
  
  
// $(document).on('ready pjax:success', function() {
//            $('.modalButton').click(function(e){
//               e.preventDefault(); //for prevent default behavior of <a> tag.
//               $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
//          
//           });
//        });
    
