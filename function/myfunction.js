function input(pricing){
        var quantityInput = document.getElementById("quantityInput");
        var priceElement = document.getElementById("price");
        var productPrice = pricing;

        function increment() {
        var currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
        calculatePrice();
        }

        function decrement() {
        var currentValue = parseInt(quantityInput.value);
        if (currentValue > 0) {
            quantityInput.value = currentValue - 1;
            calculatePrice();
        }
        }

        function calculatePrice() {
        var quantity = parseInt(quantityInput.value);
        var totalPrice = quantity * productPrice;
        priceElement.textContent = totalPrice;
        }
    }