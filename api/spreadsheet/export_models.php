<div class="loading" style="position:fixed; z-index:9999999; top:0px; left:0px; width:100%; height:100%; background:#000;">
    <table style="width:100%; height:100%;">
        <tr>
            <td style="width:100%; height:100%; text-align:center; vertical-align:middle;">
                <img src="../logo_cockpit.png" style="width:250px;"><br/>
                <img src="../loader.gif" style="width:100px;"><br/>
                <span style="color:#FFF;">Data loading please wait..</span>
            </td>
        </tr>
    </table>
</div>

<?php
require 'vendor/autoload.php';
include "../db.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xls; 
$today = date('Y-m-d');
$time = date('H:i');
$time = str_replace(":","-",$time);

$spreadsheet = new Spreadsheet(); 

$sheet = $spreadsheet->getActiveSheet();  
	
$sheet->setCellValue('A1', 'Brand');  
$sheet->setCellValue('A2', 'Model');   

$row = 1; // 1-based index
$query1113 = "SELECT * FROM car_brand_models";

$data1113=mysqli_query($i_conn,$query1113);   

while($row_data = mysqli_fetch_array($data1113)) 
{
    $rowcount = $rowcount + 1;
    $brand_id = $row_data['brand_id'];
    $brand = "";

    $query11135 = "SELECT * FROM car_brands WHERE id='$brand_id'";

    $data11135=mysqli_query($i_conn,$query11135);   

    while($row_data6=mysqli_fetch_array($data11135))
    {
        $brand = $row_data6['brand'];
    };

    $model = $row_data['model'];
    $model = str_replace("(","",$model);
    $model = str_replace(")","",$model);
    $model = str_replace("vanaf"," | vanaf",$model);

    $sheet->setCellValue('A'.$rowcount, "$brand"); 
    $sheet->setCellValue('B'.$rowcount, "$model");
};

$writer = new Xls($spreadsheet);  

$writer->save('models_'.$today.'-'.$time.'.xls');

$filename = "models_$today-$time.xls";

$sql2 = "INSERT INTO exports (file_name, file_link, extension) VALUES ('$filename', 'http://localhost/kms-apeldoorn.nl/api/spreadsheet/$filename', '.xls')";
if (mysqli_query($i_conn, $sql2)) 
{
    ?>
        <script>
            window.location.replace('http://127.0.0.1:8000/activity');
        </script>   
    <?php
}

