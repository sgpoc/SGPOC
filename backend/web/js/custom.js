//Bindear modal para boton en todas las filas?
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

var VistaModal = {
    init: function() {
        //Mostrar mensajes de error arriba del Modal.
        $(document).ready(function(){
            $('form#formModal').on('beforeSubmit',function(e){
                var form = $(this);
                $.post(
                    form.attr("action"), //serialize yii2 form
                    form.serialize() //pone los datos del form en un array
                )
                .done(function(result) {
                    if(result === 'OK.'){
                        form.trigger("reset");
                        $.pjax.reload({container:'#gridview'}); 
                        $.notify({
                            icon: 'glyphicon glyphicon-ok-sign',
                            message: result,
                            }, {
                            type: 'success',
                            delay: 1500,
                            z_index: 2000,
                            placement : { from:'top', align: 'center'} 
                        });
                    }
                    else { 
                        $.notify({
                            icon: 'glyphicon glyphicon-remove-sign',
                            message: result,
                            }, {
                            type: 'danger',
                            delay: 1500,
                            z_index: 2000,
                            placement : { from:'top', align: 'center'} 
                        })
                    }
               }).fail(function(){
                   console.log('Server error.');
               }); 
            return false; 
            }); 
        });
    }
}
