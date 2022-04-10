<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();


    if(!empty($_GET['id']) && $_GET['status'] == "error")
    {
        $id_order = $_GET['id'];
        $update = $db->update("tb_orders","status_order = 'เกิดข้อผิดพลาด'","id_order = '$id_order'");
        if($update)
        {
            $db->alert("เปลื่ยนสถานะเสร็จสิ้น");
            $db->header("admin.php");
        }
        else
        {
            $db->alert("เกิดข้อผิดพลาดในการเปลื่ยนสถานะ");
            $db->header("admin.php");
        }
    }
    if(!empty($_GET['id']) && $_GET['status'] == "success")
    {
        $id_order = $_GET['id'];
        $update = $db->update("tb_orders","status_order = 'ชำระเงินเสร็จสิ้น'","id_order = '$id_order'");
        if($update)
        {
            $db->alert("เปลื่ยนสถานะเสร็จสิ้น");
            $db->header("admin.php");
        }
        else
        {
            $db->alert("เกิดข้อผิดพลาดในการเปลื่ยนสถานะ");
            $db->header("admin.php");
        }
    }
    $day = date("d");
    $day_last = date("d")-1;
    $month = date("m");
    $years = date("Y");
    $year_last = date("Y")-1;
    $sql1 = "SELECT SUM(total_order) as total FROM tb_orders WHERE DAY(date_order) = '$day_last' AND MONTH(date_order) = '$month' AND YEAR(date_order) = '$years' AND status_order = 'ชำระเงินเสร็จสิ้น'";
    $sq_1 = $db->conn->query($sql1);
    $order_day = $sq_1->fetch_assoc();
    $sql2 = "SELECT SUM(total_order) as total FROM tb_orders WHERE DAY(date_order) = '$day' AND MONTH(date_order) = '$month' AND YEAR(date_order) = '$years' AND status_order = 'ชำระเงินเสร็จสิ้น'";
    $sq_2 = $db->conn->query($sql2);
    $total_day = $sq_2->fetch_assoc();
    $sql3 = "SELECT SUM(total_order) as total FROM tb_orders WHERE YEAR(date_order) = '$years' AND status_order = 'ชำระเงินเสร็จสิ้น'";
    $sq_3 = $db->conn->query($sql3);
    $total_month = $sq_3->fetch_assoc();
    $sql4 = "SELECT SUM(total_order) as total FROM tb_orders WHERE YEAR(date_order) = '$year_last' AND status_order = 'ชำระเงินเสร็จสิ้น'";
    $sq_4 = $db->conn->query($sql4);
    $total_year = $sq_4->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<?php include('./includes/h_admin.php');?>

<body>
    <div class="contanier">
        <div class="text-right" style="margin-top: 10px; width: 95%;">
            <a href="index.php" class="btn btn-danger">กลับ</a>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
            <?php include('group_admin.php');?>
        </div>
        <div class="col-lg-9" style="margin-top: 10px;">
            <div class="col-lg-12 text-center" style="padding:20px;">
                <div class="col-lg-3">
                    <a href="show_order.php?mode=lastday" style="text-decoration: none;">
                        <div class="panel panel-info">
                            <div class="panel-heading"><b>ยอดขายเมื่อวาน</b></div>
                            <div class="panel-body">
                                <h4><?php echo number_format($order_day['total']); ?></h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="show_order.php?mode=today" style="text-decoration: none;">
                        <div class="panel panel-success">
                            <div class="panel-heading"><b>ยอดขายวันนี้</b></div>
                            <div class="panel-body">
                                <h4><?php echo number_format($total_day['total']); ?></h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="show_order.php?mode=toyear" style="text-decoration: none;">
                        <div class="panel panel-warning">
                            <div class="panel-heading"><b>ยอดขายปีนี้</b></div>
                            <div class="panel-body">
                                <h4><?php echo number_format($total_month['total']); ?></h4>

                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="show_order.php?mode=lastyear" style="text-decoration: none;">
                        <div class="panel panel-danger">
                            <div class="panel-heading"><b>ยอดขายปีที่แล้ว</b></div>
                            <div class="panel-body">
                                <h4><?php echo number_format($total_year['total']); ?></h4>

                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading  text-center">รายการสั่งซื้อ (รอตรวจสอบ)</div>
                    <table class="table table-hover">
                        <tr>
                            <th class="text-center">ลำดับ</th>
                            <th class="text-center">ข้อมูลผู้รับ</th>
                            <th class="text-center">ช่องทางชำระเงิน</th>
                            <th class="text-center">ราคารวม</th>
                            <th class="text-center">หลักฐาน</th>
                            <th class="text-center">รายละเอียดการสั่งซื้อ</th>
                            <th class="text-center">จัดการ</th>
                        </tr>
                        <?php
                        $i=0;
                        $sq_order = $db->select_where("tb_orders","status_order = 'รอตรวจสอบ'");
                        while($order = $sq_order->fetch_assoc())
                        {
                            $id_order = $order['id_order'];
                            $i++;
                        ?>
                        <tr class="text-center">
                            <td><?php echo $i; ?></td>
                            <td>
                                <button
                                    onclick="window.open('order_user.php?id=<?php echo $id_order; ?>','_blank','width=600,height=500'); "
                                    class="btn btn-primary"><span class="glyphicon glyphicon-user"></span></button>
                            </td>
                            <td><?php echo $order['payment']; ?></td>
                            <td><?php echo number_format($order['total_order']); ?></td>
                            <td>
                                <button
                                    onclick="window.open('Images/Orders/<?php echo $order['image_order']; ?>','_blank','width=500,height=600');"
                                    class="btn btn-info"><span class="glyphicon glyphicon-picture"></span></button>

                            </td>
                            <td>
                                <button
                                    onclick="window.open('detail_order.php?id=<?php echo $order['id_order']; ?>','_blank','width=600,height=600');"
                                    class="btn btn-success"><span
                                        class="glyphicon glyphicon-shopping-cart"></span></button>

                            </td>
                            <td>
                                <a href="admin.php?id=<?php echo $id_order; ?>&status=error"
                                    class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                <a href="admin.php?id=<?php echo $id_order; ?>&status=success"
                                    class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></a>
                                <a href="print.php?id=<?php echo $id_order; ?>" target="_blank"
                                    class="btn btn-warning"><span class="glyphicon glyphicon-print"></span></a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>

                    </table>

                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>