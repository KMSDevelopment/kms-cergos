<div class="loading" style="position:fixed; z-index:9999999; top:0px; left:0px; width:100%; height:100%; background:#000;">
    <table style="width:100%; height:100%;">
        <tr>
            <td style="width:100%; height:100%; text-align:center; vertical-align:middle;">
                <img src="../../logo_cockpit.png" style="width:250px;"><br/>
                <img src="../../loader.gif" style="width:100px;"><br/>
                <span style="color:#FFF;">Data loading please wait..</span>
            </td>
        </tr>
    </table>
</div>
<?php
include "../db.php";

// error_reporting(E_ERROR);
$query = "SELECT * FROM apis WHERE active=1";

$data=mysqli_query($i_conn,$query);   

while($row=mysqli_fetch_array($data))
{
    $api_id = $row['id'];
    $endpoint = $row['endpoint'];
    $credentials = $row['credentials'];

    echo"$endpoint loaded";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $headers = array();
    $headers[] = 'Authorization: '.$credentials;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    $array = json_decode($result);

    if($endpoint == "https://api.mygadgetrepairs.com/v1/customers")
    {
        foreach($array as $data)
        {
            // customers
            $mgr_id = mysqli_real_escape_string($i_conn, $data->id);
            $ref = mysqli_real_escape_string($i_conn, $data->ref);
            $first_name = mysqli_real_escape_string($i_conn, $data->name_parts->first_name);
            $middle_name = mysqli_real_escape_string($i_conn, $data->name_parts->middle_name);
            $last_name = mysqli_real_escape_string($i_conn, $data->name_parts->last_name);
            $email = mysqli_real_escape_string($i_conn, $data->email);
            $invoice_email = mysqli_real_escape_string($i_conn, $data->invoiceemail);
            $city = mysqli_real_escape_string($i_conn, $data->fulladdress->city);
            $country = mysqli_real_escape_string($i_conn, $data->fulladdress->country);
            $address = mysqli_real_escape_string($i_conn, $data->fulladdress->address);
            $post_code = mysqli_real_escape_string($i_conn, $data->fulladdress->post_code);
            $mobile = mysqli_real_escape_string($i_conn, $data->mobile);
            $phone = mysqli_real_escape_string($i_conn, $data->phone);
            $company = mysqli_real_escape_string($i_conn, $data->company);
            $vat_registration_number = mysqli_real_escape_string($i_conn, $data->vat_registration_number);
            echo"<br/> $ref - $first_name - $email <br/>";


            $customer_id = 0;

            $query11 = "SELECT * FROM customers WHERE email LIKE '%$email%' OR firstname LIKE '%$first_name%' AND lastname LIKE '%$last_name%'";

            $data11=mysqli_query($i_conn,$query11);   

            while($row11=mysqli_fetch_array($data11))
            {
                $customer_id = $row11['id'];
            };


            if($customer_id == 0)
            {
                $sql = "INSERT INTO customers (api_id, reference, mgr_id, firstname, middlename, lastname, email, phonenr, address, zipcode, city, country) VALUES ('$api_id', '$ref', '$mgr_id', '$first_name', '$middle_name', '$last_name', '$email', '$mobile', '$address', '$post_code', '$city', '$country')";
                if (mysqli_query($i_conn, $sql)) 
                {
                    $last_id = mysqli_insert_id($i_conn);
                    if($company != "" && $company != NULL)
                    {
                        $sql1 = "INSERT INTO customer_companies (customer_id, vat, company_name, email, invoice_email, phonenr, address, zipcode, city, country) VALUES ('$last_id', '$vat_registration_number', '$company', '$email', '$invoice_email', '$mobile', '$address', '$post_code', '$city', '$country')";
                        if (mysqli_query($i_conn, $sql1)) {
                            echo"+ Bedrijf $company toegevoegd aan de database<br/><Br/>";
                        }
                    }
                    echo"+ Klant $first_name $middle_name $last_name toegevoegd aan de database<br/><Br/>";
                }
            }
            else
            {
                echo"-- Klant $first_name $middle_name $last_name bestaat al in onze database<br/><Br/>";
            }

        }
    }

    if($endpoint == "https://api.mygadgetrepairs.com/v1/issueTypes")
    {
        foreach($array as $data)
        {
            // issuetypes
            $label = mysqli_real_escape_string($i_conn, $data->label);
            $photo = mysqli_real_escape_string($i_conn, $data->photourls->large);


            
            $sql = "INSERT INTO revision_problem_types (label, img) VALUES ('$label', '$photo')";
            if (mysqli_query($i_conn, $sql)) {
                echo"PROBLEM DATA INSERTED<br/><Br/>";
            }
        }
    }




    if($endpoint == "https://api.mygadgetrepairs.com/v1/brands")
        {
            // brands
            $ch = curl_init();
    
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $headers = array();
            $headers[] = 'Authorization: '.$credentials;
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);    
    
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
    
            $array = json_decode($result);
            // var_dump($array);
    
            foreach($array as $data)
            {
                // // brands
                $brand = $data->name;
                $large = $data->logourls->large;
                $sql = "INSERT INTO car_brands (api_id, brand, logo) VALUES ('$api_id', '$brand', '$large')";
                if (mysqli_query($i_conn, $sql)) {
                    echo"CAR BRAND INSERTED<br/><Br/>";
                }
            }
        }
    
    
    
        if($endpoint == "https://api.mygadgetrepairs.com/v1/models")
        {
            $ch = curl_init();
    
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $headers = array();
            $headers[] = 'Authorization: '.$credentials;
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);   
    
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
    
            $array = json_decode($result);
            var_dump($array);
    
            foreach($array as $data)
            {
                // // models
                $brand_id = "";
                $model = $data->model;
                $brand = $data->make;
                $img = $data->photourls->large;
    
                $query1 = "SELECT * FROM car_brands WHERE brand LIKE '%$brand%'";
    
                $data1=mysqli_query($i_conn,$query1);   
    
                while($row1=mysqli_fetch_array($data1))
                {
                    $brand_id = $row1['id'];
                };
    
                if($brand_id == "")
                {
                    $sql2 = "INSERT INTO car_brands (api_id, brand, logo) VALUES ('$api_id', '$brand', NULL)";
                    if (mysqli_query($i_conn, $sql2)) {
                        echo"CAR BRAND INSERTED<br/><Br/>";
                        $brand_id = mysqli_insert_id($i_conn);
                    }
                }
                $sql = "INSERT INTO car_brand_models (api_id, brand_id, model, img) VALUES ('$api_id', '$brand_id', '$model', '$img')";
                if (mysqli_query($i_conn, $sql)) {
                    echo"CAR BRAND MODEL INSERTED<br/><Br/>";
                }
            }
        }





    if($endpoint == "https://api.mygadgetrepairs.com/v1/products")
    {
        // https://api.mygadgetrepairs.com/v1/products
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $headers = array();
        $headers[] = 'Authorization: '.$credentials;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);   

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $array = json_decode($result);
        // var_dump($array);

        foreach($array as $data)
        {
            // // products
            $type = mysqli_real_escape_string($i_conn, $data->type);
            $name = mysqli_real_escape_string($i_conn, $data->name);
            $code = mysqli_real_escape_string($i_conn, $data->code);
            $stock = mysqli_real_escape_string($i_conn, $data->stock);
            $stock_location = mysqli_real_escape_string($i_conn, $data->physical_location);
            $brand_id = "";
            $model_id = "";
        
            $brand = $data->brand;
            $query1 = "SELECT * FROM car_brands WHERE brand LIKE '%$brand%'";

            $data1=mysqli_query($i_conn,$query1);   

            while($row1=mysqli_fetch_array($data1))
            {
                $brand_id = $row1['id'];
            };

            $model = $data->model;

            $query2 = "SELECT * FROM car_brand_models WHERE model LIKE '%$model%'";

            $data2=mysqli_query($i_conn,$query2);   

            while($row2=mysqli_fetch_array($data2))
            {
                $model_id = $row1['id'];
            };
        
            $img = mysqli_real_escape_string($i_conn, $data->photourls->large);
           
            $supplier_code = mysqli_real_escape_string($i_conn, $data->supplier_code);
        
            $retail_price = mysqli_real_escape_string($i_conn, $data->prices->retail_price);
            $retail_price_inc_vat = mysqli_real_escape_string($i_conn, $data->prices->retail_price_inc_vat);
            $cost_price_inc_vat = mysqli_real_escape_string($i_conn, $data->prices->cost_price_inc_vat);
            $cost_price = mysqli_real_escape_string($i_conn, $data->prices->cost_price);
            $vat = mysqli_real_escape_string($i_conn, $data->prices->vat);


            $sql = "INSERT INTO car_model_type_variant_parts (brand_id, model_id, distributor_id, code, name, img, sales_price, sales_price_inc_vat, purchase_price, purchase_price_inc_vat, vat, stock, stock_location) VALUES ('$brand_id', '$model_id', '$supplier_code', '$code', '$name', '$img', '$retail_price', '$retail_price_inc_vat', '$cost_price', '$cost_price_inc_vat', '$vat', '$stock', '$stock_location')";
            if (mysqli_query($i_conn, $sql)) {
                echo"CAR PART INSERTED<br/><Br/>";
            }
        }
    }

    curl_close($ch);




    if($endpoint == "https://api.mygadgetrepairs.com/v1/tickets")
    {
        // https://api.mygadgetrepairs.com/v1/tickets
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $headers = array();
        $headers[] = 'Authorization: '.$credentials;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);   

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $array = json_decode($result);
        // var_dump($array);

        foreach($array as $data)
        {
            // // brands
            $ticket_ref = mysqli_real_escape_string($i_conn, $data->ticket_ref);
            $ticket_no = mysqli_real_escape_string($i_conn, $data->ticket_no);
            $customerid = mysqli_real_escape_string($i_conn, $data->customer->internal_id);
            // $customer = mysqli_real_escape_string($i_conn, $data->customer);
            $short_info = mysqli_real_escape_string($i_conn, $data->short_info);
            $description = mysqli_real_escape_string($i_conn, $data->description);
            $device = mysqli_real_escape_string($i_conn, $data->device);
            $status = mysqli_real_escape_string($i_conn, $data->status->label);
            $issue = mysqli_real_escape_string($i_conn, $data->issue_type->label);
            $first_name = mysqli_real_escape_string($i_conn, $data->technician->first_name);
            $created_date = mysqli_real_escape_string($i_conn, $data->created_date);
            $source = mysqli_real_escape_string($i_conn, $data->created_from);
            $model_id = "";
            $variant_id = "";
            $customer_id = "";
            $user_id = "";


            $query3 = "SELECT * FROM customers WHERE reference='$customerid'";

            $data3=mysqli_query($i_conn,$query3);   

            while($row3=mysqli_fetch_array($data3))
            {
                $customer_id = $row3['id'];
            };

            $query4 = "SELECT * FROM users WHERE name LIKE '%$first_name%'";

            $data4=mysqli_query($i_conn,$query4);   

            while($row4=mysqli_fetch_array($data4))
            {
                $user_id = $row4['id'];
            };

            $device_parts = explode("|", $device);
            $model = $device_parts[0];

            $query1 = "SELECT * FROM car_brand_models WHERE model LIKE '%$model%'";

            $data1=mysqli_query($i_conn,$query1);   

            while($row1=mysqli_fetch_array($data1))
            {
                $brand_id = $row1['brand_id'];
                $model_id = $row1['id'];
            };

            $bouwjaar = $device_parts[1];

            $query2 = "SELECT * FROM car_model_types_variants WHERE build LIKE '%$bouwjaar%' AND model_id='$model_id'";

            $data2=mysqli_query($i_conn,$query2);   

            while($row2=mysqli_fetch_array($data2))
            {
                $variant_id = $row2['id'];
            };

            $sql = "INSERT INTO revisions (api_id, title, complain_desc) VALUES ('$api_id', '$short_info', '$description - $issue')";
            if (mysqli_query($i_conn, $sql)) 
            {
                echo"REVISION TICKET INSERTED<br/><Br/>";
                $revision_id = mysqli_insert_id($i_conn);

                $sql = "INSERT INTO revision_models (revision_id, brand_id, model_id, variant_id) VALUES ('$revision_id', '$brand_id', '$model_id', '$variant_id')";
                if (mysqli_query($i_conn, $sql)) {
                    echo"REVISION MODEL INSERTED<br/><Br/>";
                }

                $sql1 = "INSERT INTO customer_revisions (revision_id, mgr_id, ticket_no, brand_id, customer_id, user_id_assigned, start, status) VALUES ('$revision_id', '$customerid', '$ticket_no',  '$brand_id', '$customer_id', '$user_id', '$created_date', '$status')";
                if (mysqli_query($i_conn, $sql1)) {
                    echo"CUSTOMER REVISION INSERTED<br/><Br/>";
                }
        
            }
        }
    }




}








