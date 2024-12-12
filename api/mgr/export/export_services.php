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
    $query13 = "SELECT * FROM revisions WHERE mgr=0 AND checked='1'";

    $data13=mysqli_query($i_conn,$query13);   

    while($row13=mysqli_fetch_array($data13))
    {
        $revision_id = $row13['id'];
        $ref = $row13['ref'];
        $title = $row13['title'];
        $revision_desc = $row13['revision_desc'];
        $price_ex = $row13['price_ex'];
        $problem_type_id = $row13['problem_type_id'];
        $vat = 2425;
        $allmodels = "";

        $query13ab = "SELECT * FROM revision_models WHERE revision_id=$revision_id";

        $data13ab=mysqli_query($i_conn,$query13ab);   

        while($row13ab=mysqli_fetch_array($data13ab))
        {
            $brand_id = $row13ab['brand_id'];
            $model_id = $row13ab['model_id'];

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
                $allmodels = "$model_id_mgr, $allmodels";
            };
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
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('type' => "service", 'name' => "$name", 'condition' => "New", 'code' => "$ref", 'brand' => $brand_id_mgr, 'model' => $model_id_mgr, 'additionalModels'=> $allmodels, 'status' => "Active", 'cost' => 0, 'price' => $price_ex, 'tax' => $vat, 'description'=>"$revision_desc")));
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

        $sql = "UPDATE revisions SET mgr='$mgr_id' WHERE id='$revision_id'";

        if (mysqli_query($i_conn, $sql)) {
            echo "Revision updated successfully with MGR id<br/>";
        } else {
            echo "Error updating record: " . mysqli_error($i_conn) . "<br/>";
        }
        
    };
}



?>