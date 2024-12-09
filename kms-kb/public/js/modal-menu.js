// btn_first_stage
// btn_second_stage
// btn_third_stage

// third_stage_export_cars_mgr
// second_stage_export_cars_mgr
// first_stage_export_cars

// export_car_stages
// btn_stages


$(document).ready(function() {
    
    $('body').on('click', '.btn_second_stage', function() {     
        var menuchoice = $('input[name="menuchoice_export"]:checked').val();        

        if(menuchoice == "mgr")
        {
            $('.export_car_stages').fadeOut(300);                   
            $('.btn_stages').fadeOut(300);       
            $('.btn_first_stage').delay(310).fadeIn('slow');
            $('.btn_third_stage').delay(310).fadeIn('slow');
            $('.second_stage_export_cars_mgr').delay(310).fadeIn('slow');
        }
    });

    $('body').on('click', '.btn_first_stage', function() {                    
        $('.export_car_stages').fadeOut(300);                       
        $('.btn_stages').fadeOut(300);            
        $('.btn_second_stage').delay(310).fadeIn('slow');
        $('.first_stage_export_cars').delay(310).fadeIn('slow');
    });
    $('body').on('click', '.btn_second_stage_return', function() {                 
        $('.export_car_stages').fadeOut(300);                   
        $('.btn_stages').fadeOut(300);       
        $('.btn_first_stage').delay(310).fadeIn('slow');
        $('.btn_third_stage').delay(310).fadeIn('slow');
        $('.second_stage_export_cars_mgr').delay(310).fadeIn('slow');
    });
    $('body').on('click', '.btn_third_stage', function() {                       
        $('.export_car_stages').fadeOut(300);             
        $('.btn_stages').fadeOut(300);          
        $('.btn_second_stage_return').delay(310).fadeIn('slow');   
        $('.third_stage_export_cars_mgr').delay(310).fadeIn('slow');
        $('.btn_submit_export').delay(310).fadeIn('slow');   
    });
    $('body').on('click', '.btn_submit_export', function() {      
        var exporttype = $('input[name="menuchoice_mgr_export"]:checked').val();  
        var menuchoice_mgr = $('input[name="menuchoice_mgr"]:checked').val();        
        if(menuchoice_mgr == "mgr_xslx")
        {
            window.location.replace("http://localhost/kms-apeldoorn.nl/api/mgr/spreadsheet/"+exporttype+'.php');
        }
    });







    $('body').on('click', '.btn_second_stage', function() {     
        var menuchoice = $('input[name="menuchoice_export"]:checked').val();        

        if(menuchoice == "mgr")
        {
            $('.export_ticket_stages').fadeOut(300);                   
            $('.btn_stages').fadeOut(300);       
            $('.btn_first_stage').delay(310).fadeIn('slow');
            $('.btn_third_stage').delay(310).fadeIn('slow');
            $('.second_stage_export_tickets_mgr').delay(310).fadeIn('slow');
        }
    });

    $('body').on('click', '.btn_first_stage', function() {                    
        $('.export_ticket_stages').fadeOut(300);                       
        $('.btn_stages').fadeOut(300);            
        $('.btn_second_stage').delay(310).fadeIn('slow');
        $('.first_stage_export_tickets').delay(310).fadeIn('slow');
    });
    $('body').on('click', '.btn_second_stage_return', function() {                 
        $('.export_ticket_stages').fadeOut(300);                   
        $('.btn_stages').fadeOut(300);       
        $('.btn_first_stage').delay(310).fadeIn('slow');
        $('.btn_third_stage').delay(310).fadeIn('slow');
        $('.second_stage_export_tickets_mgr').delay(310).fadeIn('slow');
    });
    $('body').on('click', '.btn_third_stage', function() {                       
        $('.export_ticket_stages').fadeOut(300);             
        $('.btn_stages').fadeOut(300);          
        $('.btn_second_stage_return').delay(310).fadeIn('slow');   
        $('.third_stage_export_tickets_mgr').delay(310).fadeIn('slow');
        $('.btn_submit_export').delay(310).fadeIn('slow');   
    });
    $('body').on('click', '.btn_submit_export', function() {      
        var exporttype = $('input[name="menuchoice_mgr_export"]:checked').val();  
        var menuchoice_mgr = $('input[name="menuchoice_mgr"]:checked').val();        
        if(menuchoice_mgr == "mgr_xslx")
        {
            window.location.replace("http://localhost/kms-apeldoorn.nl/api/mgr/spreadsheet/"+exporttype+'.php');
        }
    });


    
});