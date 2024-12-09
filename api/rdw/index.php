<?php

include "../db.php";

$query = "SELECT * FROM license_plate ORDER BY id DESC";

$data=mysqli_query($i_conn,$query);   

while($row=mysqli_fetch_array($data))
{
    $brand_id="";
    $model_id="";
    $type_id="";
    $variantid="";

    $licenseid = $row['id'];
    $license_plate = $row['license_plate'];
    $kenteken = str_replace("-", "", $license_plate);
    
    $revision_id = $row['revision_id'];
    $customer_id = $row['customer_id'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken=$kenteken",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));

    $response = curl_exec($curl);
    $result = json_decode($response);

    if($result != "")
    {
        $kenteken = mysqli_real_escape_string($i_conn, $result[0]->kenteken);
        $merk = mysqli_real_escape_string($i_conn, $result[0]->merk);
        $model = mysqli_real_escape_string($i_conn, $result[0]->handelsbenaming);
        $type = mysqli_real_escape_string($i_conn, $result[0]->type);
        $variant = mysqli_real_escape_string($i_conn, $result[0]->variant);
        $uitvoering = mysqli_real_escape_string($i_conn, $result[0]->uitvoering);

        $datum_eerste_tenaamstelling_in_nederland_dt = mysqli_real_escape_string($i_conn, $result[0]->datum_eerste_tenaamstelling_in_nederland_dt);
        $bouwjaar = substr($datum_eerste_tenaamstelling_in_nederland_dt, 0, 4);

        $vervaldatum_apk = mysqli_real_escape_string($i_conn, $result[0]->vervaldatum_apk);
        $datum_tenaamstelling = mysqli_real_escape_string($i_conn, $result[0]->datum_tenaamstelling);
        $catalogusprijs = mysqli_real_escape_string($i_conn, $result[0]->catalogusprijs);

        echo"! $kenteken - $merk - $model - $type - $variant - $uitvoering <br/>";

        $merklowercase = strtolower($merk);
        $modellowercase = strtolower($model);
        if($merklowercase == "mercedes-benz")
        {
            $merklowercase = "mercedes";
        }





        $query112 = "SELECT * FROM car_brands WHERE brand LIKE '%$merklowercase%'";

        $data112=mysqli_query($i_conn,$query112);   

        while($row112=mysqli_fetch_array($data112))
        {
            $brand_id = $row112['id'];
        };

        if($brand_id != "")
        {
            echo"V    Merk $merklowercase gevonden in onze database met id $brand_id <br/>";

            $query112 = "SELECT * FROM car_brand_models WHERE model LIKE '%$modellowercase%'";

            $data112=mysqli_query($i_conn,$query112);   

            while($row112=mysqli_fetch_array($data112))
            {
                $model_id = $row112['id'];
            };
            $model = ucfirst($modellowercase);

            if($model_id != "")
            {
                echo"V    Model $modellowercase gevonden in onze database met id $model_id <br/>";
                // model updaten 

                $sqlu = "UPDATE car_brand_models SET model='$model (vanaf $bouwjaar)' WHERE id=$model_id";

                if (mysqli_query($i_conn, $sqlu)) {
                    echo "! Model data $model is aangepast met het bouwjaar $bouwjaar.<br/>";
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }

            }
            else
            {
                echo"X    Model $modellowercase niet gevonden in onze database <br/>";
                // model toevoegen 
                $sql = "INSERT INTO car_brand_models (brand_id, model) VALUES ('$brand_id', '$model')";

                if (mysqli_query($i_conn, $sql)) 
                {
                    $model_id = mysqli_insert_id($i_conn);
                    echo"+ Model $model toegevoegd aan onze database <br/>";
                }
            }
        }
        else
        {
            echo"X    Merk $merklowercase niet gevonden in onze database <br/>";
            $merk = ucfirst($merklowercase);
            // merk toevoegen aan de database
            $sql2 = "INSERT INTO car_brands (brand) VALUES ('$merk')";

            if (mysqli_query($i_conn, $sql2)) 
            {
                $brand_id = mysqli_insert_id($i_conn);
                echo"+ Merk $merk toegevoegd aan onze database <br/>";

                // model toevoegen aan de database
                $model = ucfirst($modellowercase);
                $sql3 = "INSERT INTO car_brand_models (brand_id, model) VALUES ('$brand_id', '$model')";

                if (mysqli_query($i_conn, $sql3)) 
                {
                    $model_id = mysqli_insert_id($i_conn);
                    echo"+ Model $model toegevoegd aan onze database <br/>";
                }
            }
        }




        // UPDATE ALL VALUES
        $sqlu = "UPDATE license_plate SET brand_id='$brand_id', brand_model_id='$model_id', eerste_tenaamstelling='$datum_eerste_tenaamstelling_in_nederland_dt', datum_tenaamstelling='$datum_tenaamstelling', vervaldatum_apk='$vervaldatum_apk', catalogusprijs='$catalogusprijs' WHERE id=$licenseid";

        if (mysqli_query($i_conn, $sqlu)) {
            echo "! Kenteken data aangepast met brand en model, tenaamstelling informatie en apk info.<br/>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }


        // 

        $query112c = "SELECT * FROM car_model_types WHERE type LIKE '%$type%'";

        $data112c=mysqli_query($i_conn,$query112c);   

        while($row112c=mysqli_fetch_array($data112c))
        {
            $type_id = $row112c['id'];
        };

        if($type_id == "")
        {
            $sql4 = "INSERT INTO car_model_types (brand_id, model_id, type) VALUES ('$brand_id', '$model_id', '$type')";

            if (mysqli_query($i_conn, $sql4)) 
            {
                $type_id = mysqli_insert_id($i_conn);
                echo"+ Type $type toegevoegd aan onze database <br/>";
            }
        }

        $query112cd = "SELECT * FROM car_model_types_variants WHERE variant LIKE '%$variant%'";

        $data112cd=mysqli_query($i_conn,$query112cd);   

        while($row112cd=mysqli_fetch_array($data112cd))
        {
            $variantid = $row112cd['id'];
        };

        if($variantid == "")
        {
            $sql5 = "INSERT INTO car_model_types_variants (brand_id, model_id, type_id, variant, build) VALUES ('$brand_id', '$model_id', '$type_id', '$variant', '$uitvoering')";

            if (mysqli_query($i_conn, $sql5)) 
            {
                $type_id = mysqli_insert_id($i_conn);
                echo"+ Variant $variant en uitvoering $uitvoering toegevoegd aan onze database <br/>";
            }
        }


    }

    $err = curl_error($curl);

    curl_close($curl);
};
?>