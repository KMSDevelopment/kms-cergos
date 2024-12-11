<script setup>
import { defineProps, reactive } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps({
    model: Array,
    brand: Array,
    types: Array,
    revisions: Array
})


async function updateCarModel(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/car/model/edit', {
        value: value,
        id: id,
    });
    console.log(response);
  } catch (error) {
    console.error('Error updating model');
  }
}



async function updateTypeName(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/car/model/type/edit', {
        value: value,
        id: id,
    });
    console.log(response);
  } catch (error) {
    console.error('Error updating model');
  }
}

async function updateVariantName(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/car/model/variant/edit', {
        value: value,
        id: id,
    });
    console.log(response);
  } catch (error) {
    console.error('Error updating model');
  }
}


async function updateBuild(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/car/model/build/edit', {
        value: value,
        id: id,
    });
    console.log(response);
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
                <div class="row" style="position: relative">
                    <div class="kms-breadcrumb-column col-md-6 col-sm-12 col-lg-12">
                        <h2 class="kms-h2 text-xl font-semibold leading-tight text-gray-800"><img :src="brand.logo" style="height:100px; top:0px; position:absolute; right:10%"><a href="/rkb" class="breadcrumb_li" style="float:left;">Reparaties <i class='bx bx-chevron-right' ></i></a>  <a href="/rkb/cars" class="breadcrumb_li" style="float:left;">Merken <i class='bx bx-chevron-right' ></i></a> <a class="breadcrumb_li" :href="'/rkb/cars#'+brand.id" style="float:left;"> {{ brand.brand }} </a> <input type="text" class="form form-control" :value="model.model"  @keydown="updateCarModel($event)" @keyup="updateCarModel($event)" @change="updateCarModel($event)" :id="model.id" title="Aanpassing wordt automatisch opgeslagen" style="border:none; background:transparent; width:300px; float:left; font-size: 21px;
                        text-transform: uppercase;
                        font-weight: normal;
                        font-family: 'Racing Sans One', sans-serif;
                        text-shadow: 0px 0px 2px #FFF; margin-top:0px; margin-left:10px;
                        color: #000;"></h2>
                    </div>
                </div>
            </div>
        </section>

        <div style="background: #1f2937;">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 justify-center">
                <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg" style="border-top-right-radius: 0px !important; border-top-left-radius: 0px !important;">
                    <div class="p-3 row text-gray-200 justify-center">
                        <a href="/rkb/cars" class="col-lg-2 text-center kms-icon-buttons kms-icon-btn-active"><i class="bx bx-car kms-bx-icons"></i><br/>Auto's</a>
                        <a href="/rkb" class="col-lg-2 text-center kms-icon-buttons "><i class="bx bx-cog kms-bx-icons kms-bx-icons-active"></i><br/>Reparaties</a>
                        <a href="/rkb/manuals" class="col-lg-3 text-center kms-icon-buttons"><i class="bx bx-file kms-bx-icons"></i><br/>Handleidingen</a>
                        <a href="/rkb/parts" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-chip kms-bx-icons"></i><br/>Onderdelen</a>
                        <a href="/rkb/customers/1" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-user kms-bx-icons"></i><br/>Klanten</a>
                    </div>
                </div>
            </div>
            <div class="menubar">
                <table class="menubar-table">
                    <tr>
                        <td class="menubar-button">
                            Nieuw
                        </td>
                        <td class="menubar-button">
                            Importeren
                        </td>
                        <td class="menubar-button">
                            Exporteren
                        </td>
                        <td class="menubar-button">
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
                <div class="row justify-center">
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-5 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-subtitle" style="font-weight:normal;">Uitvoeringen
                            <div class="kms-btn-rnd-dark" id="btn-add-type" :alt="model.id" :title="brand.id" style="right:-20px;"><table style="height: 100%; width: 100%; position: relative;"><tr><td style="width: 100%; height: 100%; text-align: center; vertical-align: middle; padding-top: 7px;"><i class="bx bx-plus"></i></td></tr></table></div>
                        </h3>
                        <hr>
                        <div class="type mb-2" v-for="typecar in types" :id="'type'+typecar.id">
                            <h5 style="    color: rgb(255, 255, 255);
                            background: #212529;
                            padding: 10px;
                            font-size: 20px;
                            font-family: GoodTimes, sans-serif;
                            border-bottom-style: solid;
                            border-bottom-color: #d31c1c;
                            border-bottom-width: 2px;">
                            <input type="text" style="border:none; background:transparent;" @keydown="updateTypeName($event)" @keyup="updateTypeName($event)" @change="updateTypeName($event)" :id="typecar.id" :value="typecar.type">
                            <a href="#" class="text-danger float-right btndeltype" :id="typecar.id"><i class="bx bx-trash"></i></a>
                            <a href="#" class="text-warning float-right btnaddvariant" :id="typecar.id" style="margin-right:10px;"><i class="bx bx-plus-circle"></i></a>
                            </h5>
                            <table class="table table-dark table-hover">
                                <tbody>
                                    <tr v-for="variant in typecar.variants" :id="'variant'+variant.id">
                                        <td>
                                            <input type="text" style="border:none; background:transparent;" @keydown="updateVariantName($event)" @keyup="updateVariantName($event)" @change="updateVariantName($event)" :id="variant.id" :value="variant.variant">
                                        </td>
                                        <td>v.a. <input type="number" min="1900" max="2099" step="1" @keydown="updateBuild($event)" @keyup="updateBuild($event)" @change="updateBuild($event)" :id="variant.id" style="border:none; background:transparent; width:100px;" :value="variant.build" >
                                        </td>
                                        <td><a href="#" class="text-danger btndeltypevariant" :id="variant.id"><i class="bx bx-trash"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-4 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-subtitle" style="font-weight:normal;">Reparaties
                            <div class="kms-btn-rnd-dark" id="btn-link-model-revision" :alt="model.id" style="right:-20px;"><table style="height: 100%; width: 100%; position: relative;"><tr><td style="width: 100%; height: 100%; text-align: center; vertical-align: middle; padding-top: 7px;"><i class="bx bx-plus"></i></td></tr></table></div>
                        </h3>
                        <hr>
                        <table class="table table-dark table-hover">
                            <tbody>
                                <tr v-for="revisionmodals in revisions" :class="'chbrevision_'+revisionmodals.revision_id+'model_'+revisionmodals.id">
                                    <td><input type="checkbox" name="chbrevision_id" class="chbmodelrevisions" :value="revisionmodals.id" :alt="revisionmodals.id"></td>
                                    <td><a :href="'/revision/'+revisionmodals.revision.id">ticket no. {{ revisionmodals.revision.ticket_no }} - {{ revisionmodals.revision.title }}</a></td>
                                    <td><a href="" class="kmi-badge kmi-badge-danger" style="min-width:50px;"><i class="bx bx-link"></i> 1</a></td>
                                </tr>
                            </tbody>    
                            <tfoot>
                                <tr>
                                    <td><a class="text-danger btndelmodelticket" href="#"><i class="bx bx-trash"></i></a></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>

                        
                    </div>
                </div>
            </div>
        </section>

    </AuthenticatedLayout>
</template>
