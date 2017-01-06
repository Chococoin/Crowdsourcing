<!-- Modal -->
<!-- Login Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Log In</h4>
      </div>
      <div class="modal-body">
      <!-- ALERT WITH STATUS MESSAGE -->
        <div id="alert-login">
          <!--<div class="alert alert-info text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $msg ?>
          </div>-->
        </div>
        <form id="formLogin" action="">
          <div class="form-group">
            <label for="Email">User</label>
            <input type="email" class="form-control" id="loginEmail" placeholder="Email" name="email">
          </div>
          <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" class="form-control" id="loginPassword" placeholder="Password" name="password">
          </div>
          <button id="submitLogin" type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Sign up Modal -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Sing Up</h4>
      </div>
      <div class="modal-body">
      <!-- ALERT WITH STATUS MESSAGE -->
        <div id="alert-signup">
        </div>
        <form id="formSignup" action="">
        <span style="color: red">* Required Fields</span>
          <div class="form-group">
            <label for="Name">First Name <span style="color: red">*</span></label>
            <input type="text" class="form-control" id="SignupFName" placeholder="First Name" name="fname" required>
          </div>
          <div class="form-group">
            <label for="Email">Last Name <span style="color: red">*</span></label>
            <input type="text" class="form-control" id="SignupLName" placeholder="Last Name" name="lname" required>
          </div>
          <div class="form-group">
            <label for="Identification">Identification <span style="color: red">*</span></label>
            <input type="text" class="form-control" id="SignupIdentification" placeholder="Identification" name="identification" required>
          </div>
          <div class="form-group">
            <label for="Birthdate">Birthdate <span style="color: red">*</span></label>
            <input type="text" class="form-control" id="datepicker" name="birthdate" placeholder="Birthdate" required>
          </div>
          <div class="form-group">
            <label for="Country">Country <span style="color: red">*</span></label>
            <select class="form-control" id="SignupCountry" name="country" required>
              <option value="">- Selecciona un pais -</option>
              <?php foreach ($countries as $country) :?>
              <option value="<?= $country['Code'] ?>"><?= $country['Name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="City">City <span style="color: red">*</span></label>
            <select class="form-control" id="SignupCity" name="city" required>
              <option value="">- Selecciona una Ciudad -</option>
            </select>
          </div>
          <div class="form-group">
            <label for="Address">Address <span style="color: red">*</span></label>
            <input type="text" class="form-control" id="SignupAddress" placeholder="Address" name="address" required>
          </div>
          

          <div class="form-group">
            <label for="OfficeAddress">Office Address</label>
            <input type="text" class="form-control" id="SignupOfficeAddress" placeholder="Office Address" name="oaddress">
          </div>
          <div class="form-group">
            <label for="Phone">Phone <span style="color: red">*</span></label>
            <input type="text" class="form-control" id="SignupPhone" placeholder="Phone" name="phone" required>
          </div>
          <div class="form-group">
            <label for="AlternativePhone">Alternative Phone</label>
            <input type="text" class="form-control" id="SignupAlternativePhone" placeholder="Alternative Phone" name="aphone">
          </div>
          <div class="form-group">
            <label for="OfficePhone">Office Phone</label>
            <input type="text" class="form-control" id="SignupOfficePhone" placeholder="Office Phone" name="ophone">
          </div>
          <div class="form-group">
            <label for="Email">Email <span style="color: red">*</span></label>
            <input type="email" class="form-control" id="SignupEmail" placeholder="Email" name="email" required>
          </div>
          <div class="form-group">
            <label for="Password">Password <span style="color: red">*</span></label>
            <input type="password" class="form-control" id="signupPassword" placeholder="Password" name="password" required>
          </div>
          <button id="submitSignup" type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Sign up Modal -->
<div class="modal fade" id="addbounty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Bounty</h4>
      </div>
      <div class="modal-body">
      <!-- ALERT WITH STATUS MESSAGE -->
        <div id="alert-addBounty">
        </div>
        <form id="formAddBounty" action="">
          <span style="color: red">* Required Fields</span>
          <div class="form-group">
            <label for="Name">Title <span style="color: red">*</span></label>
            <input type="text" class="form-control" id="" placeholder="Title" name="title" required>
          </div>
          <div class="form-group">
            <label for="Email">Description <span style="color: red">*</span></label>
            <input type="text" class="form-control" id="" placeholder="Description" name="description" required>
          </div>
          <div class="form-group">
            <label for="Identification">Estimated Time (in hours) <span style="color: red">*</span></label>
            <input type="number" class="form-control" id="" placeholder="Estimated Time" name="estimated" required>
          </div>
          <div class="form-group">
            <label for="Birthdate">Offer</label>
            <input type="text" class="form-control" id="" name="offer" placeholder="Offer">
          </div>
          <div class="form-group">
            <label for="Country">Type <span style="color: red">*</span></label>
            <select class="form-control" id="typeBounty" name="typeBounty" required>
              <option value="1">Backend Development</option>
              <option value="2">Frontend Development</option>
              <option value="3">Design</option>
            </select>
          </div>

          <button id="submitAddBounty" type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>