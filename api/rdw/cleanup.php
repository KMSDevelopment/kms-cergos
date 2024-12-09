<?php
include "../db.php";

$query112 = "SELECT * FROM car_brand_models WHERE model LIKE '%(vanaf )%'";

$data112=mysqli_query($i_conn,$query112);   

while($row112=mysqli_fetch_array($data112))
{
    $model_id = $row112['id'];

    $sql = "DELETE FROM car_model_types_variants WHERE model_id='$model_id'";

    if (mysqli_query($i_conn, $sql)) {
        echo "Variant Record deleted successfully<br/>";
    }

    $sql2 = "DELETE FROM car_model_types WHERE model_id='$model_id'";

    if (mysqli_query($i_conn, $sql2)) {
        echo "Type Record deleted successfully<br/>";
    }

    $sql3 = "DELETE FROM car_brand_models WHERE id='$model_id'";

    if (mysqli_query($i_conn, $sql3)) {
        echo "Model Record deleted successfully<br/>";
    }
};