<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    // Firebase Realtime Database URL
    $firebaseDatabaseURL = "https://portfolio-a02de-default-rtdb.firebaseio.com/contact.json";

    // Data to be sent to Firebase
    $data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'message' => $message,
    ];

    // Convert data to JSON
    $json_data = json_encode($data);

    // Initialize cURL session
    $ch = curl_init($firebaseDatabaseURL);

    // Set cURL options
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json_data),
    ]);

    // Execute cURL session and close
    $result = curl_exec($ch);
    curl_close($ch);

    // Handle the result as needed
    if ($result) {
        header("Location: http://localhost/Portfolio-Website/");
    } else {
        echo "Error sending data to Firebase.";
    }
}

?>
