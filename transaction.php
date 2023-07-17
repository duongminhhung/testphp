<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include_once 'header.php';
include_once 'db_connect.php';
$id = $_SESSION['user']['id'];
$sql = "SELECT * FROM transaction where  user_id = $id";
$result = mysqli_query($conn, $sql);
if (isset($_GET['postName']) || isset($_GET['date_from']) || isset($_GET['date_to'])) {
    $id_cate = $_GET['postName'];
    $from = $_GET['date_from'];
    $to = $_GET['date_to'];
    $query = "SELECT * FROM transaction where  user_id = $id";

    if ($id_cate != '' && $from != '' && $to != '') {
        $query = "SELECT * FROM transaction where  user_id = $id AND category_id = $id_cate and day <= '$to' and day >= '$from'";
    } else if ($id_cate != '' && $from == '' && $to == '') {
        $query = "SELECT * FROM transaction where  user_id = $id AND category_id = $id_cate";
    } else if ($id_cate == '' && $from != '' && $to != '') {
        $query = "SELECT * FROM transaction where  user_id = $id  and day <= '$to' and day >= '$from'";
    } else if ($id_cate == '' && $from == '' && $to != '') {
        $query = "SELECT * FROM transaction where  user_id = $id  and day <= '$to'";
    } else if ($id_cate == '' && $from != '' && $to == '') {
        $query = "SELECT * FROM transaction where  user_id = $id  and day >= '$from'";
    } else if ($id_cate != '' && $from != '' && $to == '') {
        $query = "SELECT * FROM transaction where  user_id = $id AND category_id = $id_cate  and day >= '$from'";
    } else if ($id_cate != '' && $from == '' && $to != '') {
        $query = "SELECT * FROM transaction where  user_id = $id AND category_id = $id_cate and day <= '$to'";
    }
    $result = mysqli_query($conn, $query);
}

?>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
input[type="date"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}


.transaction-list {
    margin-top: 30px;
    border-collapse: collapse;
    width: 100%;
}

.transaction-list th,
.transaction-list td {
    padding: 8px;
    text-align: left;
}

.transaction-list th {
    background-color: #4CAF50;
    color: white;
}

.transaction-list tr:nth-child(even) {
    background-color: #f2f2f2;
}

.edit-btn,
.delete-btn {
    padding: 5px 10px;
    background-color: #ccc;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.edit-btn:hover,
.delete-btn:hover {
    background-color: #999;
}
</style>
<div class="container" style="margin-top: 56px;">
    <div class="text-center">
        <h2>Revenue And Expenditure</h2>
    </div>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add transaction</button>
    <form action="">
        <select class="postName form-control" style="width:760px" name="postName">
            <option value="">Choose</option>

            <option value="1">Revenue</option>
            <option value="2">Expenditure</option>
        </select>
        <label for="amount">Date From:</label>
        <input type="date" name="date_from">
        <label for="amount">Date To:</label>
        <input type="date" name="date_to">
        <button type="submit" class="btn btn-success">Search</button>

        <!-- <button></button> -->
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Amount of Money</th>
                <th>Date</th>
                <th>Note</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php while ($row = mysqli_fetch_assoc($result)) {?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php if ($row['category_id'] == 1) {
    echo 'Revenue';
} else {
    echo 'Expenditure';
}?></td>
                <td><?php echo $row['price_transaction'] ?>$</td>
                <td><?php echo $row['day'] ?></td>
                <td><?php echo $row['description'] ?></td>
                <td>
                    <button type="button" value="<?php echo $row['id'] ?>" class="btn btn-secondary edit"
                        data-toggle="modal" data-target="#myModal1">Sửa</button>
                    <a href="delete_transaction.php?id=<?php echo $row['id'] ?>"><button type="button"
                            class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="add_transaction.php" method="post">
                    <div class="form-group">
                        <label for="type">Type transaction:</label>
                        <select id="type" name="type" required>
                            <option value="" selected>Choose transaction</option>
                            <option value="1">Revenue</option>
                            <option value="2">Expenditure</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount of Money:</label>
                        <input type="number" id="amount" name="amount" placeholder="Amount of Money" required>
                    </div>
                    <div class="form-group">
                        <label for="datetimeInput">Choose Date:</label>
                        <input type="date" id="date" name="time">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" id="description" name="description" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="edit_transaction.php" method="post">
                    <div class="form-group">
                        <label for="type">Type transaction:</label>
                        <input type="hidden" name="id" class="id">
                        <select id="type_edit" name="type" required>
                            <option value="" selected>Choose transaction</option>
                            <option value="1">Revenue</option>
                            <option value="2">Expenditure</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount of Money:</label>
                        <input type="number" id="amount_edit" name="amount" placeholder="Amount of Money" required>
                    </div>
                    <div class="form-group">
                        <label for="datetimeInput">Choose Date:</label>
                        <input type="date" id="date_edit" name="time">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" id="description_edit" name="description" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.postName').select2();
});
$(".edit").click(function() {
    var id = $(this).val();
    $.ajax({
        url: 'edit_cash_flow.php',
        type: 'get',
        data: {
            id: id,
        }
    }).done(function(response) {
        $('.id').val(response[0].id);
        $('#type_edit').val(response[0].category_id);
        $('#amount_edit').val(response[0].price_transaction);
        $('#description_edit').val(response[0].description);
        $('#date_edit').val(response[0].day);
    });

});
</script>

<?php include_once 'footer.php';?>