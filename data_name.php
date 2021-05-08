<?php
$id = json_decode($_POST["id"], true);
include('conn.php');
$mydb = new db(); // สร้าง object ใหม่ , class db()

$data = [];
$conn = $mydb->connect();


//มีข้อมูลใน invoice_item จะแสดงข้อมูล 

    $res = $conn->prepare("SELECT * FROM invoice_item   WHERE  invoice_id = $id  ");
    $res->execute();

    $data["res"] = $res->fetchAll(PDO::FETCH_ASSOC);
    exit( json_encode( $data ) );
  
