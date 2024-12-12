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



$sheet->setCellValue('A1', "Ticket nr."); //
$sheet->setCellValue('B1', "Kenteken"); // 	
$sheet->setCellValue('C1', "Klant"); //
$sheet->setCellValue('D1', "Bedrijf"); //
$sheet->setCellValue('E1', "E-mail"); // 
$sheet->setCellValue('F1', "Telefoonnummer"); //
$sheet->setCellValue('G1', "Adres"); //
$sheet->setCellValue('H1', "Reparatie"); //
$sheet->setCellValue('I1', "Status"); //  
$sheet->setCellValue('J1', "Collega"); // 	
$sheet->setCellValue('K1', "Automerk"); // 
$sheet->setCellValue('L1', "Model"); // 	

$query1113 = "SELECT * FROM customer_revisions";

$data1113=mysqli_query($i_conn,$query1113);   

while($row_data=mysqli_fetch_array($data1113))
{
    $brand = "";
    $companyname = "";
    $row = $row + 1;
    $revision_id = $row_data['revision_id'];

    $query11345 = "SELECT * FROM revisions WHERE id='$revision_id'";

    $data11345=mysqli_query($i_conn,$query11345);   

    while($row_data2=mysqli_fetch_array($data11345))
    {
        $title = $row_data2['title'];
    };

    $query1134512 = "SELECT * FROM revision_models WHERE revision_id='$revision_id'";

    $data1134512=mysqli_query($i_conn,$query1134512);   

    while($row_data212=mysqli_fetch_array($data1134512))
    {
        $model_id = $row_data212['model_id'];

        $query13456 = "SELECT * FROM car_brand_models WHERE id='$model_id'";

        $data13456=mysqli_query($i_conn,$query13456);   

        while($row_data2=mysqli_fetch_array($data13456))
        {
            $model = $row_data2['model'];
        };
    };


    $ticket_no = $row_data['ticket_no'];
    $brand_id = $row_data['brand_id'];

    $query1345 = "SELECT * FROM car_brands WHERE id='$brand_id'";

    $data1345=mysqli_query($i_conn,$query1345);   

    while($row_data1=mysqli_fetch_array($data1345))
    {
        $brand = $row_data1['brand'];
    };

    $customer_id = $row_data['customer_id'];

    $query11134 = "SELECT * FROM customers WHERE id='$customer_id'";

    $data11134=mysqli_query($i_conn,$query11134);   

    while($row_data4=mysqli_fetch_array($data11134))
    {
        $firstname = $row_data4['firstname'];
        $lastname = $row_data4['lastname'];
        $email = $row_data4['email'];
        $phonenr = $row_data4['phonenr'];
        $address = $row_data4['address'];
        $zipcode = $row_data4['zipcode'];
        $city = $row_data4['city'];
        $country = $row_data4['country'];
    };

    $query111345 = "SELECT * FROM customer_companies WHERE customer_id='$customer_id'";

    $data111345=mysqli_query($i_conn,$query111345);   

    while($row_data3=mysqli_fetch_array($data111345))
    {
        $company_name = $row_data3['company_name'];
    };

    $user_id_assigned = $row_data['user_id_assigned'];
    
    $query111345 = "SELECT * FROM users WHERE id='$user_id_assigned'";

    $data111345=mysqli_query($i_conn,$query111345);   

    while($row_data3=mysqli_fetch_array($data111345))
    {
        $user_name = $row_data3['name'];
    };


    $license_plate = "";

    $query111345cs = "SELECT * FROM license_plate WHERE ticket_no='$ticket_no'";

    $data111345cs=mysqli_query($i_conn,$query111345cs);   

    while($row_data3cs=mysqli_fetch_array($data111345cs))
    {
        $license_plate = $row_data3cs['license_plate'];
    };


    $start = $row_data['start'];
    $end = $row_data['end'];
    $status = $row_data['status'];
    $sales_price = $row_data['sales_price'];

    $sheet->setCellValue('A'.$row, "$ticket_no"); //
    $sheet->setCellValue('B'.$row, "$license_plate"); // 	Kenteken
    $sheet->setCellValue('C'.$row, "$firstname $lastname"); //
    $sheet->setCellValue('D'.$row, "$company_name"); //
    $sheet->setCellValue('E'.$row, "$email"); //
    $sheet->setCellValue('F'.$row, "$phonenr"); //
    $sheet->setCellValue('G'.$row, "$address - $zipcode, $city"); //
    $sheet->setCellValue('H'.$row, "$title"); //  
    $sheet->setCellValue('I'.$row, "$status"); // 
    $sheet->setCellValue('J'.$row, "$user_name"); //  
    $sheet->setCellValue('K'.$row, "$brand"); // Merk
    $sheet->setCellValue('L'.$row, "$model"); // Modelentype	

};

$writer = new Xls($spreadsheet);  

$writer->save('tickets_'.$today.'-'.$time.'.xls');

$filename = "tickets_$today-$time.xls";

$sql2 = "INSERT INTO exports (file_name, file_link, extension) VALUES ('$filename', 'http://localhost/kms-apeldoorn.nl/api/spreadsheet/$filename', '.xls')";
if (mysqli_query($i_conn, $sql2)) 
{
    ?>
        <script>
            window.location.replace('http://127.0.0.1:8000/activity');
        </script>   
    <?php
}
