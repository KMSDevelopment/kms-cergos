<script setup>
import { defineProps, reactive } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps({
    exports: Array
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <section class="header bg-white" style="height: 100px;">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                <div class="flex flex-row">
                <div class="mx-auto w-3/12 sm:w-12/12 lg:w-3/12 mt-3" style="text-align: center; text-transform: uppercase; font-weight: bold; font-family: 'Racing Sans One', sans-serif;"><i class="bx bx-station" style="font-size: 36px;"></i><Br/>  Activity Tracker</div>
                </div>
            </h2>
        </section>

        <div class="container">
            <div class="row justify-center">
                <div class="kms-body-column col-md-12 col-sm-12 col-lg-4 bg-gray-800 text-white kms-column-border">
                    <h3 class="kms-column-subtitle" style="font-weight:normal;"><input type="checkbox" class="chbrevisions kms-checkboxes"> Exports</h3>
                    <hr>
                    <table class="table table-dark table-hover">
                        <tbody>
                            <tr v-for="expor in exports">
                                <td>
                                    <input type="checkbox" class="chbrevisions kms-checkboxes">
                                </td>
                                <td>{{ expor.file_name }}</td>
                                <td><a :href="expor.file_link" download class="btn btn-danger" title="Downloaden"><i class="bx bx-download"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="kms-body-column col-md-12 col-sm-12 col-lg-6 bg-gray-800 text-white kms-column-border">
                    <h3 class="kms-column-subtitle" style="font-weight:normal;">Gebruikersactiviteit</h3>
                    <hr>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
