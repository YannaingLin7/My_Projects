$(document).ready(function() {
    // when + button is clicked
    $('.btn-plus').click( function () {
        $parentNode = $(this).parents('tr');
        $price = $parentNode.find("#productPrice").text().replace("MMK","");
        $price = Number($price);                                                // <= ရရှိလာသော data သည် String ဖြစ်နေ၍ Number ပြန်ပြောင်းခြင်း
        $qty = Number($parentNode.find("#qty").val()) ;
        $total = $price * $qty ;
        $parentNode.find('#total').html($total + " MMK");

        summaryCalculation();
    } )

    // when - button is clicked
    $('.btn-minus').click( function () {
        $parentNode = $(this).parents('tr');
        $price = $parentNode.find("#productPrice").text().replace("MMK","");
        $price = Number($price);
        $qty = Number($parentNode.find("#qty").val());
        $total = $price * $qty ;
        $parentNode.find('#total').html($total + " MMK");

        summaryCalculation();
    })

    // Function to Calculate the summary of price per item in the cart
    function summaryCalculation () {
        $subtotal = 0;
        $("#dataTable tbody tr").each(function(index,row){
            $subtotal += Number($(row).find("#total").text().replace("MMK",""));
        });

        $("#subtotal").html(`${$subtotal} MMK`);
        $("#finalAmount").html(`${$subtotal+3000} MMK`);
    }
})

