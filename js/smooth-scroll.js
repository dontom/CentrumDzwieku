$(".navbar-fixed-top ul li a[href^='#']").on('click', function(e) {

   // prevent default anchor click behavior
   e.preventDefault();

   // store hash
   var hash = this.hash;

   // animate
   $('html, body').animate({
       scrollTop: $(this.hash).offset().top -60 
     }, 900, function(){
        return false; /* MEGA WAŻNE!!! */
       // when done, add hash to url
       // (default click behaviour)
       window.location.hash = hash;
     });

});

$("a.navbar-brand[href^='#']").on('click', function(e) {

   // prevent default anchor click behavior
   e.preventDefault();

   // store hash
   var hash = this.hash;

   // animate
   $('html, body').animate({
       scrollTop: $(this.hash).offset().top -10 
     }, 900, function(){
        return false; /* MEGA WAŻNE!!! */
       // when done, add hash to url
       // (default click behaviour)
       window.location.hash = hash;
     });

});