////////////////////// DONE

// https://api.mygadgetrepairs.com/v1/issueTypes
// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://api.mygadgetrepairs.com/v1/issueTypes');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// $headers = array();
// $headers[] = 'Authorization: 1x!U1!Ma.aAzx3X@7ft|3rEW9=R8@t@^C5v^7HFNAgCt';
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $result = curl_exec($ch);
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// curl_close($ch);

// $array = json_decode($result);

// // var_dump($array);

// foreach($array as $data)
// {
//     if($endpoint == "https://api.mygadgetrepairs.com/v1/issueTypes")
//     {
//         // issuetypes
//         $label = $data->label;
//         $photo = $data->photourls->large;
//         $sql = "INSERT INTO revision_problem_types (label, img) VALUES ('$label', '$photo')";
//         if (mysqli_query($i_conn, $sql)) {
//             echo"DATA INSERTED<br/><Br/>";
//         }
//     }
// }

////////////////////// DONE










////////////////////// DONE

// https://api.mygadgetrepairs.com/v1/customers
// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://api.mygadgetrepairs.com/v1/customers');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// $headers = array();
// $headers[] = 'Authorization: 1x!U1!Ma.aAzx3X@7ft|3rEW9=R8@t@^C5v^7HFNAgCt';
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $result = curl_exec($ch);
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// curl_close($ch);
// $array = json_decode($result);
// // var_dump($array);

