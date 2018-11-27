$("form#formModal").on("beforeSubmit", function(e) {
  var form = $(this);
  $.post(
    form.attr("action"), //serialize yii2 form
    form.serialize() //pone los datos del form en un array
  )
    .done(function(result) {
      if (result === "OK.") {
        form.trigger("reset");
        $.pjax.reload({ container: "#gridview" });
        $.notify(
          {
            icon: "glyphicon glyphicon-ok-sign",
            message: result
          },
          {
            type: "success",
            delay: 1500,
            z_index: 2000,
            placement: { from: "top", align: "center" }
          }
        );
      } else {
        $.notify(
          {
            icon: "glyphicon glyphicon-remove-sign",
            message: result
          },
          {
            type: "danger",
            delay: 1500,
            z_index: 2000,
            placement: { from: "top", align: "center" }
          }
        );
      }
    })
    .fail(function() {
      console.log("server error");
    });
  return false;
});
