$(document).ready(function () {    
    $.ajaxSetup({
        beforeSend: function(xhr, type) {
            if (!type.crossDomain) {
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            }
        },	
    });
    $(document).ready(function(){
        var coinId = 0;
        var minPrice = 0; 
        $('.js-adding-modal').on('click', function () { 
            minPrice = $(this).attr("coinPrice");
            coinId = $(this).attr('coinId');
        })

        $('.js-add-coin').on('click', function () {  
            var price = $("#price").val();
            if (price == "" || parseFloat(price) < parseFloat(minPrice)) {
                $(".auth-error").html(
                    "Ставка не может быть меньше " + minPrice
                );
                 setTimeout(function () {
                     $(".auth-error").html("");
                 }, 2000);
            } else {
                $.ajax({
                    type: "POST",
                    url: "/ajaxAdd",
                    data: {
                        coinId: coinId,
                        price: price,
                    },
                    success: function (result) {
                        $("#price").val("");
                        $(".js-add-coin").addClass("disabled");
                        $(".auth-error")
                            .removeClass("text-danger")
                            .html("Ставка сделана");
                        setTimeout(function () {
                            jQuery("#addModal").modal("hide");
                            $(".js-add-coin").removeClass("disabled");
                            $(".auth-error").html("");
                        }, 2000);
                        location.reload();
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
            }
        })
    });
});

