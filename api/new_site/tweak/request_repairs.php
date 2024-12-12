<div class="loading" style="position:fixed; z-index:9999999; top:0px; left:0px; width:100%; height:100%; overflow-y:scroll; background:#000;">
    <table style="width:100%; height:100%;">
        <tr>
            <td style="width:100%; height:100%; text-align:center; vertical-align:middle; color:#FFF;">
                <img src="../../logo_cockpit.png" style="width:250px;"><br/>
                <img src="../../loader.gif" style="width:100px;"><br/>
                <span style="color:#FFF;">Data loading please wait..</span><br/>
                    <?php
                    include "../../db.php";

                    $strapi_api = "e3909cd5f9a52ffa9ee773937cd711c87bb43f0aadbe14c502b3c8714fa6901c69f061bc2d38b0ebd6ee808dbdfdf451a952876023893ad0d91ce412ece73bd582a0afd2e91422a374c50e8b3df0911cdc3333387a4300068e84405b73658043b71b468b84e3c387773502df266099692c1ca796ed3f488af55645cb064fadf9";
                    $ch = curl_init();
                            
                    curl_setopt($ch, CURLOPT_URL, 'https://cms.kms-apeldoorn.webbers.dev/api/repairs?publicationState=preview&pagination[pageSize]=3000');
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    $headers = array();
                    $headers[] = 'Authorization: Bearer '.$strapi_api;
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
                        foreach($data as $repair)
                        {
                            // var_dump($repair);

                            if($repair->title != null && $repair->title != "")
                            {
                                $revision_id = "";
                                $repairtitle = mysqli_real_escape_string($i_conn, $repair->title);

                                $query13 = "SELECT * FROM revisions WHERE title LIKE '%$repairtitle%'";

                                $data13=mysqli_query($i_conn,$query13);   

                                while($row13=mysqli_fetch_array($data13))
                                {
                                    $revision_id = $row13['id'];
                                };

                                if($revision_id != "")
                                {
                                    echo"Reparatie $repair->title gevonden met id $revision_id ";
                                    $sql = "UPDATE revisions SET site='$repair->id' WHERE id=$revision_id";
                                    if (mysqli_query($i_conn, $sql)) {
                                        echo"+ Reparatie is aangepast met het id v/d site $repair->id<br/>";
                                    }
                                }

                                echo"<br/>";
                            }
                        }
                    }
                    ?>
            </td>
        </tr>
    </table>
</div>