// foreach($array as $data)
// {
//     // customers
//     $ref = $data->ref;
//     $first_name = $data->name_parts->first_name;
//     $middle_name = $data->name_parts->middle_name;
//     $last_name = $data->name_parts->last_name;
//     $email = $data->email;
//     $invoice_email = $data->invoiceemail;
//     $city = $data->fulladdress->city;
//     $country = $data->fulladdress->country;
//     $address = $data->fulladdress->address;
//     $post_code = $data->fulladdress->post_code;
//     $mobile = $data->mobile;
//     $phone = $data->phone;
//     $company = $data->company;
//     $vat_registration_number = $data->vat_registration_number;
//     echo"$ref - $first_name - $email";
//     echo"<br/><br/>";
// }

////////////////////// DONE











////////////////////// DONE

// https://api.mygadgetrepairs.com/v1/brands
// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://api.mygadgetrepairs.com/v1/brands');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// $headers = array();
// $headers[] = 'Authorization: 1x!U1!Ma.aAzx3X@7ft|3rEW9=R8@t@^C5v^7HFNAgCt';
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $result = curl_exec($ch);
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// curl_close($ch);

// $array = json_decode($result);
// // var_dump($array);

// foreach($array as $data)
// {
//     // // brands
//     $brand = $data->name;
//     $large = $data->logourls->large;
//     echo"$brand - $large";
//     echo"<br/><br/>";
// }

