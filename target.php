<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include_once 'db_connect.php';

$id = $_SESSION['user']['id'];
$sql = "SELECT * FROM goal where  user_id = $id";
$result = mysqli_query($conn, $sql);
include_once 'header.php';
?>
<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addGoalModal">
        Add Goal for Next Month
    </button>
</div>

<div class="modal fade" id="addGoalModal" tabindex="-1" role="dialog" aria-labelledby="addGoalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGoalModalLabel">Add Goal for Next Month</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="target_add.php" method="post" id="goalForm">
                    <div class="form-group">
                        <label for="goalTitle">Goal Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="goalDescription">Taget Money</label>
                        <input type="number" class="form-control" name="money" required>
                    </div>
                    <div class="form-group">
                        <label for="goalDescription">Month</label>
                        <input type="date" class="form-control" name="month" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveGoalBtn">Save Goal</button>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="container mt-4">
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Taget Money</th>
                <th>Month</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="goalsTableBody">
            <?php while ($row = mysqli_fetch_assoc($result)) {?>
            <tr>
                <td><?php echo $row['title'] ?></td>
                <td><?php echo $row['target'] ?></td>
                <td><?php echo $row['month'] ?></td>
                <td>
                    <button type="button" value="<?php echo $row['id'] ?>" class="btn btn-secondary edit"
                        data-toggle="modal" data-target="#myModal1">Sửa</button>
                    <a href="target_delete.php?id=<?php echo $row['id'] ?>"><button type="button"
                            class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="target_update.php" method="get" id="goalForm">
                    <div class="form-group">
                        <input type="hidden" name="id" class="id_edit">
                        <label for="goalTitle">Goal Title</label>
                        <input type="text" class="form-control title_edit" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="goalDescription">Taget Money</label>
                        <input type="number" class="form-control money_edit" name="money" required>
                    </div>
                    <div class="form-group">
                        <label for="goalDescription">Month</label>
                        <input type="date" class="form-control month_edit" name="month" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveGoalBtn">Save Goal</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
$(".edit").click(function() {
    var id = $(this).val();
    $.ajax({
        url: 'target_edit.php',
        type: 'get',
        data: {
            id: id,
        }
    }).done(function(response) {
        console.log(response);
        $('.id_edit').val(response[0].id);
        $('.title_edit').val(response[0].title);
        $('.money_edit').val(response[0].target);
        $('.month_edit').val(response[0].month);
    });
});
</script>
<?php include_once 'footer.php';?>