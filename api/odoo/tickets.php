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

$query = "SELECT * FROM apis WHERE active=1";

$data=mysqli_query($i_conn,$query);   

while($row=mysqli_fetch_array($data))
{
    $api_id = $row['id'];
    $endpoint = $row['endpoint'];
    $credentials = $row['credentials'];
    $count = 0;
    // var_dump($row);

    if($endpoint == "http://localhost/kms-apeldoorn.nl/api/odoo/revisions.php")
    {
        foreach ($rows as $row) 
        {
            $count = $count + 1;

            if($count > 1){
                $odoo_id = mysqli_real_escape_string($i_conn, $row[0]);
                $ref = substr($odoo_id, 2);

                $created = mysqli_real_escape_string($i_conn, $row[1]);
                $customer = mysqli_real_escape_string($i_conn, $row[2]);
                $kenteken = mysqli_real_escape_string($i_conn, $row[3]);
                $assigned_to = mysqli_real_escape_string($i_conn, $row[4]);
                $activities = mysqli_real_escape_string($i_conn, $row[5]);
                $costs = mysqli_real_escape_string($i_conn, $row[6]);
                $status = mysqli_real_escape_string($i_conn, $row[7]);
                $customer_id = '';
                $revision_id = '';
                echo"
                    $odoo_id <br/>
                    $ref<br/>
                    $created <br/>
                    $customer <br/>
                    $kenteken <br/>
                    $assigned_to<br/>
                    $costs<br/>
                    $status<br/>
                ";

                

                $query1113 = "SELECT * FROM customers WHERE firstname LIKE '%$customer%' OR lastname LIKE '%$customer%'";

                $data1113=mysqli_query($i_conn,$query1113);   

                while($row1113=mysqli_fetch_array($data1113))
                {
                    $customer_id = $row1113['id'];
                    $firstname = $row1113['firstname'];
                    $lastname = $row1113['lastname'];
                };

                if($customer_id != "")
                {
                    echo"klant gevonden met id $customer_id: $firstname $lastname<br/>";
                }
                else
                {
                    $query11134 = "SELECT * FROM customer_companies WHERE company_name LIKE '%$customer%'";

                    $data11134=mysqli_query($i_conn,$query11134);   

                    while($row11134=mysqli_fetch_array($data11134))
                    {
                        $company_id = $row11134['id'];
                        $customer_id = $row11134['customer_id'];
                    };

                    if($company_id != "")
                    {
                        echo"Bedrijf gevonden met id $customer_id: $customer en bedrijfsid $company_id<br/>";
                    }
                }

                $query11135 = "SELECT * FROM revisions WHERE ref='$ref'";

                $data11135=mysqli_query($i_conn,$query11135);   

                while($row11135=mysqli_fetch_array($data11135))
                {
                    $revision_id = $row11135['id'];
                };

                $query111356 = "SELECT * FROM revision_models WHERE revision_id='$revision_id' LIMIT 1";

                $data111356=mysqli_query($i_conn,$query111356);   

                while($row111356=mysqli_fetch_array($data111356))
                {
                    $brand_id = $row111356['brand_id'];
                };

                if($revision_id != "")
                {
                    echo"Reparaties gevonden met id: $revision_id<br/>";
                }

                $userid = "";

                $query111356 = "SELECT * FROM users WHERE name='$assigned_to'";

                $data111356=mysqli_query($i_conn,$query111356);   

                while($row111356=mysqli_fetch_array($data111356))
                {
                    $userid = $row111356['id'];
                };

                if($userid == "")
                {
                    //$2y$12$9ixJhtEUCiGf/WUYFLeWbe9U8e7ZflKCa8z19dmsNl2lBgypCrfRy = @kmsapeldoorn
                    
                    $nameparts = explode(' ', $assigned_to,2);
                    $firstname = mysqli_real_escape_string($i_conn, $nameparts[0]);
                    $email = $firstname."@kmsapeldoorn.nl";

                    $sql2 = "INSERT INTO users (name, email, password) VALUES ('$assigned_to', '$email', '$2y$12$9ixJhtEUCiGf/WUYFLeWbe9U8e7ZflKCa8z19dmsNl2lBgypCrfRy')";
                    if (mysqli_query($i_conn, $sql2)) 
                    {
                        $userid = mysqli_insert_id($i_conn);
                        echo "+ $assigned_to is toegevoegd als gebruiker aan de database<br/>";
                    }
                }


                $sql25 = "INSERT INTO customer_revisions (revision_id, api_id, ticket_no, odoo_id, brand_id, customer_id, user_id_assigned, start, status, sales_price) VALUES ('$revision_id', '$api_id', '$odoo_id', '$ref', '$brand_id', '$customer_id', '$userid', '$created', '$status', '$costs')";
                if (mysqli_query($i_conn, $sql25)) 
                {
                    echo "+ Ticket $odoo_id is toegevoegd aan de database<br/>";
                }

                echo"<Br/><br/>";
            }
        }
    }
};