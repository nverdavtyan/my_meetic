$( window ).load(function(){

    //menu overlay profil
    $('.profile__over').on('click',function(){
        let clicks = $(this).data('clicks');
        if (clicks){
            $(".dropdown-menu").css('display', "none");
        }else{
            $(".dropdown-menu").css('display', "block");
        }
        $(this).data("clicks", !clicks);
    })

    //conform profile deletion
    $(".disable__account").on("click",function(){
        $(".modal").fadeIn(200);
    })

    $(".close__modal").on("click",function(){
        $(".modal").fadeOut(200);
    })


   /* edit image according to gender*/
    let genre = $(".user__gender");
    if (genre.length > 0){
        if (genre.html().indexOf("homme") > 0){
            $(".rounded__img , .rounded-circle").attr("src", "../public/assets/images/men.jpeg")
        }else if(genre.html().indexOf("femme") > 0){
            $(".rounded__img , .rounded-circle").attr("src", "../public/assets/images/women.png")
        }else{
            $(".rounded__img , .rounded-circle").attr("src", "../public/assets/images/other.jpeg")
        }
    }




});