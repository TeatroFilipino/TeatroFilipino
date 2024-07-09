<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Create Appointment</title>
</head>
<body>

    <div class="wrapper">

        <div class="side-bar">
            <div class="header">
                <div class="head-container">
                    <img src="../images/logo.png" alt="Manila Zoo Logo">
                    <h2>ADMIN</h2>
                </div>
 
            </div>
            <div class="dashboard-nav"> <a href="admin-profile.php">Dashboard</a></div>
            <div class="feature-header"><span>FEATURES:</span></div>
            <div class="feature-nav"><a href="#">Appointment Management</a></div>

            <div class="appointment-nav">
                <ul>
                    <li><a href="#">CREATE Appointment</a></li>
                    <li><a href="#">READ Appointment</a></li>
                    <li><a href="#">UPDATE Appointment</a></li>
                    <li><a href="#">DELETE Appointment</a></li>
                </ul>
            </div>
            <div class="feature-nav"><a href="#">Ticket Categories</a></div>

        </div>

        <div class="main-container">
            <div class="header"></div>
            <div class="form">
                <h2>CREATE APPOINTMENT</h2>
                <form method="post">

                <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = $_POST['year'];
    $month = $_POST['month'];
    $slots = $_POST['slots'];
    $startingDay = $_POST['starting-day'];

    // New file name convention
    $fileName = "Slot_No.json";

    // Check if the JSON file exists
    if (file_exists($fileName)) {
        $jsonString = file_get_contents($fileName);
        $data = json_decode($jsonString, true);
    } else {
        $data = array();
    }

    // Create a new entry for this submission
    $newEntry = array(
        'year' => $year,
        'month' => $month,
        'starting_day' => $startingDay,
        'days' => array()
    );

    // Add selected dates and corresponding slots to the new entry
    for ($i = 1; $i <= 31; $i++) {
        if (isset($_POST["date_$i"])) {
            $newEntry['days'][$i] = $slots;
        }
    }

    // Add the new entry to the existing data
    array_push($data, $newEntry);

    // Save the updated data back to the file
    file_put_contents($fileName, json_encode($data, JSON_PRETTY_PRINT));
}
?>




                    <label>Year:</label>
                    <input type="text" name="year">
                    <label>Month</label>
                    <select id="month" name="month" required>
                        <option disabled selected value="">-Select Month-</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="7">August</option>
                        <option value="7">September</option>
                        <option value="7">October</option>
                        <option value="7">November</option>
                        <option value="7">December</option>
                    </select>
                    <label>Select Dates:</label>
                    <div class="date-selection">
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_1" id="1">
                            <label for="1">1</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_2" id="2">
                            <label for="2">2</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_3" id="3">
                            <label for="3">3</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_4" id="4">
                            <label for="4">4</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_5" id="5">
                            <label for="5">5</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_6" id="6">
                            <label for="6">6</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_7" id="7">
                            <label for="7">7</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_8" id="8">
                            <label for="8">8</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_9" id="9">
                            <label for="9">9</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_10" id="10">
                            <label for="10">10</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_11" id="11">
                            <label for="11">11</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_12" id="12">
                            <label for="12">12</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_13" id="13">
                            <label for="13">13</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_14" id="14">
                            <label for="14">14</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_15" id="15">
                            <label for="15">15</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_16" id="16">
                            <label for="16">16</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_17" id="17">
                            <label for="17">17</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_18" id="18">
                            <label for="18">18</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_19" id="19">
                            <label for="19">19</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_20" id="20">
                            <label for="20">20</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_21" id="21">
                            <label for="21">21</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_22" id="22">
                            <label for="22">22</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_23" id="23">
                            <label for="23">23</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_24" id="24">
                            <label for="24">24</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_25" id="25">
                            <label for="25">25</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_26" id="26">
                            <label for="26">26</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_27" id="27">
                            <label for="27">27</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_28" id="28">
                            <label for="28">28</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_29" id="29">
                            <label for="29">29</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_30" id="30">
                            <label for="30">30</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" name="date_31" id="31">
                            <label for="31">31</label>
                        </div>
                    </div>
                    <label>Starting Day</label>
                    <select id="startingDay" name="starting-day" required>
                        <option disabled selected value="">-Select Starting Day-</option>
                        <option value="1">Sunday</option>
                        <option value="2">Monday</option>
                        <option value="3">Tuesday</option>
                        <option value="4">Wednesday</option>
                        <option value="5">Thursday</option>
                        <option value="6">Friday</option>
                        <option value="7">Saturday</option>
                    </select>
                    <label>Number of Slots:</label>
                    <input type="number" id="slots" name="slots" min="0" required>

                    <input type="submit" value="CREATE" required></input>
 
                </form>
            </div>
        </div>

    </div>

</body>
</html>
