<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FireSafety Title</title>
    <style>
        /* Basic styling for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
            box-sizing: border-box;
            /* background-color: #f4f4f4;
            display: flex;           
            flex-direction: column;  
            justify-content: center; 
            align-items: center;     
            height: 100vh; */
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: top;
            background-color: #FFDC86;
            padding: 20px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        header h1 {
            color: #000000;
            margin: 0;
            margin-right: 200px;
            font-size: 56px;
        }

        nav {
            display: flex;
            /* justify-content: center; */
            background-color: #FFDC86;
            padding: 15px 0;
        }

        nav a {
            color: #000000;
            text-decoration: none;
            margin: 0 15px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #ffffff;
        }

        .listing-section,
        .cart-section {
            width: 100%;
            float: left;
            padding: 1%;
            border-bottom: 0.01em solid #dddbdb;
        }

        .product {
            float: left;
            width: 23%;
            border-radius: 2%;
            margin: 1%;
            padding-top: 140px;
        }

        .image-box {
            width: 100%;
            overflow: hidden;
            border-radius: 2% 2% 0 0;
        }

        .images {
            height: 15em;
            background-size: contain;
            background-position: center center;
            background-repeat: no-repeat;
            border-radius: 2% 2% 0 0;
            transition: all 1s ease;
            -moz-transition: all 1s ease;
            -ms-transition: all 1s ease;
            -webkit-transition: all 1s ease;
            -o-transition: all 1s ease;
        }

        .images:hover {
            transform: scale(1.2);
            overflow: hidden;
            border-radius: 2%;
        }

        #image-1 {
            background-image: url('Assets/1kgCO2.jpg');
        }

        #image-2 {
            background-image: url('Assets/3kgCO2.jpg');
        }

        #image-3 {
            background-image: url('Assets/6kgCO2.jpg');
        }

        #image-4 {
            background-image: url('Assets/1kgABCDryPowder.jpg');
        }

        #image-5 {
            background-image: url('Assets/3kgABCDryPowder.jpg');
        }

        #image-6 {
            background-image: url('Assets/6kgABCDryPowder.jpg');
        }

        #image-7 {
            background-image: url('Assets/9kgABCDryPowder.jpg');
        }

        #image-8 {
            background-image: url('Assets/6LWaterFire.jpg');
        }

        #image-9 {
            background-image: url('Assets/9LWaterFire.jpg');
        }

        #image-10 {
            background-image: url('Assets/smokedetector1.jpg');
        }

        .text-box {
            width: 100%;
            float: left;
            border: 0.01em solid #dddbdb;
            border-radius: 0 0 2% 2%;
            padding: 1em;
        }

        h2,
        h3 {
            float: left;
            font-family: 'Roboto', sans-serif;
            font-size: 1em;
            text-transform: uppercase;
            margin: 0 auto;
        }

        .item,
        .price {
            clear: left;
            width: 100%;
            text-align: center;
        }

        .price {
            color: Grey;
        }

        .description,
        label,
        button,
        input {
            float: left;
            clear: left;
            width: 100%;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            font-size: 1em;
            text-align: center;
            margin: 0.2em auto;
        }

        input:focus {
            outline-color: #fdf;
        }

        label {
            width: 60%;
        }

        .text-box input {
            width: 15%;
            clear: none;
        }

        .text-box button {
            margin-top: 1em;
        }

        button {
            padding: 2%;
            background-color: #FFDC86;
            border: none;
            border-radius: 2%;
        }

        button:hover {
            bottom: 0.1em;
        }

        button:focus {
            outline: 0;
        }

        button:active {
            bottom: 0;
            background-color: #fdf;
        }

        .table-heading,
        .table-content {
            width: 75%;
            display: flex;
            margin: 1% 12.25%;
            float: left;
            background-color: #FFDC86;
        }

        .table-heading h2 {
            padding: 1%;
            margin: 0;
            text-align: center;
        }

        .cart-product {
            width: 50%;
            float: left;
        }

        .cart-price {
            width: 15%;
            float: left;
        }

        .cart-quantity {
            width: 10%;
            float: left;
        }

        .cart-total {
            width: 25%;
            float: left;
        }

        .cart-image-box {
            width: 20%;
            overflow: hidden;
            border-radius: 2%;
            float: left;
            margin: 1%;
        }

        .cart-images {
            height: 7em;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }

        .cart-item {
            width: 20%;
            float: left;
            margin: 3.2em 1%;
            text-align: center;
        }

        .cart-description {
            width: 53%;
            float: left;
            margin: 3.2em 1%;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            font-size: 1em;
            text-align: center;
        }

        .cart-price h3,
        .cart-total h3 {
            margin: 3.2em 5% 3.2em 20%;
            width: 60%;
        }

        .cart-quantity input {
            margin: 3.2em 1%;
            border: none;
        }

        .remove {
            width: 10%;
            margin: 1px;
            float: right;
            clear: right;
        }

        .coupon {
            width: 20%;
            background-color: #ffffff;
            margin: 1% 1% 1% 12.25%;
            float: left;
            height: 6em;
        }

        .coupon input {
            width: 60%;
            border: none;
            margin: 12.75% 5%;
            padding: 1%;
        }

        .coupon button {
            width: 25%;
            float: left;
            clear: right;
            margin: 12% 5% 12% 0;
        }

        .keep-shopping {
            width: 15%;
            height: 6em;
            float: left;
            margin: 1% auto;
            padding: 1%;
            background-color: #ffffff;
        }

        .keep-shopping button {
            text-transform: uppercase;
            margin: 12% auto;
        }

        .checkout {
            width: 37.25%;
            margin: 1% 12.75% 1% 1%;
            float: right;
            background-color: #ffffff;
            height: 6em;
        }

        .checkout button {
            width: 30%;
            clear: none;
            margin: 5.4% 0 5.4% 5.5%;
            text-transform: uppercase;
        }

        .final-cart-total {
            width: 15%;
            float: right;
            margin: 7%;
            background-color: White;
        }

        .final-cart-total h3 {
            color: Black;
        }
    </style>
