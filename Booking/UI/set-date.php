<?php
    session_start(); 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $_SESSION['selectedDate'] = $_POST['selectedDate'];
        header("Location: payment.php");
        exit;
    }
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ticket.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <title>Book a Ticket!</title>
</head>
<body>
    <div class="header">
        <h1 class="main-head">Get a Ticket</h1>
        <p>Fill out the required fields to get your ticket.</p>
        <a href="#">View Rates</a>
    </div>

    <form method="post" action="">
            <div id="dateContainer" class="dateContainer">
                <div class="calendar-container">
                    <h3>Set Appointment</h3>
                    <h2 id="monthYear"></h2>
                    <!-- <h4 id="currentDate"></h4> -->
                    <table class="calendar-table">
                        <tr>
                            <th>Sunday</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                        </tr>

                        <tbody id="calendar-body">
                        </tbody>
                        
                    </table>
                </div>
                <input type="hidden" name="selectedDate" id="selectedValue" >

                <div class="appointmentDetails-container">
                    <div class="container">
                        <h4>Appointment Details</h4>
                        <div class="details-appointment">
                            <span>Date:</span><span class="span-value" id="dateValue">-Select Date-</span>
                        </div>
                        <div class="details-appointment">
                            <span>Remaining:</span><span class="span-value" id="slotValue">-Select Date-</span>
                        </div>
                        <div class="details-appointment">
                            <span>Location:</span><span class="location">Manila Zoo, Adriatico Street, Malate, <br> Manila, Metro Manila, Philippines</span>
                        </div>
                        <!--
                        <div class="details-appointment">
                            <span>Type:</span><span class="span-value">Discounted Rates</span>
                        </div>
                        -->
                    </div>
                    
                    <!-- <div id="checkout-btn" class="checkout-btn">PROCEED TO CHECKOUT</div> -->
                    <input type="submit" value="PROCEED TO CHECKOUT">

                </div>
                
            </div>
            <!--
                <div style="display:none;" id="checkout-full-container" class="checkout-full-container">
                    <div class="ticket-details">
                        <div class="ticket-container">
                        <div id="ticket-id" class="ticket-id"></div>
                        <div class="ticket-label">Ticket Number</div>
                        </div>
                    </div>
                    <input type="submit" id="payButton" name="pay" value="PAY NOW" required></input>
                </div>

                <br>
                    -->
                <!--
                <div class="actionBtn-container">
                <button class="cancel-btn">Cancel</button>
                <div id="appoint-btn" class="appointment-btn">Set Appointment</button>
                </div>
            -->
        
    </form>

    <script src="../js/calendar.js"></script>

</body>
</html>
