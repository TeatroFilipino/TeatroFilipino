<?php
    session_start();
    include("../database.php"); 

    // Read the ticket rates from JSON file
    $ticket_rates_json = file_get_contents('../assets/ticket_rates.json');
    $ticket_rates = json_decode($ticket_rates_json, true);

    $total_price = 0;

    for($i = 0; $i < count($_SESSION['residency']); $i++) {
        $total_price += getEachPrice($_SESSION['residency'][$i], $_SESSION['status'][$i], $ticket_rates);
    }
    
    function getEachPrice($residency, $status, $ticket_rates) {
        $key = $status . "-" . $residency;
        return isset($ticket_rates[$key]) ? $ticket_rates[$key] : 0;
    }

    function generateUniqueTicketID() {
        // Start with T
        $ticketId = 'T';
        
        // Generate and append a letter (N-Z, skipping O to avoid confusion with 0)
        $letters = range('N', 'Z');
        unset($letters[array_search('O', $letters)]); // Optional: remove 'O' to avoid confusion
        $ticketId .= $letters[array_rand($letters)];
        
        // Append a digit (2-9, to match your example)
        $ticketId .= rand(2, 9);
        
        // Add first separator
        $ticketId .= '-';
        
        // Append three digits
        $ticketId .= sprintf('%03d', rand(0, 999));
        
        // Add a letter (A-D)
        $ticketId .= chr(rand(65, 68)); // ASCII values for A-D
        
        // Add second separator
        $ticketId .= '-';
        
        // Append three more digits
        $ticketId .= sprintf('%03d', rand(0, 999));
        
        // Final letter (A-D)
        $ticketId .= chr(rand(65, 68));
        
        return $ticketId;
    }
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/payment.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <title>Book a Ticket!</title>
</head>
<body>

    <form method="post" action="">
        <div id="checkout-full-container" class="checkout-full-container">
            <div class="price-details">
                <div class="price-container">
                <div id="price-id" class="price-id"><?php echo number_format($total_price, 2); ?></div>
                <div class="price-label">Total Price</div>
                </div>
            </div>
            <div class="payButton" id="payButton">PAY NOW</div>
        </div>
        <div class="confirm-container" id="confirmation">
            <label class="confirm-label">Confirm Payment?</label>
            <div class="buttons">
                <div class="cancel-btn" id="cancel-btn"> Cancel </div>
                <div class="submit-btn">
                    <input class="confirm-btn" type="submit" value="Confirm">
                </div>
            </div>
        </div>
    </form>

    <script src="../js/payment.js"></script>

</body>
</html>
