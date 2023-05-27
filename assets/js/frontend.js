;
(function ( $ ) {


    $(".create-health-test-order-form").submit(function(e){
        e.preventDefault();


        // alert(ajax_url);

        var selected_test = $('#select-patients-test').val();
        var date_pickup = $('.date-pickup').val();


        // ajax on adding single product page
        $.ajax({
            url:data.ajax_url,
            type: 'post',
            data: {
                action: 'create_new_order',
                selected_test: selected_test,
                date_pickup : date_pickup 

            
                },
                success: function(response){

                    $('.test-order-success').html('<h3 > Your Order Is Successfull </h3 >');
    
               
                },
                error: function(error){
                    console.log(error);
                }
                
            });
        });






})( jQuery );