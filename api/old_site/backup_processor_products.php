<?php
require_once 'vendor/autoload.php';
include "../db.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

$filename = 'producten_backup_server.xlsx';
$spreadsheet = IOFactory::load($filename);

$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();


$needle = "reparatie";

foreach ($rows as $row) {
    $product_name = strtolower($row[1]);
    if (!str_contains($product_name, $needle)) 
    {
        // insert reparatie
        // var_dump($row);


        $product = mysqli_real_escape_string($i_conn, $row[1]);     
        $code = $row[2];
        $prijs = $row[5];
        $prijs = mysqli_real_escape_string($i_conn,str_replace("€","",$prijs));
        $prijs = (int)$prijs;
        $locatie = $row[6];
        $ref = $row[2];
        $revision_desc = mysqli_real_escape_string($i_conn, $row[1]);     
        $prijsonepercent = $prijs / 100;
        $btwprijs = $prijsonepercent * 21;


        $assigned_to = '';
        $price_ex_btw = $row[5]; // PRICE EX BTW
        $btw = 21; 
        $price_inc_btw = $prijs - $btwprijs;
        $in_stock = 0; // BESCHIKBAAR
        $stock = 0; // IN STOCK VIRTUAAL
        $brand_id = NULL;
        $model_id = '';
        $revision_id = 0;
        $brand = "";

        $query1113 = "SELECT * FROM revisions WHERE ref LIKE '%$ref%'";

        $data1113=mysqli_query($i_conn,$query1113);   

        while($row1113=mysqli_fetch_array($data1113))
        {
            $revision_id = $row1113['id'];
        };

        if($revision_id != "")
        {

            $query1114 = "SELECT * FROM revision_models WHERE revision_id='$revision_id'";

            $data1114=mysqli_query($i_conn,$query1114);   
    
            while($row1114=mysqli_fetch_array($data1114))
            {
                $brand_id = $row1114['brand_id'];
                $model_id = $row1114['model_id'];
            };

            $partid = "";

            $query1114x = "SELECT * FROM car_model_type_variant_parts WHERE name LIKE '%$product%'";

            $data1114x=mysqli_query($i_conn,$query1114x);   
    
            while($row1114x=mysqli_fetch_array($data1114x))
            {
                $partid = $row1114x['id'];
            };

            if($partid != "")
            {
                $sql2 = "INSERT INTO car_model_type_variant_parts (brand_id, model_id, ref, code, name, purchase_price, purchase_price_inc_vat, stock, stock_location) VALUES ('$brand_id', '$model_id', '$ref', '$ref', '$product', '0', '0', '1', '$locatie')";
                if (mysqli_query($i_conn, $sql2)) 
                {
                    $last_id = mysqli_insert_id($i_conn);
                    echo "+ Het onderdeel $product is toegevoegd in de database in relatie met de auto en het model<br/>";

                    $sql2 = "INSERT INTO revision_parts (revision_id, part_id) VALUES ('$revision_id', '$last_id')";
                    if (mysqli_query($i_conn, $sql2)) 
                    {
                        echo "+ Het onderdeel is in relatie gebracht met een reparatie<br/>";
                    }
                }
            }
            else
            {
                echo "-- Dit onderdeel $product is al bekend in onze database <br/>";
            }

        }
        else
        {
            $query1114x = "SELECT * FROM car_model_type_variant_parts WHERE name LIKE '%$product%'";

            $data1114x=mysqli_query($i_conn,$query1114x);   
    
            while($row1114x=mysqli_fetch_array($data1114x))
            {
                $partid = $row1114x['id'];
            };

            if($partid != "")
            {
                $sql2 = "INSERT INTO car_model_type_variant_parts (brand_id, model_id, ref, code, name, purchase_price, purchase_price_inc_vat, stock, stock_location) VALUES ('0', '0', '$ref', '$ref', '$product', '0', '0', '1', '$locatie')";
                if (mysqli_query($i_conn, $sql2)) 
                {
                    echo "+ Het onderdeel $product is toegevoegd in de database <br/>";
                }
            }
            else
            {
                echo "-- Dit onderdeel $product is al bekend in onze database <br/>";
            }

        }
        
    }
}

