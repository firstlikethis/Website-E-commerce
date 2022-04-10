<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();


    if(isset($_POST['submit']))
    {
       
        $text1 = $_POST['text1'];
        $text2 = $_POST['text2'];
        $text3 = $_POST['text3'];
        $text4 = $_POST['text4'];
        $text5 = $_POST['text5'];
        $text6 = $_POST['text6'];
    
            $id = $_GET['id'];
            $insert = $db->update("tb_howtobuys","text1='$text1',text2='$text2',text3='$text3',text4='$text4',text5='$text5',text6='$text6'","id_htb = '$id'");
            if($insert)
            {
                $db->alert("แก้ไขข้อมูลเสร็จสิ้น!");
                $db->header("admin_howtobuy.php");
            }
            else
            {
                $db->alert("เกิดข้อผิดพลาดในการแก้ไขข้อมูล!");
                $db->header("admin_howtobuy.php");
            }
    }
    $id=$_GET['id'];
    $se_howtobuy = $db->select_where('tb_howtobuys',"id_htb = $id");
    $htb = $se_howtobuy->fetch_assoc();
?>
<?php include('./includes/h_admin.php');?>

<body>

    <div class="container">
        <form action="" method="post">
            <div style="margin: 20px auto; width:500px;" class="panel panel-primary">
                <div class="panel-heading text-center">แก้ไขข้อมูลร้าน</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="text1">ขั้นตอนที่ 1</label>
                        <input type="text" id="text1" name="text1" value="<?php echo $htb['text1']; ?>" required placeholder="ขั้นตอนที่ 1"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="text2">ขั้นตอนที่ 2</label>
                        <input type="text" id="text2" name="text2" value="<?php echo $htb['text2']; ?>" required placeholder="ขั้นตอนที่ 2"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="text3">ขั้นตอนที่ 3</label>
                        <input type="text" id="text3" name="text3" value="<?php echo $htb['text3']; ?>" required placeholder="ขั้นตอนที่ 3"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="text4">ขั้นตอนที่ 4</label>
                        <input type="text" id="text4" name="text4" value="<?php echo $htb['text4']; ?>" required placeholder="ขั้นตอนที่ 4"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="text5">ขั้นตอนที่ 5</label>
                        <input type="text" id="text5" name="text5" value="<?php echo $htb['text5']; ?>" required placeholder="ขั้นตอนที่ 5"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="text6">ขั้นตอนที่ 6</label>
                        <input type="text" id="text6" name="text6" value="<?php echo $htb['text6']; ?>" required placeholder="ขั้นตอนที่ 6"
                            class="form-control">
                    </div>
                    <input type="submit" name="submit" class="btn btn-success btn-block"
                        onclick="return confirm('คุณต้องการที่จะแก้ไขข้อมูล ใช่หรือไม่?'); " value="แก้ไขข้อมูล">
                    <a href="admin_howtobuy.php" class="btn btn-danger btn-block">กลับ</a>
                </div>
            </div>
        </form>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>