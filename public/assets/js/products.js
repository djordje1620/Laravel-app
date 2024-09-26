// Funkcija za prikazivanje proizvoda
function displayProducts(products) {
    var html = '';
    var pr = products;
    console.log(pr);
    if (pr.length > 0) {
        pr.forEach(function(product) {
            html += '<div class="col-md-4 mt-3">';
            html += '<div class="phone-box text-md-center">';
            html += '<a href="products/' + product.product_id + '"> <img class="mb-2 phone-img" src="' + baseUrl + '/assets/images/' + product.image + '" alt="' + product.name + '"></a> ';
            html += '<p>' + product.brand + ' ' + product.name + '</p>';
            html += '<p>' + product.internal_value + 'GB - ' + product.color_value + '</p>';
            html += '<span>$ <strong>' + product.price + '</strong></span>';
            if (isAdmin && isLoggedIn){
                html += '<div class="col-md-12">';
                html += '<a href="/admin-products-update/' + product.product_id + '" class="read-more">Edit product</a>';
                html += '</div>';
            }
            html += '</div></div>';

        });
    } else {
        html += '<p>No products available.</p>';
    }

    $('#products').html(html);
}

$(document).ready(function() {
    $('#filter').on('change', 'input, select, textarea', function() {
        var resetFiltersBtn = document.getElementById("resetFiltersBtn");
        resetFiltersBtn.style.display = "block";
        var formData = $('form').serialize();
          console.log(formData);
        $.ajax({
            url: '/products',
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function(response) {
                $('#pagination').html(response.pagination);
                displayProducts(response.products.data);
            },
            error: function(xhr, status, error) {
                console.error('Request failed with status ' + xhr.status);
                console.error('Status: ' + status);
                console.error('Error: ' + error);
                console.error('Response Text: ' + xhr.responseText);
                console.error('Response JSON: ', xhr.responseJSON);
            }
        });
    });
});
document.getElementById("resetFiltersBtn").addEventListener("click", function() {
    window.location.href = "/products";
});

