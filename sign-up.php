<?php include_once 'header.php'; 
?>

<section class="w-100 d-flex justify-content-center pb-4 shadow p-3 mb-5 bg-body rounded" style="margin-top: 56px; ">

      <form class="" style="width: 22rem;" action="suc.php" method="POST">
      <div class="m-5 text-center">
        <h1>Sign Up</h1>
      </div>
      <!-- username input -->
      <div class="form-outline mb-4">

            <label class="form-label" for="username" style="margin-left: 0px;" for="username">User name</label>

          <input type="text" id="username" class="form-control" placeholder="Enter your user name" name="username" required>  

        <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="" style="width: 88.8px;"></div><div class="form-notch-trailing"></div></div></div>

        <!-- Email input -->
        <div class="form-outline mb-4">

            <label class="form-label" for="email" style="margin-left: 0px;">Email address</label>

          <input type="email" id="email" class="form-control" placeholder="Enter your email address" name="email" required>

        <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="" style="width: 88.8px;"></div><div class="form-notch-trailing"></div></div></div>

        <!-- Password input -->
        <div class="form-outline mb-4">

        <label class="form-label" for="password" style="margin-left: 0px;">Password</label>

          <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password" required>

        <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="" style="width: 64px;"></div><div class="form-notch-trailing"></div></div></div>

        <!-- Password input -->
        <div class="form-outline mb-4">

        <label class="form-label" for="confirm_password" style="margin-left: 0px;">Confirm password</label>

          <input type="password" id="confirm_password" class="form-control" placeholder="Confirm password" name="confirm_password" required>

        <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="" style="width: 64px;"></div><div class="form-notch-trailing"></div></div></div>

        <!-- Submit button -->
        <button type="button" class="form-control btn btn-primary mt-3" >Sign in</button> 

        <!-- Register buttons -->
        <div class="text-center">
          <p>Already have an account? <a href="login.php">Login now</a></p>
          <p>or sign up with:</p>
          <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-facebook-f"></i>
          </button>

          <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-google"></i> 
          </button>

          <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-twitter"></i>
          </button>

          <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-github"></i>
          </button>
        </div>
      </form>
    </section>


<?php include_once 'footer.php'; 
?>