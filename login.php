<?php include_once 'header.php';


session_start();
// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
// 
?>
<section class="w-100 d-flex justify-content-center pb-4 shadow p-3 mb-5 bg-body rounded" style="margin-top: 56px; ">
    <form style="width: 22rem;" method="POST" action="login_process.php">

        <div class="m-5 text-center">
            <h1>Login</h1>
        </div>
        <!-- username input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="username" style="margin-left: 0px;">User name</label>

            <input type="text" id="username" class="form-control" placeholder="Enter your user name" name="username" required>

            <div class="form-notch">
                <div class="form-notch-leading" style="width: 9px;"></div>
                <div class="" style="width: 88.8px;"></div>
                <div class="form-notch-trailing"></div>
            </div>
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="password" style="margin-left: 0px;">Password</label>

            <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password" required>

            <div class="form-notch">
                <div class="form-notch-leading" style="width: 9px;"></div>
                <div class="" style="width: 64px;"></div>
                <div class="form-notch-trailing"></div>
            </div>
        </div>

        <!-- 2 column grid layout for inline styling -->
        <div class="row mb-4">

            <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">

                    <input class="form-check-input" type="checkbox" value="" checked="">

                    <label class="form-check-label" for="form2Example31"> Remember me </label>

                </div>
            </div>

            <div class="col">
                <!-- Simple link -->
                <a href="forgotpw.php">Forgot password?</a>
            </div>
        </div>

        <!-- Submit button -->
        <button type="submit" class="form-control btn btn-primary mt-3">Sign in</button>

        <!-- Register buttons -->
        <div class="text-center">
            <p>Not a member? <a href="sign-up.php">Sign Up</a></p>
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






<?php include_once 'footer.php' ?>

<!-- bị mất luôn trang đăng ký ạ :(( -->