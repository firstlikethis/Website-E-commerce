<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        if($db->delete('tb_howtobuys',"id_htb = '$id'"))
        {
            $db->alert('ลบข้อมูลสำเร็จ');
            $db->header('admin_howtobuy.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการลบข้อมูล!');
            $db->header('admin_howtobuy.php');
        }
    }
    
?>
<?php include('./includes/h_admin.php');?>
<body>
    <div class="contanier">
        <div class="text-right" style="margin-top: 10px; width: 95%;">
            <a href="add_howtobuy.php" class="btn btn-primary">เพิ่มวิธีการสั่งซื้อ</a>
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
                        <div class="panel-heading  text-center"><b>วิธีการสั่งซื้อ</b></div>
                        <table class="table table-hover">
                            <tr>
                                <th class="text-center">รหัส</th>
                                <th class="text-center">ขั้นตอนที่ 1</th>
                                <th class="text-center">ขั้นตอนที่ 2</th>
                                <th class="text-center">ขั้นตอนที่ 3</th>
                                <th class="text-center">ขั้นตอนที่ 4</th>
                                <th class="text-center">ขั้นตอนที่ 5</th>
                                <th class="text-center">ขั้นตอนที่ 6</th>
                            </tr>
                            <?php
                             if(!empty($_GET['search']))
                             {
                             $search = $_GET['search'];
                             $se_buy = $db->select_where('tb_howtobuys',"text1 LIKE '%$search%'");
                             }
                            else
                            {
                                $se_buy = $db->select('tb_howtobuys');
                            }
                            while($buy = $se_buy->fetch_assoc()) 
                            { 
                               $idm = $buy['id_htb'];                             
                            ?>
                            <tr class="text-center">
                                <td><?php echo $buy['id_htb'];?></td>
                                <td><?php echo $buy['text1'];?></td>
                                <td><?php echo $buy['text2'];?></td>
                                <td><?php echo $buy['text3'];?></td>
                                <td><?php echo $buy['text4'];?></td>
                                <td><?php echo $buy['text5'];?></td>
                                <td><?php echo $buy['text6'];?></td>
                                <td>
                                    <a href="edit_howtobuy.php?id=<?php echo $buy['id_htb'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="admin_howtobuy.php?id=<?php echo $buy['id_htb'];?>" onclick="return confirm('ต้องการลบ ใช่ หรือ ไม่')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
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