tooblox_URL = "php/snippets/toolbox.php"
$(document).ready(function(){
    //used to retrieve the first compagny's employee without click
    $.post(tooblox_URL, 
            {
                partenerId:$("#parteners option:selected").val()

            },
            function(data)
            {
                if(data['error'] === "none")
                {
                    $("#partener_employee").html(data['employee_list'])
                }
                else
                {
                    alert(data['error']);
                }
            }
    );
    //used to dynamically edit the employee list
    $('#parteners').on('change', function (e) {

        $.post(tooblox_URL, 
            {
                partenerId:this.value

            },
            function(data)
            {
                if(data['error'] === "none")
                {
                    $("#partener_employee").html(data['employee_list'])
                }
                else
                {
                    alert(data['error']);
                }
            }
            );
      });
    $("#sendPresta").click(function()
    {
        
        const presta_type = $("#prestation option:selected").val();
        const price = $("#prestation option:selected").attr("price");
        const quantity = document.getElementsByName("quantity")[0].value
        const checkout = document.getElementsByName("checkout")[0].value

        if(presta_type && price && quantity && checkout && (/^([0-9]+)$/.test(quantity) && /(gyazo|https)$/.test(checkout)))
        {
            $.post("php/presta.php", 
            {
                type: Number(presta_type),
                price:Number(price),
                quantity:Number(quantity),
                checkout:checkout,
                isCompagny:0

            },
            function(data)
            {
                if(data['error'] === "none")
                {
                    alert("Préstation enregistrée")
                }
                else
                {
                    alert(data['error']);
                }
            }
            );
        }
    });
    $("#sendCompPresta").click(function()
    {
        const presta_type = $("#compType option:selected").val();
        const price = $("#compType option:selected").attr("price");
        const quantity = document.getElementsByName("compQuantity")[0].value

        const p_id = $("#parteners option:selected").val();
        const p_employee = $("#partener_employee option:selected").val();

        if(presta_type && price && quantity && (/^([0-9]+)$/.test(quantity)))
        {
            $.post("php/presta.php", 
            {
                type: Number(presta_type),
                price:Number(price),
                quantity:Number(quantity),
                partener_id:Number(p_id),
                partener_employee:Number(p_employee),
                isCompagny:1

            },
            function(data)
            {
                if(data['error'] === "none")
                {
                    alert("Prestation enregistrée")
                }
                else
                {
                    alert(data['error']);
                }
            }
            );
        }
    });
    $("#refreshTable").click(function()
    {
        $.post(tooblox_URL, 
            {
                refreshData:1

            },
            function(data)
            {
                if(data['error'] === "none")
                {
                    console.log(data['freshData']);
                    $("#lastPrestaTable").html(data['freshData'])
                }
                else
                {
                    alert(data['error']);
                }
            }
            );
    });
});