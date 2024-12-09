<script setup>
import { defineProps, reactive } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    manuals: Array,
})


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
                        <a href="/rkb" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-cog kms-bx-icons kms-bx-icons-active"></i><br/>Reparaties</a>
                        <a href="/rkb/manuals" class="col-lg-3 text-center kms-icon-buttons kms-icon-btn-active"><i class="bx bx-file kms-bx-icons"></i><br/>Handleidingen</a>
                        <a href="/rkb/parts" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-chip kms-bx-icons"></i><br/>Onderdelen</a>
                        <a href="/rkb/customers/1" class="col-lg-2 text-center kms-icon-buttons"><i class="bx bx-user kms-bx-icons"></i><br/>Klanten</a>
                    </div>
                </div>
            </div>
            <div class="menubar">
                <table class="menubar-table">
                    <tr>
                        <td class="menubar-button btn-new-manual">
                            Nieuw
                        </td>
                        <td class="menubar-button btn-import-manual">
                            Importeren
                        </td>
                        <td class="menubar-button btn-export-manual">
                            Exporteren
                        </td>
                        <td class="menubar-button btn-del-manual">
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
                <div class="row justify-center manuals">
                    <div v-for="manual in manuals" style="position:relative;" class="kms-body-column col-md-6 col-sm-12 col-lg-3 bg-gray-800 text-white kms-column-border text-center">
                        <div class="kms-manual-header"><input type="checkbox" class="chbmanuals" :value="manual.id" style="border-radius: 50% !important; box-shadow: inset 1px 1px 1px;"></div>
                        <a href="#" class="btnloadmanual" :id="manual.id">
                            <hr>
                                <h3 class="kms-column-subtitle" style="font-weight: normal; font-size: 16px;">{{ manual.title }}</h3>
                            <hr>
                            <i class='bx bxs-file text-danger' style="font-size:72px;"></i><br/>
                            Handleiding
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>