////////////////////// DONE








////////////////////// DONE

// https://api.mygadgetrepairs.com/v1/models
// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://api.mygadgetrepairs.com/v1/models');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// $headers = array();
// $headers[] = 'Authorization: 1x!U1!Ma.aAzx3X@7ft|3rEW9=R8@t@^C5v^7HFNAgCt';
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $result = curl_exec($ch);
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// curl_close($ch);

// $array = json_decode($result);
// var_dump($array);

// foreach($array as $data)
// {
//     // // brands
//     $model = $data->model;
//     $brand = $data->make;
//     $img = $data->photourls->large;
//     echo"$brand - $model - $img";
//     echo"<br/><br/>";
// }

//////////////////// DONE












////////////////////// DONE

// https://api.mygadgetrepairs.com/v1/products
// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://api.mygadgetrepairs.com/v1/products');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// $headers = array();
// $headers[] = 'Authorization: 1x!U1!Ma.aAzx3X@7ft|3rEW9=R8@t@^C5v^7HFNAgCt';
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $result = curl_exec($ch);
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// curl_close($ch);

// $array = json_decode($result);
// // var_dump($array);

// foreach($array as $data)
// {
//     // // brands
//     $type = $data->type;
//     $name = $data->name;
//     $code = $data->code;
//     $stock = $data->stock;
//     $stock_location = $data->physical_location;

