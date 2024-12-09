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

require_once 'vendor/autoload.php';
include "../db.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

$filename = 'files/tickets.xlsx';
$spreadsheet = IOFactory::load($filename);

$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();

foreach ($rows as $row) {

    $revision_id = "";
    $brand_id = "";
    $customer_id = "";
    $model_id = "";
    $revision_model_id = "";
    $brand_model_id = "";

    $ticket_no = $row[0];
    $kenteken = $row[3];

    if($kenteken != "")
    {
        $query1113 = "SELECT * FROM customer_revisions WHERE ticket_no='$ticket_no'";

        $data1113=mysqli_query($i_conn,$query1113);   

        while($row1113=mysqli_fetch_array($data1113))
        {
            $revision_id = $row1113['revision_id'];
            $brand_id = $row1113['brand_id'];
            $customer_id = $row1113['customer_id'];
        };

        $q1113 = "SELECT * FROM revision_models WHERE revision_id='$ticket_no' AND brand_id='$brand_id'";

        $d113=mysqli_query($i_conn,$q1113);   

        while($r13=mysqli_fetch_array($d113))
        {
            $revision_model_id = $r13['id'];
            $model_id = $r13['model_id'];
        };

        $q1113 = "SELECT * FROM car_brand_models WHERE id='$model_id'";

        $d113=mysqli_query($i_conn,$q1113);   

        while($r13=mysqli_fetch_array($d113))
        {
            $brand_model_id = $r13['id'];
        };

        $sql2 = "INSERT INTO license_plate (ticket_no, license_plate, brand_id, brand_model_id, revision_id, revision_model_id, customer_id) VALUES ('$ticket_no', '$kenteken', '$brand_id','$brand_model_id','$revision_id','$revision_model_id','$customer_id')";
        if (mysqli_query($i_conn, $sql2)) 
        {
            echo "+ Het kenteken $kenteken is toegevoegd in de database en relatie met de klant, een merk en een model<br/>";
        }
    }

}



