<script setup>
import { defineProps, reactive, computed } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    cars: Array,
    reparaties: Array,
    customers: Array,
    apiarray: Array,
    totalpages: Array,
    current_page: Array,
    total_cars: Array,
    apis: Array,
    kentekens: Array
})


async function updateCarBrand(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/car/brand/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating brand');
  }
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <section class="header bg-white" style="height: 100px;">
            <div class="container">
                <div class="row">
                    <div class="kms-breadcrumb-column col-md-12 col-sm-12 col-lg-4" >
                        <h2 class="kms-h2 text-xl font-semibold leading-tight text-gray-800" style="text-align:right;">Reparatie Kennisbank</h2>
                    </div>
                    <div class="kms-breadcrumb-column col-md-12 col-sm-12 col-lg-4">
                        <input type="text" class="form form-control kms-txt-input-light mt-6 text-left btnbrowserfindinput" placeholder="Zoek op deze pagina..">
                    </div>
                    <div class="kms-breadcrumb-column col-md-12 col-sm-12 col-lg-3">
                        <button class="btn btn-danger btnbrowserfind" style="margin-top: 7px;"><i class="bx bx-search"></i> Zoeken</button>
                    </div>
                </div>
            </div>
        </section>

        <div class="kms-car-dashboard">
            <div class="kms-car-dashboard-inside">
                <input type="radio" class="dashboard_choice_cars" :id="current_page" name="dashboard_choice_cars" style="zoom:1.5; position:absolute; left:11%; top:2%;" value="previous" placeholder="Vorige pagina">

                <input type="radio" class="dashboard_choice_cars" :id="current_page" name="dashboard_choice_cars" style="zoom:1.5; position:absolute; right:46%; top:-10%;" value="filter" placeholder="Filter">
                
                <input type="radio" class="dashboard_choice_cars" :id="current_page" name="dashboard_choice_cars" style="zoom:1.5; position:absolute; right:11%; top:2%;" value="next" placeholder="Volgende pagina">

                <a href="#" class="btn-hide-dash"><i class='bx bx-down-arrow-circle' style="font-size:35px; color:#FFF; position:absolute; bottom:-35px; right:45%;"></i></a>



                <div class="kms-dashboard-description">
                    pagina {{ current_page }} / <a :href="'/rkb/cars/page/'+totalpages">{{ totalpages }}</a>
                    <br/>
                    <div class="dashboard-info" style="display:none; padding-top:5px;">
                        Totaal aantal automerken: {{ total_cars }} <br/>
                        <table style="width:100%; text-align:center; font-size:18px; margin-top:10px;">
                            <tr>
                                <td style="text-align:center;"><a href="#" class="btnspecs btnfilter_specs" data-toggle="tooltip" data-placement="top" title="Filteren"><i class='bx bx-filter-alt'></i></a></td>
                                <td style="text-align:center;"><a href="#" class="btnspecs btnsearch_specs" data-toggle="tooltip" data-placement="top" title="Specifiek zoeken"><i class='bx bx-file-find'></i></a></td>
                                <td style="text-align:center;"><a href="#" class="btnspecs btnsort_specs" data-toggle="tooltip" data-placement="top" title="Sorteren"><i class='bx bx-sort' ></i></a></td>
                            </tr>
                        </table>
                    </div>


                    <div class="dashboard-info-specs dshb-filter" style="display:none; padding-top:10px;">
                        <select class="form form-control dshb-btn-filter">
                            <option value="" selected disabled>Maak een keuze..</option>
                            <option v-for="api in apis" :value="api.id">{{ api.platform }} ({{ api.desc }})</option>
                        </select>
                        <br/>
                        <em style="color:#FFF; font-size:12px;">Filter op basis van een bron waarvan de data afkomstig is.</em>
                    </div>
                    <div class="dashboard-info-specs dshb-search" style="display:none; padding-top:10px;">
                        <input type="text" class="form form-control dshb-input-search" placeholder="Type, Automerk of Model">
                        <br/>
                        <em style="color:#FFF; font-size:12px;">Zoek op basis van automerk of model.</em>
                    </div>
                    <div class="dashboard-info-specs dshb-sort" style="display:none; padding-top:10px;">
                        <select class="form form-control dshb_sort_choice">
                            <option value="" selected disabled>Maak een keuze..</option>
                            <option value="alfabetisch">Alfabetisch (alles op één pagina)</option>
                        </select>
                        <br/>
                        <em style="color:#FFF; font-size:12px;">Toon data op een geselecteerde manier</em>
                    </div>
                </div>

            </div>
        </div>

        
        <div style="background: #1f2937;">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 justify-center">
                <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg" style="border-top-right-radius: 0px !important; border-top-left-radius: 0px !important;">
                    <div class="p-3 row text-gray-200 justify-center">
                        <a href="/rkb/cars" class="col-lg-2 text-center kms-icon-buttons kms-icon-btn-active"><i class="bx bx-car kms-bx-icons kms-bx-icons-active"></i><br/>Auto's</a>
                        <a href="/rkb" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-cog kms-bx-icons"></i><br/>Reparaties</a>
                        <a href="/rkb/manuals" class="col-lg-3 text-center kms-icon-buttons"><i class="bx bx-file kms-bx-icons"></i><br/>Handleidingen</a>
                        <a href="/rkb/parts" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-chip kms-bx-icons"></i><br/>Onderdelen</a>
                        <a href="/rkb/customers/1" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-user kms-bx-icons"></i><br/>Klanten</a>
                    </div>
                </div>
            </div>
            <div class="menubar">
                <table class="menubar-table">
                    <tr>
                        <td class="menubar-button btn-new-car">
                            Nieuw
                        </td>
                        <td class="menubar-button btn-import-cars">
                            Importeren
                        </td>
                        <td class="menubar-button btn-export-cars">
                            Exporteren
                        </td>
                        <td class="menubar-button btn-del-cars">
                            Verwijderen
                        </td>
                        <td class="menubar-button btn-car-help">
                            Help
                        </td>
                    </tr>
                </table>
            </div>
        </div>



        <section class="body">
            <div class="container">


                <div class="row justify-center" style="position:relative !important;">
                    <div :class="'kms-body-column col-md-6 col-sm-12 col-lg-5 bg-gray-800 text-white kms-column-border car'+item.id" :id=item.brand.toLowerCase() style="position:relative; overflow:hidden;" v-for="item in cars">

                        
                        <div class="kms-checker" data-toggle="tooltip" data-placement="bottom" title="Check als dit automerk is gecontroleerd">
                            <input type="checkbox" class="kms-check-checker checkcar" :id="item.id" :value="item.checked" :checked="item.checked =='1'">
                        </div>

                        <span class="alert alert-danger kms-api-badge" :title="'Ingeladen van '+apiarray[item.id]">{{ apiarray[item.id] }}</span>
                        <h3 class="kms-column-subtitle" style="font-size:17px; right:50%;"><input type="checkbox" style="float:left; margin-top:11px; margin-right:15px;" class="chbcars kms-checkboxes" :value="item.id"><i class='bx bx-label kms-icons-sm-lbl' style="margin-top:8px;"></i> 
                            <input type="text" class="form form-control" style="border:none; background:transparent; width:70%; margin-top:-10px; color:#FFF" @keydown="updateCarBrand($event)" @keyup="updateCarBrand($event)" @change="updateCarBrand($event)" :id="item.id" :value=item.brand  title="Aanpassing wordt automatisch opgeslagen">
                            <a v-if="item.logo != NULL" href="#"  id="btn-upload-logo" :alt="item.id"><img :src="item.logo" style="float:right; top:10px; height:50px; position:absolute; right:10px;"></a>
                            <a v-if="item.logo == NULL" href="#"  id="btn-upload-logo" :alt="item.id"><i class="bx bx-image-add" style="float:right; top:20px; height:65px; position:absolute; right:25px; font-size:24px;"></i></a>
                        </h3>
                        <hr>

                        
                        <div class="status-bar" style="padding-bottom:0px;">
                            <div class="table-responsive">
                                <table style="margin-bottom:10px;"><!-- to do -->
                                    <tr>
                                        <td v-for="kenteken in kentekens[item.id]">
                                            <a v-if="kenteken[1] != ''" :href="'/customer/'+kenteken[1]" class="kmi-badge kmi-badge-warning" style=" float:right; min-width:200px; margin-right:5px; margin-left:5px;">{{ kenteken[0] }}</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-7 col-md-12 col-sm-12 pb-4">
                                <h4 class="kms-column-subtitle" style="font-size:13px;"><a href="#" id="btn-link-model" :alt="item.id" :title="item.brand"><i class='bx bx-plus-circle' style="font-size:19px; float:right;"></i> Modellen</a><hr style="border-width:2px; border-color:#ff0000;"></h4>
                                <div style="max-height:250px; overflow-x:hidden; overflow-y:scroll;">
                                <ul class="pt-3">
                                    <li class="kms-list-link" v-for="model in item.models"><a href="#" :alt="model.id" id="docs-card" style="width:100%" class="model_li"> {{ model.model }} <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="float:right;"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" /></svg></a></li>
                                </ul>
                            </div>
                                <br/><br/>
                                <h4 class="kms-column-subtitle" style="font-size:13px;"><a href="#" id="btn-link-tickets" :alt="item.id" :title="item.brand"><i class='bx bx-plus-circle' style="font-size:19px; float:right;"></i> Tickets<hr style="border-width:2px; border-color:#ff0000;"></a></h4>
                                <div style="max-height:200px; overflow-y:scroll; overflow-x:hidden;">
                                    <ul class="pt-3">
                                        <li class="kms-list-link" v-for="revision in item.revisions">
                                        <a :href="'/revision/ticket/'+revision.ticket_no" :alt="revision.ticket_no" id="docs-card" style="width:100%" >Ticket nr. {{ revision.ticket_no }} <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="float:right;"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" /></svg></a>
                                       </li> 
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 col-sm-12">
                                <h4 class="kms-column-subtitle " style="font-size:13px;"><a href="#" id="btn-link-klanten" :alt="item.id" :title="item.brand"><i class='bx bx-plus-circle' style="font-size:19px; float:right;"></i> Klanten<hr style="border-width:2px; border-color:#ff0000;"></a></h4>
                                <div style="min-height:270px; max-height:530px; overflow-y:scroll; overflow-x:hidden;">
                                    <ul class="pt-3">
                                        <li class="kms-list-link" v-for="customer in customers[item.id]">
                                            <a :href="'/customer/'+customer[0]" target="_BLANK" :alt="customer[0]" id="docs-card" style="width:100%">{{ customer[1] }} {{ customer[2] }} <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="float:right;"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" /></svg></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>



