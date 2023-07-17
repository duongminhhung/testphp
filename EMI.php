<?php
include_once 'db_connect.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include_once 'db_connect.php';
$sql = "SELECT * FROM emi";
$result = mysqli_query($conn, $sql);

include_once 'header.php';?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}

.container {
    margin: 30px auto;
    margin-top: 56px;
}

.container .card {
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    background: #fff;
    border-radius: 0px;
}

.btn.btn-primary:focus,
.btn.btn-danger:focus {
    box-shadow: none;
}


.container .card img {
    width: 100%;
    object-fit: fill;
}

.container .card .number {
    font-size: 24px;
}

.container .card-body .btn.btn-primary .fab.fa-cc-paypal {
    font-size: 32px;
    color: #3333f7;
}

.fab.fa-cc-amex {
    color: #1c6acf;
    font-size: 32px;
}

.fab.fa-cc-mastercard {
    font-size: 32px;
    color: red;
}

.fab.fa-cc-discover {
    font-size: 32px;
    color: orange;
}

.c-green {
    color: green;
}

.btn.btn-primary.payment {
    background-color: #1c6acf;
    color: white;
    border-radius: 0px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 24px;
}


.form__div {
    height: 50px;
    position: relative;
    margin-bottom: 24px;
}

.form-control {
    width: 100%;
    height: 45px;
    font-size: 14px;
    border: 1px solid #DADCE0;
    border-radius: 0;
    outline: none;
    padding: 2px;
    background: none;
    z-index: 1;
    box-shadow: none;
}

.form__label {
    position: absolute;
    left: 16px;
    top: 10px;
    background-color: #fff;
    color: #80868B;
    font-size: 16px;
    transition: .3s;
    text-transform: uppercase;
}

.form-control:focus+.form__label {
    top: -8px;
    left: 12px;
    color: #1A73E8;
    font-size: 12px;
    font-weight: 500;
    z-index: 10;
}

.form-control:not(:placeholder-shown).form-control:not(:focus)+.form__label {
    top: -8px;
    left: 12px;
    font-size: 12px;
    font-weight: 500;
    z-index: 10;
}

.form-control:focus {
    border: 1.5px solid #1A73E8;
    box-shadow: none;
}
</style>


<div class="container">
    <div class="row">
        <div class="row">

            <?php while ($row = mysqli_fetch_assoc($result)) {?>
            <div class="shadow-lg col-6 col-md-4 p-5 m-4">
                <p class="text-center fw-bold"><?php echo $row['title'] ?></p>
                <div class="number">
                    <label class="fw-bold text-success"
                        for=""><?php echo number_format($row['price'], 2, ',', '.') . ' $'; ?></label>
                </div>
                <div class="d-flex align-items-center justify-content-between my-3">
                    <small><span class="fw-bold">Start
                            date:</span><span><?php echo $row['start_date'] ?></span></small>
                    <small><span class="fw-bold">End date:</span><span><?php echo $row['end_date'] ?></span></small>
                </div>
                <form method="post" action="EMI_process.php">
                    <div class="d-flex align-items-center justify-content-between">
                        <input hidden value="<?php echo $row['id'] ?>" name="id" />
                        <input type="submit" name="btn_del" class="btn btn-danger" value="Remove" />
                        <input type="submit" name="btn_edit" class="btn btn-outline-success btn-primary" value="Edit" />
                    </div>
                </form>
            </div>
            <?php }?>
        </div>


    </div>
    <div class="col-12 mt-4">
        <div class="card p-3">
            <p class="mb-0 fw-bold h4">Equated Monthly Installment - EMI</p>
        </div>
    </div>
    <div class="col-12">
        <div class="card p-3">
            <div class="card-body border p-0">
                <p>
                    <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                        data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                        aria-controls="collapseExample">
                        <span class="fw-bold">Add New</span>
                    </a>
                </p>
                <div class="collapse show p-3 pt-0" id="collapseExample">
                    <div class="row">
                        <div class="col-lg-5 mb-lg-0 mb-3">
                            <img src="./image/EMI2.jpg" alt="">
                        </div>
                        <div class="col-lg-7">
                            <form action="EMI_process.php" class="form" method="post">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form__div">
                                            <input type="text" class="form-control" placeholder=" " name="title">
                                            <label for="" class="form__label">Reason</label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form__div">
                                            <input type="date" class="form-control" placeholder=" " name="start_date">
                                            <label for="" class="form__label">DD / MM / YY</label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form__div">
                                            <input type="date" class="form-control" placeholder=" " name="end_date">
                                            <label for="" class="form__label">DD / MM / YY</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form__div">
                                            <input type="text" class="form-control" placeholder=" " name="price">
                                            <label for="" class="form__label">Price</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <input type="submit" class="btn btn-primary w-100" name="add" value="ADD" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once 'footer.php';?>