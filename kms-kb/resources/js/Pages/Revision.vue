<script setup>
import { defineProps, reactive, computed } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps({
    revision: Array,
    revisions_models: Array,
    revisions_customers: Array,
    model: Array,
    manuals: Array,
    parts: Array,
    customers: Array,
    csrf: String,
    users: Array
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



    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <section class="header bg-white" style="height: 100px;">
            <div class="container">
                <div class="row" style="position: relative">
                    <div class="kms-breadcrumb-column col-md-6 col-sm-12 col-lg-12"><h2 class="kms-h2 text-xl font-semibold leading-tight text-gray-800"><img style="height: 100px; top: 0px; position: absolute; right: 10%;"><a href="/rkb" class="breadcrumb_li" style="float: left;">Reparaties <i class="bx bx-chevron-right"></i></a> <a class="breadcrumb_li" href="/rkb/cars#57" style="float: left;">{{ revision.title }}</a> </h2></div>
                </div>
            </div>
            <input type="hidden" name="revid" class="reviid" :value="revision.id">
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
                        <td class="menubar-button btn-manual-add">
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
                        <input type="text" class="form form-control" style="border:none; font-size:15px; background:none; color:#FFF; font-family: 'GoodTimes', sans-serif;" @keydown="updateRevisionTitle($event)" @keyup="updateRevisionTitle($event)" @change="updateRevisionTitle($event)" :id="revision.id" :value="revision.title">
                        <hr>
                        <div class="table-responsive">
                            <textarea class="form form-control" @keydown="updateRevisionComplain($event)" @keyup="updateRevisionComplain($event)" @change="updateRevisionComplain($event)" :id="revision.id" style="border:none; background:transparent; color:#FFF; height:200px">{{ revision.revision_desc }}</textarea>
                        </div>
                    </div>


                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-4 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-subtitle" style="font-weight:normal;">Klachtomschrijving
                        </h3>
                        <hr>
                        <textarea class="form form-control" @keydown="updateComplainDesc($event)" @keyup="updateComplainDesc($event)" @change="updateComplainDesc($event)" :id="revision.id" style="border:none; background:transparent; color:#FFF; height:85%" >{{ revision.complain_desc }}</textarea>
                    </div>


                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-4 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-subtitle" style="font-weight:normal; font-size:16px;">Merk & Model
                            <div class="kms-btn-rnd-dark btn-link-modellen-revisions" :id="revision.id"><table style="height: 100%; width: 100%; position: relative;"><tr><td style="width: 100%; height: 100%; text-align: center; vertical-align: middle; padding-top: 7px;"><i class="bx bx-plus"></i></td></tr></table></div>
                        </h3>
                        <hr>
                        <div class="row justify-center">
                            <div class="col-lg-12">
                                <ul class="pt-3" v-for="models in revisions_models">
                                    <li class="kms-list-link" v-for="modeldata in model[models.id]"><a :href="'/car/model/'+modeldata.id" target="_BLANK" id="docs-card" style="width:100%"> {{ modeldata.brand.brand }} - {{ modeldata.model }} <i class='bx bx-chevron-right kms-icons-sm'></i> </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-5 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-subtitle" style="font-weight:normal;">Handleidingen
                            <div class="kms-btn-rnd-dark btnnewmanual" :id="revision.id">
                                <table style="height: 100%; width: 100%; position: relative;">
                                    <tr>
                                        <td style="width: 100%; height: 100%; text-align: center; vertical-align: middle; padding-top: 7px;">
                                            <i class="bx bx-plus"></i>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </h3>
                        <hr>
                        <table class="table table-dark table-hover">
                            <thead>
                                <th>Titel</th>
                                <th>Laatsts bewerkt</th>
                            </thead>
                            <tbody>
                                <tr v-for="manual in manuals">
                                    <td>{{ manual.title }}</td>
                                    <td>{{ manual.updated_at }}</td>
                                    <td><a href="#" class="btnloadmanual btn btn-warning" :alt="revision.id" :id="manual.id"><i class='bx bx-book-reader' ></i></a></td>
                                </tr>
                            </tbody>    
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>

                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-6 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-subtitle" style="font-weight:normal;">Onderdelen
                            <div class="kms-btn-rnd-dark btn-link-product-revision" :id="revision.id"><table style="height: 100%; width: 100%; position: relative;"><tr><td style="width: 100%; height: 100%; text-align: center; vertical-align: middle; padding-top: 7px;"><i class="bx bx-plus"></i></td></tr></table></div>
                        </h3>
                        <hr>
                        <table class="table table-dark table-hover">
                            <thead>
                                <th>Ref</th>
                                <th>Code</th>
                                <th>Product</th>
                                <th>Opbergplaats</th>
                            </thead>
                            <tbody>
                                <tr v-for="part in parts">
                                    <td>{{ part.part.ref }}</td>
                                    <td>{{ part.part.code }}</td>
                                    <td>{{ part.part.name }}</td>
                                    <td>{{ part.part.stock_location }}</td>
                                </tr>
                            </tbody>    
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>

                    
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-6 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-subtitle" style="font-weight:normal;">Tickets
                            <div class="kms-btn-rnd-dark btnlinktickets"><table style="height: 100%; width: 100%; position: relative;"><tr><td style="width: 100%; height: 100%; text-align: center; vertical-align: middle; padding-top: 7px;"><i class="bx bx-plus"></i></td></tr></table></div>
                        </h3>
                        <hr>
                        <table class="table table-dark table-hover">
                            <thead>
                                <th></th>
                                <th>Ticket Nr.</th>
                            </thead>
                            <tbody>
                            </tbody>    
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>




                    
                </div>

                

            </div>
        </section>

    </AuthenticatedLayout>
</template>
