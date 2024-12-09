<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <section class="header bg-white" style="height: 100px;">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                <div class="flex flex-row">
                <div class="mx-auto w-3/12 sm:w-12/12 lg:w-3/12 mt-3" style="text-align: center; text-transform: uppercase; font-weight: bold; font-family: 'Racing Sans One', sans-serif;"><i class="fi fi-rr-tachometer-fastest" style="font-size: 36px;"></i><Br/> API Tracker</div>
                </div>
            </h2>
        </section>


        <div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg" style="border-top-right-radius: 0px !important; border-top-left-radius: 0px !important;">
                    <div class="p-6 text-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