</head>

<body>
    <header>
        <h1>FireSafety</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="contact.php">Contact Us</a>
            <a href="products.php">Products</a>
            <a href="book_checkup.php">Book Online</a>
            <?php if (isset($_SESSION['userType'])) : ?>
                <a href="<?php echo $_SESSION['userType']; ?>_profile.php">Profile</a>
                <?php if ($_SESSION['userType'] == 'employee' || $_SESSION['userType'] == 'technician') : ?>
                    <a href="databases.php">Databases</a>
                <?php elseif ($_SESSION['userType'] == 'businesscustomer' || $_SESSION['userType'] == 'customer') : ?>
                    <a href="orders.php">Orders</a>
                <?php endif; ?>
                <a href="logout.php">Log Out</a>
            <?php else : ?>
                <a href="login.php">Log In</a>
            <?php endif; ?>
        </nav>
    </header>
    <script>
        let cart = [];

        // Function to add a product to the cart
        function addToCart(productId, productName, productPrice, productImage, quantity) {
            // Check if product already exists in cart
            const existingProduct = cart.find(item => item.productId === productId);

            if (existingProduct) {
                // Update the quantity of the existing product
                existingProduct.quantity += quantity;
            } else {
                // Add new product to the cart
                cart.push({
                    productId,
                    productName,
                    productPrice,
                    productImage,
                    quantity
                });
            }

            updateCartDisplay();
        }

        function updateCartDisplay() {
            renderCartItems();
            const total = calculateCartTotal();
            const totalElement = document.querySelector('.final-cart-total h3.price');
            totalElement.textContent = `${total}THB`;
        }

        function calculateCartTotal() {
            let total = 0;
            cart.forEach(item => {
                total += item.productPrice * item.quantity;
            });
            return total;
        }

        function removeFromCart(productId) {
            const index = cart.findIndex(item => item.productId === productId);
            if (index !== -1) {
                cart.splice(index, 1);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('button[id$="-button"]');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = parseInt(this.id.split('-')[1]);
                    const productElement = this.closest('.product');
                    const productName = productElement.querySelector('.item').textContent;
                    const productPrice = parseFloat(productElement.querySelector('.price').textContent.replace('THB', ''));
                    const productImage = productElement.querySelector('.images').style.backgroundImage.split('"')[1];
                    const quantity = parseInt(productElement.querySelector('input[type="text"]').value);
                    addToCart(productId, productName, productPrice, productImage, quantity);
                });
            });
        });

        function renderCartItems() {
            const cartContent = document.querySelector('.cart-section');
            const tableHeading = document.querySelector('.table-heading');
            const existingItems = document.querySelectorAll('.table-content');
            existingItems.forEach(item => item.remove());

            cart.forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.classList.add('table-content');

                const productDiv = document.createElement('div');
                productDiv.classList.add('cart-product');

                const imageBox = document.createElement('div');
                imageBox.classList.add('cart-image-box');
                const imageDiv = document.createElement('div');
                imageDiv.classList.add('cart-images');
                imageDiv.style.backgroundImage = `url('${item.productImage}')`;
                imageBox.appendChild(imageDiv);

                const itemName = document.createElement('h2');
                itemName.classList.add('cart-item');
                itemName.textContent = item.productName;

                const itemDescription = document.createElement('p');
                itemDescription.classList.add('cart-description');
                itemDescription.textContent = item.productName;

                productDiv.appendChild(imageBox);
                productDiv.appendChild(itemName);
                productDiv.appendChild(itemDescription);

                const priceDiv = document.createElement('div');
                priceDiv.classList.add('cart-price');
                const price = document.createElement('h3');
                price.classList.add('price');
                price.textContent = `${item.productPrice}THB`;
                priceDiv.appendChild(price);

                const quantityDiv = document.createElement('div');
                quantityDiv.classList.add('cart-quantity');
                const quantityInput = document.createElement('input');
                quantityInput.name = `cart-${item.productId}-quantity`;
                quantityInput.type = 'text';
                quantityInput.value = item.quantity;
                quantityDiv.appendChild(quantityInput);

                const totalDiv = document.createElement('div');
                totalDiv.classList.add('cart-total');
                const totalPrice = document.createElement('h3');
                totalPrice.classList.add('price');
                totalPrice.textContent = `${item.productPrice * item.quantity}THB`;
                totalDiv.appendChild(totalPrice);

                cartItem.appendChild(productDiv);
                cartItem.appendChild(priceDiv);
                cartItem.appendChild(quantityDiv);
                cartItem.appendChild(totalDiv);

                cartContent.insertBefore(cartItem, tableHeading.nextSibling);

                const removeButton = document.createElement('button');
                removeButton.classList.add('remove');
                removeButton.textContent = 'x';
                removeButton.addEventListener('click', function() {
                    removeFromCart(item.productId);
                    updateCartDisplay();
                });
                totalDiv.appendChild(removeButton);
            });
        }
    </script>
