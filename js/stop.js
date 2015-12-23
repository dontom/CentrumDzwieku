//alert("done");
console.log("js works fine :)");
console.log(" ");
console.log(" ");

$("#myModal").on('hidden.bs.modal', function (e) {
    $("#myModal iframe").attr("src", $("#myModal iframe").attr("src"));
});

/*

$('.modal-body').bind('hide', function () {
  var iframe = $(this).children('div.modal-body').find('iframe'); 
  var src = iframe.attr('src');
  iframe.attr('src', '');
  iframe.attr('src', src);
});

$('#myModal').on('show', function () { 
 $('div.modal-body').html('<iframe width="560" height="315" src="https://www.youtube.com/embed/7Ka-rGmXr7A?list=PL79375DB53E511C2E" frameborder="0" allowfullscreen></iframe>');  
});
$('#myModal').on('hide', function () {
 $('div.modal-body').html('');
});

$(document).ready(function(){
    $('.modal-body').each(function(){
            var src = $(this).find('iframe').attr('src');

        $(this).on('click', function(){

            $(this).find('iframe').attr('src', '');
            $(this).find('iframe').attr('src', src);

        });
    });
});

$(".modal .modal-header .close").click( function() {
   $(this).parent().parent().addClass("hide");
   $('#myModal').modal('hide')
});*/
/*
//Play Video

  width = $(window).width();
  
  if (width > 768) {
    //$('a.video').attr('href', '#myModal');
    $('#myModal').modal({show: false});
    $('a.video').click(function() {
        $('#myModal').modal({show: true});
        return false;
    });
  } else {
    $('a.video img').click(function() {
      window.location = $('a.video').attr('href');
    });
  }
  $('#myModal').on('show', function () {
    var $url = $('#myModal').attr('data-href');
    $('#myModal div.container').html('<a href="javascript:playerID.stopVideo();" class="close icon" data-dismiss="modal">&#10006;</a><iframe src="'+$url+'" width="500" height="281" frameborder="0"></iframe>');  
  });

  $('#myModal').on('hide', function () {
    var $url = $('#myModal').attr('data-href');
    $('#myModal div.container').html($url);  
  });

  
var msg = document.getElementById("test");
msg.textContent = name;
window.show("test");

$('#myModal').on('show', function () {
  $('div.modal-body').html('<iframe src="http://www.youtube.com/v/itTskyFLSS8&amp;rel=0&amp;autohide=1&amp;showinfo=0&amp;autoplay=1" width="500" height="281" frameborder="0" allowfullscreen=""></iframe>');  
});
$('#myModal').on('hide', function () {
  $('div.modal-body').html('');  
});

$('#modalClose').get(0).stopVideo();
$('.modal-body').get(0).stopVideo();

var video = $("#modalClose").attr("src");
$("#modalClose").attr("src","");
$("#modalClose").attr("src",video);

var video = $(".modal-body").attr("src");
$(".modal-body").attr("src","");
$(".modal-body").attr("src",video);

var video = $("#myModal").attr("src");
$("#myModal").attr("src","");
$("#myModal").attr("src",video);


$('#myModal').on('fade', function () {
    $('#video_player').stopVideo();
})

$('#yt-player').on('show', function () {
  $('div.modal-body').html('<iframe src="https://www.youtube.com/embed/HeOHLunhNWs;rel=0&amp;autohide=1&amp;showinfo=0&amp;autoplay=1" width="500" height="281" frameborder="0" allowfullscreen=""></iframe>');  
});
$('#yt-player').on('hide', function () {
  $('div.modal-body').html('');  
});

*/
