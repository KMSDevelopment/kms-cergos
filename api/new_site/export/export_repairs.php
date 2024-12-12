<?php

    // DELETE 

    $strapi_api = "e3909cd5f9a52ffa9ee773937cd711c87bb43f0aadbe14c502b3c8714fa6901c69f061bc2d38b0ebd6ee808dbdfdf451a952876023893ad0d91ce412ece73bd582a0afd2e91422a374c50e8b3df0911cdc3333387a4300068e84405b73658043b71b468b84e3c387773502df266099692c1ca796ed3f488af55645cb064fadf9";
    // $ch = curl_init();
            
    // curl_setopt($ch, CURLOPT_URL, 'https://cms.kms-apeldoorn.webbers.dev/api/repairs/26');
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // $headers = array();
    // $headers[] = 'Authorization: Bearer '.$strapi_api;
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);    

    // $result = curl_exec($ch);
    // if (curl_errno($ch)) {
    //     echo 'Error:' . curl_error($ch);
    // }

    // curl_close($ch);

    // $array = json_decode($result);

    // var_dump($array);



    // CREATE 


    // Invalid relations error -> what to do what to doo?
    


    $ch = curl_init();

    $json = '{ "data": { "title": "test REPAIR", "slug": "chevrolet/g20/3de-gen-vanaf-1971/reparatie-tellerpaneel-chevrolet-g20-uitval-1-meerdere", "error_description": "een test reparatie ingeschoten", "part_numbers": "12432423432,134234234236,32412,21245677", "price": 20, "locale": "nl", "brand_model_type": "Chevrolet G20 3de gen. vanaf 1971", "mgr_thumbnail": "https://www.mygadgetrepairs.com/document/product/2024/11/T4HXXSZZ-large.jpg", "MyGadgetRepair.issueType": 5603, "MyGadgetRepair.deviceModel": [432108, 454732]}}';

    // $array = array('data');
    // $array['data'] = array('title'=>'test', "slug"=>"chevrolet/g20/3de-gen-vanaf-1971/reparatie-tellerpaneel-chevrolet-g20-uitval-1-meerdere", "error_description"=>"een test reparatie ingeschoten", "part_numbers"=> "12432423432,134234234236,32412,21245677", "price"=> '20', "locale"=> "nl", "brand_model_type"=> "Chevrolet G20 3de gen. vanaf 1971", "mgr_thumbnail"=> "https://www.mygadgetrepairs.com/document/product/2024/11/T4HXXSZZ-large.jpg");

    // var_dump($array);

    curl_setopt($ch, CURLOPT_URL,"https://cms.kms-apeldoorn.webbers.dev/api/repairs");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    $headers = array();
    $headers[] = 'Content-Type:application/json';
    $headers[] = 'Authorization: Bearer '.$strapi_api;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    // Receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $server_output = curl_exec($ch);
    
    curl_close($ch);
    $array = json_decode($server_output);

    var_dump($array);




?>