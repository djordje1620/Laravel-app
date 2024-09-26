$(document).ready(function() {
    displayCartDataFromLocalStorage();

    $(document).on('change', '.quantity-input', function() {
        var productId = $(this).data('product-id');
        var newQuantity = parseInt($(this).val());

        updateQuantityInLocalStorage(productId, newQuantity);
    });
    // console.log(isLoggedIn);

    $('#buyBtn').click(function(e) {
        e.preventDefault();

        if (isLoggedIn) {
            var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            var productsToSend = [];
            cartItems.forEach(function(item) {
                productsToSend.push({
                    productId: item.product_id,
                    quantity: item.quantity
                });
            });
                    console.log(productsToSend);
            $.ajax({
                url: '/checkout',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    cartItems: productsToSend
                },
                success: function(response) {
                    console.log('Data sent successfully:', response);
                    var message = response.message;
                    $('#cart-container').html("<div class='alert-success alert mt-3'> <p class='alert-success'>" + message + "</p></div>");
                    localStorage.removeItem("cartItems");
                },
                error: function(xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                }
            });
        } else {
            window.location.href = '/login';
        }
    });
});

function displayCartDataFromLocalStorage() {
    var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    var productHtml = "";

    if (cartItems.length === 0) {

        productHtml = "<div class='jumbotron alert-info alert my-5'><p class='alert-info'>No products in the cart.</p></div>";
    } else {
        cartItems.forEach(function(item) {
            productHtml += `
                <div class="col-md-6 mb-4 mt-4">
                    <div class="cart-product">
                        <img class="mb-2" src="${baseUrl}/assets/images/${item.image}" alt="${item.name}">
                        <h3>${item.name}</h3>
                        <p>Brand: ${item.brand}</p>
                        <p>Price: ${item.active_price * item.quantity}$</p>
                        <p>Quantity:
                            <input type="number" class="quantity-input"
                                   data-product-id="${item.product_id}"
                                   value="${item.quantity}" min="0">
                        </p>

                    </div>
                </div>
            `;
        });
        productHtml += `<a href="#" class="btn-success btn mt-3" id="buyBtn">Complete the purchase</a>`;
    }

    $('#cart-container').html(productHtml);
}


function updateQuantityInLocalStorage(productId, newQuantity) {
    var cartItems = JSON.parse(localStorage.getItem('cartItems'));

    var existingItemIndex = cartItems.findIndex(function(item) {
        return item.product_id == productId;
    });

    if (existingItemIndex !== -1) {
        cartItems[existingItemIndex].quantity = newQuantity;

        if (newQuantity === 0) {

            cartItems.splice(existingItemIndex, 1);
        }

        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        displayCartDataFromLocalStorage();
    } else {
        console.error('Product with ID ' + productId + ' not found in cart.');
    }
}

