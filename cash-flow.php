<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include_once 'db_connect.php';
if (!empty($_POST['thongke'])) {

    $start_date = $_POST['start_date']; // Ngày bắt đầu khoảng thời gian
    $end_date = $_POST['end_date']; // Ngày kết thúc khoảng thời gian
// Câu truy vấn SELECT với điều kiện WHERE
    $sql_emi = "SELECT * FROM emi WHERE end_date BETWEEN '$start_date' AND '$end_date'";
// $sql = "SELECT * FROM emi WHERE day >= '$start_date' AND day <= '$end_date'";
    $sql_category_1 = "SELECT * FROM transaction WHERE category_id = 1 AND day BETWEEN '$start_date' AND '$end_date'";
    $sql_category_2 = "SELECT * FROM transaction WHERE category_id = 2 AND day BETWEEN '$start_date' AND '$end_date'";
    // $id = $_SESSION['user']['id'];
    // $sql_goal = "SELECT * FROM goal where  user_id = $id AND month BETWEEN '$start_date' AND '$end_date'";

    $result_emi = mysqli_query($conn, $sql_emi);
    $result_category_1 = mysqli_query($conn, $sql_category_1);
    $result_category_2 = mysqli_query($conn, $sql_category_2);
    // $result_goal = mysqli_query($conn, $sql_goal);
    $total_price_eim = 0;
    $total_price_category_1 = 0;
    $total_price_category_2 = 0;
    // $total_price_goal = 0;

}
// Câu truy vấn SELECT với điều kiện WHERE

include_once 'header.php';
?>
<?php
$condition = false; // Điều kiện để hiển thị

if (!empty($start_date) && !empty($end_date)) {
    ?>
<!-- Mã HTML khi điều kiện đúng -->
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th scope="col" colspan="4">Cash-flow</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="" method="post">
                    <td>
                        Start Date <input type="date" class="form-control" placeholder=" " name="start_date">
                    </td>
                    <td>
                        End Date <input type="date" class="form-control" placeholder=" " name="end_date">
                    </td>
                    <td colspan="2">
                        <div>
                            <input type="submit" class="btn btn-primary" value="Thống kê" name="thongke" />
                        </div>
                    </td>
                </form>
            </tr>
            <tr>
                <th colspan="4">cash flow operations</th>
            </tr>
            <tr class="table-danger">
                <th colspan="4">Thu</th>
            </tr>
            <?php

    while ($row = mysqli_fetch_assoc($result_category_1)) {
        $total_price_category_1 += $row['price_transaction'];
        ?>
            <tr>
                <td scope="row" colspan="2"><?php echo $row['description'] ?></td>
                <td></td>
                <td><?php echo number_format($row['price_transaction'], 2, ',', '.') . ' $' ?></td>
            </tr>
            <?php }?>

            <tr class="table-info">
                <td colspan="3">+</td>
                <td> <?php echo number_format($total_price_category_1, 2, ',', '.') . ' $' ?></td>
            </tr>
            <tr class="table-danger">
                <th colspan="4">Chi</th>
            </tr>
            <?php
while ($row = mysqli_fetch_assoc($result_category_2)) {
        $total_price_category_2 += $row['price_transaction']
        ?>
            <tr>
                <td scope="row" colspan="2"><?php echo $row['description'] ?></td>
                <td></td>
                <td><?php echo number_format($row['price_transaction'], 2, ',', '.') . ' $' ?></td>
            </tr>
            <?php }?>

            <tr class="table-info">
                <td colspan="3">-</td>
                <td><?php echo number_format($total_price_category_2, 2, ',', '.') . ' $' ?> </td>
            </tr>
            <tr class="table-danger">
                <th colspan="4">EMI</th>
            </tr>
            <?php
while ($row = mysqli_fetch_assoc($result_emi)) {
        $total_price_eim += $row['price']
        ?>
            <tr>
                <td scope="row" colspan="2"><?php echo $row['title'] ?></td>
                <td></td>
                <td><?php echo number_format($row['price'], 2, ',', '.') . ' $' ?></td>
            </tr>
            <?php }?>

            <tr class="table-info">
                <td colspan="3">-</td>
                <td> <?php echo number_format($total_price_eim, 2, ',', '.') . ' $' ?></td>
            </tr>
            <tr class="table-success">
                <th colspan="3">Còn lại</th>
                <td><?php echo number_format($total_price_category_1 - $total_price_category_2 - $total_price_eim, 2, ',', '.') . ' $' ?>
                </td>
            </tr>
            <!-- <tr class="table-danger">
                <th colspan="4">Target</th>
            </tr>
            <?php
while ($row = mysqli_fetch_assoc($result_goal)) {
        $total_price_goal += $row['target'];
        ?>
            <tr>
                <td scope="row" colspan="2"><?php echo $row['title'] ?></td>
                <td></td>
                <td></td>
            </tr>
            <?php }?>
            <tr class="table-active">
                <td colspan="3"></td>
                <td> <?php echo number_format($total_price_goal, 2, ',', '.') . ' $' ?></td>
            </tr> -->


        </tbody>
    </table>

</div>
<?php
} else {
    ?>
<!-- Mã HTML khi điều kiện sai -->
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th scope="col" colspan="4">Cash-flow</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="" method="post">
                    <td>
                        Start Date <input type="date" class="form-control" placeholder=" " name="start_date">
                    </td>
                    <td>
                        End Date <input type="date" class="form-control" placeholder=" " name="end_date">
                    </td>
                    <td colspan="2">
                        <div>
                            <input type="submit" class="btn btn-primary" value="Thống kê" name="thongke" />
                        </div>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>

</div>
<?php
}
?>