//     $brand = $data->brand;
//     $model = $data->model;

//     $img = $data->photourls->large;
   
//     $supplier_code = $data->supplier_code;

//     $retail_price = $data->prices->retail_price;
//     $retail_price_inc_vat = $data->prices->retail_price_inc_vat;
//     $cost_price_inc_vat = $data->prices->cost_price_inc_vat;
//     $cost_price = $data->prices->cost_price;
//     $vat = $data->prices->vat;
    
//     echo"<br/><br/>";
// }

////////////////////// DONE






// ////////////////////// DONE

// https://api.mygadgetrepairs.com/v1/tickets
// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://api.mygadgetrepairs.com/v1/tickets');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// $headers = array();
// $headers[] = 'Authorization: 1x!U1!Ma.aAzx3X@7ft|3rEW9=R8@t@^C5v^7HFNAgCt';
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $result = curl_exec($ch);
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// curl_close($ch);

// $array = json_decode($result);
// // var_dump($array);

// foreach($array as $data)
// {
//     // // brands
//     $ticket_ref = $data->ticket_ref;
//     $ticket_no = $data->ticket_no;
//     $customerid = $data->customer->internal_id;
//     $customer = $data->customer;
//     $short_info = $data->short_info;
//     $description = $data->description;
//     $device = $data->device;
//     $status = $data->status->label;
//     $issue = $data->issue_type->label;
//     $first_name = $data->technician->first_name;
//     $created_date = $data->created_date;
//     $source = $data->created_from;

//     $device_parts = explode("|", $device);
//     $model = $device_parts[0];
//     $bouwjaar = $device_parts[1];
   
//     echo"$source - $created_date - $ticket_ref - ticketnr: $ticket_no - $model = bouwjaar: $bouwjaar - $short_info - $description - $issue";
//     echo"<br/><br/>";
// }

////////////////////// DONE






// https://api.mygadgetrepairs.com/v1/ticketsInvoices
// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://api.mygadgetrepairs.com/v1/ticketsInvoices');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// $headers = array();
// $headers[] = 'Authorization: 1x!U1!Ma.aAzx3X@7ft|3rEW9=R8@t@^C5v^7HFNAgCt';
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $result = curl_exec($ch);
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// curl_close($ch);

// $array = json_decode($result);
// var_dump($array);
// foreach($array as $customer)
// {
//     var_dump($customer);
//     echo"<br/><br/>";
// }



// https://api.mygadgetrepairs.com/v1/ticketinvoices/{invoiceid}






