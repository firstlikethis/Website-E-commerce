<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        if($db->delete('tb_howtopayments',"id_payment = '$id'"))
        {
            $db->alert('ลบข้อมูลสำเร็จ');
            $db->header('admin_payment.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการลบข้อมูล!');
            $db->header('admin_payment.php');
        }
    }
    
?>
<?php include('./includes/h_admin.php');?>
<body>
    <div class="contanier">
        <div class="text-right" style="margin-top: 10px; width: 95%;">
            <a href="add_payment.php" class="btn btn-primary">เพิ่มการชำระเงิน</a>
            <a href="admin.php" class="btn btn-danger">กลับ</a>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
            <?php include('group_admin.php');?>
        </div>
            <div class="col-lg-9" style="margin-top: 10px;">
                <div class="col-lg-12">
                    <div class="col-lg-3">
                        <form action="" method="GET">
                            <input type="text" name="search" id="search" placeholder="ค้นหา" class="form-control">
                            <button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-search"></span></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading  text-center"><b>ข้อมูลการชำระเงิน</b></div>
                        <table class="table table-hover">
                            <tr>
                                <th class="text-center">รหัส</th>
                                <th class="text-center">เลขบัญชี</th>
                                <th class="text-center">ธนาคาร</th>
                                <th class="text-center">ชื่อเจ้าของบัญชี</th>
                            </tr>
                            <?php
                             if(!empty($_GET['search']))
                             {
                             $search = $_GET['search'];
                             $se_payment = $db->select_where('tb_howtopayments',"bank_name LIKE '%$search%'");
                             }
                            else
                            {
                                $se_payment = $db->select('tb_howtopayments');
                            }
                            while($payment = $se_payment->fetch_assoc()) 
                            { 
                               $idm = $payment['id_payment'];                             
                            ?>
                            <tr class="text-center">
                                <td><?php echo $payment['id_payment'];?></td>
                                <td><?php echo $payment['bank_acc'];?></td>
                                <td><?php echo $payment['bank_name'];?></td>
                                <td><?php echo $payment['holder_name'];?></td>
                                <td>
                                    <a href="edit_payment.php?id=<?php echo $payment['id_payment'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="admin_payment.php?id=<?php echo $payment['id_payment'];?>" onclick="return confirm('ต้องการลบ ใช่ หรือ ไม่')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
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
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>