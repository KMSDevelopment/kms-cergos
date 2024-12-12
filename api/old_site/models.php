
<?php

include "../db.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kms_old";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "END POINT DB CONNECTED successfully<Br/><Br/>";



function htmlToPlainText($str){
    $str = str_replace('&nbsp;', ' ', $str);
    $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
    $str = html_entity_decode($str);
    $str = htmlspecialchars_decode($str);
    $str = strip_tags($str);

    return $str;
}




$query4 = "SELECT * FROM taxonomy_term_data";

$data4=mysqli_query($conn,$query4);   

while($row4=mysqli_fetch_array($data4)){
    $tidher = $row4['tid'];
    $brand = mysqli_real_escape_string($i_conn, $row4['name']);
    $brand_id = "";


    // brand check 

    $query12 = "SELECT * FROM car_brands WHERE brand='$brand' LIMIT 1";

    $data12=mysqli_query($i_conn,$query12);   

    while($row12=mysqli_fetch_array($data12)){
        $brand_id = $row12['id'];
    };


    if($brand_id != "")
    {
        echo"$brand - gevonden in db = ID: $brand_id<br/><br/>";


        $query45 = "SELECT * FROM taxonomy_term_hierarchy WHERE parent='$tidher'";

        $data45=mysqli_query($conn,$query45);   

        while($row45=mysqli_fetch_array($data45)){
            $tidher = $row45['tid'];

            $query457 = "SELECT * FROM taxonomy_term_data WHERE tid='$tidher' AND vid='2'";

            $data457=mysqli_query($conn,$query457);   

            while($row457=mysqli_fetch_array($data457)){
                $tid2 = $row457['tid'];
                $model = mysqli_real_escape_string($i_conn, $row457['name']);

                // alle modellen van de auto
                echo"<strong>MODEL $tid2 = $model </strong><br/>";


                
                
                
                // INSERT MODEL OF CAR
                $sql = "INSERT INTO car_brand_models (api_id, brand_id, model_id, model, img) VALUES ('6', '$brand_id', '$tid2', '$model', NULL)";

                if (mysqli_query($i_conn, $sql)) {
                    echo"<em>CAR MODEL DATA INSERTED</em><br/>";
                    $model_id = mysqli_insert_id($i_conn);
                }







                echo"===========================================================<br/>";
                // REPARATIE DATA
                echo"Reparatie voor model $model wat tid = $tid2<br/>";

                $query45xz = "SELECT * FROM taxonomy_term_hierarchy WHERE parent='$tid2'";

                $data45xz=mysqli_query($conn,$query45xz);   

                while($row45xz=mysqli_fetch_array($data45xz)){
                    $tidher = $row45xz['tid'];

                    $query457dd = "SELECT * FROM taxonomy_term_data WHERE tid='$tidher'";

                    $data457dd=mysqli_query($conn,$query457dd);   

                    while($row457dd=mysqli_fetch_array($data457dd)){
                        $tid2 = $row457dd['tid'];
                        $type = mysqli_real_escape_string($i_conn, $row457dd['name']);
                    };
                    // BOUWJAAR TYPE
                    echo"$tid2 = $type <br/>";

                    // INSERT MODEL OF CAR
                    $sql = "INSERT INTO car_model_types (brand_id, model_id, type) VALUES ('$brand_id', '$model_id', '$type')";

                    if (mysqli_query($i_conn, $sql)) {
                        echo"<em>CAR TYPE DATA INSERTED</em><br/>";
                        $type_id = mysqli_insert_id($i_conn);
                    }



                    $query4576x = "SELECT * FROM taxonomy_index WHERE tid='$tidher'";

                    $data4576x=mysqli_query($conn,$query4576x);   
                
                    while($row4576x=mysqli_fetch_array($data4576x))
                    {
                        $nid  = $row4576x['nid'];

                        echo"NID = $nid <br/>";



                        // LOAD REVISION


                        $query45769y = "SELECT * FROM node WHERE nid='$nid'";
                
                        $data45769y=mysqli_query($conn,$query45769y);   
                
                        while($row45769y=mysqli_fetch_array($data45769y)){
                            $title  = mysqli_real_escape_string($i_conn, $row45769y['title']);
                            echo"Reparatie $title <br/> ";
                        };

                        $query2 = "SELECT * FROM field_data_field_omschrijving WHERE entity_id='$nid'";

                        $data2=mysqli_query($conn,$query2);   

                        while($row2=mysqli_fetch_array($data2)){
                            $field_omschrijving_value = mysqli_real_escape_string($i_conn, htmlToPlainText($row2['field_omschrijving_value']));
                        };
                    

                        echo"<br/>Onderdeelnummers<br/>";

                        $query21 = "SELECT * FROM field_data_field_onderdeelnummers WHERE entity_id='$nid'";

                        $data21=mysqli_query($conn,$query21);   

                        while($row21=mysqli_fetch_array($data21)){
                            $field_onderdeelnummers_value = mysqli_real_escape_string($i_conn, htmlToPlainText($row21['field_onderdeelnummers_value']));

                            echo"$field_onderdeelnummers_value <br/>";
                        };



                        echo"<br/>Prijs<br/>";

                        $query21g = "SELECT * FROM field_revision_field_inkoopprijs_int WHERE revision_id='$nid'";

                        $data21g=mysqli_query($conn,$query21g);   

                        while($row21g=mysqli_fetch_array($data21g)){
                            $field_inkoopprijs_int_value = mysqli_real_escape_string($i_conn, htmlToPlainText($row21g['field_inkoopprijs_int_value']));

                            echo"$field_inkoopprijs_int_value <br/>";
                        };


                        echo"<br/>Soort onderdeel<br/>";

                        $query21gx = "SELECT * FROM field_revision_field_onderdeel WHERE revision_id='$nid'";

                        $data21gx=mysqli_query($conn,$query21gx);   

                        while($row21gx=mysqli_fetch_array($data21gx)){
                            $field_onderdeel_value = mysqli_real_escape_string($i_conn, htmlToPlainText($row21gx['field_onderdeel_value']));

                            echo"$field_onderdeel_value <br/>";
                        };



                        // CREATE REVISION

                        $sql2 = "INSERT INTO revisions (api_id, title, complain_desc, revision_desc, parts, models, price_inc) VALUES ('6', '$title', '$field_omschrijving_value', '$field_onderdeel_value m.b.t. $brand $model $type', '$field_onderdeelnummers_value', 'NULL', '$field_inkoopprijs_int_value')";

                        if (mysqli_query($i_conn, $sql2)) {
                            echo"<em>REVISION DATA INSERTED</em><br/>";
                            $revision_id = mysqli_insert_id($i_conn);
                        }

                        $sqlzz = "INSERT INTO revision_models (revision_id, brand_id, model_id, type_id) VALUES ('$revision_id', '$brand_id', '$model_id', '$type_id')";

                        if (mysqli_query($i_conn, $sqlzz)) {
                            echo"<em>REVISION CAR MODEL RELATION INSERTED</em><br/>";
                        }
            

                        // CREATE MANUAL 

                        $query2 = "SELECT * FROM field_data_field_reparatiebeschrijving WHERE entity_id='$nid'";

                        $data2=mysqli_query($conn,$query2);   

                        while($row2=mysqli_fetch_array($data2)){
                            $field_reparatiebeschrijving_value = mysqli_real_escape_string($i_conn, htmlToPlainText($row2['field_reparatiebeschrijving_value']));
                        };

                        $sql3 = "INSERT INTO manuals (revision_id, title, text) VALUES ('$revision_id', '$title - $field_onderdeel_value m.b.t. $brand $model $type', '$field_reparatiebeschrijving_value')";

                        if (mysqli_query($i_conn, $sql3)) {
                            echo"<em>REVISION DATA INSERTED</em><br/>";
                            $manual_id = mysqli_insert_id($i_conn);
                        }

                        // IMAGES
                        $query457ddd = "SELECT * FROM field_data_field_afbeeldingen WHERE revision_id='$nid'";

                        $data457ddd=mysqli_query($conn,$query457ddd);   

                        while($row457ddd=mysqli_fetch_array($data457ddd))
                        {
                            $fid = $row457ddd['field_afbeeldingen_fid'];

                            $query457dddd = "SELECT * FROM file_managed WHERE fid='$fid'";

                            $data457dddd=mysqli_query($conn,$query457dddd);   

                            while($row457dddd=mysqli_fetch_array($data457dddd)){
                                $uri = $row457dddd['uri'];
                                $file_name = str_replace("public://", "", $uri);
                                $extarray = explode(".", $file_name);
                                $ext = $extarray[1];
                                $uri = str_replace("public://", "https://kms-apeldoorn.nl/sites/default/files/styles/reparatie_thumb/public/", $uri);

                                $sql3 = "INSERT INTO media (revision_id, manual_id, file_name, file_link, extension) VALUES ('$revision_id', '$manual_id', '$file_name', '$uri', '$ext')";

                                if (mysqli_query($i_conn, $sql3)) {
                                    echo"<em>MANUAL DATA INSERTED</em><br/>";
                                    $manual_id = mysqli_insert_id($i_conn);
                                }
                            };

                        };





                        echo"===========================================================<br/><br/><br/>";

                    };






                    // 1255 is 147 model
                };
                echo"<br/><br/> ";

            };


            
        };


    }

};


// Abarth
// Aiways
// Alfa Romeo
// Alpine
// Aston Martin
// Audi
// Bentley
// BMW
// Bugatti
// BYD
// Cadillac
// Caterham
// Chevrolet
// Citroën
// Cupra
// Dacia
// Donkervoort
// DS
// Ferrari
// Fiat
// Fisker
// Ford
// Honda
// Hongqi
// Hyundai
// Ineos
// Infiniti
// Isuzu
// Iveco
// Jaguar
// Jeep
// Kia
// Lamborghini
// Lancia
// Land Rover
// Lexus
// Lightyear
// Lotus
// Lucid
// Lynk & Co
// Maserati
// Mazda
// McLaren
// Mercedes-Benz
// MG
// Micro Mobility Systems
// MINI
// Mitsubishi
// Morgan
// NIO
// Nissan
// Opel
// Peugeot
// Polestar
// Porsche
// Renault
// Rolls-Royce
// SEAT
// Skoda
// Smart
// SsangYong
// Subaru
// Suzuki
// Tesla
// Toyota
// TVR
// VinFast
// Volkswagen
// Volvo
// XPeng


?>
