$(document).ready(function () {
    $("#sendMail").on("click",function(){

        let login = $("#login").val().trim();
        let name = $("#name").val().trim();
        let surname = $("#surname").val().trim();
        let pass = $("#pass").val().trim();

        if(login === ""){
            $(".errLogin").text("Это обязательное поле");
            $("#login").attr('style', 'border: 1px solid red;');

            $("#login").blur(function() {
                if (login == ''){
                    $(".errLogin").text("");
                    $("#login").attr('style', 'border: 1px solid lightgrey;');
                }
            });

            return false;
        } else if(name === ""){
            $(".errName").text("Это обязательное поле");
            $("#name").attr('style', 'border: 1px solid red;');

            $("#name").blur(function() {
                if (name == ''){
                    $(".errName").text("");
                    $("#name").attr('style', 'border: 1px solid lightgrey;');
                }
            });

            return false;
        } else if(surname === ""){
            $(".errSurname").text("Это обязательное поле");
            $("#surname").attr('style', 'border: 1px solid red;');

            $("#surname").blur(function() {
                if (surname == ''){
                    $(".errSurname").text("");
                    $("#surname").attr('style', 'border: 1px solid lightgrey;');
                }
            });

            return false;
        } else if(pass === ""){
            $(".errPass").text("Это обязательное поле");
            $("#pass").attr('style', 'border: 1px solid red;');

            $("#pass").blur(function() {
                if (pass == ''){
                    $(".errPass").text("");
                    $("#pass").attr('style', 'border: 1px solid lightgrey;');
                }
            });

            return false;
        }



        $.ajax({
            url: 'mail.php',
            type: 'POST',
            cache: false,
            data: {'login': login, 'name': name, 'surname': surname, 'pass': pass },
            dataType: 'html',
            beforeSend: function(){
                $("sendMail").prop("disabled", true);

                if(login !== ""){
                    $("#login").attr('style', 'border: 1px solid green;');
                }
                if(name !== ""){
                    $("#name").attr('style', 'border: 1px solid green;');
                }
                if(surname !== ""){
                    $("#surname").attr('style', 'border: 1px solid green;');
                }
                if(pass !== ""){
                    $("#pass").attr('style', 'border: 1px solid green;');
                }
            },
            success: function (data) {
                alert(data);
                $("sendMail").prop("disabled", false);
            },
        });

    });
});