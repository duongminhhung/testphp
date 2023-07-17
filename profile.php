<script src="https://cdn.jsdelivr.net/npm/apexcharts">
</script>

<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include_once 'db_connect.php';

// tính tổng tiền của emi
$id_user =  $_SESSION['user']['id'];

$sql = "SELECT SUM(price) AS total_price FROM emi where user_id  = '$id_user'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_emi = $row["total_price"];
}
// tính tổng tiền của goal 
$sql3 = "SELECT SUM(target) AS total_price FROM goal where user_id  = '$id_user'";
$result3 = mysqli_query($conn, $sql3);
if (mysqli_num_rows($result3) > 0) {
    $row = mysqli_fetch_assoc($result3);
    $total_goal = $row["total_price"];
}
//. Tính tiền chi và tiêu
$sql2 = "SELECT category_id, SUM(price_transaction) AS total FROM transaction 
where user_id  = '$id_user'
 GROUP BY category_id ";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $category_id = $row["category_id"];
        $total_transaction = $row["total"];
        $data[$category_id] = $total_transaction;
    }
}

include_once 'header.php'; ?>

<section class="w-100" style="background-color: #eee;" style="margin-top: 56px;">
    <div class="container py-5" style="margin-top: 56px;">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="./image/EMI1.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3"><?php echo $_SESSION['user']['username']; ?></h5>
                        <p class="text-muted mb-1"><?php echo $_SESSION['user']['email']; ?></p>
                        <div class="d-flex justify-content-center mb-2">
                            <button type="button" class="btn btn-outline-primary">Edit</button>
                            <a href="logout.php">
                                <button type="button" class="btn btn-danger ms-1">Sign out</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Revenue</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    <?php echo number_format($data[1], 2, ',', '.') . ' $' ?>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Expenditure</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo number_format($data[2], 2, ',', '.') . ' $' ?>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">EMI</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    <?php echo number_format($total_emi, 2, ',', '.') . ' $'; ?>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Target</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    <?php echo number_format($total_goal, 2, ',', '.') . ' $'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="border p-4 mb-4 rounded-5 d-flex justify-content-center">
                    <div class="col-lg-8">
                        <h3>Doanh thu các tháng gần đây</h3>
                        <div id="chart"></div>
                    </div>
                    <div class="col-lg-8">
                        <h3>Chi phí các tháng gần đây</h3>
                        <div id="chart2"></div>
                    </div>
                </section>
                <section class="border p-4 mb-4 rounded-5 d-flex justify-content-center">
                    <div class="col-lg-8">
                        <h3 style="text-align: center;">Mức tagert và lợi nhuận của các tháng</h3>
                        <div id="chart3"></div>

                    </div>

                </section>
            </div>
        </div>
    </div>
</section>
<?php
$id_user =  $_SESSION['user']['id'];
$query = "SELECT EXTRACT(YEAR FROM day) AS year,EXTRACT(MONTH FROM day) AS month,SUM(price_transaction) AS total_price FROM transaction WHERE
category_id = 1 AND user_id = '$id_user'
GROUP BY
EXTRACT(YEAR FROM day),
EXTRACT(MONTH FROM day)
ORDER BY
year, month;
";
$result = mysqli_query($conn, $query);
if ($result) {
    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            'month' => "tháng " . $row['month'],
            'total_price' => $row['total_price']
        );
    }

    $data1 = json_encode($data);
} else {
    echo "Error executing query: " . mysqli_error($conn);
}
?>
<?php
$id_user =  $_SESSION['user']['id'];
$query = "SELECT EXTRACT(YEAR FROM day) AS year,EXTRACT(MONTH FROM day) AS month,SUM(price_transaction) AS total_price FROM transaction WHERE
category_id = 2 AND user_id = '$id_user'
GROUP BY
EXTRACT(YEAR FROM day),
EXTRACT(MONTH FROM day)
ORDER BY
year, month;
";
$result = mysqli_query($conn, $query);
if ($result) {
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            'month' => "tháng " . $row['month'],
            'total_price' => $row['total_price']
        );
    }
    $data2 = json_encode($data);
} else {
    echo "Error executing query: " . mysqli_error($conn);
}
?>
<?php
$id_user =  $_SESSION['user']['id'];
$query = "SELECT 
EXTRACT(YEAR FROM t.day) AS year,
EXTRACT(MONTH FROM t.day) AS month,
SUM(CASE WHEN t.category_id = 1 THEN t.price_transaction ELSE 0 END) 
    - SUM(CASE WHEN t.category_id = 2 THEN t.price_transaction ELSE 0 END) 
    - COALESCE(SUM(e.price), 0) AS difference,
