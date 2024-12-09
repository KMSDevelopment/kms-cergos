<script setup>
import { defineProps, reactive } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    products: Array,
    current_page: Array,
    totalpages: Array,
    total_revisions: Array,
    apis: Array,
})


async function updateRevisionTitle(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/revision/title/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating model');
  }
}


async function updateRevisionComplain(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/revision/revision_desc/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating model');
  }
}

</script>

<template>
    <Head title="Dashboard" />


    <AuthenticatedLayout>


        <section class="header bg-white" style="height: 100px;">
            <div class="container">
                <div class="row">
                    <div class="kms-breadcrumb-column col-md-6 col-sm-12 col-lg-4" >
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
                <input type="radio" class="dashboard_choice" :id="current_page" name="dashboard_choice" style="zoom:1.5; position:absolute; left:11%; top:2%;" value="previous" placeholder="Vorige pagina">

                <input type="radio" class="dashboard_choice" :id="current_page" name="dashboard_choice" style="zoom:1.5; position:absolute; right:46%; top:-10%;" value="filter" placeholder="Filter">
                
                <input type="radio" class="dashboard_choice" :id="current_page" name="dashboard_choice" style="zoom:1.5; position:absolute; right:11%; top:2%;" value="next" placeholder="Volgende pagina">

                <a href="#" class="btn-hide-dash"><i class='bx bx-down-arrow-circle' style="font-size:35px; color:#FFF; position:absolute; bottom:-35px; right:45%;"></i></a>

                <div class="kms-dashboard-description">
                    pagina {{ current_page }} / <a :href="'/rkb/page/'+totalpages">{{ totalpages }}</a>
                    <br/>
                    <div class="dashboard-info" style="display:none; padding-top:5px;">
                        Totaal aantal reparaties: {{ total_revisions }} <br/>
                        <table style="width:100%; text-align:center; font-size:18px; margin-top:5px;">
                            <tr>
                                <td style="text-align:center;"><a href="#" class="btnfilter_specs" data-toggle="tooltip" data-placement="top" title="Filteren"><i class='bx bx-filter-alt'></i></a></td>
                                <td style="text-align:center;"><a href="#" class="btnsearch_specs" data-toggle="tooltip" data-placement="top" title="Specifiek zoeken"><i class='bx bx-file-find'></i></a></td>
                                <td style="text-align:center;"><a href="#" class="btnsort_specs" data-toggle="tooltip" data-placement="top" title="Sorteren"><i class='bx bx-sort' ></i></a></td>
                            </tr>
                        </table>
                    </div>
                    <div class="dashboard-info-specs dshb-filter" style="display:none; padding-top:10px;">
                        <select class="form form-control dshb-btn-filter_rev">
                            <option value="" selected disabled>Maak een keuze..</option>
                            <option v-for="api in apis" :value="api.id">{{ api.platform }} ({{ api.desc }})</option>
                        </select>
                        <br/>
                        <em style="color:#FFF; font-size:12px;">Filter op basis van een bron waarvan de data afkomstig is.</em>
                    </div>
                    <div class="dashboard-info-specs dshb-search" style="display:none; padding-top:10px;">
                        <input type="text" class="form form-control dshb-input-search_rev" placeholder="Type ticket nummer of automerk">
                        <br/>
                        <em style="color:#FFF; font-size:12px;">Zoek op basis van ticket nummer, klantnaam of automerk.</em>
                    </div>
                    <div class="dashboard-info-specs dshb-sort" style="display:none; padding-top:10px;">
                        <select class="form form-control dshb_sort_choice_rev">
                            <option value="" selected disabled>Maak een keuze..</option>
                            <option value="DESC">Datum laatst aangemaakt</option>
                            <option value="ASC">Datum eerst aangemaakt</option>
                            <option value="brand">Basis van merk</option>
                        </select>
                        <br/>
                        <em style="color:#FFF; font-size:12px;">Sorteer data</em>
                    </div>
                </div>

            </div>
        </div>
        
        <div style="background: #1f2937;">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 justify-center">
                <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg" style="border-top-right-radius: 0px !important; border-top-left-radius: 0px !important;">
                    <div class="p-3 row text-gray-200 justify-center">
                        <a href="/rkb/cars" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-car kms-bx-icons"></i><br/>Auto's</a>
                        <a href="/rkb" class="col-lg-2 text-center kms-icon-buttons kms-icon-btn-active"><i class="bx bx-cog kms-bx-icons kms-bx-icons-active"></i><br/>Reparaties</a>
                        <a href="/rkb/manuals" class="col-lg-3 text-center kms-icon-buttons"><i class="bx bx-file kms-bx-icons"></i><br/>Handleidingen</a>
                        <a href="/rkb/parts" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-chip kms-bx-icons"></i><br/>Onderdelen</a>
                        <a href="/rkb/customers/1" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-user kms-bx-icons"></i><br/>Klanten</a>
                    </div>
                </div>
            </div>
            <div class="menubar">
                <table class="menubar-table">
                    <tr>
                        <td class="menubar-button btn-new-revision">
                            Nieuw
                        </td>
                        <td class="menubar-button btn-import-revision">
                            Importeren
                        </td>
                        <td class="menubar-button btn-export-revision">
                            Exporteren
                        </td>
                        <td class="menubar-button btn-del-revision">
                            Verwijderen
                        </td>
                        <td class="menubar-button btn-docs">
                            Help
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <section class="body">
            <div class="container">
                <div class="row justify-center ">
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-5 pt-4 bg-gray-800 text-white kms-column-border" style="overflow:hidden;" :id="'revision'+item[0]" v-for="item in products">

                        <em style="position:absolute; top:3px; right:15px; font-size:11px; color:#999;">{{ item[8] }}</em>
                        <span class="alert alert-danger" style="font-size: 10px;
                        position: absolute;
                        padding: 5px;
                        background-color: transparent;
                        color: rgb(255, 255, 255);
                        top: -5px;
                        right: 45%;
                        background: #191f29;
                        box-shadow: 0px 1px 4px #d91717;" :title="'Ingeladen van '+item[7]">{{ item[7] }}</span>

                        <h3 class="kms-column-subtitle mt-2" style="font-size:17px;">
                            <input type="checkbox" class="chbrevisions" :id="item[0]" style="float:left; margin-top:3px; margin-right:5px;">
                            <i class='bx bx-label kms-icons-sm-lbl' style="float:left;"></i>
                            <input type="text" class="form form-control" style="border:none; margin-top:-8px; color:#FFF; background:transparent; width:90%; float:left; font-size:14px;" :value="item[3]" @keydown="updateRevisionTitle($event)" @keyup="updateRevisionTitle($event)" @change="updateRevisionTitle($event)" :id="item[0]">
                        </h3>
                        <hr class="mt-5">

                        <div class="status-bar">
                            <div class="table-responsive">
                                <table>
                                    <tr>
                                        <td class="pb-2">
                                            <a class="kmi-badge kmi-badge-warning btn-revision-mdl-ticket" href="#" :id="item[0]" style="margin-left:5px;"><i class="bx bx-plus"></i></a>
                                        </td>
                                        <td :class="'pb-2 revisiontickets revticket'+revison_customers.ticket_no" v-for="revison_customers in item[1]">
                                            <a :href="'/revision/ticket/'+revison_customers.ticket_no" class="kmi-badge kmi-badge-danger kms-ticket-background" style=" float:right; min-width:200px; margin-right:5px; margin-left:5px;">Ticket nr. {{ revison_customers.ticket_no }} > {{ revison_customers.status }} </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <br/>
                        <div class="row">
                            <div class="col-lg-7">
                                <h4 class="kms-column-subtitle " style="font-size:13px;">Beschrijving<hr style="border-width: 2px; border-color: rgb(255, 0, 0);"></h4>
                                <textarea class="form form-control" @keydown="updateRevisionComplain($event)" @keyup="updateRevisionComplain($event)" @change="updateRevisionComplain($event)" :id="item[0]" style="border:none; background:transparent; color:#FFF; height:150px;">{{ item[4] }}</textarea>
                                <br/><br/>
                            </div>
                            <div class="col-lg-5 mb-3">
                                <h4 class="kms-column-subtitle " style="font-size:13px;">
                                    <a href="#" class="btn-link-klanten-revisions" :id="item[0]">Klant(en) <i class="bx bx-plus-circle" style="font-size:17px; float:right;"></i></a>
                                    <hr style="border-width: 2px; border-color: rgb(255, 0, 0);">
                                </h4>
                                
                                <ul class="pt-3 ">
                                    <li class="kms-list-link" v-for="customer in item[2]"><a :href="'/customer/'+customer.id" id="docs-card" style="width:100%" class="model_li">{{ customer.firstname }} {{ customer.lastname }} <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="float:right;"> <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" /> </svg></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-7">
                                <h4 class="kms-column-subtitle " style="font-size:13px;">Merk(en)<hr style="border-width: 2px; border-color: rgb(255, 0, 0);"></h4>
                                <ul class="pt-3 ">
                                    <li class="kms-list-link pb-3" v-for="brands in item[6]" style="margin-bottom:25px"><a :href="'/rkb/cars/sort/alfabetisch#'+brands.brand.toLowerCase()" :alt="brands.id" id="docs-card" style="width:100%" class="model_li"><img :src="brands.logo" style="height:50px; float:left; margin-top:-15px; margin-right:15px;"> {{ brands.brand }} <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="float:right;"> <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" /> </svg></a></li>
                                </ul>
                            </div>
                            <div class="col-lg-5">
                                <h4 class="kms-column-subtitle " style="font-size:13px;">
                                    <a href="#" class="btn-link-modellen-revisions" :id="item[0]">Model(len) <i class="bx bx-plus-circle" style="font-size:17px; float:right;"></i></a>
                                    <hr style="border-width: 2px; border-color: rgb(255, 0, 0);">
                                </h4>
                                <ul class="pt-3">
                                    <li class="kms-list-link" v-for="models in item[5]"><a :href="'/car/model/'+models.id" :alt="models.id" id="docs-card" style="width:100%" class="model_li"> {{ models.model }} <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="float:right;"> <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" /> </svg></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>



