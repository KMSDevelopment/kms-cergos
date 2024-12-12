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

$sheet->setCellValue('A1', 'name');   

$row = 1; // 1-based index

$sheet->setCellValue('A1', "Titel"); //
$sheet->setCellValue('B1', "Referentienummer"); //
$sheet->setCellValue('C1', "Merk"); // 
$sheet->setCellValue('D1', "Model"); //
$sheet->setCellValue('E1', "Klachtomschrijving"); //
$sheet->setCellValue('F1', "Prijs (inc. BTW)"); //
$sheet->setCellValue('G1', "Prijs (ex. BTW)"); // 

$query1113 = "SELECT * FROM revisions";

$data1113=mysqli_query($i_conn,$query1113);   

while($row_data=mysqli_fetch_array($data1113))
{
    $row = $row + 1;
    $brand_id = "";
    $brand = "";
    $model_id = "";
    $model = "";

    $revision_id = $row_data['id'];
    $ref = $row_data['ref'];
    $title = $row_data['title'];
    $complain_desc = $row_data['complain_desc'];
    $revision_desc = $row_data['revision_desc'];
    $price_ex = $row_data['price_ex'];
    $price_inc = $row_data['price_inc'];


    $query11345 = "SELECT * FROM customer_revisions WHERE revision_id='$revision_id'";

    $data11345=mysqli_query($i_conn,$query11345);   

    while($row_data2=mysqli_fetch_array($data11345))
    {
        $brand_id = $row_data2['brand_id'];
    };


    $query1345 = "SELECT * FROM car_brands WHERE id='$brand_id'";

    $data1345=mysqli_query($i_conn,$query1345);   

    while($row_data1=mysqli_fetch_array($data1345))
    {
        $brand = $row_data1['brand'];
    };

    $query11345a = "SELECT * FROM revision_models WHERE revision_id='$revision_id' AND brand_id='$brand_id'";

    $data11345a=mysqli_query($i_conn,$query11345a);   

    while($row_data2a=mysqli_fetch_array($data11345a))
    {
        $model_id = $row_data2a['model_id'];

        $query13456 = "SELECT * FROM car_brand_models WHERE id='$model_id'";

        $data13456=mysqli_query($i_conn,$query13456);   

        while($row_data2=mysqli_fetch_array($data13456))
        {
            $model = $row_data2['model'];
        };
    };


    $sheet->setCellValue('A'.$row, "$title"); //
    $sheet->setCellValue('B'.$row, "$ref"); // 
    $sheet->setCellValue('C'.$row, "$brand"); //
    $sheet->setCellValue('D'.$row, "$model"); //
    $sheet->setCellValue('E'.$row, "$complain_desc"); // 
    $sheet->setCellValue('F'.$row, "$price_inc"); // 	
    $sheet->setCellValue('G'.$row, "$price_ex"); // 
};

$writer = new Xls($spreadsheet);  

$writer->save('services_'.$today.'-'.$time.'.xls');

$filename = "services_$today-$time.xls";

$sql2 = "INSERT INTO exports (file_name, file_link, extension) VALUES ('$filename', 'http://localhost/kms-apeldoorn.nl/api/spreadsheet/$filename', '.xls')";

if (mysqli_query($i_conn, $sql2)) 
{
    ?>
        <script>
            window.location.replace('http://127.0.0.1:8000/activity');
        </script>   
    <?php
}
