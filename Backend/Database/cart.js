// cart.js

// Get the shopping cart items from the server using AJAX
function getCartItems() {
    // Make an AJAX call to the server to get the cart items
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "cart.php");
    xhr.onload = function () {
        if (xhr.status === 200) {
            var items = JSON.parse(xhr.responseText);
            updateCartTable(items);
            updateTotalPrice(items);
        }
    };
    xhr.send();
}

// Function to update the cart table with the list of products
function updateCartTable(items) {
    // Get the table body element
    var tableBody = document.querySelector("tbody");
    // Clear the table body
    tableBody.innerHTML = "";
    // Loop through the items and add them to the table
    for (var i = 0; i < items.length; i++) {
        var item = items[i];
        var row = tableBody.insertRow(-1);
        var nameCell = row.insertCell(0);
        var quantityCell = row.insertCell(1);
        var priceCell = row.insertCell(2);
        var totalCell = row.insertCell(3);
        nameCell.textContent = item.name;
        quantityCell.textContent = item.quantity;
        priceCell.textContent = item.price;
        totalCell.textContent = item.total;
    }
    // Add edit and delete buttons to the action cell
    var editButton = document.createElement("button");
    editButton.textContent = "Sửa";
    editButton.addEventListener("click", function () {
        // Handle edit button click event
    });
    actionCell.appendChild(editButton);
    var deleteButton = document.createElement("button");
    deleteButton.textContent = "Xóa";
    deleteButton.addEventListener("click", function () {
        // Handle delete button click event
    });
    actionCell.appendChild(deleteButton);
}

// Function to calculate the cart totals and update the totals table
function updateTotals() {
    // Get the cart items
    var items = getCartItems();
    // Calculate the subtotal, tax, and total
    var subtotal = 0;
    for (var i = 0; i < items.length; i++) {
        subtotal += items[i].total;
    }
    var tax = subtotal * 0.1;
    var total = subtotal + tax;
    // Update the totals table
    var subtotalCell = document.getElementById("subtotal");
    var taxCell = document.getElementById("tax");
    var totalCell = document.getElementById("total");
    subtotalCell.textContent = subtotal.toFixed(2);
    taxCell.textContent = tax.toFixed(2);
    totalCell.textContent = total.toFixed(2);
}


// Function to update the quantity of a cart item
function updateCartItem(customer_id, meal_id, quantity) {
    // Make an AJAX call to the server to update the cart item quantity
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_cart.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (xhr.status === 200) {
            // The cart item quantity was updated successfully
            getCartItems(); // Update the cart table and totals
        }
    };
    xhr.send("customer_id=" + customer_id + "&meal_id=" + meal_id + "&quantity=" + quantity);
}

// Event listener for the quantity input field change event
var quantityInputs = document.querySelectorAll(".quantity-input");
quantityInputs.forEach(function (input) {
    input.addEventListener("change", function () {
        // Get the customer ID and meal ID from the data attributes
        var customer_id = input.getAttribute("data-customer-id");
        var meal_id = input.getAttribute("data-meal-id");
        // Get the new quantity from the input field
        var quantity = input.value;
        // Update the cart item quantity
        updateCartItem(customer_id, meal_id, quantity);
    });
});
// Function to initialize the cart page
function initCartPage() {
    // Update the cart table with the list of products
    var items = getCartItems();
    updateCartTable(items);
    // Update the cart totals
    updateTotals();
}

// Call the initCartPage function when the page is loaded
window.addEventListener("load", initCartPage);
