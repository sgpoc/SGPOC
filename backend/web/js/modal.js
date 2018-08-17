$('.modalButton').click(function modal(e){    
    e.preventDefault();
    $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
   return false;
});

