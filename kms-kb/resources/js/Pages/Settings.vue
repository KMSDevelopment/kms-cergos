<script setup>
import { defineProps, computed, reactive } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    apis: Array,
});

async function updateState(e) {
  try {
    var check = e.target.checked;
    if(check == true){ check = 1; }else{ check = 0; }
    var value = e.target.value;
    const response = await axios.post('/api/update-state', {
        check: check,
        id: value,
    });
    console.log("API activated");
  } catch (error) {
    console.error('Error activating API');
  }
}

async function updateInputEndpoint(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/api/update-endpoint', {
        value: value,
        id: id,
    });
    console.log("Endpoint updated");
  } catch (error) {
    console.error('Error updating endpoint');
  }
}


async function updateInputApiKey(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/api/update-credentials', {
        value: value,
        id: id,
    });
    console.log("Credentials updated");
  } catch (error) {
    console.error('Error updating credentials');
  }
}

async function decreaseSort(e) {
  try {
    var id = e.target.id;
    const response = await axios.post('/api/decrease-sort', {
        id: id
    });
    console.log(response);
    location.reload();
  } catch (error) {
    console.error('Error sorting');
    // location.reload();
  }
}

async function increaseSort(e) {
  try {
    var id = e.target.id;
    const response = await axios.post('/api/increase-sort', {
        id: id,
    });
    console.log(response);
    location.reload();
  } catch (error) {
    console.error('Error sorting');
    location.reload();
  }
}



</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <section class="header bg-white" style="height: 100px;">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                <div class="flex flex-row">
                <div class="mx-auto w-3/12 sm:w-12/12 lg:w-3/12 mt-3" style="text-align: center; text-transform: uppercase; font-weight: bold; font-family: 'Racing Sans One', sans-serif;"><i class="bx bx-cog" style="font-size: 36px;"></i><Br/>Configuratie</div>
                </div>
            </h2>
        </section>

        <section class="body">
            <div class="container">
                <div class="row">
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-12 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-title">
                            DATA TRANSFERS
                            <div class="kms-btn-rnd" id="btn-api-execute"><table style="height:100%; width:100%; position: relative;"><tr><td style="width:100%; height:100%; text-align:center; vertical-align: middle; padding-top: 7px;"><i class="bx bx-play"></i></td></tr></table></div>

                            <div class="kms-btn-rnd-dark" id="btn-api-automate"><table style="height:100%; width:100%; position: relative;"><tr><td style="width:100%; height:100%; text-align:center; vertical-align: middle; padding-top: 7px;"><i class="lni lni-android"></i></td></tr></table></div>

                            <div class="kms-btn-rnd-dark" id="btn-api"><table style="height:100%; width:100%; position: relative;"><tr><td style="width:100%; height:100%; text-align:center; vertical-align: middle; padding-top: 7px;"><i class="bx bx-plus"></i></td></tr></table></div>
                        </h3>
                        <hr>
                        <div class="row justify-center">
                            <div class="col-sm-12 col-md-12 col-lg-12" style="padding-left: 0px;">
                                <div class="table-responsive">
                                <table class="table table-dark table-hover table-striped">
                                    <thead>
                                        <th></th>
                                        <th></th>
                                        <th>Platform <i class='bx bx-caret-right' style="background:transparent; border:none;"></i> beschrijving</th>
                                        <th>Endpoint | Host</th>
                                        <th>API Key | DB Credentails</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="api in apis" class="sortable">
                                            <td class="py-3">
                                                <!-- Rounded switch -->
                                                <label class="switch">
                                                    <input type="checkbox" @click="updateState($event)" :value="api.id" :checked="api.active == 1 ? true: false">
                                                    <span class="slider round"></span>
                                                </label>

                                                <a class="btn btn-sm btn-warning btn-edit-api" :id="api.id" style="border-radius:50%; margin-top:8px; margin-left:5px;"><i class="bx bx-edit"></i></a>
                                                <a class="btn btn-sm btn-dark btn-del-api" :id="api.id" style="border-radius:50%; margin-top:8px; margin-left:5px;"><i class="bx bx-trash"></i></a>
                                            </td>
                                            <td class="py-3">
                                                <a :href="api.api_point_route+'?api_id='+api.id+'&endpoint='+api.endpoint" target="_BLANK"><span class="badge"><i class='bx bx-transfer'></i> {{api.type}}</span></a>
                                            </td>
                                            <td class="py-3">
                                                <a :href="api.docs" target="_BLANK"><i class="bx bx-file-blank kms-icons-sm-lbl"></i> {{ api.platform }} | {{ api.desc }}</a>
                                            </td>
                                            <td class="py-3">
                                                <input type="text" :value="api.endpoint" @keydown="updateInputEndpoint($event)" :id="api.id" class="form form-control kms-txt-input" style="border:none; background:none; margin:0px; color:#999 !important; margin-left:-15px">
                                            </td>
                                            <td class="py-3">
                                                <input type="text" :value="api.credentials" @keydown="updateInputApiKey($event)" :id="api.id" class="form form-control kms-txt-input" style="border:none; background:none; margin:0px; color:#999 !important; margin-left:-15px">
                                            </td>
                                            <td class="py-3">
                                                <a href="#" class="sort-up" @click="decreaseSort($event)" :id="api.id" title="Eerder uitvoeren"><i class='bx bx-caret-up-square' :id="api.id" style="font-size:25px;"></i></a><Br/>
                                                <a href="#" class="sort-down" @click="increaseSort($event)" :id="api.id" title="Later uitvoeren"><i class='bx bx-caret-down-square' :id="api.id" style="font-size:25px;"></i></a>
                                            </td>
                                        </tr>




                                        <!-- <tr>
                                            <td class="py-3">
                                                <a href="https://docs.strapi.io/dev-docs/api/rest#endpoints" target="_BLANK"><i class="bx bx-file-blank kms-icons-sm-lbl"></i> Strapi CMS</a>
                                            </td>
                                            <td class="py-3">
                                                
                                                <input type="text" value="GET http://localhost:1337/api/restaurants" class="form form-control kms-txt-input" style="border:none; background:none; margin:0px; color:#999 !important; margin-left:-15px">
                                            </td>
                                            <td class="py-3">
                                                <input type="text" value="https://api.mygadgetrepairs.com/v1" class="form form-control kms-txt-input" style="border:none; background:none; margin:0px; color:#999 !important; margin-left:-15px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-3">
                                                <a href="https://vps48540.webbers.com/phpMyAdmin/" target="_BLANK"><i class="bx bx-file-blank kms-icons-sm-lbl"></i> KMS DA</a>
                                            </td>
                                            <td class="py-3">
                                                <input type="text" value="https://vps48540.webbers.com/phpMyAdmin/" class="form form-control kms-txt-input" style="border:none; background:none; margin:0px; color:#999 !important; margin-left:-15px">
                                            </td>
                                            <td class="py-3">
                                                <input type="text" value="un: cakms_KMS | pass: GPCpxUh4TQbA2CLwu83h" class="form form-control kms-txt-input" style="border:none; background:none; margin:0px; color:#999 !important; margin-left:-15px">
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>


