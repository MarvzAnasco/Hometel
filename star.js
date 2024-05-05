  //Para sa Star na Javascript

  $(document).ready(function (){
    resetStarColors();

    $('.fa-star').mouseover(function (){
        resetStarColors();

         var currentIndex = parseInt($(this).data('index'));

         for(var i=0; i <= currentIndex; i++)
            $('.fa-star:eq('+i+')').css('color', 'greeen');
    });

    $('.fa-star').mouseleave(function (){
        resetStarColors();
    });
});

function resetStarColors(){
    $('.fa-star').css('color', 'black');
}