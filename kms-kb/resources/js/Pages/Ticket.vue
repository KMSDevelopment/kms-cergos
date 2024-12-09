<script setup>
import { defineProps, reactive, computed } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps({
    revision: Array,
    revisions_models: Array,
    revisions_customers: Array,
    brand: Array,
    model: Array,
    manuals: Array,
    brand: Array,
    parts: Array,
    customers: Array,
    csrf: String,
    users: Array
})



async function updateComplainDesc(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/revision/complain/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating brand');
  }
}


</script>



<template>

    
    <div class="modal fade mdl-user-ticket-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog kms-modal" role="document">
            <div class="modal-content" style="overflow:hidden;">
                <div class="modal-header kms-modal-header kms-column-subtitle">
                    <h5 class="modal-title" id="exampleModalLabel"> Collega</h5>
                    <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                    <table class="table table-dark">
                        <tbody>
                            <tr>
                                <td>Naam</td>
                                <td class="user_name"></td>
                            </tr>
                            <tr>
                                <td>E-mailadres</td>
                                <td class="user_email"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer kms-modal-footer">
                    <form action="/ticket/user/link" method="POST">
                        <div class="row">
                            <input type="hidden" name="_token" class="_token" :value="csrf">
                            <input type="hidden" name="id" :value="revisions_customers.id">
                            <input type="hidden" name="ticket_no" :value="revisions_customers.ticket_no">
                            <div class="col-lg-6">
                                <select class="form from-control" name="userid"style="margin-top: -2px; border-radius: 15px; color:#333; max-width:225px;" required>
                                    <option selected disabled value="">Maak een keuze..</option>
                                    <option v-for="user in users" :value="user.id" style="color:#000;">{{ user.name }}</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-warning" style="width:100%;"><i class='bx bx-plus' ></i> Aanpassen</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <div class="modal fade mdl-customer-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog kms-modal" role="document">
            <div class="modal-content" style="overflow:hidden;">
                <div class="modal-header kms-modal-header kms-column-subtitle">
                    <h5 class="modal-title" id="exampleModalLabel"> Klant informatie</h5>
                    <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body kms-modal-body" style="max-height: 300px; overflow-y:scroll; overflow-x:hidden;">
                    <table class="table table-dark">
                        <tbody>
                            <tr>
                                <td>Naam</td>
                                <td class="client_name"></td>
                            </tr>
                            <tr>
                                <td>E-mailadres</td>
                                <td class="client_email"></td>
                            </tr>
                            <tr>
                                <td>Telefoonnummer</td>
                                <td class="client_phone"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer kms-modal-footer">
                    <form action="/ticket/customer/link" method="POST">
                        <div class="row">
                            <input type="hidden" name="_token" class="_token" :value="csrf">
                            <input type="hidden" name="id" :value="revisions_customers.id">
                            <input type="hidden" name="ticket_no" :value="revisions_customers.ticket_no">
                            <div class="col-lg-6">
                                <select class="form from-control" name="customerid"style="margin-top: -2px; border-radius: 15px; color:#333; max-width:225px;" required>
                                    <option selected disabled value="">Maak een keuze..</option>
                                    <option v-for="customer in customers" :value="customer.id" style="color:#000;">{{ customer.firstname }} {{  customer.lastname }}</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-warning" style="width:100%;"><i class='bx bx-plus' ></i> Aanpassen</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <section class="header bg-white" style="height: 100px;">
            <div class="container">
                <div class="row" style="position: relative">
                    <div class="kms-breadcrumb-column col-md-6 col-sm-12 col-lg-12"><h2 class="kms-h2 text-xl font-semibold leading-tight text-gray-800"><img style="height: 100px; top: 0px; position: absolute; right: 10%;"><a href="/rkb" class="breadcrumb_li" style="float: left;">Reparaties <i class="bx bx-chevron-right"></i></a> <a class="breadcrumb_li" href="/rkb/cars#57" style="float: left;">Ticket {{ revisions_customers.ticket_no }} <i class="bx bx-chevron-right"></i> {{ revision.title }}</a> </h2></div>
                </div>
            </div>
        </section>

        <div style="background: #1f2937;">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 justify-center">
                <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg" style="border-top-right-radius: 0px !important; border-top-left-radius: 0px !important;">
                    <div class="p-3 row text-gray-200 justify-center">
                        <a href="/rkb/cars" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-car kms-bx-icons"></i><br/>Auto's</a>
                        <a href="/rkb" class="col-lg-2 text-center kms-icon-buttons  kms-icon-btn-active"><i class="bx bx-cog kms-bx-icons kms-bx-icons-active"></i><br/>Reparaties</a>
                        <a href="/rkb/manuals" class="col-lg-3 text-center kms-icon-buttons"><i class="bx bx-file kms-bx-icons"></i><br/>Handleidingen</a>
                        <a href="/rkb/parts" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-chip kms-bx-icons"></i><br/>Onderdelen</a>
                        <a href="/rkb/customers/1" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-user kms-bx-icons"></i><br/>Klanten</a>
                    </div>
                </div>
            </div>
            <div class="menubar">
                <table class="menubar-table">
                    <tr>
                        <td class="menubar-button btn-manual-add" :id="revisions_customers.ticket_no">
                            Nieuw
                        </td>
                        <td class="menubar-button btn-del-revision-customer">
                            Verwijderen
                        </td>
                        <td class="menubar-button">
                            Help
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <section class="body">
            <div class="container">
                <div class="row justify-center">
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-3 bg-gray-800 text-white kms-column-border">
                        <input type="text" class="form form-control" style="border:none; font-size:15px; background:none; color:#FFF; font-family: 'GoodTimes', sans-serif;" :value="revision.title">
                        <div class="table-responsive">
                            <table class="table table-dark mt-2">
                                <tbody>
                                    <tr>
                                        <td>Ticket no.</td>
                                        <td><span class="kmi-badge kmi-badge-warning" style='float:left'>{{ revisions_customers.ticket_no }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Klant</td>
                                        <td><a href="#" class="btncustomerticket" :id="revisions_customers.customer_id">Bekijk klantgegevens</a></td>
                                    </tr>
                                    <tr>
                                        <td>Toewijzing</td>
                                        <td><a href="#" class="btnuserticket" :id="revisions_customers.user_id_assigned">Bekijk collega</a></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>{{ revisions_customers.status }}</td>
                                    </tr>
                                    <tr>
                                        <td>Prijs</td>
                                        <td><input type="number" step="any" min="0" :value="revisions_customers.sales_price" style="height:30px; border:none; background:transparent; color:#FFF;"></td>
                                    </tr>
                                    <tr>
                                        <td>Datering</td>
                                        <td><em style="font-size:12px; color:999">{{ revisions_customers.start }}</em></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-4 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-subtitle" style="font-weight:normal;">Klachtomschrijving
                        </h3>
                        <hr>
                        <textarea class="form form-control" style="border:none; background:transparent; color:#FFF; height:85%" @keydown="updateComplainDesc($event)" @keyup="updateComplainDesc($event)" @change="updateComplainDesc($event)" :id="revision.id">{{ revision.complain_desc }}</textarea>
                    </div>
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-4 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-subtitle" style="font-weight:normal; font-size:16px;">Merk & Model
                        </h3>
                        <hr>
                        <div class="row justify-center">
                            <div class="col-lg-12 text-center">
                                <a :href="'/rkb/cars/sort/alfabetisch#'+brand.brand.toLowerCase()" target="_BLANK"><img :src="brand.logo" :title="brand.brand" style="height:100px; margin-left:auto; margin-right:auto;"><br/>
                                <h3 class="kms-column-subtitle" style="font-weight:normal;">{{brand.brand}}</h3>
                                </a>
                            </div>
                        </div>
                        <div class="row justify-center" v-for="revisions_model in revisions_models">
                            <div class="col-lg-12">
                                <ul class="pt-3">
                                    <li class="kms-list-link" style="position:relative;" v-for="modeldata in model[revisions_model.id]">
                                        <a :href="'/car/model/'+modeldata.id" alt="39" id="docs-card" style="width: 100%; padding-left:65px;">{{ modeldata.model }} <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="float: right;"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path></svg></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="kms-body-column col-md-12 col-sm-12 col-lg-11 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-subtitle" style="font-weight:normal;">Onderdelen
                            <div class="kms-btn-rnd-dark" id="btn-link-product" :alt="revisions_customers.ticket_no"><table style="height: 100%; width: 100%; position: relative;"><tr><td style="width: 100%; height: 100%; text-align: center; vertical-align: middle; padding-top: 7px;"><i class="bx bx-plus"></i></td></tr></table></div>
                        </h3>
                        <hr>
                        <table class="table table-dark table-hover">
                            <thead>
                                <th></th>
                                <th>Ref</th>
                                <th>Product</th>
                                <th>Locatie</th>
                            </thead>
                            <tbody>
                                <tr v-for="part in parts" :class="'part'+part.id">
                                    <td><a class="text-danger btndelpart" href="#" :id="part.id"><i class="bx bx-trash"></i></a></td>
                                    <td>{{ part.part.code }}</td>
                                    <td>{{ part.part.name }}</td>
                                    <td>{{ part.part.stock_location }}</td>
                                </tr>
                            </tbody>    
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                    
                </div>

                
                <div class="row justify-center manuals">
                    <div v-for="manual in manuals" class="kms-body-column col-md-6 col-sm-12 col-lg-3 bg-gray-800 text-white kms-column-border text-center"><a href="#" class="btnloadmanual" :id="manual.id">
                        <hr>
                        <h3 class="kms-column-subtitle" style="font-weight: normal; font-size: 16px;">{{ manual.title }}</h3>
                        <hr>
                        <i class='bx bxs-file text-danger' style="font-size:72px;"></i></a><br/>
                        Handleiding
                    </div>
                </div>

            </div>
        </section>

    </AuthenticatedLayout>
</template>
