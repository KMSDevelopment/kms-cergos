<script setup>
import { defineProps, reactive } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    customers: Array
})

async function updateFirstname(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/firstname/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}
async function updateLastname(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/lastname/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}
async function updateAddress(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/address/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}

async function updateZipcode(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/zipcode/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}

async function updateCity(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/city/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
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
                        <input type="text" class="form form-control kms-txt-input-light mt-6 text-left" placeholder="Type wat u wilt zoeken en klik op enter..">
                    </div>
                    <div class="kms-breadcrumb-column col-md-12 col-sm-12 col-lg-3">
                        <button class="btn btn-danger" style="margin-top: 7px;"><i class="bx bx-search"></i> Zoeken</button>
                    </div>
                </div>
            </div>
        </section>

        
        <div style="background: #1f2937;">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 justify-center">
                <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg" style="border-top-right-radius: 0px !important; border-top-left-radius: 0px !important;">
                    <div class="p-3 row text-gray-200 justify-center">
                        <a href="/rkb/cars" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-car kms-bx-icons kms-bx-icons-active"></i><br/>Auto's</a>
                        <a href="/rkb" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-cog kms-bx-icons"></i><br/>Reparaties</a>
                        <a href="/rkb/manuals" class="col-lg-3 text-center kms-icon-buttons"><i class="bx bx-file kms-bx-icons"></i><br/>Handleidingen</a>
                        <a href="/rkb/parts" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-chip kms-bx-icons"></i><br/>Onderdelen</a>
                        <a href="/rkb/customers/1" class="col-lg-2 text-center kms-icon-buttons kms-icon-btn-active"><i class="bx bx-user kms-bx-icons"></i><br/>Klanten</a>
                    </div>
                </div>
            </div>
            <div class="menubar">
                <table class="menubar-table">
                    <tr>
                        <td class="menubar-button btn-new-customers">
                            Nieuw
                        </td>
                        <td class="menubar-button btn-import-customers">
                            Importeren
                        </td>
                        <td class="menubar-button btn-export-revision">
                            Exporteren
                        </td>
                        <td class="menubar-button btn-del-customers">
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
                    <div :class="'kms-body-column col-md-12 col-sm-12 col-lg-12 bg-gray-800 text-white kms-column-border car'" style="position:relative; overflow:hidden; transform: rotate(0deg) !important;">
                        <h3 class="kms-column-subtitle" style="font-size:17px;"><input type="checkbox" style="float:left; margin-top:3px; margin-right:15px;" class="kms-checkboxes checkbox_checkall"><i class='bx bx-label kms-icons-sm-lbl' style="margin-top:0px;"></i> 
                            Klantenbestand 
                            <a href="/rkb/customers/1" class="btn btn-danger" title="Bekijk particuliere klanten" style="float:right; margin-right:15px; margin-top:-10px;"><i class="bx bx-user"></i></a>
                            <a href="/rkb/customers/1" class="btn btn-danger" title="Bekijk zakelijke klanten" style="float:right; margin-right:15px; margin-top:-10px;"><i class='bx bxs-business'></i></a>
                        </h3>
                        <hr style="margin-top:20px;">
                        <br/>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover table-dark">
                                    <thead style="border-bottom: 5px solid rgb(52 52 52); line-height: 38px;">
                                        <th>Referentie</th>
                                        <th style="padding-left:15px;">Bedrijfsnaam</th>
                                        <th style="padding-left:15px;">Straatnaam</th>
                                        <th style="padding-left:15px;">Postcode</th>
                                        <th style="padding-left:15px;">Vestigingsplaats</th>
                                        <th>Contact</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="customer in customers" :class="'allcsm customer'+customer.id">
                                            <td style="text-decoration: underline;">
                                                <a :href="'/customer/'+customer.id"><i class="bx bx-user text-danger"></i> {{ customer.reference }}</a>
                                            </td>
                                            <td>
                                                <input type="text" style="height:30px; border:none; background:transparent; width:200px; color:#FFF;" :value="customer.company_name" @keydown="updateFirstname($event)" @keyup="updateFirstname($event)" @change="updateFirstname($event)" :id="customer.id">
                                            </td>
                                            <td>
                                                <input type="text" style="height:30px; border:none; background:transparent; width:200px; color:#FFF;" :value="customer.address" @keydown="updateAddress($event)" @keyup="updateAddress($event)" @change="updateAddress($event)" :id="customer.id">

                                            </td>
                                            <td>
                                                <input type="text" style="height:30px; border:none; background:transparent; width:100px; color:#FFF;" :value="customer.zipcode" @keydown="updateZipcode($event)" @keyup="updateZipcode($event)" @change="updateZipcode($event)" :id="customer.id">
                                            </td>
                                            <td>
                                                <input type="text" style="height:30px; border:none; background:transparent; width:200px; color:#FFF;" :value="customer.city" @keydown="updateCity($event)" @keyup="updateCity($event)" @change="updateCity($event)" :id="customer.id">
                                            </td>
                                            <td>
                                                <a style="margin-right:10px;" class="text-secondary" :href="'mailto:'+customer.email"><i class='bx bx-envelope'style="font-size:20px;"></i></a>
                                                <a class="text-warning" :href="'tel:'+customer.phonenr"><i class='bx bxs-phone-call' style="font-size:20px;"></i></a>
                                            </td>
                                            <td>
                                                <i class='bx bx-message-rounded-error' style="font-size:32px;"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>



