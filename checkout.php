<?php
require __DIR__ . '/vendor/autoload.php';

$stripe_secret_key = "sk_test_51Qj1rtAVfzE5i5AyAPBgoLdEQEplkFUsjeebjMvBAYu4dgFJep7cZWWhtcXkWA6dzveFKFuI9rkGDIIr5uftBz9A00hj6VGVZq";

\Stripe\Stripe::setApiKey($stripe_secret_key);

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost:30000/success.php",
        "cancel_url" => "http://localhost/cancel.php",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "usd",
                    "unit_amount" => 2000,
                    "product_data" => [
                        "name" => "T-shirt"
                    ]
                ]
            ]
        ]
    ]);

    http_response_code(303);
    header('Location: ' . $checkout_session->url);
} catch (Exception $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}
