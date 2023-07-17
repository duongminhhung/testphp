<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include_once 'header.php';
?>


<div class="container mt-8" style="margin-top: 60px; width: 100%;">
    <div class="row">
        <div class="col-sm-4">
            <h2>About Me</h2>
            <h5>Photo of me:</h5>
            <div class="fakeimg">
                <img class="img-fluid" src="./image/index3.jpg" alt="New York">
            </div>
            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
            <h3 class="mt-4">Some Links</h3>
            <p>Lorem ipsum dolor sit ame.</p>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item"><a class="nav-link link-dark" href="#">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-dark">Profile</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-dark">Categories</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-dark">EMI</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-dark">Transaction</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-dark">Target</a></li>
            </ul>
            <hr class="d-sm-none">
        </div>
        <div class="col-sm-8">
            <h2>TITLE HEADING</h2>
            <h5>Title description, Dec 7, 2020</h5>
            <div class="fakeimg">
                <img class="img-fluid" src="./image/index1.jpg" alt="New York">
            </div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco.</p>

            <h2 class="mt-5">TITLE HEADING</h2>
            <h5>Title description, Sep 2, 2020</h5>
            <div class="fakeimg">
                <img class="img-fluid" src="./image/index2.jpg" alt="New York">
            </div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco.</p>
        </div>
    </div>
</div>



<?php include_once 'footer.php';?>