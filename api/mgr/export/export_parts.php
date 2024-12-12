<?php
include "../../db.php";

$delete = $_GET['del'];

if($delete == 1)
{

    echo"The delete API functionality in MGR is not working";
    // $brand_id = 0;

    // $query13 = "SELECT * FROM car_brands WHERE mgr!='0' LIMIT 1";

    // $data13=mysqli_query($i_conn,$query13);   

    // while($row13=mysqli_fetch_array($data13))
    // {
    //     $brand_id = $row13['id'];
    //     $brand = $row13['brand'];
    //     $mgr = $row13['mgr'];
    // };

    // if($brand_id != 0)
    // {
    //     echo"merk $brand is gevonden in MGR met MGRID = $mgr<br/>";

    //     $ch2 = curl_init();
        
    //     curl_setopt($ch2, CURLOPT_URL, 'https://api.mygadgetrepairs.com/v1/brands/'.$mgr);
    //     curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, 'DELETE');
    //     curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
    //     $headers = [
    //         'Authorization: '.$mgr_api,
    //         'Content-Type: json/xml'
    //     ];
    //     curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);    

    //     $result = curl_exec($ch2);
    //     if (curl_errno($ch2)) {
    //         echo 'Error:' . curl_error($ch2);
    //     }
    //     curl_close($ch2);

    //     var_dump($result);

    // }
}
else
{
    $query13 = "SELECT * FROM car_model_type_variant_parts WHERE mgr=0";

    $data13=mysqli_query($i_conn,$query13);   

    while($row13=mysqli_fetch_array($data13))
    {
        $product_id = $row13['id'];
        $brand_id = $row13['brand_id'];
        $model_id = $row13['model_id'];
        $ref = $row13['ref'];
        $code = $row13['code'];
        $name = $row13['name'];
        $purchase_price_inc_vat = $row13['purchase_price_inc_vat'];
        $stock_location = $row13['stock_location'];
        $stock = $row13['stock'];
        $vat = 2425;

        $query13a = "SELECT * FROM car_brands WHERE id=$brand_id";

        $data13a=mysqli_query($i_conn,$query13a);   

        while($row13a=mysqli_fetch_array($data13a))
        {
            $brand_id_mgr = $row13a['mgr'];
        };

        $query13b = "SELECT * FROM car_brand_models WHERE id=$model_id";

        $data13b=mysqli_query($i_conn,$query13b);   

        while($row13b=mysqli_fetch_array($data13b))
        {
            $model_id_mgr = $row13b['mgr'];
        };

        if($brand_id_mgr == 0)
        {
            $brand_id_mgr = "";
        }
        if($model_id == 0)
        {
            $model_id_mgr = "";
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://api.mygadgetrepairs.com/v1/products");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('type' => "product", 'name' => "$name", 'condition' => "New", 'code' => "$code", 'imei' => "$ref", 'brand' => $brand_id_mgr, 'model' => $model_id_mgr, 'status' => "Active", 'cost' => $purchase_price_inc_vat, 'price' => 0, 'tax' => $vat, 'physicalLocation' => "$stock_location")));
        $headers = array();
        $headers[] = 'Authorization: 1x!U1!Ma.aAzx3X@7ft|3rEW9=R8@t@^C5v^7HFNAgCt';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $server_output = curl_exec($ch);
        
        curl_close($ch);

        var_dump($server_output);
        $array = json_decode($server_output);
        $mgr_id = $array->id;

        $sql = "UPDATE car_model_type_variant_parts SET mgr='$mgr_id' WHERE id='$product_id'";

        if (mysqli_query($i_conn, $sql)) {
            echo "Product updated successfully with MGR id<br/>";
        } else {
            echo "Error updating record: " . mysqli_error($i_conn) . "<br/>";
        }
        
    };
}



?>