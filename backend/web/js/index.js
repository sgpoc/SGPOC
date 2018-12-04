$(document).ready(function(){
   $('.app-logo').fadeIn(2000)
   $('.main-title').fadeIn(3000)
   $('.sub-title').fadeIn(4000)
   $('.fau-logo').fadeIn(5000);
});

$(document).ready(function() {
   $('.app-logo').click(function() {
      $('.desc').toggle(1500);
   }); 
});
