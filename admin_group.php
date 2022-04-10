<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        if($db->delete('tb_groups',"id_group = '$id'"))
        {
            $db->alert('ลบหมวดหมู่สำเร็จ');
            $db->header('admin_group.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการลบหมวดหมู่!');
            $db->header('admin_group.php');
        }
    }
    
?>
<?php include('./includes/h_admin.php');?>
<body>
    <div class="contanier">
        <div class="text-right" style="margin-top: 10px; width: 95%;">
            <a href="add_group.php" class="btn btn-primary">เพิ่มหมวดหมู่</a>
            <a href="admin.php" class="btn btn-danger">กลับ</a>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
            <?php include('group_admin.php');?>
        </div>
            <div class="col-lg-9" style="margin-top: 10px;">
                <div class="col-lg-12">
                    <div class="col-lg-3">
                        <form action="" method="GET">
                            <input type="text" name="search" id="search" placeholder="ค้นหาหมวดหมู่" class="form-control">
                            <button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-search"></span></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading  text-center"><b>ข้อมูลหมวดหมู่</b></div>
                        <table class="table table-hover">
                            <tr>
                                <th class="text-center">รหัส</th>
                                <th class="text-center">ชื่อหมวดหมู่</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                            <?php
                             if(!empty($_GET['search']))
                             {
                             $search = $_GET['search'];
                             $se_group = $db->select_where('tb_groups',"name_group LIKE '%$search%'");
                             }
                            else
                            {
                                $se_group = $db->select('tb_groups');
                            }
                            while($group = $se_group->fetch_assoc()) 
                            { 
                               $idm = $group['id_group'];                             
                            ?>
                            <tr class="text-center">
                                <td><?php echo $group['id_group'];?></td>
                                <td><?php echo $group['name_group'];?></td>
                                <td>
                                    <a href="edit_group.php?id=<?php echo $group['id_group'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="admin_group.php?id=<?php echo $group['id_group'];?>" onclick="return confirm('ต้องการลบหมวดหมู่นี้ ใช่ หรือ ไม่')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
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