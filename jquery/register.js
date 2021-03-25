$(document).ready(function(){
    $("button").click(function(){
        const name = document.getElementsByName("identity")[0].value;
        const id = document.getElementsByName("id")[0].value;
        const account_n = document.getElementsByName("account")[0].value;
        const grade = $("#grade option:selected").val();
        if(name && id && account_n && grade)
        {
            $.post("php/register.php", 
            {
                name: name,
                id:id,
                account:account_n,
                grade:grade

            },
            function(data)
            {
                if(data['error'] === "none")
                {
                    alert("user has been created")
                }
                else
                {
                    alert(data['error']);
                }
            }
            );
        }
    });

  });