<div class="loading" style="position:fixed; z-index:9999999; top:0px; left:0px; width:100%; height:100%; background:#000;">
    <table style="width:100%; height:100%;">
        <tr>
            <td style="width:100%; height:100%; text-align:center; vertical-align:middle;">
                <img src="../../logo_cockpit.png" style="width:250px;"><br/>
                <img src="../../loader.gif" style="width:100px;"><br/>
                <span style="color:#FFF;">Data loading please wait..</span>
            </td>
        </tr>
    </table>
</div>

<?php
require 'vendor/autoload.php';
include "../../db.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xls; 
$today = date('Y-m-d');
$time = date('H:i');
$time = str_replace(":","-",$time);

$spreadsheet = new Spreadsheet(); 

$sheet = $spreadsheet->getActiveSheet();  

$sheet->setCellValue('A1', 'name');   

$row = 1; // 1-based index

$sheet->setCellValue('A1', "Type"); // Service / Labor
$sheet->setCellValue('B1', "Name"); //
$sheet->setCellValue('C1', "Condition"); //
$sheet->setCellValue('D1', "Code"); // 
$sheet->setCellValue('E1', "Category"); //
$sheet->setCellValue('F1', "Brand"); //
$sheet->setCellValue('G1', "Model"); //
$sheet->setCellValue('H1', "AdditionalModels"); //  
$sheet->setCellValue('I1', "Status"); // 	
$sheet->setCellValue('J1', "Description"); // 

$sheet->setCellValue('K1', "StockQuantity"); // 
$sheet->setCellValue('L1', "VatIncludedinSellPrice"); // 	
$sheet->setCellValue('M1', "SellPrice"); // 
$sheet->setCellValue('N1', "VatIncludedinCostPrice"); //  
$sheet->setCellValue('O1', "CostPrice"); // 	
$sheet->setCellValue('P1', "AlertQuantity"); //

$sheet->setCellValue('Q1', "Discountable"); // 	
$sheet->setCellValue('R1', "VATPercentage"); // 	
$sheet->setCellValue('S1', "Supplier"); // 	
$sheet->setCellValue('T1', "ReorderQuantity"); // 	
$sheet->setCellValue('U1', "SupplierCode"); // 	
$sheet->setCellValue('V1', "EmailToSupplier"); // 	

$sheet->setCellValue('W1', "PhysicalLocation"); // 	
$sheet->setCellValue('X1', "Warranty"); // 	
$sheet->setCellValue('Y1', "DatewhenShippedBacktous"); // 	
$sheet->setCellValue('Z1', "SerialisedStock"); // 	
$sheet->setCellValue('AA1', "CrossSelling"); // 	
$sheet->setCellValue('AB1', "UpSelling"); // 	
$sheet->setCellValue('AC1', "DisplayOn"); // 	
$sheet->setCellValue('AD1', "AutoCalculatePrice"); // 

$sheet->setCellValue('AE1', "WeightAveragedStock"); // 
$sheet->setCellValue('AF1', "TagAlong"); // 
$sheet->setCellValue('AG1', "InternalNotes"); // 
$sheet->setCellValue('AH1', "HandleidingURL"); // 
$sheet->setCellValue('AI1', "AutoType"); // 

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


    $sheet->setCellValue('A'.$row, "Service / Labor"); // Service / Labor
    $sheet->setCellValue('B'.$row, "$title"); //
    $sheet->setCellValue('C'.$row, "New"); //
    $sheet->setCellValue('D'.$row, "$ref"); // 
    $sheet->setCellValue('E'.$row, ""); //
    $sheet->setCellValue('F'.$row, "$brand"); //
    $sheet->setCellValue('G'.$row, "$model"); //
    $sheet->setCellValue('H'.$row, ""); //  
    $sheet->setCellValue('I'.$row, "0"); // 	
    $sheet->setCellValue('J'.$row, "$complain_desc"); // 
    
    $sheet->setCellValue('K'.$row, "$stock"); // 
    $sheet->setCellValue('L'.$row, "$price_inc"); // 	
    $sheet->setCellValue('M'.$row, "$price_ex"); // 
    $sheet->setCellValue('N'.$row, "-"); //  
    $sheet->setCellValue('O'.$row, "0"); // 	
    $sheet->setCellValue('P'.$row, "25"); //
    
    $sheet->setCellValue('Q'.$row, "0"); //  Discountable	
    $sheet->setCellValue('R'.$row, "21"); // VATPercentage	
    $sheet->setCellValue('S'.$row, "xxx"); // 	Supplier
    $sheet->setCellValue('T'.$row, "25"); // ReorderQuantity 	
    $sheet->setCellValue('U'.$row, "xxx"); // 	SupplierCode
    $sheet->setCellValue('V'.$row, "0"); // EmailToSupplier	
    
    $sheet->setCellValue('W'.$row, ""); // 	
    $sheet->setCellValue('X'.$row, "1 Year"); // 	
    $sheet->setCellValue('Y'.$row, ""); // 	
    $sheet->setCellValue('Z'.$row, ""); // 	
    $sheet->setCellValue('AA'.$row, ""); // 	
    $sheet->setCellValue('AB'.$row, ""); // 	
    $sheet->setCellValue('AC'.$row, "All"); // 	
    $sheet->setCellValue('AD'.$row, "0"); // 
    
    $sheet->setCellValue('AE'.$row, "0"); // 
    $sheet->setCellValue('AF'.$row, "$ref"); // 
    $sheet->setCellValue('AG'.$row, ""); // 
    $sheet->setCellValue('AH'.$row, ""); // 
    $sheet->setCellValue('AI'.$row, "$model"); // 
};

$writer = new Xls($spreadsheet);  

$writer->save('services_'.$today.'-'.$time.'.xls');

$filename = "services_$today-$time.xls";

$sql2 = "INSERT INTO exports (file_name, file_link, extension) VALUES ('$filename', 'http://localhost/kms-apeldoorn.nl/api/mgr/spreadsheet/$filename', '.xls')";

if (mysqli_query($i_conn, $sql2)) 
{
    ?>
        <script>
            window.location.replace('http://127.0.0.1:8000/activity');
        </script>   
    <?php
}
