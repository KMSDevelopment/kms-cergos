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
    $query13 = "SELECT * FROM car_brands WHERE mgr=0 AND checked='1'";

    $data13=mysqli_query($i_conn,$query13);   

    while($row13=mysqli_fetch_array($data13))
    {
        $brand_id = $row13['id'];
        $brand = $row13['brand'];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://api.mygadgetrepairs.com/v1/brands");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('name' => "$brand")));
        $headers = array();
        $headers[] = 'Authorization: 1x!U1!Ma.aAzx3X@7ft|3rEW9=R8@t@^C5v^7HFNAgCt';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $server_output = curl_exec($ch);
        
        curl_close($ch);

        curl_close($ch);
        $array = json_decode($server_output);
        $mgr_id = $array->id;

        echo"<br/>";

        
        $sql = "UPDATE car_brands SET mgr='$mgr_id' WHERE id='$brand_id'";

        if (mysqli_query($i_conn, $sql)) {
            echo "Brand updated successfully with MGR id<br/>";
        } else {
            echo "Error updating record: " . mysqli_error($i_conn) . "<br/>";
        }
        
    };
}



?>