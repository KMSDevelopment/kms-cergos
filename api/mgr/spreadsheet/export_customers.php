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


$sheet->setCellValue('A1', "Company"); //
$sheet->setCellValue('B1', "Name"); //
$sheet->setCellValue('C1', "Email"); //
$sheet->setCellValue('D1', "InvoiceEmail"); // 
$sheet->setCellValue('E1', "Telephone"); //
$sheet->setCellValue('F1', "Mobile"); //
$sheet->setCellValue('G1', "FullAddress"); //
$sheet->setCellValue('H1', "ShippingAddress"); //  
$sheet->setCellValue('I1', "City"); // 	
$sheet->setCellValue('J1', "CountryCode"); // 	


$sheet->setCellValue('K1', "BirthDate"); // 
$sheet->setCellValue('L1', "CustomerGroup"); // 	
$sheet->setCellValue('M1', "Latitude"); // 
$sheet->setCellValue('N1', "Longitude"); //  
$sheet->setCellValue('O1', "Gender"); // 	
$sheet->setCellValue('P1', "RefferedBy"); // 	
$sheet->setCellValue('Q1', "AccountManager"); // 	
$sheet->setCellValue('R1', "PaymentTermDays"); // 	
$sheet->setCellValue('S1', "PaymentTermDueEachMonth"); // 

$sheet->setCellValue('T1', "PaymentTermDueNextMonth"); // 	
$sheet->setCellValue('U1', "Profile"); // 	
$sheet->setCellValue('V1', "GDPRCompliant"); // 	
$sheet->setCellValue('W1', "SmsService"); // 	


$sheet->setCellValue('X1', "PrintMedia"); // 	
$sheet->setCellValue('Y1', "EmailMarketing"); // 	
$sheet->setCellValue('Z1', "EmailNotifications"); // 	
$sheet->setCellValue('AA1', "IntraCommunity"); // 	
$sheet->setCellValue('AB1', "VATPercentage"); // 	
$sheet->setCellValue('AC1', "Prijsafspraak"); // 	

$row = 1; // 1-based index

$query1113 = "SELECT * FROM customers";

$data1113=mysqli_query($i_conn,$query1113);   

while($row_data=mysqli_fetch_array($data1113))
{
    $customer_id = "";
    $invoice_email = "";
    $company_name = "";
    $row = $row + 1;

    $customer_id = $row_data['id'];
    $odoo_id = $row_data['odoo_id'];
    $mgr_id = $row_data['mgr_id'];

    if($odoo_id == NULL)
    {
        $customer_ref = $mgr_id;
    }
    else
    {
        $customer_ref = $odoo_id;
    }

    $reference = $row_data['reference'];
    $firstname = $row_data['firstname'];
    $middlename = $row_data['middlename'];
    $lastname = $row_data['lastname'];
    $gender = $row_data['gender'];
    $birthdate = $row_data['birthdate'];
    $email = $row_data['email'];
    $phonenr = $row_data['phonenr'];
    $address = $row_data['address'];
    $housenr = $row_data['housenr'];
    $zipcode = $row_data['zipcode'];
    $city = $row_data['city'];
    $country = $row_data['country'];

    $query11134 = "SELECT * FROM customer_companies WHERE customer_id='$customer_id'";

    $data11134=mysqli_query($i_conn,$query11134);   

    while($row_data4=mysqli_fetch_array($data11134))
    {
        $company_name = $row_data4['company_name'];
        $invoice_email = $row_data4['invoice_email'];
    };
    
    $sheet->setCellValue('A'.$row, "$company_name"); //
    $sheet->setCellValue('B'.$row, "$firstname $middlename $lastname"); //
    $sheet->setCellValue('C'.$row, "$email"); //
    $sheet->setCellValue('D'.$row, "$invoice_email"); // 
    $sheet->setCellValue('E'.$row, "$phonenr"); //
    $sheet->setCellValue('F'.$row, ""); //
    $sheet->setCellValue('G'.$row, "$address $zipcode $city"); //
    $sheet->setCellValue('H'.$row, ""); //  
    $sheet->setCellValue('I'.$row, "$city"); // 	
    $sheet->setCellValue('J'.$row, "NL"); // 	
    $sheet->setCellValue('K'.$row, "$birthdate"); // 
    $sheet->setCellValue('L'.$row, ""); // 	
    $sheet->setCellValue('M'.$row, ""); // 
    $sheet->setCellValue('N'.$row, ""); //  
    $sheet->setCellValue('O'.$row, "$gender"); // 	
    $sheet->setCellValue('P'.$row, ""); // 	
    $sheet->setCellValue('Q'.$row, ""); // 	
    $sheet->setCellValue('R'.$row, ""); // 	
    $sheet->setCellValue('S'.$row, ""); // 
    $sheet->setCellValue('T'.$row, ""); // 	
    $sheet->setCellValue('U'.$row, ""); // 	
    $sheet->setCellValue('V'.$row, ""); // 	
    $sheet->setCellValue('W'.$row, ""); // 	
    $sheet->setCellValue('X'.$row, ""); // 	
    $sheet->setCellValue('Y'.$row, ""); // 	
    $sheet->setCellValue('Z'.$row, ""); // 	
    $sheet->setCellValue('AA'.$row, ""); // 	
    $sheet->setCellValue('AB'.$row, "21"); // 	
    $sheet->setCellValue('AC'.$row, ""); // 	

    

};

$writer = new Xls($spreadsheet);  

$writer->save('customers_'.$today.'-'.$time.'.xls');

$filename = "customers_$today-$time.xls";

$sql2 = "INSERT INTO exports (file_name, file_link, extension) VALUES ('$filename', 'http://localhost/kms-apeldoorn.nl/api/mgr/spreadsheet/$filename', '.xls')";
if (mysqli_query($i_conn, $sql2)) 
{
    ?>
        <script>
            window.location.replace('http://127.0.0.1:8000/activity');
        </script>   
    <?php
}
