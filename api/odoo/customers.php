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

$filename = 'files/customers.xlsx';
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


    // foreach ($rows as $row) 
    // {
    //     $customer_name = $row[0];
    //     $customer_name_check = strtolower($row[0]);
    //     $email = strtolower($row[2]);

    //     var_dump($row);

    // }


    if($endpoint == "http://localhost/kms-apeldoorn.nl/api/odoo/customers.php")
    {
        foreach ($rows as $row) 
        {
            $count = $count + 1;
            if($count > 1){
                $customer_name = mysqli_real_escape_string($i_conn, $row[0]);
                $phonenr = mysqli_real_escape_string($i_conn, $row[1]);
                $email = mysqli_real_escape_string($i_conn, $row[2]);

                $verkoper = mysqli_real_escape_string($i_conn, $row[4]);
                $activiteiten = mysqli_real_escape_string($i_conn, $row[5]);

                $postcode = mysqli_real_escape_string($i_conn, $row[3]);
                $plaats = mysqli_real_escape_string($i_conn, $row[6]);
                $land = mysqli_real_escape_string($i_conn, $row[7]);

                $customer_name_check = strtolower($row[0]);
                $email = strtolower($row[2]);

                if (str_contains($email, "@hotmail") && !str_contains($customer_name_check, "garage") && !str_contains($customer_name_check, "auto") && !str_contains($customer_name_check, "specialist") && !str_contains($customer_name_check, "handel") && !str_contains($customer_name_check, "car") && !str_contains($customer_name_check, "vof") && !str_contains($customer_name_check, "motor")) 
                {
                    $nameparts = explode(' ', $customer_name,2);
                    $firstname = mysqli_real_escape_string($i_conn, $nameparts[0]);
                    $last_name = mysqli_real_escape_string($i_conn, $nameparts[1]);
                    // = particulier
                    $customer_id = 0;

                    $query11 = "SELECT * FROM customers WHERE email LIKE '%$email%' OR firstname LIKE '%$firstname%' AND lastname LIKE '%$last_name%'";

                    $data11=mysqli_query($i_conn,$query11);   

                    while($row11=mysqli_fetch_array($data11))
                    {
                        $customer_id = $row11['id'];
                    };

                    if($customer_id == 0)
                    {
                        $sql = "INSERT INTO customers (api_id, reference, odoo_id, firstname, middlename, lastname, email, phonenr, address, zipcode, city, country) VALUES ('$api_id', '$verkoper', '$activiteiten', '$firstname', '', '$last_name', '$email', '$phonenr', '', '$postcode', '$plaats', '$land')";
                        if (mysqli_query($i_conn, $sql)) 
                        {
                            $last_id = mysqli_insert_id($i_conn);
                            echo"+ Klant $firstname $last_name toegevoegd aan de database (Particulier)<br/><Br/>";
                        }
                    }
                    else
                    {
                        echo"-- Klant $firstname $last_name bestaat al in onze database<br/><Br/>";
                    }

                }
                else if (str_contains($email, "@outlook") && !str_contains($customer_name_check, "garage") && !str_contains($customer_name_check, "auto") && !str_contains($customer_name_check, "specialist") && !str_contains($customer_name_check, "handel") && !str_contains($customer_name_check, "car") && !str_contains($customer_name_check, "vof") && !str_contains($customer_name_check, "motor")) 
                {
                    $nameparts = explode(' ', $customer_name,2);
                    $firstname = mysqli_real_escape_string($i_conn, $nameparts[0]);
                    $last_name = mysqli_real_escape_string($i_conn, $nameparts[1]);
                    // = particulier

                    $customer_id = 0;

                    $query11 = "SELECT * FROM customers WHERE email LIKE '%$email%' OR firstname LIKE '%$firstname%' AND lastname LIKE '%$last_name%'";

                    $data11=mysqli_query($i_conn,$query11);   

                    while($row11=mysqli_fetch_array($data11))
                    {
                        $customer_id = $row11['id'];
                    };

                    if($customer_id == 0)
                    {
                        $sql = "INSERT INTO customers (api_id, reference, odoo_id, firstname, middlename, lastname, email, phonenr, address, zipcode, city, country) VALUES ('$api_id', '$verkoper', '$activiteiten', '$firstname', '', '$last_name', '$email', '$phonenr', '', '$postcode', '$plaats', '$land')";
                        if (mysqli_query($i_conn, $sql)) 
                        {
                            $last_id = mysqli_insert_id($i_conn);
                            echo"+ Klant $firstname $last_name toegevoegd aan de database (Particulier)<br/><Br/>";
                        }
                    }
                    else
                    {
                        echo"-- Klant $firstname $last_name bestaat al in onze database<br/><Br/>";
                    }
                }
                else if (str_contains($email, "@gmail") && !str_contains($customer_name_check, "garage") && !str_contains($customer_name_check, "auto") && !str_contains($customer_name_check, "specialist") && !str_contains($customer_name_check, "handel") && !str_contains($customer_name_check, "car") && !str_contains($customer_name_check, "vof") && !str_contains($customer_name_check, "motor")) 
                {
                    $nameparts = explode(' ', $customer_name,2);
                    $firstname = mysqli_real_escape_string($i_conn, $nameparts[0]);
                    $last_name = mysqli_real_escape_string($i_conn, $nameparts[1]);
                    // = particulier
                    echo"$customer_name <br/> $email<br/><br/>";

                    
                    $customer_id = 0;

                    $query11 = "SELECT * FROM customers WHERE email LIKE '%$email%' OR firstname LIKE '%$firstname%' AND lastname LIKE '%$last_name%'";

                    $data11=mysqli_query($i_conn,$query11);   

                    while($row11=mysqli_fetch_array($data11))
                    {
                        $customer_id = $row11['id'];
                    };

                    if($customer_id == 0)
                    {

                        $sql = "INSERT INTO customers (api_id, reference, odoo_id, firstname, middlename, lastname, email, phonenr, address, zipcode, city, country) VALUES ('$api_id', '$verkoper', '$activiteiten', '$firstname', '', '$last_name', '$email', '$phonenr', '', '$postcode', '$plaats', '$land')";
                        if (mysqli_query($i_conn, $sql)) 
                        {
                            $last_id = mysqli_insert_id($i_conn);
                            echo"+ Klant $firstname $last_name toegevoegd aan de database (Particulier)<br/><Br/>";
                        }

                    }
                    else
                    {
                        echo"-- Klant $firstname $last_name bestaat al in onze database<br/><Br/>";
                    }
                }
                else
                {
                    $nameparts = explode(' ', $customer_name,2);
                    $firstname = mysqli_real_escape_string($i_conn, $nameparts[0]);
                    $last_name = mysqli_real_escape_string($i_conn, $nameparts[1]);

                    
                    $customer_id = 0;

                    $query11 = "SELECT * FROM customers WHERE email LIKE '%$email%' OR firstname LIKE '%$firstname%' AND lastname LIKE '%$last_name%'";

                    $data11=mysqli_query($i_conn,$query11);   

                    while($row11=mysqli_fetch_array($data11))
                    {
                        $customer_id = $row11['id'];
                    };

                    if($customer_id == 0)
                    {

                        $sql = "INSERT INTO customers (api_id, reference, odoo_id, firstname, middlename, lastname, email, phonenr, address, zipcode, city, country) VALUES ('$api_id', '$verkoper', '$activiteiten', '$firstname', '', '$last_name', '$email', '$phonenr', '', '$postcode', '$plaats', '$land')";
                        if (mysqli_query($i_conn, $sql)) 
                        {
                            echo"+ Klant $firstname $last_name toegevoegd aan de database (Bedrijf)<br/><Br/>";

                            $last_id = mysqli_insert_id($i_conn);
                        
                            $sql1 = "INSERT INTO customer_companies (customer_id, vat, company_name, email, invoice_email, phonenr, address, zipcode, city, country) VALUES ('$last_id', '', '$customer_name', '$email', '$email', '$phonenr', '', '$postcode', '$plaats', '$land')";
                            if (mysqli_query($i_conn, $sql1)) {
                                echo"+ Bedrijf $customer_name toegevoegd aan de database<br/><Br/>";
                            }

                        }
                    }
                    else
                    {
                        echo"-- Klant $firstname $last_name bestaat al in onze database<br/><Br/>";
                    }

                }
            }
        }

    }

};
// 