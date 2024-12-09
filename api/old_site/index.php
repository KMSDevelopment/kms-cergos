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
echo "END POINT DB CONNECTED successfully<Br/>";



$query = "SELECT * FROM apis WHERE active=1";

$data=mysqli_query($i_conn,$query);   

while($row=mysqli_fetch_array($data))
{
    $api_id = $row['id'];
    $endpoint = $row['endpoint'];
    $credentials = $row['credentials'];


    if($endpoint == "http://localhost/kms-apeldoorn.nl/api/old_site/index.php")
    {

            $query = "SELECT * FROM node WHERE type='reparaties'";

            $data=mysqli_query($conn,$query);   

            while($row=mysqli_fetch_array($data)){
                $nid = $row['nid'];
                $title = $row['title'];
                


                $query1 = "SELECT * FROM node_revision WHERE nid='$nid'";

                $data1=mysqli_query($conn,$query1);   

                while($row1=mysqli_fetch_array($data1)){
                    $rev_title = $row1['title'];
                };


                $query2 = "SELECT * FROM field_data_field_omschrijving WHERE entity_id='$nid'";

                $data2=mysqli_query($conn,$query2);   

                while($row2=mysqli_fetch_array($data2)){
                    $field_omschrijving_value = $row2['field_omschrijving_value'];
                };


                $query2 = "SELECT * FROM field_data_field_reparatiebeschrijving WHERE entity_id='$nid'";

                $data2=mysqli_query($conn,$query2);   

                while($row2=mysqli_fetch_array($data2)){
                    $field_reparatiebeschrijving_value = $row2['field_reparatiebeschrijving_value'];
                };


                echo"<h2>$title</h2><h3>$rev_title</h3> <br/> <h4>Klacht omschrijving</h4> <p>$field_omschrijving_value</p> <h4>Reparatie beschrijving</h4><p>$field_reparatiebeschrijving_value</p> ";

                echo"<h4>Onderdeelnummers</h4>";

                $query21 = "SELECT * FROM field_data_field_onderdeelnummers WHERE entity_id='$nid'";

                $data21=mysqli_query($conn,$query21);   

                while($row21=mysqli_fetch_array($data21)){
                    $field_onderdeelnummers_value = $row21['field_onderdeelnummers_value'];

                    echo"$field_onderdeelnummers_value";
                };


                echo"<h4>Merk, model en type.</h4>";
                $models = "";

                $query3 = "SELECT * FROM taxonomy_index WHERE nid='$nid'";

                $data3=mysqli_query($conn,$query3);   

                while($row3=mysqli_fetch_array($data3)){
                    $tid = $row3['tid'];

                    $query4 = "SELECT * FROM taxonomy_term_data WHERE tid='$tid'";

                    $data4=mysqli_query($conn,$query4);   
                
                    while($row4=mysqli_fetch_array($data4)){
                        $name = $row4['name'];
                        $models =  "$name, $models";
                    };

                };

                echo"<br/>==================================================<br/><br/><br/><br/>";






                $sql = "INSERT INTO revisions (api_id, title, complain_desc, revision_desc, parts, models) VALUES ('$api_id', '$rev_title', '$field_omschrijving_value', '$field_reparatiebeschrijving_value', '$field_onderdeelnummers_value', '$models')";

                if (mysqli_query($i_conn, $sql)) {
                    echo"DATA INSERTED<br/><Br/>";
                }



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