g.target
FROM
transaction t
LEFT JOIN emi e ON EXTRACT(YEAR FROM t.day) = EXTRACT(YEAR FROM e.start_date) 
           AND EXTRACT(MONTH FROM t.day) = EXTRACT(MONTH FROM e.start_date)
LEFT JOIN goal g ON EXTRACT(YEAR FROM t.day) = EXTRACT(YEAR FROM g.month) 
            AND EXTRACT(MONTH FROM t.day) = EXTRACT(MONTH FROM g.month)
WHERE
t.user_id = '$id_user'
GROUP BY
EXTRACT(YEAR FROM t.day),
EXTRACT(MONTH FROM t.day),
g.target
ORDER BY
year, month;
";
// die($query);
$result = mysqli_query($conn, $query);
if ($result) {
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            'target' => $row['target'],
            'month' => "tháng " . $row['month'],
            'transaction' => $row['difference']
        );
    }
    $data3 = json_encode($data);
    // die($data3);
} else {
    echo "Error executing query: " . mysqli_error($conn);
}
?>


<script>
    var jsonData = <?php echo $data1; ?>;
    var yValues = jsonData.map(item => item.total_price);
    var xValues = jsonData.map(item => item.month);
    var colors = ['#007bff', '#00cc99', '#ff8800', '#cc33ff', '#ff0000', '#00ff00', '#ff33cc', '#3333cc'];
    var options = {
        series: [{
            data: yValues
        }],
        chart: {
            height: 350,
            type: 'bar',
            events: {
                click: function(chart, w, e) {}
            },
            title: {
                text: 'Distributed Column Chart',
                align: 'center',
                margin: 10,
                style: {
                    fontSize: '20px',
                    fontWeight: 'bold',
                    color: '#333',
                },
            },
        },
        colors: colors,
        plotOptions: {
            bar: {
                columnWidth: '25%',
                distributed: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        xaxis: {
            categories: xValues,
            labels: {
                style: {
                    colors: colors,
                    fontSize: '12px'
                }
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
<script>
    var jsonData = <?php echo $data2; ?>;
    var yValues = jsonData.map(item => item.total_price);
    var xValues = jsonData.map(item => item.month);
    var colors = ['#007bff', '#00cc99', '#ff8800', '#cc33ff', '#ff0000', '#00ff00', '#ff33cc', '#3333cc'];
    var options = {
        series: [{
            data: yValues
        }],
        chart: {
            height: 350,
            type: 'bar',
            events: {
                click: function(chart, w, e) {}
            },
            title: {
                text: 'Distributed Column Chart',
                align: 'center',
                margin: 10,
                style: {
                    fontSize: '20px',
                    fontWeight: 'bold',
                    color: '#333',
                },
            },
        },
        colors: colors,
        plotOptions: {
            bar: {
                columnWidth: '25%',
                distributed: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        xaxis: {
            categories: xValues,
            labels: {
                style: {
                    colors: colors,
                    fontSize: '12px'
                }
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#chart2"), options);
    chart.render();
</script>
<script>
    var jsonData = <?php echo $data3; ?>;
    var yValues = jsonData.map(item => item.transaction);
    var xValues = jsonData.map(item => item.month);
    var zValues = jsonData.map(item => item.target);
    var options = {
        series: [{
            name: 'Mục tiêu tháng',
            data: zValues
        }, {
            name: 'Thực tế',
            data: yValues
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: xValues
        },
        fill: {
            opacity: 1
        },
    };
    var chart = new ApexCharts(document.querySelector("#chart3"), options);
    chart.render();
</script>






<?php include_once 'footer.php'; ?>