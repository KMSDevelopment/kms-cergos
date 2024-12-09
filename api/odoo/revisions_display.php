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

                $reparatie = $row[1];
                $complain_desc = getStringBetween($reparatie,$from,$to);
                $odoo_id = $row[2];
                $ref = str_replace("cergos00000", "", $odoo_id);
                $revision_desc = "$odoo_id <br/> $reparatie";
                $assigned_to = $row[3];
                $price_ex_btw = $row[5]; // PRICE EX BTW
                $btw = 21; 
                $price_inc_btw = $price_ex_btw * 1.21;
                $in_stock = $row[7]; // BESCHIKBAAR
                $stock = $row[8]; // IN STOCK VIRTUAAL
                $brand_id = NULL;
                $model_id = '-';
                $revision_id = 0;

                $query1113 = "SELECT * FROM revisions WHERE ref='$ref' OR title LIKE '%$reparatie%'";

                $data1113=mysqli_query($i_conn,$query1113);   

                while($row1113=mysqli_fetch_array($data1113))
                {
                    $revision_id = $row1113['id'];
                };

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
                ";
                
            }
        }
    }
};



function getStringBetween($str,$from,$to)
{
    $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
    return substr($sub,0,strpos($sub,$to));
}