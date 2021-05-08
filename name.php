
<?php

$input = json_decode($_POST["query"], true);
$query = $input["query"];
$page = $input["page"];



include('conn.php'); 
$mydb = new db(); // สร้าง object ใหม่ , class db()

$conn = $mydb->connect();


echo '<div>';
$COUNT= $conn->prepare("SELECT COUNT(*)as ttt FROM invoice ");
$COUNT->execute();
$rec = $COUNT->fetch(PDO::FETCH_ASSOC);
$ttt = $rec['ttt'];

$rpp = 10; // limit
$startPage = ( $page - 1 ) * $rpp; 


$ttp = ceil($ttt/$rpp);



//รับค่า Query จากหน้า index.php 
if(isset($query))
{
// ค้นหาข้อมูลใน database ที่ตรงกับ input 
$q = $query;
	
$results = $conn->prepare("SELECT * FROM invoice WHERE email LIKE '%" . $q . "%'
OR name LIKE '%".$q."%'
OR invoice_id LIKE '%".$q."%'
OR title LIKE '%".$q."%'
OR address LIKE '%".$q."%'
OR organization LIKE '%".$q."%'
OR company_format LIKE '%".$q."%'
OR branch LIKE '%".$q."%'
LIMIT {$startPage},{$rpp};
");


}
else
{
 //ถ้าไม่ได้ input  จะแสดงข้อมูล ใน datadase
 $results = $conn->prepare("SELECT * FROM invoice  LIMIT {$startPage},{$rpp}");

}
//แสดงข้อมูล column database
$results->execute();
echo'<table  id="main">
<thead>
  <tr>
    <th colspan = "2" >ชื่อ</th>
    
  </tr>
</thead>   
 <tbody id="result">';
while($row = $results->fetch(PDO::FETCH_ASSOC))
{

     echo '<tr>' . 
    '<td>'. $row['name'] . '</td>' 
		."<td ><button onclick='send(".$row['invoice_id'].");'type='button'  name='butsave' id='show' >
			<i class='fas fa-plus'></i></button>
		</td>"	.
    '</tr>'.
    '<tr  id="invoiceBody'.$row['invoice_id'].'"style="display:none" bgcolor="#FFFF99">
			<td colspan = "2" id ="invoiceBody'.$row['invoice_id'].' bgcolor="#FFFF99"">
			</td>
	</tr>';

} 
echo'</tbody>
</table>';

 json_decode($ttp);

?>
