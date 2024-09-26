$(document).ready(function() {
    $('#add_to_cart').click(function(e) {
        e.preventDefault();

        var productId = $("#product_id").val();
        var productName = $("#name").val();
        var brand = $("#brand").val();
        var image = $("#image").val();
        var activePrice = $("#active_price").val();
        var quantity = parseInt($("#quantity").val());


        var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

        var existingItemIndex = cartItems.findIndex(function(item) {
            return item.product_id === productId;
        });

        if (existingItemIndex !== -1) {
            cartItems[existingItemIndex].quantity += quantity;
        } else {
            cartItems.push({
                product_id: productId,
                name: productName,
                brand: brand,
                image: image,
                active_price: activePrice,
                quantity: quantity
            });
        }

        localStorage.setItem('cartItems', JSON.stringify(cartItems));

        var expirationDate = new Date();
        expirationDate.setDate(expirationDate.getDate() + 7); // Dodaj 7 dana
        localStorage.setItem('cartItemsExpiration', expirationDate.getTime());

        var expirationTime = localStorage.getItem('cartItemsExpiration');
        if (expirationTime && new Date().getTime() > expirationTime) {
            localStorage.removeItem('cartItems');
            localStorage.removeItem('cartItemsExpiration');
        }

        $("#message").html("<div class='alert-success alert mt-3'> <p class='alert-success'>Successfully added to cart</p></div>");
        setTimeout(function() {
            $("#message").html("");
        }, 3000);
    });
});
