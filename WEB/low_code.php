<!DOCTYPE html>
<html>
<head>
    <title>Stripe Checkout</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <button id="checkout-button">Pay with Stripe</button>

    <script>
        const publicKey = 'pk_live_51N4KymKy2Ki2xcvjfsANuH6axZwW7Z6rezNpcYMGA35ptwrHC88WomjnOqZzQEXQ4OwBN3kxePeLiMnU17b5wLql00Mt2lSPuj'; // Replace with your publishable key
        const stripe = Stripe(publicKey);

        document.getElementById('checkout-button').addEventListener('click', () => {
            fetch('basic_checkout.php', {
                method: 'POST',
            })
            .then(response => response.json())
            .then(session => {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(result => {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
