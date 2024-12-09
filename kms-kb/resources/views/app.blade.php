<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- <link href="/css/style.css" rel="stylesheet" /> -->
        <link href="/css/register-style.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Funnel+Sans:ital,wght@0,300..800;1,300..800&family=Racing+Sans+One&display=swap" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet"/>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <!-- Import editor -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/editor/src/richtext.min.css">
        <script type="text/javascript" src="/editor/src/jquery.richtext.js"></script>
        <script src="/js/modal-menu.js"></script>
        <script src="/js/register.js"></script>
        <script>
            $(document).ready(function() {
                
                $('.editor').richText();
               

                $('[data-toggle="tooltip"]').tooltip()
                $(document).scroll(function() {
                    if ($(document).scrollTop() >= 200) {
                        $('.menubar').addClass('hasScrolled');
                    } else {
                        $('.menubar').removeClass('hasScrolled');
                    }
                });


                $('body').on('click', '#btn-api', function() {                    
                    $('#exampleModal').modal('toggle');
                });

                $('.kms-preloader').delay(900).slideUp("slow");

                $('body').on('click', '.model_li', function() {
                    $('.kms-preloader').slideDown("slow");
                });
                

                $('body').on('click', '.btndelpart', function() {
                    var id = $(this).attr("id");
                    if (confirm("Weet je zeker dat je dit onderdeel uit deze ticket wilt verwijderen") == true) {
                        $.ajax({
                            url: '/ticket/part/delete', // The URL to which the request is sent
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                            data: { id: id }, // Data to be sent to the server
                            success: function(response) {
                                // Code to execute if the request succeeds
                                location.reload();
                                console.log("Part deleted");
                            },
                            error: function(xhr, status, error) {
                                // Code to execute if the request fails
                                location.reload();
                                console.log('Error:', error);
                            }
                        });
                    }
                });

                $('body').on('click', '.btn-edit-api', function() {
                    var id = $(this).attr("id");
                    $.ajax({
                        url: '/api/read', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { id: id }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            console.log(response);
                            var type = response.type;
                            var desc = response.desc;
                            var platform = response.platform;
                            var docs = response.docs;
                            
                            $(".api_id").val(id);
                            $(".apitypes").prop("checked", false);
                            $(".type_"+type).prop("checked", true);
                            $(".desc").val(desc);
                            $(".platform").val(platform);
                            $(".docs").val(docs);
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });
                    $('.mdl-edit-api').modal('toggle');
                });


                $('body').on('click', '.btn-del-api', function() {
                    var id = $(this).attr("id");
                    if (confirm("Weet je zeker dat je dit record wilt verwijderen") == true) {
                        $.ajax({
                            url: '/api/delete', // The URL to which the request is sent
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                            data: { id: id }, // Data to be sent to the server
                            success: function(response) {
                                // Code to execute if the request succeeds
                                location.reload();
                                console.log("Api deleted");
                            },
                            error: function(xhr, status, error) {
                                // Code to execute if the request fails
                                location.reload();
                                console.log('Error:', error);
                            }
                        });
                    }
                });


                $('body').on('click', '.btn_exec_api', function() {
                    
                    var typerequest = "";
                    if($('.1voor1').is(':checked')) 
                    { 
                        typerequest = "1voor1";
                    }
                    else($('.redirectexec').is(':checked')) 
                    { 
                        typerequest = "redirect";
                    }


                    $.ajax({
                        url: '/apis/read', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { id: '1' }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            if(response.count == 0)
                            {
                                alert("Geen api's gevonden om aan te roepen");   
                            }
                            else
                            {
                                console.log(response);
                                $.each(response, function (i, api) {
                                    for (var i in api) {
                                        if(typerequest == "redirect")
                                        {
                                            window.open(api[i].api_route, '_blank');
                                        }
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });
                });



                $('body').on('click', '.closemdl', function() {
                    $('.modal').modal('hide');
                });

                $('body').on('click', '#btn-api-automate', function() {
                    $('.mdl-automate-api').modal('toggle');
                });

                $('body').on('click', '.model_li', function() {
                    var id = $(this).attr("alt");
                    window.location.replace("/car/model/"+id);
                });
                
                $('body').on('click', '#btn-api-execute', function() {
                    $('.mdl-execute-api').modal('toggle');
                });

                $('body').on('click', '#btn-add-type', function() {
                    var id = $(this).attr("alt");
                    $('.car_model_id').val(id);
                    var brandid = $(this).attr("title");
                    $('.car_brand_id').val(brandid);
                    $('.mdl-add-type').modal('toggle');
                });
                


                $('body').on('click', '.btnlinkcustomers', function() {
                    var count = 0;
                    var brandid = $('.brandid_hid').val();
                    var brandname = $('.brandname_hid').val();
                    brandname=brandname.toLowerCase();

                    $.ajax({
                        url: '/car/customers/unlink', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { brandid:brandid }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });

                    $('.chbcustomers').each(function () {
                        if (this.checked) {
                            count = count + 1;
                            var value = $(this).val();
                            $.ajax({
                                url: '/car/customers/link', // The URL to which the request is sent
                                dataType: "json",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                                data: { id: value, brandid:brandid }, // Data to be sent to the server
                                success: function(response) {
                                    // Code to execute if the request succeeds
                                },
                                error: function(xhr, status, error) {
                                    // Code to execute if the request fails
                                    console.log('Error:', error);
                                }
                            });
                        }
                    });

                    
                    location.reload();
                });



                $('body').on('click', '#btn-link-klanten', function() {

                    var brandid = $(this).attr("alt");
                    var brandname = $(this).attr("title");
                    $('.brandid_hid').val(brandid);
                    $('.brandname_hid').val(brandname.toLowerCase());
                    $('.mdl-link-klanten').modal('toggle');

                    $.ajax({
                        url: '/customers/read', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { id: brandid }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            if(response.count == 0)
                            {
                                alert("Geen klanten gevonden");   
                            }
                            else
                            {
                                $("#tbody_customers").empty();
                                $.each(response.customers, function (i, customers) {
                                    if(response.custom.indexOf(customers.id) ==! -1)
                                    {
                                        $('.customers_table > tbody:last-child').append('<tr class="chbmodel_'+customers.id+'"><td><input type="checkbox" class="chbcustomers"  name="chbcustomers" value="'+customers.id+'" checked></td><td>'+customers.firstname+' '+customers.lastname+'</td></tr>');
                                    }
                                    else
                                    {
                                        $('.customers_table > tbody:last-child').append('<tr class="chbmodel_'+customers.id+'"><td><input type="checkbox" class="chbcustomers"  name="chbcustomers" value="'+customers.id+'"></td><td>'+customers.firstname+' '+customers.lastname+'</td></tr>');
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });
                });

                $('body').on('click', '.closemdlmodels', function() {
                    var id = $('.brandid_hid').val();
                    window.location.replace("/rkb/cars#"+id);
                });







                $('body').on('change', '.brandsselect', function() {
                    var id = $(this).val();

                    if(id == "all")
                    {
                        $('.allmodels').fadeIn("slow");
                    }
                    else
                    {
                        $('.allmodels').fadeOut(300);
                        $('.brand'+id).delay(310).fadeIn("slow");
                    }

                });

                $('body').on('click', '.btn-link-modellen-revisions', function() {

                    var id = $(this).attr('id');
                    $('.revision_id').val(id);
                    $('.mdl-link-modellen-revisions').modal('toggle');


                    $.ajax({
                        url: '/brands/all', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { id: id }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            if(response.count == 0)
                            {
                                alert("Geen merken gevonden");   
                            }
                            else
                            {
                                $.each(response.brands, function (i, brands) {
                                    $('.brandsselect').append($('<option>', {
                                        value: brands.id,
                                        text: brands.brand
                                    }));
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });
                    
                        
                    $.ajax({
                        url: '/revision/modellen/read', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { id: id }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            if(response.count == 0)
                            {
                                alert("Geen klanten gevonden");   
                            }
                            else
                            {
                                $("#tbody_modellen").empty();
                                $.each(response.modellen, function (i, modellen) {
                                    if(response.custom.indexOf(modellen.id) ==! -1)
                                    {
                                        $('.modellen_table > tbody:last-child').append('<tr class="chbmodellen_'+modellen.id+' allmodels brand'+modellen.brand.id+'"><td><input type="checkbox" class="chbmodellen"  name="chbmodellen" value="'+modellen.id+' brand'+modellen.brand.brand+'" checked></td><td>'+modellen.brand.brand+ ' - ' +modellen.model+'</td></tr>');
                                    }
                                    else
                                    {
                                        $('.modellen_table > tbody:last-child').append('<tr class="chbmodellen_'+modellen.id+' allmodels brand'+modellen.brand.id+'"><td><input type="checkbox" class="chbmodellen"  name="chbmodellen" value="'+modellen.id+'"></td><td>'+modellen.brand.brand+ ' - ' +modellen.model+'</td></tr>');
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });
                });

                $('body').on('click', '.btnlinkmodellenrevision', function() {
                    var count = 0;
                    var revision_id = $('.revision_id').val();
                    $.ajax({
                        url: '/revision/modellen/unlink', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { revision_id:revision_id }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });

                    $('.chbmodellen').each(function () {
                        if (this.checked) {
                            count = count + 1;
                            var value = $(this).val();
                            $.ajax({
                                url: '/revision/modellen/link', // The URL to which the request is sent
                                dataType: "json",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                                data: { model_id: value, revision_id:revision_id }, // Data to be sent to the server
                                success: function(response) {
                                    // Code to execute if the request succeeds
                                },
                                error: function(xhr, status, error) {
                                    // Code to execute if the request fails
                                    console.log('Error:', error);
                                }
                            });
                        }
                    });

                    $('.mdl-link-modellen-revisions').modal('hide');
                    location.reload();
                    
                });












                $('body').on('click', '.btn-link-klanten-revisions', function() {

                    var id = $(this).attr('id');
                    $('.revision_id').val(id);
                    $('.mdl-link-klanten-revisions').modal('toggle');

                    $.ajax({
                        url: '/revision/customers/read', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { id: id }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            if(response.count == 0)
                            {
                                alert("Geen klanten gevonden");   
                            }
                            else
                            {
                                $("#tbody_customers2").empty();
                                $.each(response.customers, function (i, customers) {
                                    if(response.custom.includes(customers.id))
                                    {
                                        $('.customers_table2 > tbody:last-child').append('<tr class="chbmodel_'+customers.id+'"><td><input type="checkbox" class="chbcustomers"  name="chbcustomers" value="'+customers.id+'" checked></td><td>'+customers.firstname+' '+customers.lastname+'</td></tr>');
                                    }
                                    else
                                    {
                                        $('.customers_table2 > tbody:last-child').append('<tr class="chbmodel_'+customers.id+'"><td><input type="checkbox" class="chbcustomers"  name="chbcustomers" value="'+customers.id+'"></td><td>'+customers.firstname+' '+customers.lastname+'</td></tr>');
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });

                });


                $('body').on('click', '.btnlinkcustomersrevision', function() {
                    var count = 0;
                    var revision_id = $('.revision_id').val();
                    $.ajax({
                        url: '/revision/customers/unlink', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { revision_id:revision_id }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });

                    $('.chbcustomers').each(function () {
                        if (this.checked) {
                            count = count + 1;
                            var value = $(this).val();
                            $.ajax({
                                url: '/revision/customers/link', // The URL to which the request is sent
                                dataType: "json",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                                data: { customer_id: value, revision_id:revision_id }, // Data to be sent to the server
                                success: function(response) {
                                    // Code to execute if the request succeeds
                                },
                                error: function(xhr, status, error) {
                                    // Code to execute if the request fails
                                    console.log('Error:', error);
                                }
                            });
                        }
                    });
                    
                    $('.mdl-link-klanten-revisions').modal('hide');
                    location.reload();
                    
                });













                $('body').on('click', '.btn-del-cars', function() {
                    var id = $(this).attr("id");
                    var count = 0;
                    
                    $('.chbcars').each(function () {
                        if (this.checked) {
                            count = count + 1;
                            var value = $(this).val();
                        }
                    });

                    if(count == 0)
                    {
                        alert("Selecteer de merken die u wilt verwijderen..");
                    }
                    else
                    {
                        if (confirm("Weet je zeker dat je deze record(s) wilt verwijderen") == true) {
                            
                            $('.chbcars').each(function () {
                                if (this.checked) {
                                    var value = $(this).val();
                                    
                                    $.ajax({
                                        url: '/car/delete', // The URL to which the request is sent
                                        dataType: "json",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                                        data: { id: value }, // Data to be sent to the server
                                        success: function(response) {
                                            // Code to execute if the request succeeds
                                            console.log("Auto verwijderd");
                                        },
                                        error: function(xhr, status, error) {
                                            // Code to execute if the request fails
                                            console.log('Error:', error);
                                        }
                                    });
                                    $('.car'+value).fadeOut(300);
                                }
                            });
                        }
                    }
                });



                
                $('body').on('click', '.btndeltype', function() {
                    var count = 0;
                    if (confirm("Weet je zeker dat je deze uitvoering wilt verwijderen") == true) {
                        var value = $(this).attr('id');
                        $.ajax({
                            url: '/car/model/type/delete', // The URL to which the request is sent
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                            data: { id: value }, // Data to be sent to the server
                            success: function(response) {
                                // Code to execute if the request succeeds
                            },
                            error: function(xhr, status, error) {
                                // Code to execute if the request fails
                                console.log('Error:', error);
                            }
                        });
                        $('#type'+value).fadeOut(300);
                    }
                });

                $('body').on('click', '.btndeltypevariant', function() {
                    var count = 0;
                    if (confirm("Weet je zeker dat je deze variant wilt verwijderen") == true) {
                        var value = $(this).attr('id');
                        $.ajax({
                            url: '/car/model/type/variant/delete', // The URL to which the request is sent
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                            data: { id: value }, // Data to be sent to the server
                            success: function(response) {
                                // Code to execute if the request succeeds
                            },
                            error: function(xhr, status, error) {
                                // Code to execute if the request fails
                                console.log('Error:', error);
                            }
                        });
                        $('#variant'+value).fadeOut(300);
                    }
                });


                $('body').on('click', '#btn-del-models', function() {
                    var count = 0;
                    $('.chbmodels').each(function () {
                        if (this.checked) {
                            count = count + 1;
                            var value = $(this).val();
                            $.ajax({
                                url: '/car/model/delete', // The URL to which the request is sent
                                dataType: "json",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                                data: { id: value }, // Data to be sent to the server
                                success: function(response) {
                                    // Code to execute if the request succeeds
                                    $('.chbmodel_'+value).fadeOut(300);
                                },
                                error: function(xhr, status, error) {
                                    // Code to execute if the request fails
                                    console.log('Error:', error);
                                }
                            });
                        }
                        if(count == 0)
                        {
                            alert("Selecteer modellen die u wilt verwijderen..");
                        }
                    });
                });



                $('body').on('click', '.btndelmodelticket', function() {
                    var count = 0;
                    $('.chbmodelrevisions').each(function () {
                        if (this.checked) {
                            count = count + 1;
                            var value = $(this).val();
                            var model = $(this).attr('alt');
                            $.ajax({
                                url: '/car/model/revision/delete', // The URL to which the request is sent
                                dataType: "json",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                                data: { id: value, model: model }, // Data to be sent to the server
                                success: function(response) {
                                    // Code to execute if the request succeeds
                                },
                                error: function(xhr, status, error) {
                                    // Code to execute if the request fails
                                    console.log('Error:', error);
                                }
                            });
                            $('.chbrevision_'+value+'model_'+model).fadeOut(300);
                        }
                    });
                    if(count == 0)
                    {
                        alert("Selecteer reparaties die u wilt verwijderen..");
                    }
                });



                $('body').on('click', '#btn-link-model', function() {
                    var brandid = $(this).attr("alt");
                    var brandname = $(this).attr("title");
                    $('.brandid_hid').val(brandid);
                    $('.brandname_hid').val(brandname.toLowerCase());
                    $('.mdl-link-model').modal('toggle');

                    $.ajax({
                        url: '/car/models/read', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { id: brandid }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            if(response.count == 0)
                            {
                                alert("Geen modellen gevonden");   
                            }
                            else
                            {
                                $("#tbody_models").empty();
                                $.each(response, function (i, models) {
                                    for (var i in models) {
                                        $('.models_table > tbody:last-child').append('<tr class="chbmodel_'+models[i].id+'"><td><input type="checkbox" class="chbmodels"  name="chbmodel" value="'+models[i].id+'"></td><td>'+models[i].model+'</td></tr>');
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });
                });


                
                $('body').on('click', '#btn-link-tickets', function() {
                    var brandid = $(this).attr("alt");
                    var brandname = $(this).attr("title");
                    $('.brandid_hid').val(brandid);
                    $('.brandname_hid').val(brandname.toLowerCase());
                    $('.mdl-link-ticket').modal('toggle');

                    $.ajax({
                        url: '/car/models/tickets/read', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { id: brandid }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            if(response.count == 0)
                            {
                                alert("Geen reparaties gevonden");   
                            }
                            else
                            {
                                $("#tbody_tickets").empty();
                                $.each(response.reparaties, function (i, reparaties) {
                                    $('.tickets_table > tbody:last-child').append('<tr class="chbmodel_'+reparaties.id+'"><td><input type="checkbox" class="chbtickets"  name="chbticket" value="'+reparaties.id+'"></td><td>'+reparaties.title+'</td></tr>');
                                });
                                $.each(response.allreparaties, function (i, singlereparaties) {
                                    $('.ticketsselect').append($('<option>', {
                                        value: singlereparaties.id,
                                        text: singlereparaties.title
                                    }));
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });

                    $.ajax({
                        url: '/car/models/read', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { id: brandid }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            if(response.count == 0)
                            {
                                alert("Geen modellen gevonden");   
                            }
                            else
                            {
                                $.each(response, function (i, models) {
                                    for (var i in models) {
                                        $('.modelselect').append($('<option>', {
                                            value: models[i].id,
                                            text: models[i].model
                                        }));
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });
                });

                

                
                $('body').on('click', '#btn-upload-logo', function() {
                    var id = $(this).attr("alt");
                    $('.brandlogoid').val(id);
                    $('.mdl-upload-logo').modal('toggle');
                });

                $('body').on('click', '.btn-new-car', function() {
                    $('.mdl-new-car').modal('toggle');
                });

                $('body').on('click', '.btn-import-cars', function() {
                    $('.mdl-import-cars').modal('toggle');
                });

                $('body').on('click', '.btn-export-cars', function() {
                    $('.mdl-export-cars').modal('toggle');
                });

                $('body').on('click', '.btn-del-cars', function() {
                    $('.mdl-del-cars').modal('toggle');
                });

                $('body').on('click', '.btn-docs', function() {
                    $('.mdl-docs').modal('toggle');
                });

                $('body').on('click', '.btnaddvariant', function() {
                    var id = $(this).attr('id');
                    $('.car_variant_id').val(id);
                    $('.mdl-add-variant').modal('toggle');
                });


                $('body').on('click', '.btn-revision-mdl-ticket', function() {
                    var revision_id = $(this).attr('id');
                    $('.revision_id_ticket').val(revision_id);
                    $('.mdl-revision-ticket-link').modal('toggle');

                    $('.table-body-revision-ticket-link').empty();
                    $.ajax({
                        url: '/revision/tickets/read', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { revision_id: revision_id }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            if(response.count == 0)
                            {
                                alert("Geen tickets gevonden");   
                            }
                            else
                            {                                
                                $.each(response.revisions, function (i, revision) {
                                    $('.ticketselect').append($('<option>', {
                                        value: revision.ticket_no,
                                        text: 'Ticket nr: '+revision.ticket_no
                                    }));
                                });

                                $.each(response.revisions_customers, function (i, revisions_customer) {
                                    $('.table-revision-ticket-link > tbody:last-child').append('<tr class="chbmodel_'+revisions_customer.id+'"><td><input type="checkbox" class="chbtickets"  name="chbticket" value="'+revisions_customer.id+'"></td><td>Ticket nr: '+revisions_customer.ticket_no+'</td></tr>');
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });
                    
                    return false;
                });



                $('body').on('click', '#btn-link-model-revision', function() {
                    var modelid = $(this).attr('alt');
                    $('.model_idtl').val(modelid);
                    $('.mdl-link-model-revision').modal('toggle');
                    $.ajax({
                        url: '/car/models/types/tickets/read', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { id: modelid }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            if(response.count == 0)
                            {
                                alert("Geen reparaties gevonden");   
                            }
                            else
                            {
                                $.each(response.allreparaties, function (i, singlereparaties) {
                                    $('.ticketsselect2').append($('<option>', {
                                        value: singlereparaties.id,
                                        text: 'Ticket no: '+singlereparaties.ticket_no+' - '+singlereparaties.title
                                    }));
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });
                });





                $('body').on('click', '.btnrevticketli', function() {
                    var revision_id = $('.revision_id_ticket').val();
                    var ticketrevselected = $('.ticketrevselected').val();

                    $.ajax({
                        url: '/revision/ticket/link', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { revision_id: revision_id, ticket: ticketrevselected}, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            if(response.count == 0)
                            {
                                alert("Geen tickets gevonden");   
                            }
                            else
                            {           
                                $('.table-body-revision-ticket-link').empty();

                                $.each(response.revisions, function (i, revision) {
                                    $('.ticketselect').append($('<option>', {
                                        value: revision.ticket_no,
                                        text: 'Ticket nr: '+revision.ticket_no
                                    }));
                                });

                                $(".revticket"+ticketrevselected).html("");
                                $.each(response.revisions_customers, function (i, revisions_customer) {
                                    $('.table-revision-ticket-link > tbody:last-child').append('<tr class="chbmodel_'+revisions_customer.id+'"><td><input type="checkbox" class="chbtickets"  name="chbticket" value="'+revisions_customer.id+'"></td><td>Ticket nr: '+revisions_customer.ticket_no+'</td></tr>');

                                    $(".revticket"+revisions_customer.ticket_no).append("<a href="+"'/revision/ticket/"+ticketrevselected+"' class='kmi-badge kmi-badge-danger' style='float:right; min-width:200px; margin-right:5px; margin-left:5px;'>Ticket nr. "+ticketrevselected+" > "+revisions_customer.status+" </a>");
                                });

                                
                            }
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });

                });




                
                $('body').on('click', '.btn-manual-add', function() {
                    var ticket_no = $(this).attr('id');
                    $('.ticket_no_manual').val(ticket_no);
                    $('.mdl-manual-add').modal('toggle');
                });


                $('body').on('click', '.btn-del-revision-customer', function() {
                    if (confirm("Weet je zeker dat je dit ticket wilt verwijderen") == true) {

                    }
                });

                $('body').on('click', '.btnchoosemenu', function() {

                    var choice = $('.menuchoice:checked').val();
                    if(choice == "new_part")
                    {

                    }
                    if(choice == "new_manual")
                    {
                        $('.mdl-manual-add').modal('hide');
                        $( ".kms-new-tab-right" ).fadeIn('fast');
                        $( ".kms-new-tab-right" ).animate({
                            width: "50%"
                        }, 300, function() {
                            $( "."+choice ).fadeIn('slow');
                        });
                    }
                });
                
                $('body').on('click', '.btn_close_tab', function() {
                    
                    $( ".kms-tab-content" ).fadeOut('fast');

                    $( ".kms-new-tab-left" ).animate({
                        width: "0%"
                    }, 300, function() {
                        $( ".kms-new-tab-left" ).fadeOut('fast');
                    });

                    $( ".kms-new-tab-right" ).animate({
                        width: "0%"
                    }, 300, function() {
                        $( ".kms-new-tab-right" ).fadeIn('fast');
                    });
                });

                $('body').on('click', '.btn-save-manual', function() {
                    var ticket_no = $('.ticket_no_manual').val();
                    var title = $('.manual_title').val();
                    var text = $('.richText-editor').html();
                    $.ajax({
                        url: '/ticket/manual/create', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { ticket_no: ticket_no, title:title, text:text }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            $(".manuals").append("<div class='kms-body-column col-md-6 col-sm-12 col-lg-3 bg-gray-800 text-white kms-column-border text-center'><a href='/manual/"+response.id+"'><h3 class='kms-column-subtitle' style='font-weight: normal; font-size: 16px;'>"+response.title+"</h3><hr><i class='bx bxs-file text-danger' style='font-size:72px;'></a></div>");

                            $( ".kms-tab-content" ).fadeOut('fast');

                            $( ".kms-new-tab-left" ).animate({
                                width: "0%"
                            }, 300, function() {
                                $( ".kms-new-tab-left" ).fadeOut('fast');
                            });

                            $( ".kms-new-tab-right" ).animate({
                                width: "0%"
                            }, 300, function() {
                                $( ".kms-new-tab-right" ).fadeIn('fast');
                            });
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });
                });


                $('body').on('click', '.btnloadmanual', function() {
                    var id = $(this).attr('id');
                    $('.manual_id').val(id);
                    $('.mdl-manual-add').modal('hide');
                    $( ".kms-new-tab-right" ).fadeIn('fast');
                    $( ".kms-new-tab-right" ).animate({
                        width: "50%"
                    }, 300, function() {
                        $('.update_manual').fadeIn("slow");
                        
                        $.ajax({
                            url: '/ticket/manual/read', // The URL to which the request is sent
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                            data: { id: id }, // Data to be sent to the server
                            success: function(response) {
                                console.log(response);
                                $('.manual_title2').val(response.manual.title);
                                $('.richText-editor').html(response.manual.text);
                            },
                            error: function(xhr, status, error) {
                                // Code to execute if the request fails
                                console.log('Error:', error);
                            }
                        });
                    });
                });


                $('body').on('keyup', '.manual_title2', function() {
                    var manual_id = $('.manual_id').val();
                    var title = $(this).val();
                    $.ajax({
                        url: '/ticket/manual/update/title', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'GET', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { manual_id:manual_id, title:title}, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            alert("opgeslagen");
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });
                });

                $('body').on('keyup', '.richText-editor', function() {
                    var manual_id = $('.manual_id').val();
                    var text = $(this).html();
                    $.ajax({
                        url: '/ticket/manual/update', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'GET', // The HTTP method to use for the request (GET, POST, etc.)
                        data: { manual_id:manual_id, text:text }, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            alert("opgeslagen");
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });
                });



                
                $('body').on('click', '.btn-new-revision', function() {
                    $('.mdl-new-revision').modal('toggle');
                });

                $('body').on('click', '.btn-import-revision', function() {
                    $('.mdl-import-revision').modal('toggle');
                });

                $('body').on('click', '.btn-export-revision', function() {
                    $('.mdl-export-revision').modal('toggle');
                });

                $('body').on('click', '.btn-del-revision', function() {
                    var id = $(this).attr("id");
                    var count = 0;
                    
                    $('.chbrevisions').each(function () {
                        if (this.checked) {
                            count = count + 1;
                            var value = $(this).val();
                        }
                    });

                    if(count == 0)
                    {
                        alert("Selecteer de reparaties die u wilt verwijderen..");
                    }
                    else
                    {
                        if (confirm("Weet je zeker dat je deze reparatie(s) wilt verwijderen") == true) {
                            
                            $('.chbrevisions').each(function () {
                                if (this.checked) {
                                    var value = $(this).attr('id');
                                    $.ajax({
                                        url: '/revision/delete', // The URL to which the request is sent
                                        dataType: "json",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                                        data: { id:value }, // Data to be sent to the server
                                        success: function(response) {
                                            // Code to execute if the request succeeds
                                            console.log("Reparatie verwijderd");
                                        },
                                        error: function(xhr, status, error) {
                                            // Code to execute if the request fails
                                            console.log('Error:', error);
                                        }
                                    });
                                    $('#revision'+value).fadeOut(300);
                                }
                            });
                            return false;
                        }
                    }
                });

                
                $('body').on('click', '.dashboard_choice', function() {
                    var value=$(this).val();
                    var currentpage = parseInt($(this).attr('id'));
                    if(value == 'previous')
                    {
                        $('.kms-dashboard-description').html("vorige pagina");
                        var lastpage = currentpage - 1;
                        if(lastpage < 1)
                        {
                            lastpage = 1;   
                        }
                        $('.kms-preloader').slideDown("slow");
                        $( ".kms-car-dashboard" ).animate({
                            transform: 'rotate(-10deg)'
                        }, 500, function() {
                            window.location.replace('/rkb/page/'+lastpage);
                        });
                    }
                    if(value == 'next')
                    {
                        $('.kms-dashboard-description').html("volgende pagina");
                        var nextpage = currentpage + 1;
                        $('.kms-preloader').slideDown("slow");
                        $( ".kms-car-dashboard" ).animate({
                            transform: 'rotate(-10deg)'
                        }, 500, function() {
                            window.location.replace('/rkb/page/'+nextpage);
                        });
                    }
                    if(value == 'filter')
                    {
                        $( ".kms-car-dashboard" ).animate({
                            bottom: "+=70"
                        }, 500, function() {
                            $('.dashboard-info').fadeIn('slow');
                        });
                    }
                    return false;
                });

                $('body').on('change', '.dshb-btn-filter_rev', function() {
                    
                    $('.kms-preloader').slideDown("slow");
                    var value=$(this).val();
                    if(value != "")
                    {
                        window.location.replace('/rkb/filter/'+value);
                    }
                });
                $('body').on('change', '.dshb_sort_choice_rev', function() {
                    var value=$(this).val();
                    if(value != "" && value != "brand")
                    {
                        $('.kms-preloader').slideDown("slow");
                        window.location.replace('/rkb/sort/'+value);
                    }
                    else if(value == "brand")
                    {
                        let brand = prompt("Typ een automerk:", "BMW");
                        if (brand != null && brand != "") {
                            $('.kms-preloader').slideDown("slow");
                            window.location.replace('/rkb/sort/brand/'+brand);
                        }
                        return false;
                    }
                });

                $('body').on('click', '.dshb-input-search_rev', function() {
                    var value=$(this).val();
                    $( ".kms-new-tab-right" ).fadeIn('fast');
                    $( ".kms-new-tab-right" ).animate({
                        width: "33%"
                    }, 300, function() {
                        $( ".search_results" ).fadeIn('slow');
                    });
                });

                
                $('body').on('click', '.btnfilter_specs', function() {
                    $('.btnsearch_specs').css({'font-size':'18px'});
                    $('.btnsort_specs').css({'font-size':'18px'});
                    $(this).css({'font-size':'30px'});
                    $( ".kms-car-dashboard" ).animate({
                        bottom: "37%"
                    }, 500, function() {
                        $('.dashboard-info-specs').fadeOut(300);
                        $('.dshb-filter').delay(310).fadeIn('slow');
                    });

                    return false;
                });
                $('body').on('click', '.btnsearch_specs', function() {
                    $('.btnfilter_specs').css({'font-size':'18px'});
                    $('.btnsort_specs').css({'font-size':'18px'});
                    $(this).css({'font-size':'30px'});
                    $( ".kms-car-dashboard" ).animate({
                        bottom: "37%"
                    }, 500, function() {
                        $('.dashboard-info-specs').fadeOut(300);
                        $('.dshb-search').delay(310).fadeIn('slow');
                    });

                    return false;
                });
                $('body').on('click', '.btnsort_specs', function() {
                    $('.btnfilter_specs').css({'font-size':'18px'});
                    $('.btnsearch_specs').css({'font-size':'18px'});
                    $('.dashboard-info-specs').css({'font-size':'18px'});
                    $(this).css({'font-size':'30px'});
                    $( ".kms-car-dashboard" ).animate({
                        bottom: "37%"
                    }, 500, function() {
                        $('.dashboard-info-specs').fadeOut(300);
                        $('.dshb-sort').delay(310).fadeIn('slow');
                    });

                    return false;
                });

                $('body').on('click', '.btn-hide-dash', function() {
                    $('.btnfilter_specs').css({'font-size':'18px'});
                    $('.btnsearch_specs').css({'font-size':'18px'});
                    $('.btnsort_specs').css({'font-size':'18px'});

                    $('.dashboard-info-specs').fadeOut(300);
                    $('.dashboard-info').fadeOut(300);
                    $( ".search_results" ).fadeOut(300);

                    $( ".kms-new-tab-right" ).animate({
                        width: "0%"
                    }, 300, function() {
                        
                    });

                    $( ".kms-car-dashboard" ).delay(410).animate({
                        bottom: "-270px"
                    }, 500, function() {
                    });

                    return false;
                });
                




                $('body').on('click', '.dashboard_choice_cars', function() {
                    var value=$(this).val();
                    var currentpage = parseInt($(this).attr('id'));
                    if(value == 'previous')
                    {
                        $('.kms-preloader').slideDown("slow");
                        $('.kms-dashboard-description').html("vorige pagina");
                        var lastpage = currentpage - 1;
                        if(lastpage < 1)
                        {
                            lastpage = 1;   
                        }
                        $( ".kms-car-dashboard" ).animate({
                            transform: 'rotate(-10deg)'
                        }, 500, function() {
                            window.location.replace('/rkb/cars/page/'+lastpage);
                        });
                    }
                    if(value == 'next')
                    {
                        $('.kms-preloader').slideDown("slow");
                        $('.kms-dashboard-description').html("volgende pagina");
                        var nextpage = currentpage + 1;
                        $( ".kms-car-dashboard" ).animate({
                            transform: 'rotate(-10deg)'
                        }, 500, function() {
                            window.location.replace('/rkb/cars/page/'+nextpage);
                        });
                    }
                    if(value == 'filter')
                    {
                        $( ".kms-car-dashboard" ).animate({
                            bottom: "+=70"
                        }, 500, function() {
                            $('.dashboard-info').fadeIn('slow');
                        });
                    }
                    return false;
                });

                $('body').on('change', '.dshb-btn-filter', function() {
                    
                    $('.kms-preloader').slideDown("slow");
                    var value=$(this).val();
                    if(value != "")
                    {
                        window.location.replace('/rkb/cars/filter/'+value);
                    }
                });
                $('body').on('change', '.dshb_sort_choice', function() {
                    $('.kms-preloader').slideDown("slow");
                    var value=$(this).val();
                    if(value != "")
                    {
                        window.location.replace('/rkb/cars/sort/'+value);
                    }
                });

                $('body').on('click', '.dshb-input-search', function() {
                    var value=$(this).val();
                    $( ".kms-new-tab-right" ).fadeIn('fast');
                    $( ".kms-new-tab-right" ).animate({
                        width: "33%"
                    }, 300, function() {
                        $( ".search_results" ).fadeIn('slow');
                    });
                });

                $('body').on('keyup', '.dshb-input-search', function() {
                    var value=$(this).val();
                    if(this.value.length > 2)
                    {
                        $.ajax({
                            url: '/rkb/cars/search', // The URL to which the request is sent
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                            data: { keywords:value }, // Data to be sent to the server
                            success: function(response) {
                                // Code to execute if the request succeeds
                                $('.count_brands').html(response.count_brands + ' gevonden');
                                $('.count_models').html(response.count_models + ' gevonden');
                                $('.count_revisions').html(response.count_reparaties + ' gevonden');
                                $('.count_tickets').html(response.count_revisions + ' gevonden');
                                $('.tbody_tickets').empty();
                                $('.tbody_brands').empty();
                                $('.tbody_revisions').empty();
                                $('.tbody_models').empty();

                                $.each(response.cars, function (i, car) {
                                    $('.tbody_brands').append('<tr><td><a href="/rkb/cars/sort/alfabetisch#'+car.brand.toLowerCase()+'" target="_BLANK">'+car.brand+'</a></td></tr>');
                                });

                                $.each(response.reparaties, function (i, reparatie) {
                                    $('.tbody_revisions').append('<tr><td><a href="/rkb/sort/DESC#revision'+reparatie.id+'" target="_BLANK">'+reparatie.title+'</a></td></tr>');
                                });
                                $.each(response.cars, function (i, car) {
                                    $.each(car.models, function (i, model) {
                                        $('.tbody_models').append('<tr><td><a href="/car/model/'+model.id+'" target="_BLANK">'+model.model+'</a></td></tr>');
                                    });
                                });
                                $.each(response.cars, function (i, car) {
                                    $.each(car.revisions, function (i, revision) {
                                        if(revision.revision_id != 0){
                                            $('.tbody_tickets').append('<tr><td><a href="/revision/ticket/'+revision.ticket_no+'" target="_BLANK">'+revision.ticket_no+' - <em style="font-size:12px; color:#999">'+ revision.start + '</em></a></td></tr>');
                                        }
                                    });
                                });
                            },
                            error: function(xhr, status, error) {
                                // Code to execute if the request fails
                                console.log('Error:', error);
                            }
                        });
                    }
                });
                
                $('body').on('click', '.btn_search_brands_open', function() {
                    $('.tbody_brands').slideToggle("slow");
                });
                $('body').on('click', '.btn_search_models_open', function() {
                    $('.tbody_models').slideToggle("slow");
                });
                $('body').on('click', '.btn_search_tickets_open', function() {
                    $('.tbody_tickets').slideToggle("slow");
                });
                $('body').on('click', '.btn_search_revisions_open', function() {
                    $('.tbody_revisions').slideToggle("slow");
                });

                



                $('body').on('change', '.customerfilter', function() {
                    var value=$(this).val();
                    window.location.replace('/rkb/customers/filter/'+value);
                });
                $('body').on('change', '.inputpagecustomers', function() {
                    var value=$(this).val();
                    window.location.replace('/rkb/customers/'+value);
                });
                
                $('body').on('click', '.btnbrowserfind', function() {
                    var value=$('.btnbrowserfindinput').val();
                    $(this).css({'position':'fixed', 'z-index':'999999999', 'right':'15px', 'top':'9%'});
                    window.find(value, false, false, false, true, false, true)
                });


                $('body').on('click', '.btn-new-manual', function() {
                    $('.mdl-manual-add').modal('hide');
                    $( ".kms-new-tab-right" ).fadeIn('fast');
                    $( ".kms-new-tab-right" ).animate({
                        width: "50%"
                    }, 300, function() {
                        $( ".new_manual" ).fadeIn('slow');
                    });
                });

                $('body').on('click', '.btn-import-manual', function() {
                    $('.mdl-import-revision').modal('toggle');
                });

                $('body').on('click', '.btn-export-manual', function() {
                    $('.mdl-export-revision').modal('toggle');
                });


                $('body').on('click', '.btn-import-customers', function() {
                    $('.mdl-import-customers').modal('toggle');
                });

                $('body').on('click', '.btn-export-customers', function() {
                    $('.mdl-export-customers').modal('toggle');
                });
                
                $('body').on('click', '.btn-new-customers', function() {
                    $('.mdl-new-customers').modal('toggle');
                });
                
                $('body').on('click', '.btn-car-help', function() {
                    $('.mdl-car-help').modal('toggle');
                });
                

                
                
                $('body').on('click', '.checkrevision', function() {
                    var check = $(this).val();
                    var revision_id = $(this).attr('id');
                    var newvalue = 0;
                    if(check == 0)
                    {
                        newvalue = 1;
                    }
                    else
                    {
                        newvalue = 0;
                    }

                    $.ajax({
                        url: '/revision/checked', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: {id:revision_id, checked:newvalue}, // Data to be sent to the server
                        success: function(response) {
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });

                });



                $('body').on('click', '.checkcar', function() {
                    var check = $(this).val();
                    var revision_id = $(this).attr('id');
                    var newvalue = 0;
                    if(check == 0)
                    {
                        newvalue = 1;
                    }
                    else
                    {
                        newvalue = 0;
                    }

                    $.ajax({
                        url: '/car/checked', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: {id:revision_id, checked:newvalue}, // Data to be sent to the server
                        success: function(response) {
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });

                });




                $('body').on('click', '.btncustomerticket', function() {
                    var id = $(this).attr('id');
                    $('._token').val($('meta[name="csrf-token"]').attr('content'));

                    $('.mdl-customer-info').modal('toggle');

                    if(id == "")
                    {
                        $('.client_name').html("Onbekend");
                        $('.client_email').html("Onbekend");
                        $('.client_phone').html("Onbekend");
                    }
                    else
                    {
                        $.ajax({
                            url: '/ticket/customers/read', // The URL to which the request is sent
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                            data: {id:id}, // Data to be sent to the server
                            success: function(response) {
                                $('.client_name').html(response.customer.firstname + ' ' + response.customer.lastname);
                                $('.client_email').html(response.customer.email);
                                $('.client_phone').html(response.customer.phonenr);
                            },
                            error: function(xhr, status, error) {
                                // Code to execute if the request fails
                                console.log('Error:', error);
                            }
                        });
                    }
                });



                $('body').on('click', '.btnuserticket', function() {
                    var id = $(this).attr('id');
                    $('._token').val($('meta[name="csrf-token"]').attr('content'));

                    $('.mdl-user-ticket-info').modal('toggle');

                    if(id == "")
                    {
                        $('.user_name').html("Onbekend");
                        $('.user_email').html("Onbekend");
                    }
                    else
                    {
                        $.ajax({
                            url: '/ticket/user/read', // The URL to which the request is sent
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                            data: {id:id}, // Data to be sent to the server
                            success: function(response) {
                                console.log(response);
                                if(response.user == null)
                                {
                                    $('.user_name').html("Onbekend");
                                    $('.user_email').html("Onbekend");
                                }
                                else
                                {
                                    $('.user_name').html(response.user.name);
                                    $('.user_email').html(response.user.email);
                                }
                            },
                            error: function(xhr, status, error) {
                                // Code to execute if the request fails
                                console.log('Error:', error);
                            }
                        });
                    }
                });






                $('body').on('click', '.btncheckbusiness', function() {
                    var id = $(this).attr('id');
                    $('._token').val($('meta[name="csrf-token"]').attr('content'));

                    $('.mdl-customer-business-info').modal('toggle');

                    if(id == "")
                    {
                        $('.vat').html("Onbekend");
                        $('.company_name').html("Onbekend");
                        $('.company_email').html("Onbekend");
                        $('.company_invoice_email').html("Onbekend");
                        $('.company_phonenr').html("Onbekend");
                        $('.company_address').html("Onbekend");
                        $('.company_zipcode').html("Onbekend");
                        $('.company_city').html("Onbekend");
                        $('.company_country').html("Onbekend");
                    }
                    else
                    {
                        $.ajax({
                            url: '/customer/company/read', // The URL to which the request is sent
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                            data: {id:id}, // Data to be sent to the server
                            success: function(response) {
                                if(response.company == null)
                                {
                                    $('.vat').html("Onbekend");
                                    $('.company_name').html("Onbekend");
                                    $('.company_email').html("Onbekend");
                                    $('.company_invoice_email').html("Onbekend");
                                    $('.company_phonenr').html("Onbekend");
                                    $('.company_address').html("Onbekend");
                                    $('.company_zipcode').html("Onbekend");
                                    $('.company_city').html("Onbekend");
                                    $('.company_country').html("Onbekend");
                                }
                                else
                                {
                                    $('.vat').html(response.company[0].vat);
                                    $('.company_name').html(response.company[0].company_name);
                                    $('.company_email').html(response.company[0].email);
                                    $('.company_invoice_email').html(response.company[0].invoice_email);
                                    $('.company_phonenr').html(response.company[0].phonenr);
                                    $('.company_address').html(response.company[0].address);
                                    $('.company_zipcode').html(response.company[0].zipcode);
                                    $('.company_city').html(response.company[0].city);
                                    $('.company_country').html(response.company[0].country);
                                }
                            },
                            error: function(xhr, status, error) {
                                // Code to execute if the request fails
                                console.log('Error:', error);
                            }
                        });
                    }
                });





                $('body').on('click', '#btn-link-product', function() {
                    $('.mdl-ticket-product').modal('toggle');
                    var ticket_no = $(this).attr('alt');
                    $('.ticket_no').val(ticket_no);
                    $.ajax({
                        url: '/ticket/parts/read', // The URL to which the request is sent
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                        data: {}, // Data to be sent to the server
                        success: function(response) {
                            // Code to execute if the request succeeds
                            if(response.count == 0)
                            {
                                alert("Geen tickets gevonden");   
                            }
                            else
                            {           
                                $('.table-body-part-ticket-link').empty();

                                $.each(response.parts, function (i, part) {
                                    $('.table-part-ticket-link > tbody:last-child').append('<tr class="chbparts"><td><input type="checkbox" class="chbtickets"  name="chbticket[]" value="'+part.id+'"></td><td>'+part.name+'<br/> <em style="font-size:11px;">Onderdeel nr: '+part.code+'</em></td></tr>');
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Code to execute if the request fails
                            console.log('Error:', error);
                        }
                    });
                });






                $('body').on('click', '.btn-del-manual', function() {
                    var id = $(this).attr("id");
                    var count = 0;
                    
                    $('.chbmanuals').each(function () {
                        if (this.checked) {
                            count = count + 1;
                            var value = $(this).val();
                        }
                    });

                    if(count == 0)
                    {
                        alert("Selecteer handleidingen die u wilt verwijderen..");
                    }
                    else
                    {
                        if (confirm("Weet je zeker dat je deze handleiding(en) wilt verwijderen") == true) {
                            
                            $('.chbmanuals').each(function () {
                                if (this.checked) {
                                    var value = $(this).val();
                                    $.ajax({
                                        url: '/ticket/manual/read', // The URL to which the request is sent
                                        dataType: "json",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                                        data: { id:value }, // Data to be sent to the server
                                        success: function(response) {
                                            // Code to execute if the request succeeds
                                            console.log("Hanleiding verwijderd");
                                        },
                                        error: function(xhr, status, error) {
                                            // Code to execute if the request fails
                                            console.log('Error:', error);
                                        }
                                    });
                                    $('#manual'+value).fadeOut(300);
                                }
                            });
                            return false;
                        }
                    }
                });


                $('body').on('click', '.checkbox_checkall_parts', function() {
                    if( $(this).is(":checked") )
                    {
                        $(".partschbs").each( function() {
                            $(".partschbs").attr("checked",true);
                        });
                    }
                    else
                    {
                        $(".partschbs").each( function() {
                            $(".partschbs").attr("checked",false);
                        });
                    }
                });


                $('body').on('click', '.checkbox_checkall', function() {
                    if( $(this).is(":checked") )
                    {
                        $(".customerchbs").each( function() {
                            $(".customerchbs").attr("checked",true);
                        });
                    }
                    else
                    {
                        $(".customerchbs").each( function() {
                            $(".customerchbs").attr("checked",false);
                        });
                    }
                });


                $('body').on('click', '.btn-del-customers', function() {
                    var id = $(this).attr("id");
                    var count = 0;
                    
                    $('.customerchbs').each(function () {
                        if (this.checked) {
                            count = count + 1;
                            var value = $(this).val();
                        }
                    });

                    if(count == 0)
                    {
                        alert("Selecteer de klanten die u wilt verwijderen..");
                    }
                    else
                    {
                        if (confirm("Weet je zeker dat je deze klant(en) wilt verwijderen") == true) {
                            $(".customerchbs").each( function() {
                                if( $(this).is(":checked") ){
                                    var value = $(this).val();
                                    $.ajax({
                                        url: '/customers/delete', // The URL to which the request is sent
                                        dataType: "json",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                                        data: { id:value }, // Data to be sent to the server
                                        success: function(response) {
                                            // Code to execute if the request succeeds
                                            console.log("Klant verwijderd");
                                        },
                                        error: function(xhr, status, error) {
                                            // Code to execute if the request fails
                                            console.log('Error:', error);
                                        }
                                    });
                                    $('.customer'+value).fadeOut(500);
                                }
                            });
                        }
                    }

                });









                $('body').on('click', '.btn-del-parts', function() {
                    var id = $(this).attr("id");
                    var count = 0;
                    
                    $('.partschbs').each(function () {
                        if (this.checked) {
                            count = count + 1;
                            var value = $(this).val();
                        }
                    });

                    if(count == 0)
                    {
                        alert("Selecteer de onderdelen die u wilt verwijderen..");
                    }
                    else
                    {
                        if (confirm("Weet je zeker dat je deze onderdelen wilt verwijderen") == true) {
                            $(".partschbs").each( function() {
                                if( $(this).is(":checked") ){
                                    var value = $(this).val();
                                    $.ajax({
                                        url: '/parts/delete', // The URL to which the request is sent
                                        dataType: "json",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: 'POST', // The HTTP method to use for the request (GET, POST, etc.)
                                        data: { id:value }, // Data to be sent to the server
                                        success: function(response) {
                                            // Code to execute if the request succeeds
                                            console.log("Onderdeel verwijderd");
                                        },
                                        error: function(xhr, status, error) {
                                            // Code to execute if the request fails
                                            console.log('Error:', error);
                                        }
                                    });
                                    $('.part'+value).fadeOut(500);
                                }
                            });
                        }
                    }

                });





                if(window.location.hash) {
                    var hash = window.location.hash;
                    $('.kms-preloader').delay(400).fadeOut("slow");
                    $('body').animate({
                        scrollTop: $("#".hash).offset().top
                    }, 300);
                }


            });
        </script>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia

        <div class="kms-preloader">
            <table style="width:100%; height:100%; text-align:center; vertical-align:middle;">
                <tr>
                    <td style="width:100%; height:100%; text-align:center; vertical-align:middle;">
                        <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/02b374101705095.5f24d5db1096f.gif" style="width:300px;  margin-left:auto; margin-right:auto; text-align:center; left:-50%;" class="carloader"><Br/>
                        <img src="https://i.gifer.com/8Etj.gif" style="margin-left: auto; margin-right:auto; margin-top:-50px; width:50px;">
                        <h3 style="color:#999;">Loading..</h3>
                        <!-- https://mir-s3-cdn-cf.behance.net/project_modules/fs/02b374101705095.5f24d5db1096f.gif  -->
                        <!-- https://auto.mahindra.com/on/demandware.static/-/Sites-amc-Library/en_IN/v1732482363747/Visualize360/XUV700/assets/one3d/images/one3d-loader-gif.gif  -->
                    </td>
                </tr>
            </table>
        </div>

        <div class="kms-new-tab-right" style="overflow-y:scroll; overflow-x:hidden;">
            <div class="kms-tab-content new_manual">
                <h2 class="kms-column-subtitle" style="color:#FFF;">Nieuwe handleiding maken</h2>
                <hr>
                <label for="titel" style="color:#FFF;">Titel</label>
                <input type="text" name="manual_title" class="form form-control manual_title" id="titel" placeholder="tellerpaneel reparatie" required>
                <input type="hidden" name="ticket_no" class="ticket_no_manual">
                <textarea name="manual" class="editor" style="margin-top:5px;"></textarea>
                <a href="#" class="btn_close_tab" style="float: right; margin-top: 20px; font-size: 17px; color: #FFF;"><i class='bx bx-right-arrow-alt' ></i> Inklappen</a>
                <button type="button" class="btn btn-warning btn-kms-warning btn-save-manual" style="float:left; margin-top:10px;"><i class="bx bx-plus"></i> Opslaan</button>
            </div>
            
            <div class="kms-tab-content update_manual">
                <h2 class="kms-column-subtitle" style="color:#FFF;">Handleiding</h2>
                <hr>
                <label for="titel" style="color:#FFF;">Titel</label>
                <input type="text" name="manual_title" class="form form-control manual_title2" id="titel" placeholder="tellerpaneel reparatie" required>
                <input type="hidden" name="manual_id" class="manual_id">
                <textarea name="manual" class="editor" id="editor" style="margin-top:5px;"></textarea>
                <a href="#" class="btn_close_tab" style="float: right; margin-top: 20px; font-size: 17px; color: #FFF;"><i class='bx bx-right-arrow-alt' ></i> Inklappen</a>
                <em style="color:#FFF;">* Bewerkingen worden automatisch opgeslagen</em><br/>
                <a href="#" class=" text-danger btn_del_manual" style="float:left;"><i class="bx bx-trash"></i> handleiding verwijderen</a>
            </div>
            <div class="kms-tab-content search_results">
                <h2 class="kms-column-subtitle" style="color:#FFF;">Zoek resultaten</h2>
                <hr style='border-color:#FFF;'>
                <table class="table table-dark">
                    <thead style='cursor:pointer' class="btn_search_brands_open">
                        <th class="brands_title"><i class="bx bx-plus"></i> Automerken</th>
                        <th class="count_brands" style="text-align:right;"></th>
                    </thead>
                    <tbody class="tbody_brands" style="display:none;">

                    </tbody>
                </table>
                <table class="table table-dark">
                    <thead style='cursor:pointer' class="btn_search_models_open">
                        <th class="models_title"><i class="bx bx-plus"></i> Modellen</th>
                        <th class="count_models" style="text-align:right;"></th>
                    </thead>
                    <tbody class="tbody_models" style="display:none;">

                    </tbody>
                </table>
                <table class="table table-dark">
                    <thead style='cursor:pointer' class="btn_search_revisions_open">
                        <th class="revisions_title"><i class="bx bx-plus"></i> Reparaties</th>
                        <th class="count_revisions" style="text-align:right;"></th>
                    </thead>
                    <tbody class="tbody_revisions" style="display:none;">

                    </tbody>
                </table>
                <table class="table table-dark">
                    <thead style='cursor:pointer' class="btn_search_tickets_open">
                        <th class="tickets_title"><i class="bx bx-plus"></i> Tickets</th>
                        <th class="count_tickets" style="text-align:right;"></th>
                    </thead>
                    <tbody class="tbody_tickets" style="display:none;">

                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="kms-new-tab-left">
            <div class="kms-tab-content new_part">
                
            </div>
        </div>


        <div class="kms-btn-rnd-dark" style="z-index:9999999; position:fixed; bottom:15px; right:15px;"><a href="#logo"><table style="height: 100%; width: 100%; position: relative;"><tr><td style="width: 100%; height: 100%; text-align: center; vertical-align: middle; "><img src="https://media2.giphy.com/media/GeJ0DvQTzUiZjwmwQb/giphy.gif?cid=6c09b952safvgduaegvgp2hi1g1pqq6ksipruey5k1hfefpc&ep=v1_stickers_related&rid=giphy.gif&ct=s" style="height:25px; margin-left:auto; margin-right:auto; margin-top:-3px;"></td></tr></table></a></div>

        <div class="kms-btn-rnd-dark" style="z-index:9999999; position:fixed; bottom:25px; left:15px;"><a href="#footer"><table style="height: 100%; width: 100%; position: relative;"><tr><td style="width: 100%; height: 100%; text-align: center; vertical-align: middle; "><img src="https://media2.giphy.com/media/GeJ0DvQTzUiZjwmwQb/giphy.gif?cid=6c09b952safvgduaegvgp2hi1g1pqq6ksipruey5k1hfefpc&ep=v1_stickers_related&rid=giphy.gif&ct=s" style="height:25px; margin-left:auto; margin-right:auto; margin-top:7px; transform:rotate(180deg)"></td></tr></table></a></div>

        <div class="kms-btn-rnd-dark nextresult" style="display:none; position:fixed; z-index:999999999; bottom:25px; left:48%;"><table style="height: 100%; width: 100%; position: relative;"><tr><td style="width: 100%; height: 100%; text-align: center; vertical-align: middle; "><span style='font-size:11px; color:#FFF;'>meer</span></td></tr></table></div>





        <div class="modal fade mdl-car-help" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Help</h5>
                        <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 600px; overflow-y:scroll; overflow-x:hidden;">
                        <h3>Import & Export</h3>
                        <p>
                            Het importeren en exporteren van auto's, modellen, typen en uitvoeringen kan via verschillende bronnen welke in relatie liggen met de API connecties met derde partijen waarmee het Cergos systeem kan communiceren. Hiervoor klik je op importeren of exporteren in de taakbalk en volg u het submenu.
                        </p>
                    </div>
                </div>
            </div>
        </div>






        <div class="modal fade mdl-ticket-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Onderdelen linken</h5>
                        <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/ticket/part/link" method="POST">
                    @csrf
                    <input type="hidden" name="ticket_no" class="ticket_no">
                    <div class="modal-body kms-modal-body" style="max-height: 600px; overflow-y:scroll; overflow-x:hidden;">
                        <table class="table table-dark table-part-ticket-link">
                            <tbody class="table-body-part-ticket-link">
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <button type="submit" class="btn btn-warning" style="width:100%;"><i class='bx bx-link' ></i> Onderdelen linken</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade mdl-ticket-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Onderdelen linken</h5>
                        <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/ticket/part/link" method="POST">
                    @csrf
                    <input type="hidden" name="ticket_no" class="ticket_no">
                    <div class="modal-body kms-modal-body" style="max-height: 600px; overflow-y:scroll; overflow-x:hidden;">
                        <table class="table table-dark table-part-ticket-link">
                            <tbody class="table-body-part-ticket-link">
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <button type="submit" class="btn btn-warning" style="width:100%;"><i class='bx bx-link' ></i> Onderdelen linken</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>




        <div class="modal fade mdl-new-revision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Nieuwe reparatie</h5>
                        <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/revision/create" method="POST">
                        @csrf
                        <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                            <label>Titel</label>
                            <input type="text" name="title" class="form form-control" required>
                            <label>Klachten beschrijving</label>
                            <textarea class="form form-control" name="complains" required></textarea>
                            <label>Reparatie omschrijving</label>
                            <textarea class="form form-control" name="description" required></textarea>
                        </div>
                        <div class="modal-footer kms-modal-footer">
                            <button type="submit" class="btn btn-warning" style="width:100%;"><i class='bx bx-plus' ></i> Aanmaken</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade mdl-new-customers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Nieuwe klant </h5>
                        <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <input type="hidden" name="revision_id" class="revision_id_ticket">
                        <table class="table table-dark">
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_part" checked></td>
                                    <td>Nieuwe particulier klant</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_part" checked></td>
                                    <td>Nieuwe bedrijf</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <a class="btn btn-danger" style="float:right;"><i class='bx bx-right-arrow-alt' ></i> volgende</a>
                    </div>
                </div>
            </div>
        </div>






        <!--- APIS TO DO -->


        <div class="modal fade mdl-import-customers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Importeren </h5>
                        <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <input type="hidden" name="revision_id" class="revision_id_ticket">
                        <table class="table table-dark">
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_part" checked></td>
                                    <td>Vanuit My Odoo</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_part" checked></td>
                                    <td>Vanuit My Gadget Repairs</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_manual"></td>
                                    <td>Vanuit het RDW</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_manual"></td>
                                    <td>Vanuit AllData</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_manual"></td>
                                    <td>Vanuit een CSV bestand</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <a class="btn btn-danger" style="float:right;"><i class='bx bx-right-arrow-alt' ></i> volgende</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade mdl-export-customers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Exporteren </h5>
                        <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <input type="hidden" name="revision_id" class="revision_id_ticket">
                        <table class="table table-dark">
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_part" checked></td>
                                    <td>Naar My Gadget Repairs</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_manual"></td>
                                    <td>Naar de website</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_manual"></td>
                                    <td>Naar een CSV bestand</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <a class="btn btn-danger" style="float:right;"><i class='bx bx-right-arrow-alt' ></i> volgende</a>
                    </div>
                </div>
            </div>
        </div>










        <div class="modal fade mdl-import-revision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Importeren </h5>
                        <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <input type="hidden" name="revision_id" class="revision_id_ticket">
                        <table class="table table-dark">
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_part" checked></td>
                                    <td>Vanuit My Odoo</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_part" checked></td>
                                    <td>Vanuit My Gadget Repairs</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_manual"></td>
                                    <td>Vanuit het RDW</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_manual"></td>
                                    <td>Vanuit AllData</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_manual"></td>
                                    <td>Vanuit een CSV bestand</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <a class="btn btn-danger" style="float:right;"><i class='bx bx-right-arrow-alt' ></i> volgende</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade mdl-export-revision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Exporteren </h5>
                        <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <div class="export_ticket_stages first_stage_export_tickets">
                            <table class="table table-dark">
                                <tbody>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_export" class="menuchoice_export" value="mgr" checked></td>
                                        <td>Naar My Gadget Repairs</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_export" class="menuchoice_export" value="site"></td>
                                        <td>Naar de website</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_export" class="menuchoice_export" value="csv"></td>
                                        <td>Naar een CSV bestand</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="export_ticket_stages second_stage_export_tickets_mgr" style="display:none;">
                            <table class="table table-dark">
                                <tbody>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_mgr" class="menuchoice_mgr" value="mgr_api" disabled></td>
                                        <td>Via API (Coming Soon)</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_mgr" class="menuchoice_mgr" value="mgr_xslx"></td>
                                        <td>Via MGR XLXS Import</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="export_ticket_stages third_stage_export_tickets_mgr" style="display:none;">
                            <table class="table table-dark">
                                <tbody>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_mgr_export" class="menuchoice_mgr_export" value="export_services" checked></td>
                                        <td>Van Reparaties</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_mgr_export" class="menuchoice_mgr_export" value="export_tickets" checked></td>
                                        <td>Van Tickets</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_mgr_export" class="menuchoice_mgr_export" value="export_customers" checked></td>
                                        <td>Van Klanten</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <input type="hidden" name="revision_id" class="revision_id_ticket">
                        <a class="btn btn-danger btn_stages btn_first_stage" style="float:left; display:none;"><i class='bx bx-left-arrow-alt' ></i> vorig</a>
                        <a class="btn btn-danger btn_stages btn_second_stage_return" style="float:left; display:none;"><i class='bx bx-left-arrow-alt' ></i> vorig</a>

                        <a class="btn btn-danger btn_stages btn_second_stage" style="float:right;"><i class='bx bx-right-arrow-alt' ></i> volgende</a>
                        <a class="btn btn-danger btn_stages btn_third_stage" style="float:right; display:none;"><i class='bx bx-right-arrow-alt' ></i> volgende</a>
                        <a class="btn btn-warning btn_stages btn_submit_export" style="float:right; display:none;"><i class='bx bx-download' ></i> exporteren</a>
                    </div>
                </div>
            </div>
        </div>


        

        <div class="modal fade mdl-import-cars" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Importeren </h5>
                        <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <input type="hidden" name="revision_id" class="revision_id_ticket">
                        <table class="table table-dark">
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_part" checked></td>
                                    <td>Vanuit My Gadget Repairs</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_manual"></td>
                                    <td>Vanuit het RDW</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_manual"></td>
                                    <td>Vanuit AllData</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_manual"></td>
                                    <td>Vanuit een CSV bestand</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <a class="btn btn-danger" style="float:right;"><i class='bx bx-right-arrow-alt' ></i> volgende</a>
                    </div>
                </div>
            </div>
        </div>




        <div class="modal fade mdl-export-cars" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Exporteren </h5>
                        <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <div class="export_car_stages first_stage_export_cars">
                            <table class="table table-dark">
                                <tbody>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_export" class="menuchoice_export" value="mgr" checked></td>
                                        <td>Naar My Gadget Repairs</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_export" class="menuchoice_export" value="site"></td>
                                        <td>Naar de website</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_export" class="menuchoice_export" value="csv"></td>
                                        <td>Naar een CSV bestand</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="export_car_stages second_stage_export_cars_mgr" style="display:none;">
                            <table class="table table-dark">
                                <tbody>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_mgr" class="menuchoice_mgr" value="mgr_api" disabled></td>
                                        <td>Via API (Coming Soon)</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_mgr" class="menuchoice_mgr" value="mgr_xslx"></td>
                                        <td>Via MGR XLXS Import</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="export_car_stages third_stage_export_cars_mgr" style="display:none;">
                            <table class="table table-dark">
                                <tbody>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_mgr_export" class="menuchoice_mgr_export" value="export_brands" checked></td>
                                        <td>Van Automerken</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_mgr_export" class="menuchoice_mgr_export" value="export_models"></td>
                                        <td>Van Modellen</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="menuchoice_mgr_export" class="menuchoice_mgr_export" value="export_products"></td>
                                        <td>Van Onderdelen</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <input type="hidden" name="revision_id" class="revision_id_ticket">
                        <a class="btn btn-danger btn_stages btn_first_stage" style="float:left; display:none;"><i class='bx bx-left-arrow-alt' ></i> vorig</a>
                        <a class="btn btn-danger btn_stages btn_second_stage_return" style="float:left; display:none;"><i class='bx bx-left-arrow-alt' ></i> vorig</a>

                        <a class="btn btn-danger btn_stages btn_second_stage" style="float:right;"><i class='bx bx-right-arrow-alt' ></i> volgende</a>
                        <a class="btn btn-danger btn_stages btn_third_stage" style="float:right; display:none;"><i class='bx bx-right-arrow-alt' ></i> volgende</a>
                        <a class="btn btn-warning btn_stages btn_submit_export" style="float:right; display:none;"><i class='bx bx-download' ></i> exporteren</a>
                    </div>
                </div>
            </div>
        </div>





        



        <!--- APIS TO DO -->

        <div class="modal fade mdl-manual-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Nieuw </h5>
                        <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <input type="hidden" name="revision_id" class="revision_id_ticket">
                        <table class="table table-dark">
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_part" checked></td>
                                    <td>Nieuw Onderdeel Toevoegen</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="menuchoice" class="menuchoice" value="new_manual"></td>
                                    <td>Nieuwe Handleiding Maken</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <a class="btn btn-danger btnchoosemenu" style="float:right;"><i class='bx bx-right-arrow-alt' ></i> volgende</a>
                    </div>
                </div>
            </div>
        </div>


        
        <div class="modal fade mdl-revision-ticket-link" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Link tickets </h5>
                        <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <table class="table table-dark table-revision-ticket-link">
                            <tbody class="table-body-revision-ticket-link">

                            </tbody>
                        </table>
                        <input type="hidden" name="revision_id" class="revision_id_ticket">
                        <table class="table table-dark">
                            <tbody>
                                <tr>
                                    <td><a class="btn btn-danger" href="#"><i class="bx bx-trash"></i></a></td>
                                    <td>
                                        <select name="ticket" class="form form-control ticketrevselected ticketselect" style="width:100%;" required>
                                            <option value="" disabled selected>Maak een keuze..</option>
                                        </select>
                                    </td>
                                    <td><button type="button" class="btn btn-warning btn-kms-warning btnrevticketli" style="width:100%; min-width:125px;"><i class="bx bx-file" style="margin-top:4px;"></i> link</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>







        <div class="modal fade mdl-link-modellen-revisions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Link Modellen </h5>
                        <button type="button" class="close closemdl" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <table class="table table-dark">
                        <tbody>
                            <tr>
                                <td style="color:#FFF;">Filter op merk</td>
                                <td>
                                    <select class="form form-control brandsselect">
                                        <option value="all" selected>Alle merken & modellen</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <table class="modellen_table table table-dark">
                            <tbody id="tbody_modellen">
                                <tr><td></td><td></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer row">
                        <input type="hidden" name="revision_id" class="revision_id">
                        <button type="button" class="btn btn-warning btn-kms-warning btnlinkmodellenrevision" style="width:100%;"><i class="bx bx-user" style="margin-top:4px;"></i> link</button>
                    </div>
                </div>
            </div>
        </div>






        <div class="modal fade mdl-link-klanten-revisions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Link Klanten </h5>
                        <button type="button" class="close closemdl" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <table class="customers_table2 table table-dark">
                            <tbody id="tbody_customers2">
                                <tr><td></td><td></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer row">
                        <input type="hidden" name="revision_id" class="revision_id">
                        <button type="button" class="btn btn-warning btn-kms-warning btnlinkcustomersrevision" style="width:100%;"><i class="bx bx-user" style="margin-top:4px;"></i> link</button>
                    </div>
                </div>
            </div>
        </div>




        
        <div class="modal fade mdl-add-variant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel">Variant Toevoegen </h5>
                        <button type="button" class="close closemdl" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="/car/model/type/variant/create">
                    <div class="modal-body kms-modal-body">
                        @csrf
                        <input type="hidden" name="type_id" class="car_variant_id" value="">
                        <table class="table table-dark">
                            <thead>
                                <th>Variant</th>
                                <th>V.a. Bouwjaar</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" name="variant" class="form form-control" placeholder="Variant *optioneel">
                                    </td>
                                    <td>
                                        <input name="build" class="form form-control" type="number" min="1900" max="2099" step="1" placeholder="2016">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <button type="submit" class="btn btn-warning btn-kms-warning" style="width:100%;">Toevoegen</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>














        <div class="modal fade mdl-link-model-revision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Link reparaties </h5>
                        <button type="button" class="close closemdl" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <form action="/car/model/type/ticket/link" method="POST">
                        @csrf
                            <input type="hidden" name="brandname" class="brandname_hid">
                            <input type="hidden" name="model_id" class="model_idtl">
                            <table class="table table-dark">
                                <tbody>
                                    <tr>
                                        <td><a class="btn btn-danger" href="#"><i class="bx bx-trash"></i></a></td>
                                        <td>
                                            <select name="ticket" class="form form-control ticketsselect2" style="width:100%;" required>
                                                <option value="" disabled selected>Maak een keuze..</option>
                                            </select>
                                        </td>
                                        <td><button type="submit" class="btn btn-warning btn-kms-warning" style="width:100%; min-width:125px;"><i class="bx bx-file" style="margin-top:4px;"></i> link</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade mdl-upload-logo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Logo aanpassen </h5>
                        <button type="button" class="close closemdl closemdlmodels" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/car/logo/edit" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                            <input type="hidden" name="brandid" class="form form-control brandlogoid">
                            <label class="mt-2">logo</label>
                            <input type="file" name="logo" class="form form-control" style="background-color: #FFF; padding:7px;" placeholder="vb: audi" required>
                        </div>
                        <div class="modal-footer kms-modal-footer row">
                            <button type="submit" class="btn btn-warning btn-kms-warning btnlinkcustomers" style="width:98%;"><i class="bx bx-upload" style="margin-top:4px;"></i> Logo uploaden</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="modal fade mdl-new-car" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Merk aanmaken </h5>
                        <button type="button" class="close closemdl closemdlmodels" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/car/create" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                            <label>Merk</label>
                            <input type="text" name="brand" class="form form-control" placeholder="vb: audi" required>
                            <label class="mt-2">logo</label>
                            <input type="file" name="logo" class="form form-control" style="background-color: #FFF; padding:7px;" placeholder="vb: audi" required>
                        </div>
                        <div class="modal-footer kms-modal-footer row">
                            <button type="submit" class="btn btn-warning btn-kms-warning btnlinkcustomers" style="width:98%;"><i class="bx bx-car" style="margin-top:4px;"></i> Auto aanmaken</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade mdl-link-klanten" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Link Klanten </h5>
                        <button type="button" class="close closemdl closemdlmodels" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <table class="customers_table table table-dark">
                            <tbody id="tbody_customers">
                                <tr><td></td><td></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer row">
                        <input type="hidden" name="brandname" class="brandname_hid">
                        <button type="button" class="btn btn-warning btn-kms-warning btnlinkcustomers" style="width:100%;"><i class="bx bx-user" style="margin-top:4px;"></i> (un)link</button>
                    </div>
                </div>
            </div>
        </div>



        
        <div class="modal fade mdl-link-ticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Link Reparaties </h5>
                        <button type="button" class="close closemdl closemdlmodels" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                        <table class="tickets_table table table-dark">
                            <tbody id="tbody_tickets">
                                <tr><td></td><td></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <form action="/car/model/ticket/link" method="POST">
                        @csrf
                        <div class="modal-footer kms-modal-footer row">
                        <input type="hidden" name="brandname" class="brandname_hid">
                            <table class="table table-dark">
                                <tbody>
                                    <tr>
                                        <td><a class="btn btn-danger" href="#"><i class="bx bx-trash"></i></a></td>
                                        <td>
                                            <select name="ticket" class="form form-control ticketsselect" style="width:170px;" required>
                                                <option value="" disabled selected>Maak een keuze..</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="models" class="form form-control modelselect" style="width:170px;" required>
                                                <option value="" disabled selected>Maak een keuze..</option>
                                            </select>
                                        </td>
                                        <td><button type="submit" class="btn btn-warning btn-kms-warning" style="width:100%;"><i class="bx bx-file" style="margin-top:4px;"></i> link</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        




        <div class="modal fade mdl-add-type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel">Uitvoering Toevoegen </h5>
                        <button type="button" class="close closemdl" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="/car/model/type/create">
                    <div class="modal-body kms-modal-body">
                        @csrf
                        <input type="hidden" name="brand_id" class="car_brand_id" value="">
                        <input type="hidden" name="model_id" class="car_model_id" value="">
                        <label>Uitvoering</label>
                        <input type="text" class="form form-control" name="type_name" placeholder="Naam v/d uitvoering" required><br/>
                        <table class="table table-dark">
                            <thead>
                                <th>Variant</th>
                                <th>V.a. Bouwjaar</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" name="variant_1" class="form form-control" placeholder="Variant *optioneel">
                                    </td>
                                    <td>
                                        <input name="build_1" class="form form-control" type="number" min="1900" max="2099" step="1" placeholder="2016">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="variant_2" class="form form-control" placeholder="Variant *optioneel">
                                    </td>
                                    <td>
                                        <input name="build_2" class="form form-control" type="number" min="1900" max="2099" step="1" placeholder="2017">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="variant_3" class="form form-control" placeholder="Variant *optioneel">
                                    </td>
                                    <td>
                                        <input name="build_3" class="form form-control" type="number" min="1900" max="2099" step="1" placeholder="2018">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="variant_4" class="form form-control" placeholder="Variant *optioneel">
                                    </td>
                                    <td>
                                        <input name="build_4" class="form form-control" type="number" min="1900" max="2099" step="1" placeholder="2019">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="variant_5" class="form form-control" placeholder="Variant *optioneel">
                                    </td>
                                    <td>
                                        <input  name="build_5" class="form form-control" type="number" min="1900" max="2099" step="1" placeholder="2020">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <button type="submit" class="btn btn-warning btn-kms-warning" style="width:100%;">Toevoegen</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade mdl-link-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content" style="overflow:hidden;">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel"> Model Toevoegen </h5>
                        <button type="button" class="close closemdl closemdlmodels" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body">
                        <table class="models_table table table-dark">
                            <tbody id="tbody_models">
                                <tr><td></td><td></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <form method="POST" action="/car/model/create">
                        @csrf
                        <div class="modal-footer kms-modal-footer row">
                            <input type="hidden" name="brandname" class="brandname_hid">
                            <input type="hidden" name="brandid" class="brandid_hid">
                            <div class="col-lg-2"><a class="btn btn-sm btn-danger" id="btn-del-models" href="#" style="float:left;"><i class="bx bx-trash"></i></a></div>
                            <div class="col-lg-7"><input type="text" class="form form-control" name="model" placeholder="Naam nieuw model" style="background-color: #999; border:none; border-color:#FFF; border-radius:5px; border-style:solid; border-width:2px; color:#FFF;" required></div>
                            <div class="col-lg-2"><button class="btn btn-warning btn-kms-warning" style="width:100%;"><i class="bx bx-plus" style="margin-top:4px;"></i></button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade mdl-execute-api" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel">API's Aanroepen </h5>
                        <button type="button" class="close closemdl" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body">
                        <table>
                            <tr>
                                <td style="padding-right:10px;">
                                    <input type="radio" name="request_call" class="1voor1" value="1voor1" checked>
                                </td>
                                <td>één voor éen (actief)</td>
                            </tr>
                            <tr>
                                <td style="padding-right:10px;">
                                    <input type="radio" name="request_call" class="redirectexec" value="redirect">
                                </td>
                                <td>alles aanroepen (redirect)</td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <button type="button" class="btn btn-danger btn_exec_api" style="width:100%;">Uitvoeren</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
            <form action="/api/create" method="POST">             
             @csrf
                <div class="modal-content">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel">Create/Connect API </h5>
                        <button type="button" class="close closemdl" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body">
                        <div class="row">
                            <table style="margin-bottom:10px;">
                                <tr>
                                    <td style="vertical-align: middle; padding-left:15px;"><input type="radio" name="type" value="request" checked></td>
                                    <td style="vertical-align: middle;">Data opvragen</td>

                                    <td style="vertical-align: middle;"><input type="radio" name="type" value="send"></td>
                                    <td style="vertical-align: middle;">Data versturen</td>
                                </tr>
                            </table>
                        </div>
                        <input type="text" name="desc" class="form form-control kms-modal-input" placeholder="Describe what it does" style="border-radius:5px;" required>
                        <input type="text" name="platform" class="form form-control kms-modal-input" placeholder="Name of connected platform" style="border-radius:5px;" required>
                        <input type="text" name="docs" class="form form-control kms-modal-input" placeholder="Documentation link" style="border-radius:5px;" required>
                        <input type="text" name="endpoint" class="form form-control kms-modal-input" placeholder="Endpoint link" style="border-radius:5px;" required>
                        <input type="text" name="api_route" class="form form-control kms-modal-input" placeholder="Route (loop door alle endpoint)" style="border-radius:5px;" required>
                        <input type="text" name="api_point_route" class="form form-control kms-modal-input" placeholder="Route (op basis van key)" style="border-radius:5px;" required>
                        <input type="text" name="apikey" class="form form-control kms-modal-input" placeholder="API Key" style="border-radius:5px;" required>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <button type="submit" class="btn btn-danger" style="width:100%;">Save changes</button>
                    </div>
                </div>
            </form>
            </div>
        </div>



         <div class="modal fade mdl-edit-api" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
            <form action="/api/update" method="POST">             
             @csrf
                <div class="modal-content">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel">Update API </h5>
                        <button type="button" class="close closemdl" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body">
                        <div class="row">
                            <table style="margin-bottom:10px;">
                                <tr>
                                    <td style="vertical-align: middle; padding-left:15px;"><input type="radio" name="type" class="apitypes type_request" value="request" checked></td>
                                    <td style="vertical-align: middle;">Data opvragen</td>

                                    <td style="vertical-align: middle;"><input type="radio" name="type" value="send" class="apitypes type_send"></td>
                                    <td style="vertical-align: middle;">Data versturen</td>
                                </tr>
                            </table>
                        </div>
                        <input type="hidden" name="id" class="api_id" value="">
                        <input type="text" name="desc" class="form form-control kms-modal-input desc" placeholder="Describe what it does" style="border-radius:5px;" required>
                        <input type="text" name="platform" class="form form-control kms-modal-input platform" placeholder="Name of connected platform" style="border-radius:5px;" required>
                        <input type="text" name="docs" class="form form-control kms-modal-input docs" placeholder="Documentation link" style="border-radius:5px;" required>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <button type="submit" class="btn btn-danger" style="width:100%;">Save changes</button>
                    </div>
                </div>
            </form>
            </div>
        </div>



         <div class="modal fade mdl-automate-api" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog kms-modal" role="document">
            <form action="/api/update" method="POST">             
             @csrf
                <div class="modal-content">
                    <div class="modal-header kms-modal-header kms-column-subtitle">
                        <h5 class="modal-title" id="exampleModalLabel">Automation </h5>
                        <button type="button" class="close closemdl" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body kms-modal-body">
                        <input type="hidden" name="id" class="api_id" value="">
                        <label>Hoelaat wil je api's aanroepen</label>
                        <input type="time" name="desc" class="form form-control kms-modal-input desc" style="border-radius:5px;" required>
                        <label>Wanneer wil je de api aanroepen?</label>
                        <select name="desc" class="form form-control kms-modal-input desc" style="border-radius:5px;" required>
                            <option disabled selected value="">Make a choice..</option>
                            <option>Elke dag</option>
                            <option>Om de dag</option>
                            <option>Elke maandag</option>
                            <option>Elke dinsdag</option>
                            <option>Elke woensdag</option>
                            <option>Elke donderdag</option>
                            <option>Elke vrijdag</option>
                            <option>Elke zaterdag</option>
                            <option>Elke zondag</option>
                        </select>
                    </div>
                    <div class="modal-footer kms-modal-footer">
                        <button type="submit" class="btn btn-danger" style="width:100%;">Save changes</button>
                    </div>
                </div>
            </form>
            </div>
        </div>



        <div id="footer"></div>

    </body>

    
</html>
