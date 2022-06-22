$('#filter_search').submit();
$(window).load(function () {
    /* Ajax form register */
    $('#register-form').on('submit', function (e) {
        e.preventDefault();
        let postdata = $("#register-form").serialize();
        $.ajax({
            type: "POST",
            url: "../private/verify_register.php",
            data: postdata,
            dataType: "json",
            context: document.body,
            success: function (result) {
                if (result["errorStatus"]) {
                    console.log(result);
                    $("#firstname + .error-msg").html(result["firstnameError"]);
                    $("#lastname + .error-msg").html(result["lastnameError"]);
                    $("#email + .error-msg").html(result["emailError"]);
                    $("#password + .error-msg").html(result["passwordError"]);
                    $("#birth + .error-msg").html(result["birthError"]);
                    $("#gender + .error-msg").html(result["genderError"]);
                    $("#Hobbies + .error-msg").html(result["hobbiesError"]);
                    $("#city + .error-msg").html(result["cityError"]);
                    $(".form-group").css("margin-bottom", "3px");
                } else {
                    window.location.href = '../Connection';
                }
            }
        })
    })

    /* Ajax form de connection */
    $('#connect-form').on('submit', function (e) {
        e.preventDefault();
        let postdata = $("#connect-form").serialize();
        $.ajax({
            type: "GET",
            url: "../private/verify_login.php",
            data: postdata,
            dataType: "json",
            context: document.body,
            success: function (result) {
                console.log(result);
                if (result["errorStatus"]) {
                    $("#email + .error-msg").html(result["emailError"]);
                    $("#password + .error-msg").html(result["passwordError"]);
                    if (result["sameLogin"]) {
                        $(".link_forms").css("display", "none");
                        $(".alert-danger.same").attr("style", "position: relative").css("opacity", "1").css("transition", "1.5s");
                    }else if (result["disableAccount"]) {
                        $(".link_forms").attr("style", "display: none !important");
                        $(".alert-danger.same").attr("style", "");
                        $(".alert-danger.disable__account").css("opacity", "1").css("transition", "1.5s");
                    }
                } else {
                    window.location.href = '../Profil?id=' + result["userID"];
                }
            }
        })
    })

    /* Ajax form  update profile */
    $('#update-form').on('submit', function (e) {
        e.preventDefault();
        let postdata = $("#update-form").serialize();
        $.ajax({
            type: "POST",
            url: "../private/verify_update.php",
            data: postdata,
            dataType: "json",
            context: document.body,
            success: function (result) {
                if (result["errorStatus"]) {
                    $("#email + .error-msg").html(result["emailError"]);
                } else {
                    let city = $("#city");
                    let firstname = $("#firstname");
                    let lastname = $("#lastname");
                    let bio = $("#description");

                    if (notEmpty(city)){
                        $(".user__location").html("<i class=\"fas fa-map-marker-alt\"></i> " + city.val());
                        $("#city + .error-msg").html("");
            
                    }else{
                        $("#city + .error-msg").html("This field is empty !");
                      
                    }

                    if (notEmpty(firstname)){
                        $(".welcome__titre").html("Salut " + firstname.val());
                        $("#firstname + .error-msg").html("");
                   
                    }else{
                        $("#firstname + .error-msg").html("This field is empty  !");
                        
                    }

                    if (notEmpty(lastname)){
                        $(".user__name.apercu, .profil__overlay--name").html(firstname.val() + " " + lastname.val());
                        $("#lastname + .error-msg").html("");
                     
                    }else{
                        $("#lastname + .error-msg").html("This field is empty  !");
                    }

                    if (notEmpty(bio)){
                        $(".user__description").html(bio.val());
                        $("#description + .error-msg").html("");
                    }else{
                        $("#description + .error-msg").html("This field is empty !");
                    }
                    $(".user__mail").html("<i class=\"fas fa-envelope\"></i> Mon email : " + $("#email").val());
                }

                function notEmpty(inp){
                    return inp.val() !== "";
                }



            }
        })
    })

    /* Ajax filtre recherche */
    $('#filter_search').on('submit', function (e) {
        e.preventDefault();
        let postdata = $("#filter_search").serialize();
        $.ajax({
            type: "POST",
            url: "private/search.php",
            data: postdata,
            dataType: "json",
            context: document.body,
            success: function (result) {
                Pagination(result);
            }
        })
    })


    function filterResult(retour, index){
            $(".result__name").html(retour[index.toString()]["firstname"] + " " + retour[index.toString()]["lastname"])
            $(".age").html(getAge(retour[index.toString()]["date_naissance"]) + " ANS");
            $(".result__city").html(retour[index.toString()]["ville"]);
            $(".mail").html(retour[index.toString()]["email"]);
            $(".result__gender").html(retour[index.toString()]["genre"]);
            $(".profil__btn").attr('href', "Profil?id=" + retour[index.toString()]["id"]);
            if(retour[index.toString()]["genre"] === "homme"){
                $(".card__profil").removeClass("women").addClass("men");
            }else if(retour[index.toString()]["genre"] === "femme"){
                $(".card__profil").removeClass("men").addClass("women");
            }else {
                $(".card__profil").removeClass("women").removeClass("men");
            }
      }


/* convert date of birth to age */
    function getAge(birth){
        birth = new Date(birth);
        let today = new Date();
        return Math.floor((today - birth) / (365.25 * 24 * 60 * 60 * 1000)).toString();
    }

/* paging next/previous page */
    function Pagination(result){
        let i = 0;
        let count = result.length - 1;
        let random = Math.floor(Math.random() * count);
        filterResult(result , random);
        $('.right').on('click', function(){
            if(i < count){
                i++;
            }
            filterResult(result , i);
        })
        $('.left').on('click', function(){
            if(i > 0){
                i--;
            }
            filterResult(result , i);
        })
    }

    /* défaut au lancement de la page => get all users */
    if ($("#filter_search").length === 1){
        let postdata = $("#filter_search").serialize();
        $.ajax({
            url: "private/search.php",
            data: postdata,
            dataType: "json",
            context: document.body,
            success: function (result) {
                /* curent genre photo */
                if (result[result.length - 1]["0"]["genre"] === "homme"){
                    $(".rounded__img , .rounded-circle").attr("src", "public/assets/images/men.jpeg")
                }else if(result[result.length - 1]["0"]["genre"] === "femme"){
                    $(".rounded__img , .rounded-circle").attr("src", "public/assets/images/women.png")
                }else{
                    $(".rounded__img , .rounded-circle").attr("src", "public/assets/images/other.jpeg")
                }
                Pagination(result);
            }
        })
    }



});