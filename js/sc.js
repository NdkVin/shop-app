$(document).ready(function () {

    $(".hide-show").click(function() {

        let tipe_input = $('.input-password').attr('type');
        console.log(tipe_input);

        if(tipe_input === "password") {

            $('.input-password').attr('type', 'text');

           
        } else if(tipe_input === "text") {
            
            $('.input-password').attr('type', 'password');

        }


    });

})