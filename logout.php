<?php
 require('./includes/connect.php');
 $db = new db;
 if(session_destroy())
 {
     $db->alert("ออกจากระบบเสร็จสิ้น");
    $db->header("index.php");
    
 }
 else
 {
     $db->header("index.php");
     $db->alert("เกิดข้อผิดพลาดในการออกจากระบบ");
 }
?>