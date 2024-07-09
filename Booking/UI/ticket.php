
<?php
    session_start(); // Start the session

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assuming you have validated and sanitized the input

        $_SESSION['firstName'] = $_POST['firstName'];
        $_SESSION['lastName'] = $_POST['lastName'];
        $_SESSION['mobileNo'] = $_POST['mobileNo'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['residency'] = $_POST['residency'];
        $_SESSION['status'] = $_POST['status'];

        // Redirect to the form page or another page
        header("Location: set-date.php");
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
        
        <div id="formContainer" class="formContainer">
            <div class="form" id="form">
                <div class="input">
                    <label>First Name</label>
                    <input type="text" id="firstName" name="firstName[]" required>
                </div>
                <div class="input">
                    <label>Last Name</label>
                    <input type="text" id="lastName" name="lastName[]" required>
                </div>
                <div class="input">
                    <label>Mobile Number</label>
                    <input type="text" id="mobileNo" name="mobileNo[]" required>
                </div>
                <div class="input">
                    <label>Email</label>
                    <input type="email" id="email" name="email[]" required>
                </div>
                <div class="input">
                    <label>Gender</label>
                    <select id="gender" name="gender[]" required> 
                        <option disabled selected value="">-Select-</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="input">
                    <label>Age</label>
                    <input type="number" id="age" name="age[]" min="0" required>
                </div>
                <div class="input" id="residency">
                    <label>Residency</label>
                    <select id="residency" name="residency[]" required>
                        <option disabled selected value="">-Select-</option>
                        <option value="MNL">Resident of Manila</option>
                        <option value="NON-MNL">Non-resident (Outside of Manila)</option>
                    </select>
                </div>
                <div class="input" id="status">
                    <label>Please select if apply:</label>
                    <select id="residency" name="status[]" required>
                        <option disabled selected value="">-Select-</option>
                        <option value="STUD">I am Student</option>
                        <option value="SC-PWD">I am PWD (Persons with disabilities)</option>
                        <option value="MNL-EMP">I am Manila LGU Employee/Teacher of Manila.</option>
                        <option value="SC-PWD">I am Senior Citizen (Must be 60 years old up)</option>
                        <option value="CHLDRN">I am 2 years old and above</option>
                        <option value="REG">None of the above</option>
                    </select>
                </div>
                
                <div class="terms">
                    <p>Required:</p>
                    <input type="checkbox" name="termsAndCondition" value="terms-and-condition" required>
                    <label>I agree with the Terms and Conditions.</label>
                </div>
                <div class="btn-container">
                    <div class="remove-btn-container"> 
                       <!-- <button style="display:none;" class="remove-btn" onclick="removeGuest(this)">Remove</button> -->
                    </div>
                    <div class="add-btn-container">
                        <button onclick="addGuest()">Add Guest</button>
                    </div>
                    
                </div>

            </div>
            <div class="guestFormsContainer" id="guestFormsContainer"></div>
        </div>

        <input type="submit" value="Set Appointment">
    </form>

    <script src="../js/ticket.js"></script>

</body>
</html>
