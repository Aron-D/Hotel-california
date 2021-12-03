<?php
 include "class.php";
    $aron = new USER();
    $roomdetails = $aron->getRoomPricesOnCategory(1);
 ?>

<head>
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="scss/style-rooms.scss" rel="stylesheet">
</head>

<body>
    <div class="top"><h2>Dual Room: <br> Book this Room and complete this form. </h2></div>
    <div class="container-l">
<form method="post">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">First name</label>
      <input type="text" class="form-control" id="validationDefault01" placeholder="First name"  required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Last name</label>
      <input type="text" class="form-control" id="validationDefault02" placeholder="Last name"  required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">Email</label>
      <div class="input-group">
        <input type="text" class="form-control" id="validationDefaultUsername" placeholder="Email" aria-describedby="inputGroupPrepend2" required>
      </div>
    </div>
  </div> 
  <!-- echo "THIS ROOM COSTS ".$roomdetails->base_price; -->
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault03">Phone number</label>
      <input type="text" class="form-control" id="validationDefault03" placeholder="number" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationDefault04">Country</label>
      <input type="text" class="form-control" id="validationDefault04" placeholder="Country" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationDefault05">City</label>
      <input type="text" class="form-control" id="validationDefault05" placeholder="City" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationDefault05">Zip</label>
      <input type="text" class="form-control" id="validationDefault05" placeholder="Zip" required>
    </div>
  </div> <br>
  <button class="btn btn-primary" type="submit">Submit form</button>
</form>
</div>
</body>