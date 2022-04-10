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

        $check = $db->select_where("tb_howtobuys","text1 = '$text1'");
        if($check->num_rows == 0)
        {
            $insert = $db->insert("tb_howtobuys","text1,text2,text3,text4,text5,text6","'$text1','$text2','$text3','$text4','$text5','$text6'");
            if($insert)
            {
                $db->alert("กรอกข้อมูลเสร็จสิ้น!");
                $db->header("admin_howtobuy.php");
            }
            else
            {
                $db->alert("เกิดข้อผิดพลาดในการกรอกข้อมูล!");
                $db->header("add_howtobuy.php");
            }
        }
        else
        {
            $db->alert("ข้อมูลซ้ำ!");
        }
    }
?>
<?php include('./includes/h_admin.php');?>

<body>

    <div class="container">
        <form action="" method="post">
            <div style="margin: 20px auto; width:420px;" class="panel panel-primary">
                <div class="panel-heading text-center">กรอกข้อมูลร้าน</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="text1">ขั้นตอนที่ 1</label>
                        <input type="text" id="text1" name="text1" required placeholder="ขั้นตอนที่ 1"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="text2">ขั้นตอนที่ 2</label>
                        <input type="text" id="text2" name="text2" required placeholder="ขั้นตอนที่ 2"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="text3">ขั้นตอนที่ 3</label>
                        <input type="text" id="text3" name="text3" required placeholder="ขั้นตอนที่ 3"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="text4">ขั้นตอนที่ 4</label>
                        <input type="text" id="text4" name="text4" required placeholder="ขั้นตอนที่ 4"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="text5">ขั้นตอนที่ 5</label>
                        <input type="text" id="text5" name="text5" required placeholder="ขั้นตอนที่ 5"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="text6">ขั้นตอนที่ 6</label>
                        <input type="text" id="text6" name="text6" required placeholder="ขั้นตอนที่ 6"
                            class="form-control">
                    </div>
                    <input type="submit" name="submit" class="btn btn-success btn-block"
                        onclick="return confirm('คุณต้องการที่จะเพิ่มวิธีการสั่งซื้อ ใช่หรือไม่?'); " value="เพิ่มวิธีการสั่งซื้อ">
                    <a href="admin_howtobuy.php" class="btn btn-danger btn-block">กลับ</a>
                </div>
            </div>
        </form>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>