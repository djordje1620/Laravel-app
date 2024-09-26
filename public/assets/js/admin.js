$(document).ready(function() {
    $("#showChart").click(function (e){
        e.preventDefault();
        sendAjaxRequest('/statistics', displayCart);
    });

    $("#social").click(function (e){
        e.preventDefault();
        sendAjaxRequest('/socials', displaySocials);
    });

    $("#color").click(function (e){
        e.preventDefault();
        sendAjaxRequest('/colors', displayColors);
    });
    $("#screen").click(function (e){
        e.preventDefault();
        sendAjaxRequest('/screen', displayScreen);
    });
    $("#ram").click(function (e){
        e.preventDefault();
        sendAjaxRequest('/rams', displayRamMemory);
    });
    $("#internal").click(function (e){
        e.preventDefault();
        sendAjaxRequest('/internal', displayInternalMemory);
    });
});
function sendAjaxRequest(route, display) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: route,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function(response) {
            display(response);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}
function displayCart(data) {
    if (!data || !data.actions || data.actions.length === 0) {
        console.log("No data available for chart");
        return;
    }

    const actions = data.actions;
    const devices = {};

    actions.forEach(action => {
        const device = action.device_type;
        devices[device] = (devices[device] || 0) + 1;
    });

    const canvas = document.getElementById('myChart');

    const ctx = canvas.getContext('2d');

    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(devices),
            datasets: [{
                label: '',
                data: Object.values(devices),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
function displaySocials(data) {
    var html = "<h2>Social network</h2>" +
        "<table class='table table-striped table-bordered'><thead class='thead-dark'>" +
        "<tr><th>Id</th><th>Name</th><th>Link</th><th>Icon</th><th>Active</th><th></th><th></th></tr></thead>" +
        "<tbody>";
    if (Array.isArray(data.socials) && data.socials.length > 0) {
        data.socials.forEach(function(social) {
            html += `
            <tr>
                <td>${social.id}</td>
                <td><input type="text" class="form-control" id="social_name" value="${social.name}" name="social_name"></td>
                <td><input type="text" class="form-control" id="social_link" value="${social.link}" name="social_link"></td>
                <td><input type="text" class="form-control" id="social_icon" value="${social.iClass}" name="social_icon"></td>
                <td><input type="text" class="form-control" id="social_icon" value="${social.active}" name="social_icon"></td>
                <td>`;
                    if (social.active===1)
                    {
                        html+=`<a href="/socials-deactivate/${social.id}" class="btn-danger btn"> Deactivate</a>`;
                    }else
                    {
                        html+=`<a href="/socials-activate/${social.id}" class="btn-success btn">Activate</a>`;
                    }
                  html+=`</td>`;
            html+=`<td><a href="/socials-delete/${social.id}" class="btn-danger btn">Delete</a></td>
            </tr>
            `;
        });
    } else {
        html += "<tr><td colspan='4'>No social data available</td></tr>";
    }
    html += `</tbody></table>`;

    $("#admin-panel").html(html);

}
function displayColors(data) {
    var html = "<h2>Colors</h2>" +
        "<table class='table table-striped table-bordered'><thead class='thead-dark'>" +
        "<tr><th>Id</th><th>Value</th><th>HEX</th><th></th><th></th></tr></thead>" +
        "<tbody>";
    if (Array.isArray(data.colors) && data.colors.length > 0) {
        data.colors.forEach(function(color) {
            html += `
            <tr>
                <td>${color.id}</td>
                <td>${color.value}</td>
                <td>${color.hex}</td>
                <td><a href="/colors/delete/${color.id}" class="btn-danger btn">Remove</a></td>
            </tr>
            `;
        });
    } else {
        html += "<tr><td colspan='4'>No colors data available</td></tr>";
    }
    html += `</tbody></table>`;

    $("#admin-panel").html(html);

}
function displayScreen(data) {
    var html = "<h2>Screen</h2>" +
        "<table class='table table-striped table-bordered'><thead class='thead-dark'>" +
        "<tr><th>Id</th><th>Name</th<th></th><th></th><th></th></tr></thead>" +
        "<tbody>";
    if (Array.isArray(data.screens) && data.screens.length > 0) {
        data.screens.forEach(function(screen) {
            html += `
            <tr>
                <td>${screen.id}</td>
                <td><input type="text" class="form-control" id="screen_name" value="${screen.screen}" name="screen_name"></td>
                <td><a href="/screen/delete/${screen.id}" class="btn-danger btn">Remove</a></td>
            </tr>
            `;
        });
    } else {
        html += "<tr><td colspan='4'>No screens data available</td></tr>";
    }
    html += `</tbody></table>`;

    $("#admin-panel").html(html);

}
function displayRamMemory(data) {
    var html = "<h2>RAM memory</h2>" +
        "<table class='table table-striped table-bordered'><thead class='thead-dark'>" +
        "<tr><th>Id</th><th>Value</th<th></th><th></th><th></th></tr></thead>" +
        "<tbody>";
    if (Array.isArray(data.rams) && data.rams.length > 0) {
        data.rams.forEach(function(ram) {
            html += `
            <tr>
                <td>${ram.id}</td>
                <td><input type="text" class="form-control" id="ram_value" value="${ram.value}" name="ram_value"></td>
                <td><a href="/rams/delete/${ram.id}" class="btn-danger btn">Remove</a></td>
            </tr>
            `;
        });
    } else {
        html += "<tr><td colspan='4'>No data available</td></tr>";
    }
    html += `</tbody></table>`;

    $("#admin-panel").html(html);

}
function displayInternalMemory(data) {
    var html = "<h2>Internal memory</h2>" +
        "<table class='table table-striped table-bordered'><thead class='thead-dark'>" +
        "<tr><th>Id</th><th>Value</th<th></th><th></th><th></th></tr></thead>" +
        "<tbody>";
    if (Array.isArray(data.internals) && data.internals.length > 0) {
        data.internals.forEach(function(internal) {
            html += `
            <tr>
                <td>${internal.id}</td>
                <td><input type="text" class="form-control" id="internal_value" value="${internal.value}" name="internal_value"></td>
                <td><a href="/internal/delete/${internal.id}" class="btn-danger btn">Remove</a></td>
            </tr>
            `;
        });
    } else {
        html += "<tr><td colspan='4'>No data available</td></tr>";
    }
    html += `</tbody></table>`;

    $("#admin-panel").html(html);

}
