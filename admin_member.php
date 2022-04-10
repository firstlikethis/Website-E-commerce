<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        if($db->delete('tb_members',"id_member = '$id'"))
        {
            $db->alert('ลบชื่อผู้ใช้สำเร็จ');
            $db->header('admin_member.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการลบชื่อผู้ใช้!');
            $db->header('admin_member.php');
        }
    }
    
?>
<?php include('./includes/h_admin.php');?>
<body>
    <div class="contanier">
        <div class="text-right" style="margin-top: 10px; width: 95%;">
            <a href="add_member.php" class="btn btn-primary">เพิ่มสมาชิก</a>
            <a href="admin.php" class="btn btn-danger">กลับ</a>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
            <?php include('group_admin.php');?>
        </div>
            <div class="col-lg-9" style="margin-top: 10px;">
                <div class="col-lg-12">
                    <div class="col-lg-3">
                        <form action="" method="GET">
                            <input type="text" name="search" id="search" placeholder="ค้นหาผู้ใช้" class="form-control">
                            <button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-search"></span></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading  text-center"><b>ข้อมูลสมาชิก</b></div>
                        <table class="table table-hover">
                            <tr>
                                <th class="text-center">รหัส</th>
                                <th class="text-center">ip_address</th>
                                <th class="text-center">ชื่อผู้ใช้</th>
                                <th class="text-center">ข้อมูลส่วนตัว</th>
                                <th class="text-center">เวลาที่ใช้งานล่าสุด</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                            <?php
                             if(!empty($_GET['search']))
                             {
                             $search = $_GET['search'];
                             $se_member = $db->select_where('tb_members',"username LIKE '%$search%' OR firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR tel LIKE '%$search%'");
                             }
                            else
                            {
                                $se_member = $db->select('tb_members');
                            }
                            while($member = $se_member->fetch_assoc()) 
                            { 
                               $idm = $member['id_member'];                             
                            ?>
                            <tr class="text-center">
                                <td><?php echo $member['id_member'];?></td>
                                <td><?php echo $member['ipaddress'];?></td>
                                <td><?php echo $member['username'];?></td>
                                    <td> 
                                        <a href="detail_member.php?id=<?php echo $member['id_member'];?>" target="popup" onclick="window.open('detail_member.php?id=<?php  echo $idm; ?>','_blank','width=600,height=500;')" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span></a>
                                    </td>
                                <td><?php echo $member['login_last'];?></td>
                                <td><?php echo $member['status'];?></td>
                                <td>
                                    <a href="edit_member.php?id=<?php echo $member['id_member'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="admin_member.php?id=<?php echo $member['id_member'];?>" onclick="return confirm('ต้องการลบชื่อผู้ใช้นี้ ใช่ หรือ ไม่')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
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