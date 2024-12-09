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
$needle2 = "bijkomende klacht";
$needle3 = "bijkomende probleem";

foreach ($rows as $row) {
    $product_name = strtolower($row[1]);
    if (!str_contains($product_name, $needle)) 
    {
        if (!str_contains($product_name, $needle2)) 
        {
            if (!str_contains($product_name, $needle3)) 
            {
                $revision_id = "";
                // insert part
                $product = mysqli_real_escape_string($i_conn, $row[1]);
                $location = mysqli_real_escape_string($i_conn, $row[2]);
                $odoo_id = mysqli_real_escape_string($i_conn, $row[3]);
                $ref = str_replace("cergos00000", "", $odoo_id);
                $kostprijs = mysqli_real_escape_string($i_conn, $row[7]);
                $kostprijs_incbtw = (int)$kostprijs * 1.21;
                $in_stock = mysqli_real_escape_string($i_conn, $row[8]);
                $ref = trim($ref);

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

                        $sql2 = "INSERT INTO car_model_type_variant_parts (brand_id, model_id, ref, code, name, purchase_price, purchase_price_inc_vat, stock, stock_location) VALUES ('$brand_id', '$model_id', '$ref', '$odoo_id', '$product', '$kostprijs', '$kostprijs_incbtw', '$in_stock', '$location')";
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
                    };
                }
                else
                {
                    $sql2 = "INSERT INTO car_model_type_variant_parts (brand_id, model_id, ref, code, name, purchase_price, purchase_price_inc_vat, stock, stock_location) VALUES ('0', '0', '$ref', '$odoo_id', '$product', '$kostprijs', '$kostprijs_incbtw', '$in_stock', '$location')";
                    if (mysqli_query($i_conn, $sql2)) 
                    {
                        echo "+ Het onderdeel $product is toegevoegd in de database <br/>";
                    }
                }
            }
        }
    }
}