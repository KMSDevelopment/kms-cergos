<?php
require_once 'vendor/autoload.php';
include "../../db.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

$filename = 'models.xlsx';
$spreadsheet = IOFactory::load($filename);

$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();
$count = 0;
$today = date('d-m-Y H:i');

foreach($rows as $row)
{
    $count = $count + 1;
    $model = mysqli_real_escape_string($i_conn, $row[0]);
    $brand = mysqli_real_escape_string($i_conn, $row[2]);

    if($count > 1)
    {
        $brand_id = "";
        $model_id = "";

        $query1113 = "SELECT * FROM car_brands WHERE brand LIKE '%$brand%'";

        $data1113=mysqli_query($i_conn,$query1113);   

        while($row1113=mysqli_fetch_array($data1113))
        {
            $brand_id = $row1113['id'];
        };

        
        $query11133 = "SELECT * FROM car_brand_models WHERE model LIKE '%$model%'";

        $data11133=mysqli_query($i_conn,$query11133);   

        while($row11133=mysqli_fetch_array($data11133))
        {
            $model_id = $row11133['id'];
        };

        if($model_id != "")
        {
            echo"$brand (id: $brand_id) - $model FOUND<br/>";
        }
        else
        {
            $sql2 = "INSERT INTO car_brand_models (brand_id, api_id, model) VALUES ('$brand_id', '4', '$model')";
            if (mysqli_query($i_conn, $sql2)) 
            {
                $userid = mysqli_insert_id($i_conn);
                echo"$brand (id: $brand_id) - $model <br/>";
                echo "+ $model is toegevoegd aan onze database<br/>";
            }
        }
    }
}