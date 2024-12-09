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

$filename = 'files/products.xlsx';
$spreadsheet = IOFactory::load($filename);

$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();
$needle = "reparatie";

$from = "(";
$to = ")";

$query = "SELECT * FROM apis WHERE active=1";

$data=mysqli_query($i_conn,$query);   

while($row=mysqli_fetch_array($data))
{
    $api_id = $row['id'];
    $endpoint = $row['endpoint'];
    $credentials = $row['credentials'];

    if($endpoint == "http://localhost/kms-apeldoorn.nl/api/odoo/revisions.php")
    {
        foreach ($rows as $row) {
            $product_name = strtolower($row[1]);
            if (str_contains($product_name, $needle)) 
            {
                // insert reparatie
                // var_dump($row);

                $reparatie = mysqli_real_escape_string($i_conn, $row[1]);
                $complain_desc = mysqli_real_escape_string($i_conn, getStringBetween($reparatie,$from,$to));
                $odoo_id = $row[2];
                $ref = str_replace("cergos00000", "", $odoo_id);
                $revision_desc = mysqli_real_escape_string($i_conn, "$odoo_id <br/> $reparatie");
                $assigned_to = $row[3];
                $price_ex_btw = $row[5]; // PRICE EX BTW
                $btw = 21; 
                $price_inc_btw = $price_ex_btw * 1.21;
                $in_stock = $row[7]; // BESCHIKBAAR
                $stock = $row[8]; // IN STOCK VIRTUAAL
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
                            Klachtomschrijving: $complain_desc <br/>
                            Referentie: $ref <br/>
                            Odoo id: $odoo_id <br/>
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

                    $reparatie = mysqli_real_escape_string($i_conn, $reparatie);
                    $complain_desc = mysqli_real_escape_string($i_conn, $complain_desc);
                    $revision_desc = mysqli_real_escape_string($i_conn, $revision_desc);



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
    }
};



function getStringBetween($str,$from,$to)
{
    $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
    return substr($sub,0,strpos($sub,$to));
}