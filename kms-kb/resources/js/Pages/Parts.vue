<script setup>
import { defineProps, reactive } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    parts: Array,
    total_parts: Array,
})

async function updateStock(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/part/stock/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}
async function updateLocation(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/part/location/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}
async function updateProductName(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/part/name/edit', {
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
                        <a href="/rkb/cars" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-car kms-bx-icons"></i><br/>Auto's</a>
                        <a href="/rkb" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-cog kms-bx-icons"></i><br/>Reparaties</a>
                        <a href="/rkb/manuals" class="col-lg-3 text-center kms-icon-buttons"><i class="bx bx-file kms-bx-icons"></i><br/>Handleidingen</a>
                        <a href="/rkb/parts" class="col-lg-2 text-center kms-icon-buttons kms-icon-btn-active"><i class="bx bx-chip kms-bx-icons kms-bx-icons-active"></i><br/>Onderdelen</a>
                        <a href="/rkb/customers/1" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-user kms-bx-icons"></i><br/>Klanten</a>
                    </div>
                </div>
            </div>
            <div class="menubar">
                <table class="menubar-table">
                    <tr>
                        <td class="menubar-button btn-new-parts">
                            Nieuw
                        </td>
                        <td class="menubar-button btn-import-customers">
                            Importeren
                        </td>
                        <td class="menubar-button btn-export-cars">
                            Exporteren
                        </td>
                        <td class="menubar-button btn-del-parts">
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
                        <h3 class="kms-column-subtitle" style="font-size:17px;"><input type="checkbox" style="float:left; margin-top:3px; margin-right:15px;" class="kms-checkboxes checkbox_checkall_parts"><i class='bx bx-label kms-icons-sm-lbl' style="margin-top:0px;"></i> Onderdelen <span class="alert alert-warning" style="font-size:10px; padding:5px; top:-3px; background:none; color:#FFF; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; float:right;">Aantal onderdelen: {{ total_parts }}</span></h3>
                        <hr>
                        <br/>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover table-dark">
                                    <thead style="border-bottom: 5px solid rgb(52 52 52); line-height: 38px;">
                                        <th></th>
                                        <th>Referentie</th>
                                        <th style="padding-left:15px;">Product</th>
                                        <th style="padding-left:15px;">Locatie</th>
                                        <th style="padding-left:15px; text-align:right; padding-right:25px;">Voorradig</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="part in parts" :class="'part'+part.id">
                                            <td >
                                                <input type="checkbox" class="kms-checkboxes partschbs" :value="part.id"> 
                                            </td>
                                            <td style="width:100px;">
                                                {{ part.code }}
                                            </td>
                                            <td>
                                                <input type="text" class="form form-control" style="background:transparent; border:none; color:#FFF;" :value="part.name" @keydown="updateProductName($event)" @keyup="updateProductName($event)" @change="updateProductName($event)" :id="part.id">
                                            </td>
                                            <td>
                                                <input type="text" class="form form-control" style="background:transparent; border:none; color:#FFF;" :value="part.stock_location" @keydown="updateLocation($event)" @keyup="updateLocation($event)" @change="updateLocation($event)" :id="part.id">
                                            </td>
                                            <td>
                                                <input type="number" class="form form-control" :value="part.stock" style="width:100px; float:right;" @keydown="updateStock($event)" @keyup="updateStock($event)" @change="updateStock($event)" :id="part.id">
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