</body>

<div class="listing-section">
    <div class="product">
        <div class="image-box">
            <div class="images" id="image-1"></div>
        </div>
        <div class="text-box">
            <h2 class="item">Co2 1 KG</h2>
            <h3 class="price">1000THB</h3>
            <p class="description">Rated for Class B fires</p>
            <label for="item-1-quantity">Quantity:</label>
            <input type="text" name="item-1-quantity" id="item-1-quantity" value="1">
            <button type="button" name="item-1-button" id="item-1-button">Add to Cart</button>
        </div>
    </div>
    <div class="product">
        <div class="image-box">
            <div class="images" id="image-2"></div>
        </div>
        <div class="text-box">
            <h2 class="item">Co2 3 KG</h2>
            <h3 class="price">1500THB</h3>
            <p class="description">Rated for Class B fires</p>
            <label for="item-2-quantity">Quantity:</label>
            <input type="text" name="item-2-quantity" id="item-2-quantity" value="1">
            <button type="button" name="item-2-button" id="item-2-button">Add to Cart</button>
        </div>
    </div>
    <div class="product">
        <div class="image-box">
            <div class="images" id="image-3"></div>
        </div>
        <div class="text-box">
            <h2 class="item">Co2 6 KG</h2>
            <h3 class="price">2000THB</h3>
            <p class="description">Rated for Class B fires</p>
            <label for="item-3-quantity">Quantity:</label>
            <input type="text" name="item-3-quantity" id="item-3-quantity" value="1">
            <button type="button" name="item-3-button" id="item-3-button">Add to Cart</button>
        </div>
    </div>
    <div class="product">
        <div class="image-box">
            <div class="images" id="image-4"></div>
        </div>
        <div class="text-box">
            <h2 class="item">Dry Powder 1 KG</h2>
            <h3 class="price">1000THB</h3>
            <p class="description">Rated for Class ABC fires</p>
            <label for="item-4-quantity">Quantity:</label>
            <input type="text" name="item-4-quantity" id="item-4-quantity" value="1">
            <button type="button" name="item-4-button" id="item-4-button">Add to Cart</button>
        </div>
    </div>
    <div class="product">
        <div class="image-box">
            <div class="images" id="image-5"></div>
        </div>
        <div class="text-box">
            <h2 class="item">Dry Powder 3 KG</h2>
            <h3 class="price">2000THB</h3>
            <p class="description">Rated for Class ABC fires</p>
            <label for="item-5-quantity">Quantity:</label>
            <input type="text" name="item-5-quantity" id="item-5-quantity" value="1">
            <button type="button" name="item-5-button" id="item-5-button">Add to Cart</button>
        </div>
    </div>
    <div class="product">
        <div class="image-box">
            <div class="images" id="image-6"></div>
        </div>
        <div class="text-box">
            <h2 class="item">Dry Powder 6 KG</h2>
            <h3 class="price">3000THB</h3>
            <p class="description">Rated for Class ABC fires</p>
            <label for="item-6-quantity">Quantity:</label>
            <input type="text" name="item-6-quantity" id="item-6-quantity" value="1">
            <button type="button" name="item-6-button" id="item-6-button">Add to Cart</button>
        </div>
    </div>
    <div class="product">
        <div class="image-box">
            <div class="images" id="image-7"></div>
        </div>
        <div class="text-box">
            <h2 class="item">Dry Powder 9 KG</h2>
            <h3 class="price">4000THB</h3>
            <p class="description">Rated for Class ABC fires</p>
            <label for="item-7-quantity">Quantity:</label>
            <input type="text" name="item-7-quantity" id="item-7-quantity" value="1">
            <button type="button" name="item-7-button" id="item-7-button">Add to Cart</button>
        </div>
    </div>
    <div class="product">
        <div class="image-box">
            <div class="images" id="image-8"></div>
        </div>
        <div class="text-box">
            <h2 class="item">Water 6 L</h2>
            <h3 class="price">3000THB</h3>
            <p class="description">Rated for Class A fires</p>
            <label for="item-8-quantity">Quantity:</label>
            <input type="text" name="item-8-quantity" id="item-8-quantity" value="1">
            <button type="button" name="item-8-button" id="item-8-button">Add to Cart</button>
        </div>
    </div>
    <div class="product">
        <div class="image-box">
            <div class="images" id="image-9"></div>
        </div>
        <div class="text-box">
            <h2 class="item">Water 9 L</h2>
            <h3 class="price">4000THB</h3>
            <p class="description">Rated for Class A fires</p>
            <label for="item-9-quantity">Quantity:</label>
            <input type="text" name="item-9-quantity" id="item-9-quantity" value="1">
            <button type="button" name="item-9-button" id="item-9-button">Add to Cart</button>
        </div>
    </div>
    <div class="product">
        <div class="image-box">
            <div class="images" id="image-10"></div>
        </div>
        <div class="text-box">
            <h2 class="item">Smoke Detector</h2>
            <h3 class="price">1500THB</h3>
            <p class="description">Photoelectric Smoke Detector</p>
            <label for="item-10-quantity">Quantity:</label>
            <input type="text" name="item-10-quantity" id="item-10-quantity" value="1">
            <button type="button" name="item-10-button" id="item-10-button">Add to Cart</button>
        </div>
    </div>
</div>

<div class="cart-section">

    <div class="table-heading">
        <h2 class="cart-product">Product</h2>
        <h2 class="cart-price">Price</h2>
        <h2 class="cart-quantity">Quantity</h2>
        <h2 class="cart-total">Total</h2>
    </div>

    <div class="coupon">
        <input type="text" name="coupon" id="coupon" placeholder="COUPON CODE">
    </div>

    <div class="checkout">
        <button type="button" name="update" id="update">Update</button>
        <button type="button" name="checkout" id="checkout">Checkout</button>
        <div class="final-cart-total">
            <h3 class="price">0THB</h3>
        </div>
    </div>

    <div class="keep-shopping">
        <button type="button" name="keep-shopping" id="keep-shopping">Keep Shopping</button>
    </div>
</div>

</html>