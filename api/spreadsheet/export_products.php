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
				


$sheet->setCellValue('B1', "Product"); //
$sheet->setCellValue('B1', "Code"); // 
$sheet->setCellValue('C1', "Automerk"); //
$sheet->setCellValue('D1', "Model"); //
$sheet->setCellValue('E1', "Inkoopprijs (inc. BTW)"); //  
$sheet->setCellValue('F1', "Inkoopprijs (ex. BTW)"); // 	
$sheet->setCellValue('G1', "Op voorraad"); // 
$sheet->setCellValue('H1', "Opbergplaats KMS"); // 


$query1113 = "SELECT * FROM car_model_type_variant_parts";

$data1113=mysqli_query($i_conn,$query1113);   

while($row_data=mysqli_fetch_array($data1113))
{
    $brand = "";
    $companyname = "";
    $row = $row + 1;

    $brand_id = $row_data['brand_id'];
    $query1345 = "SELECT * FROM car_brands WHERE id='$brand_id'";

    $data1345=mysqli_query($i_conn,$query1345);   

    while($row_data1=mysqli_fetch_array($data1345))
    {
        $brand = $row_data1['brand'];
    };

    $model_id = $row_data['model_id'];
    
    $query13456 = "SELECT * FROM car_brand_models WHERE id='$model_id'";

    $data13456=mysqli_query($i_conn,$query13456);   

    while($row_data2=mysqli_fetch_array($data13456))
    {
        $model = $row_data2['model'];
    };


    $model_type_id = $row_data['model_type_id'];
    $variant_id = $row_data['variant_id'];
    $distributor_id = $row_data['distributor_id'];

    $ref = $row_data['ref'];
    $code = $row_data['code'];
    $name = $row_data['name'];
    $img = $row_data['img'];
    
    $sales_price = $row_data['sales_price'];
    $sales_price_inc_vat = $row_data['sales_price_inc_vat'];
    $purchase_price = $row_data['purchase_price'];
    $purchase_price_inc_vat = $row_data['purchase_price_inc_vat'];
    $vat = $row_data['vat'];
    
    $stock = $row_data['stock'];
    $stock_location = $row_data['stock_location'];

    $sheet->setCellValue('A'.$row, "$name"); //
    $sheet->setCellValue('B'.$row, "$code"); // 
    $sheet->setCellValue('C'.$row, "$brand"); //
    $sheet->setCellValue('D'.$row, "$model"); //    
    $sheet->setCellValue('E'.$row, "$purchase_price_inc_vat"); //  
    $sheet->setCellValue('F'.$row, "$purchase_price"); // 	
    $sheet->setCellValue('G'.$row, "$stock"); // 
    $sheet->setCellValue('H'.$row, "$stock_location"); // 	
};

$writer = new Xls($spreadsheet);  

$writer->save('products_'.$today.'-'.$time.'.xls');

$filename = "products_$today-$time.xls";

$sql2 = "INSERT INTO exports (file_name, file_link, extension) VALUES ('$filename', 'http://localhost/kms-apeldoorn.nl/api/spreadsheet/$filename', '.xls')";
if (mysqli_query($i_conn, $sql2)) 
{
    ?>
        <script>
            window.location.replace('http://127.0.0.1:8000/activity');
        </script>   
    <?php
}
