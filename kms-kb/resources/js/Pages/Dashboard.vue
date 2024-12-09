<script setup>
import { defineProps, reactive } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    users: Array,
    tickets: Array
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <section class="header bg-white" style="height: 100px;">
            <div class="container">
                <div class="row">
                    <div class="kms-breadcrumb-column col-md-6 col-sm-12 col-lg-4">
                        <h2 class="kms-h2 text-xl font-semibold leading-tight text-gray-800">Werknemersportaal</h2>
                    </div>
                    <div class="kms-breadcrumb-column col-md-6 col-sm-12 col-lg-7">
                        <input type="text" class="form form-control kms-txt-input-light mt-6 text-left" placeholder="Type wat u wilt zoeken en klik op enter..">
                    </div>
                </div>
            </div>
        </section>

        <section class="body">
            <div class="container justify-center">
                <div class="row">
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-5 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-title">Links</h3>
                        <hr>
                        <ul class="pt-3">
                            <li class="kms-list-link"><a href="https://kms-apeldoorn.nl" target="_BLANK" id="docs-card" style="width:100%"> Bezoek onze website <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="float:right;"> <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" /> </svg></a></li>
                            <li class="kms-list-link"><a href="https://www.mygadgetrepairs.com/admin/login.cfm" target="_BLANK" id="docs-card" style="width:100%"> Login op My Gadget Repairs  <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="float:right;"> <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" /> </svg></a></li>
                            <li class="kms-list-link"><a href="https://www.odoo.com/nl_NL/web/login" target="_BLANK" id="docs-card" style="width:100%"> Login op Odoo <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="float:right;"> <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" /> </svg></a></li>
                            <li class="kms-list-link"><a href="https://cms.kms-apeldoorn.webbers.dev/admin/auth/register?registrationToken=161cbf95fd67f4d322e73c75c52b1843a4ffdc50" target="_BLANK" id="docs-card" style="width:100%"> Login op de website CMS  <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="float:right;"> <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" /> </svg></a></li>
                        </ul>
                    </div>
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-6 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-subtitle">Mijn Tickets</h3>
                        <hr>
                        <div class="row" style="max-height:300px; overflow-y:scroll; overflow-x:hidden;">
                            <div class="kms-body-column col-lg-3 col-md-6 col-sm-12 text-white kms-column-border text-center" v-for="ticket in tickets"> 
                                <h3 class="kms-column-subtitle" style="font-size:18px; font-weight:normal; text-align:center;">{{ ticket.ticket_no }}</h3>
                                <span class="alert alert-danger" title="Ingeladen van ODOO" style="font-size: 10px; position: absolute; padding: 5px; background: rgb(25, 31, 41); color: rgb(255, 255, 255); top: -5px; right: 45%; box-shadow: rgb(217, 23, 23) 0px 1px 4px;">{{ ticket.status }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-5 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-title">Collega's</h3>
                        <hr>
                        <ul class="pt-3">
                            <li class="kms-list-link" v-for="user in users"><a href="https://kms-apeldoorn.nl" target="_BLANK" id="docs-card" style="width:100%"> {{ user.name }} <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="float:right;"> <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" /> </svg></a></li>
                        </ul>
                    </div>
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-6 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-subtitle">Chat</h3>
                        <hr>
                    </div>
                </div>

            </div>
        </section>

    </AuthenticatedLayout>
</template>
