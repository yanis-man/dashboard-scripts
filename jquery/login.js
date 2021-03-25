$(document).ready(function(){

    $("#login").click(function(){

        const employee_id = document.getElementsByName("id")[0].value;
        const password = document.getElementsByName("password")[0].value;

        if(employee_id && password)
        {
            $.post("php/login.php", 
                {
                employee_id:employee_id,
                password:password

                },
                function(data)
                {
                    console.log(data)
                    if(data['error'] === "none")
                    {
                    $(location).attr('href', "index.php");
                    }
                }
            )
        }
    });

  });