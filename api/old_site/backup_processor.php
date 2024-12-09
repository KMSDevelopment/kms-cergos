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
    if (str_contains($product_name, $needle)) 
    {
        echo $row[1];
        // insert reparatie
        // var_dump($row);

        $productnaam = mysqli_real_escape_string($i_conn, $row[1]);     
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

        $query1113 = "SELECT * FROM revisions WHERE ref='$ref' OR title LIKE '%$reparatie%'";

        $data1113=mysqli_query($i_conn,$query1113);   

        while($row1113=mysqli_fetch_array($data1113))
        {
            $revision_id = $row1113['id'];
        };


        if($revision_id == 0)
        {
            echo"
                <h5>$reparatie</h5>
                <p>
                    Klachtomschrijving: $revision_desc <br/>
                    Referentie: $ref <br/>
                    reparatie omschrijving: $revision_desc <br/>
                    Prijs ex: $price_ex_btw <br/>
                    Prijs inc: $price_inc_btw <br/>
                </p>
                <br/>
            ";

            $query112 = "SELECT * FROM car_brands WHERE brand != 'Haima' AND brand != 'Infiniti'";

            $data112=mysqli_query($i_conn,$query112);   

            while($row112=mysqli_fetch_array($data112))
            {
                $brand = $row112['brand'];

                if( strpos( $reparatie, $brand ) !== false) {
                    $brand_id = $row112['id'];
                    echo"$brand gevonden ----<br/>";
                }
            };

            $sql = "INSERT INTO revisions (api_id, ref, title, complain_desc, revision_desc, price_ex, price_inc) VALUES ('$api_id', '$ref', '$reparatie', '$complain_desc', '$revision_desc', '$price_ex_btw', '$price_inc_btw')";

            if (mysqli_query($i_conn, $sql)) 
            {
                $last_id = mysqli_insert_id($i_conn);
                echo"+ Reparatie $odoo_id toegevoegd aan onze database <br/>";

                if($brand_id != NULL)
                {

                    $query112 = "SELECT * FROM car_brands";

                    $data112=mysqli_query($i_conn,$query112);   

                    while($row112=mysqli_fetch_array($data112))
                    {
                        $model_id = "";
                        $brand = $row112['brand'];

                        if( strpos( $reparatie, $brand ) !== false) {
                            $brand_id = $row112['id'];
                            $model_id = "";

                            echo"! Er is een merk gevonden in de titel van deze reparatie: $brand <br/>";

                            $query11 = "SELECT * FROM car_brand_models WHERE brand_id='$brand_id'";

                            $data11=mysqli_query($i_conn,$query11);   

                            while($row11=mysqli_fetch_array($data11))
                            {
                                $model = $row11['model'];
                                
                                if( strpos( $reparatie, $model ) !== false) {
                                    $model_id = $row11['id'];
                                }
                            };

                            $sql2 = "INSERT INTO revision_models (revision_id, brand_id, model_id) VALUES ('$last_id', '$brand_id', '$model_id')";
                            if (mysqli_query($i_conn, $sql2)) 
                            {
                                echo "+ Het merk $brand is toegevoegd in de database in relatie met de bovenstaande reparatie<br/>";
                            }
                        }
                    };

                    
                }
            }
            

            echo"<Br/><br/>";
        }
        else
        {
            echo"-- Deze reparatie is al bekend in onze database <br/>";
        }
        
    }
}

