<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        if($db->delete('tb_contacts',"id_contact = '$id'"))
        {
            $db->alert('ลบข้อมูลสำเร็จ');
            $db->header('admin_contact.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการลบข้อมูล!');
            $db->header('admin_contact.php');
        }
    }
    
?>
<?php include('./includes/h_admin.php');?>
<body>
    <div class="contanier">
        <div class="text-right" style="margin-top: 10px; width: 95%;">
            <a href="add_contact.php" class="btn btn-primary">เพิ่มรายละเอียด</a>
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
                        <div class="panel-heading  text-center"><b>ข้อมูลร้านค้า</b></div>
                        <table class="table table-hover">
                            <tr>
                                <th class="text-center">รหัส</th>
                                <th class="text-center">ชื่อร้าน</th>
                                <th class="text-center">ที่อยู่</th>
                                <th class="text-center">เฟซบุ๊ค</th>
                                <th class="text-center">ไลน์</th>
                                <th class="text-center">เบอร์โทรศัพท์</th>
                            </tr>
                            <?php
                             if(!empty($_GET['search']))
                             {
                             $search = $_GET['search'];
                             $se_contact = $db->select_where('tb_contacts',"s_name LIKE '%$search%'");
                             }
                            else
                            {
                                $se_contact = $db->select('tb_contacts');
                            }
                            while($contact = $se_contact->fetch_assoc()) 
                            { 
                               $idm = $contact['id_contact'];                             
                            ?>
                            <tr class="text-center">
                                <td><?php echo $contact['id_contact'];?></td>
                                <td><?php echo $contact['s_name'];?></td>
                                <td><?php echo $contact['s_adress'];?></td>
                                <td><?php echo $contact['s_facebook'];?></td>
                                <td><?php echo $contact['s_line'];?></td>
                                <td><?php echo $contact['s_tel'];?></td>
                                <td>
                                    <a href="edit_contact.php?id=<?php echo $contact['id_contact'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="admin_contact.php?id=<?php echo $contact['id_contact'];?>" onclick="return confirm('ต้องการลบ ใช่ หรือ ไม่')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
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