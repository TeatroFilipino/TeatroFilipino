<?php include ('navbar.html'); ?>

<!-- DASHBOARD -->

<!DOCTYPE html>
<html>
<head>
  <!-- Link the dashboard .css -->
  <title>Tenant Landlord Information</title>
  <link rel="stylesheet" type="text/css" href="dashboard.css">
</head>
<body>
  <!-- Stock images & Descriptions -->
  <div class="container">
    <a href="properties.php">
      <div class="box" id="properties">
        <h3>PROPERTIES</h3>
        <p>Includes the property parcel number, its number of units, address, type, owner, and manager.</p>
      </div>
    </a>
    <a href="units.php">
      <div class="box" id="units">
        <h3>UNITS</h3>
        <p>Indicates the property a unit belongs to, the unit number, and its type.</p>
      </div>
    </a>
    <a href="leases.php">
      <div class="box" id="leases">
        <h3>LEASES</h3>
        <p>Shows lease contracts, detailing the tenant, start of lease, and its expiry.</p>
      </div>
    </a>
    <a href="persons.php">
      <div class="box" id="persons">
        <h3>PERSONS</h3>
        <p>Personal information of tenants, landlords, or managers.</p>
      </div>
    </a>
  </div>
  <!-- About Us Section -->
  <div id="about-section">
    <h2>About Us</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur auctor justo et lectus pretium eleifend. Donec nec nulla euismod, lobortis mi id, vehicula felis. Ut ac aliquet est. Morbi quis risus eu felis lacinia consequat. Mauris sodales euismod consectetur. Sed efficitur rutrum justo, sit amet cursus est eleifend sit amet. Mauris auctor sagittis est ac pulvinar.</p>
  </div>  
</body>
</html>