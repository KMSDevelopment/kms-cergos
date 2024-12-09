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

echo"Loading cars and models from 2008 - 2018 <Br/><br/>"; 

// error_reporting(E_ERROR);
$query = "SELECT * FROM cars";

$data=mysqli_query($i_conn,$query);   

while($row=mysqli_fetch_array($data))
{
    $brand_id = 0;
    $make_id = $row['make_id'];
    $make = $row['make'];

    $query2 = "SELECT * FROM car_brands WHERE brand LIKE '%$make%'";

    $data2=mysqli_query($i_conn,$query2);   

    while($row2=mysqli_fetch_array($data2))
    {
        $brand_id = $row['id'];
    };

    if($brand_id != 0)
    {
        echo"car brand $make already excisting and found now checking models <br/>";

        $query3 = "SELECT * FROM car_models WHERE make_id='$make_id'";

        $data3=mysqli_query($i_conn,$query3);   

        while($row3=mysqli_fetch_array($data3))
        {
            $model = $row3['model'];
            $mid = 0;

            $query4 = "SELECT * FROM car_brand_models WHERE model LIKE '%$model%'";

            $data4=mysqli_query($i_conn,$query4);   

            while($row4=mysqli_fetch_array($data4))
            {
                $mid = $row4['id'];
            };

            if($mid != 0)
            {
                echo"car model $model already excisting and found <br/>";
            }
            else
            {
                $sql = "INSERT INTO car_brand_models (api_id, brand_id, model, img) VALUES ('11', '$brand_id', '$model', '/images/unknown_logo.png')";
                if (mysqli_query($i_conn, $sql)) 
                {
                    $last_id = mysqli_insert_id($i_conn);
                    echo"new car model $model inserted for $make<br/>";
                }
            }

        };
    }
    else
    {
        $sql1 = "INSERT INTO car_brands (api_id, brand, logo) VALUES ('11', '$make', '/images/unknown_logo.png')";
        if (mysqli_query($i_conn, $sql1)) 
        {
            $last_id = mysqli_insert_id($i_conn);
            echo"new car brand $make inserted <br/>";

            $query5 = "SELECT * FROM car_models WHERE make_id='$make_id'";

            $data5=mysqli_query($i_conn,$query5);   

            while($row5=mysqli_fetch_array($data5))
            {
                $mid = $row5['id'];
                $model = $row5['model'];
                $mid = $row5['id'];

                $sql2 = "INSERT INTO car_brand_models (api_id, brand_id, model, img) VALUES ('11', '$last_id', '$model', '/images/unknown_logo.png')";
                if (mysqli_query($i_conn, $sql2)) 
                {
                    echo"new car model $model inserted for $make<br/>";
                }
            };

        }
    }

};