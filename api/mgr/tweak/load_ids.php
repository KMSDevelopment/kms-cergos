<?php
include "../../db.php";

// brands
$ch = curl_init();
        
curl_setopt($ch, CURLOPT_URL, 'https://api.mygadgetrepairs.com/v1/brands');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$headers = array();
$headers[] = 'Authorization: '.$mgr_api;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);    

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$array = json_decode($result);

foreach($array as $data)
{
    $brand = mysqli_real_escape_string($i_conn, $data->name);

    $brand_id = 0;

    $query13 = "SELECT * FROM car_brands WHERE brand LIKE '%$brand%'";

    $data13=mysqli_query($i_conn,$query13);   

    while($row13=mysqli_fetch_array($data13))
    {
        $brand_id = $row13['id'];
        $brand = $row13['brand'];
    };

    if($brand_id != 0)
    {
        $mgr_id = mysqli_real_escape_string($i_conn, $data->id);

        $sql = "UPDATE car_brands SET mgr='$mgr_id' WHERE id=$brand_id";
        if (mysqli_query($i_conn, $sql)) {
            echo"+ Het MGR Kenmerk is toegevoegd aan het merk $brand<br/>";
        }
    }
}





// modellen

$ch2 = curl_init();
        
curl_setopt($ch2, CURLOPT_URL, 'https://api.mygadgetrepairs.com/v1/models');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
$headers = array();
$headers[] = 'Authorization: '.$mgr_api;
curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);    

$result = curl_exec($ch2);
if (curl_errno($ch2)) {
    echo 'Error:' . curl_error($ch2);
}
curl_close($ch2);

$array = json_decode($result);

// var_dump($array);

foreach($array as $data)
{
    $model = mysqli_real_escape_string($i_conn, $data->model);

    $modelarray = explode("(", $model);
    $model_name = $modelarray[0];

    $model_id = 0;

    $query13 = "SELECT * FROM car_brand_models WHERE model LIKE '%$model_name%'";

    $data13=mysqli_query($i_conn,$query13);   

    while($row13=mysqli_fetch_array($data13))
    {
        $model_id = $row13['id'];
        $model = $row13['model'];
    };

    if($model_id != 0)
    {
        $mgr_id = mysqli_real_escape_string($i_conn, $data->id);

        $sql = "UPDATE car_brand_models SET mgr='$mgr_id' WHERE id=$model_id";
        if (mysqli_query($i_conn, $sql)) {
            echo"+ Het MGR Kenmerk is toegevoegd aan het model $model_name<br/>";
        }
    }
}



// producten

$ch3 = curl_init();
        
curl_setopt($ch3, CURLOPT_URL, 'https://api.mygadgetrepairs.com/v1/products');
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, true);
$headers = array();
$headers[] = 'Authorization: '.$mgr_api;
curl_setopt($ch3, CURLOPT_HTTPHEADER, $headers);    

$result = curl_exec($ch3);
if (curl_errno($ch3)) {
    echo 'Error:' . curl_error($ch3);
}
curl_close($ch3);

$array = json_decode($result);

// var_dump($array);

foreach($array as $data)
{
    $type = mysqli_real_escape_string($i_conn, $data->type);
    $name = mysqli_real_escape_string($i_conn, $data->name);
    $code = mysqli_real_escape_string($i_conn, $data->code);

    if($type == "product")
    {
        $product_id = 0;

        $query13 = "SELECT * FROM car_model_type_variant_parts WHERE name LIKE '%$name%' OR ref='$code'";

        $data13=mysqli_query($i_conn,$query13);   

        while($row13=mysqli_fetch_array($data13))
        {
            $product_id = $row13['id'];
            $name = $row13['name'];
        };

        if($product_id != 0)
        {
            $mgr_id = mysqli_real_escape_string($i_conn, $data->id);

            $sql = "UPDATE car_model_type_variant_parts SET mgr='$mgr_id' WHERE id=$product_id";
            if (mysqli_query($i_conn, $sql)) {
                echo"+ Het MGR Kenmerk is toegevoegd aan het product $name<br/>";
            }
        }
    }
}




// reparaties

$ch4 = curl_init();
        
curl_setopt($ch4, CURLOPT_URL, 'https://api.mygadgetrepairs.com/v1/products');
curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch4, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch4, CURLOPT_FOLLOWLOCATION, true);
$headers = array();
$headers[] = 'Authorization: '.$mgr_api;
curl_setopt($ch4, CURLOPT_HTTPHEADER, $headers);    

$result = curl_exec($ch4);
if (curl_errno($ch4)) {
    echo 'Error:' . curl_error($ch4);
}
curl_close($ch4);

$array = json_decode($result);

// var_dump($array);

foreach($array as $data)
{
    $type = mysqli_real_escape_string($i_conn, $data->type);
    $name = mysqli_real_escape_string($i_conn, $data->name);
    $code = mysqli_real_escape_string($i_conn, $data->code);

    if($type == "services")
    {
        $rev_id = 0;

        $query13 = "SELECT * FROM revisions WHERE title LIKE '%$name%' OR ref='$code'";

        $data13=mysqli_query($i_conn,$query13);   

        while($row13=mysqli_fetch_array($data13))
        {
            $rev_id = $row13['id'];
            $title = $row13['title'];
        };

        if($rev_id != 0)
        {
            $mgr_id = mysqli_real_escape_string($i_conn, $data->id);

            $sql = "UPDATE revisions SET mgr='$mgr_id' WHERE id=$rev_id";
            if (mysqli_query($i_conn, $sql)) {
                echo"+ Het MGR Kenmerk is toegevoegd aan de reparatie $title<br/>";
            }
        }
    }
}




?>