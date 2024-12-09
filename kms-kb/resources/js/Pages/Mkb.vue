<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <section class="header bg-white" style="height: 100px;">
            <div class="container">
                <div class="row">
                    <div class="kms-breadcrumb-column col-md-6 col-sm-12 col-lg-4">
                        <h2 class="kms-h2 text-xl font-semibold leading-tight text-gray-800" style="text-align:right;">Marketing Kennisbank</h2>
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


        <section class="body">
            <div class="container">
                <div class="row justify-center">
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-7 bg-gray-800 text-white kms-column-border">
                        <h3 class="kms-column-title">Huisstijl Handboek</h3>
                        <hr>
                        <em class="kms-cursive-desc">Het huisstijl handboek is gemaakt om een overzicht te creeëren en realiseert de mogelijkheid efficienter het huisstijl van KMS toe te passen op verschillende type uitingen waarmee intern en extern gecommuniceerd kan worden.</em>
                        <div class="row">
                            <div class="kms-body-column col-md-12 col-sm-12 col-lg-12 bg-gray-800 text-white">
                                <h3 class="kms-column-subtitle"><i class='bx bx-label kms-icons-sm-lbl'></i> Het logo</h3>
                                <hr>
                                <div class="row justify-center">
                                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-3 bg-gray-800 text-white kms-column-border" style="padding:5px;">
                                        <img src="/images/logo/logo_white.png" style="width:100%;">
                                    </div>
                                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-3 bg-white text-white kms-column-border" style="padding:5px;">
                                        <img src="/images/logo/logo_zwart.png" style="width:100%;">
                                    </div>
                                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-3 bg-gray-800 text-white kms-column-border" style="padding:5px;">
                                        <svg class="w-[100%] h-[auto] lg:w-[100%] lg:h-[auto] text-brand-primary pt-3" viewBox="0 0 250 33.77" xmlns="http://www.w3.org/2000/svg"><g><path fill="currentColor" d="m103.25 4.64-12.61 0.06-20.44 8.9 6.92-8.61-8.43 0.05-17.48 22.65h8.1l7.15-9.41 10.62 9.41h13.03l-14.21-10.39 27.35-12.66z"></path><path fill="currentColor" d="m140.06 4.74-5.53 0.02-8.4 14.65-7.97-14.77-4.96 0.03-18.44 23.02h8.51l12.26-15.45 8.5 15.45h5.47l8.28-15.35 11.73 15.35h7.9l-17.23-22.79-0.12-0.16z"></path><path fill="currentColor" d="M197.59 22.03l-5.24-5.77c-3.22-3.54-9.22-3.14-9.44-3.12l-19.41.1-2.95-3.25 18.45-.1.85.93h7.59l-.27-.65c-2.27-5.53-10.06-5.51-10.38-5.5l-19.53.1c-2.88 0-4.51.64-5 1.89-.55 1.47.84 3.09.89 3.14l4.18 5.23c3.41 3.75 9 3.24 9.25 3.22l20.13-.1 3 4.08-19.95.1-1.33-1.44H161l.44.72a12.88 12.88 0 0010.86 6.09h21c3.16 0 4.92-1 5.39-2.29.56-1.57-1.06-3.3-1.12-3.37M223 18.89l-11.8 14.89.39-.06c12-1.41 29.41-6.83 38.41-15.09zM223 14.89L211.2 0l.39.06c12 1.41 29.41 6.88 38.41 15.09zM27 18.89l11.8 14.89-.39-.06C26.41 32.31 9.05 26.89 0 18.63zM27 14.89L38.8 0l-.39.06C26.41 1.47 9.05 6.94 0 15.15z"></path></g></svg>
                                    </div>
                                    <div class="kms-body-column col-md-12 col-sm-12 col-lg-9 bg-gray-800 text-white kms-column-border" style="padding:5px;">
                                        <img src="/images/logo/logo.svg " style="width:100%;">
                                    </div>
                                    <div class="kms-body-column col-md-12 col-sm-12 col-lg-9 bg-gray-800 text-white kms-column-border" style="padding:5px;">
                                        <svg class="w-[100%] h-[auto] lg:w-[100%] lg:h-[auto] text-brand-primary" viewBox="0 0 250 33.77" xmlns="http://www.w3.org/2000/svg"><g><path fill="currentColor" d="m103.25 4.64-12.61 0.06-20.44 8.9 6.92-8.61-8.43 0.05-17.48 22.65h8.1l7.15-9.41 10.62 9.41h13.03l-14.21-10.39 27.35-12.66z"></path><path fill="currentColor" d="m140.06 4.74-5.53 0.02-8.4 14.65-7.97-14.77-4.96 0.03-18.44 23.02h8.51l12.26-15.45 8.5 15.45h5.47l8.28-15.35 11.73 15.35h7.9l-17.23-22.79-0.12-0.16z"></path><path fill="currentColor" d="M197.59 22.03l-5.24-5.77c-3.22-3.54-9.22-3.14-9.44-3.12l-19.41.1-2.95-3.25 18.45-.1.85.93h7.59l-.27-.65c-2.27-5.53-10.06-5.51-10.38-5.5l-19.53.1c-2.88 0-4.51.64-5 1.89-.55 1.47.84 3.09.89 3.14l4.18 5.23c3.41 3.75 9 3.24 9.25 3.22l20.13-.1 3 4.08-19.95.1-1.33-1.44H161l.44.72a12.88 12.88 0 0010.86 6.09h21c3.16 0 4.92-1 5.39-2.29.56-1.57-1.06-3.3-1.12-3.37M223 18.89l-11.8 14.89.39-.06c12-1.41 29.41-6.83 38.41-15.09zM223 14.89L211.2 0l.39.06c12 1.41 29.41 6.88 38.41 15.09zM27 18.89l11.8 14.89-.39-.06C26.41 32.31 9.05 26.89 0 18.63zM27 14.89L38.8 0l-.39.06C26.41 1.47 9.05 6.94 0 15.15z"></path></g></svg>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="kms-body-column col-md-12 col-sm-12 col-lg-12 bg-gray-800 text-white kms-column-border">
                                <h3 class="kms-column-subtitle"><i class='bx bx-label kms-icons-sm-lbl'></i> Lettertypen</h3>
                                <hr>
                                <ul class="pt-3">

                                    <li class="kms-list-link"> 
                                        <a  href="/fonts/Racing_Sans_One.zip" download id="docs-card" style="font-family: 'Racing Sans One', sans-serif; font-size:18px; text-transform: uppercase;">Racing Sans One <i class='bx bx-download kms-icons-sm'></i> <br/>
                                            <em class="kms-cursive-desc">Config: 28px groot, hoofdletters, gebruik voor breadcrumb titles</em></a>
                                    </li>

                                    <li class="kms-list-link"><a href="/fonts/Funnel_Sans.zip" download id="docs-card" style="font-family: 'Funnel Sans', sans-serif; font-size:18px;">Funnel Sans <i class='bx bx-download kms-icons-sm'></i></a><br/>
                                        <em class="kms-cursive-desc">Config: 15px groot, schuin gedrukt / normaal, gebruik voor element beschrijvingen of paragrafen</em></li>


                                    <li class="kms-list-link"><a href="/fonts/pro-racing.zip" download id="docs-card" style="width:100%; font-family: 'ProRacing', sans-serif;"> ProRacing <i class='bx bx-download kms-icons-sm'></i></a><br/>
                                        <em class="kms-cursive-desc">Config: 28px groot, gebruik voor kolom titels</em></li>

                                    <li class="kms-list-link"><a href="/fonts/good-times.zip" download id="docs-card" style="width:100%; font-family: 'GoodTimes', sans-serif;"> Good Times<i class='bx bx-download kms-icons-sm'></i></a><br/>
                                        <em class="kms-cursive-desc">Config: 19px groot, hoofdletters, gebruik voor kolom paragraaf titels</em></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="kms-body-column col-md-6 col-sm-12 col-lg-4 bg-gray-800 text-white">
                        <h3 class="kms-column-title">Kleuren</h3>
                        <hr>
                        <table class="table table-dark table-striped">
                            <thead>
                                <th>Benaming</th>
                                <th>Rood (Gradient)</th>
                            </thead>
                            <thead>
                                <th>Gebruik</th>
                                <th>Achtergronden</th>
                            </thead>
                            <thead>
                                <th>Hex Codes</th>
                                <th>90deg, #ed1b24 0, #b71006</th>
                            </thead>
                            <thead>
                                <th>CSS Code</th>
                                <th style="font-size:11px;">background-image: linear-gradient(90deg, #ed1b24 0, #b71006);</th>
                            </thead>
                            <thead>
                                <th>Voorbeeld</th>
                                <th><div style="height:30px; width:100px; background-image: linear-gradient(90deg, #ed1b24 0, #b71006);"></div></th>
                            </thead>
                        </table>

                        <hr>
                        <table class="table table-dark table-striped">
                            <thead>
                                <th>Benaming</th>
                                <th>Rood (donker)</th>
                            </thead>
                            <thead>
                                <th>Gebruik</th>
                                <th>Titels / achtergronden</th>
                            </thead>
                            <thead>
                                <th>Hex Codes</th>
                                <th>#b71006</th>
                            </thead>
                            <thead>
                                <th>Voorbeeld</th>
                                <th><div style="height:30px; width:100px; background-color: #b71006;"></div></th>
                            </thead>
                        </table>
                        <hr>
                        <table class="table table-dark table-striped">
                            <thead>
                                <th>Benaming</th>
                                <th>Rood (light)</th>
                            </thead>
                            <thead>
                                <th>Gebruik</th>
                                <th>Titels / achtergronden</th>
                            </thead>
                            <thead>
                                <th>Hex Codes</th>
                                <th>#ed1b24</th>
                            </thead>
                            <thead>
                                <th>Voorbeeld</th>
                                <th><div style="height:30px; width:100px; background-color: #ed1b24;"></div></th>
                            </thead>
                        </table>
                        <hr>
                        <table class="table table-dark table-striped">
                            <thead>
                                <th>Benaming</th>
                                <th>Blauwgrijs (donker)</th>
                            </thead>
                            <thead>
                                <th>Gebruik</th>
                                <th>Achtergronden</th>
                            </thead>
                            <thead>
                                <th>Hex Codes</th>
                                <th>#1f2937</th>
                            </thead>
                            <thead>
                                <th>Voorbeeld</th>
                                <th><div style="height:30px; width:100px; background-color: #1f2937; box-shadow: 1px 1px 8px #FFF;"></div></th>
                            </thead>
                        </table>
                        <hr>

                        <hr>
                        <table class="table table-dark table-striped">
                            <thead>
                                <th>Benaming</th>
                                <th>Blauwgrijs (light)</th>
                            </thead>
                            <thead>
                                <th>Gebruik</th>
                                <th>Randen</th>
                            </thead>
                            <thead>
                                <th>Hex Codes</th>
                                <th>#2b3647</th>
                            </thead>
                            <thead>
                                <th>Voorbeeld</th>
                                <th><div style="height:30px; width:100px; background-color: #2b3647; box-shadow: 1px 1px 8px #FFF;"></div></th>
                            </thead>
                        </table>
                        <hr>

                        <table class="table table-dark table-striped">
                            <thead>
                                <th>Benaming</th>
                                <th>Blauwgrijs (light)</th>
                            </thead>
                            <thead>
                                <th>Gebruik</th>
                                <th>Blok en Kolom Titles</th>
                            </thead>
                            <thead>
                                <th>Hex Codes</th>
                                <th>#535b6b</th>
                            </thead>
                            <thead>
                                <th>Voorbeeld</th>
                                <th><div style="height:30px; width:100px; background-color: #535b6b; box-shadow: 1px 1px 8px #FFF;"></div></th>
                            </thead>
                        </table>
                        <hr>

                        <table class="table table-dark table-striped">
                            <thead>
                                <th>Benaming</th>
                                <th>Wit (light)</th>
                            </thead>
                            <thead>
                                <th>Gebruik</th>
                                <th>Titels</th>
                            </thead>
                            <thead>
                                <th>Hex Codes</th>
                                <th>#FFFFFF</th>
                            </thead>
                            <thead>
                                <th>Voorbeeld</th>
                                <th><div style="height:30px; width:100px; background-color: #FFF; box-shadow: 1px 1px 8px #FFF;"></div></th>
                            </thead>
                        </table>
                        <hr>
                        <table class="table table-dark table-striped">
                            <thead>
                                <th>Benaming</th>
                                <th>Grijs (light)</th>
                            </thead>
                            <thead>
                                <th>Gebruik</th>
                                <th>paragrafen / subtitels</th>
                            </thead>
                            <thead>
                                <th>Hex Codes</th>
                                <th>#c3c3c3</th>
                            </thead>
                            <thead>
                                <th>Voorbeeld</th>
                                <th><div style="height:30px; width:100px; background-color: #c3c3c3; box-shadow: 1px 1px 8px #FFF;"></div></th>
                            </thead>
                        </table>
                    </div>
                </div>


                <div class="row">
                    <div class="kms-body-column col-sm-12 col-md-12 col-lg-12 bg-gray-800 text-white">
                        <h3 class="kms-column-title">Communicatie kanalen</h3>
                        <hr>
                        <div class="row justify-center">
                            <div class="kms-body-column col-sm-12 col-md-6 col-lg-3 bg-gray-800 text-white kms-column-border">
                                <a href="https://www.google.com/search?sca_esv=a8e43bc9143f75b8&sxsrf=ADLYWIL6geKGATrYk_5GgKm9xbYVarDrgA:1732184213065&q=kms+apeldoorn&si=ACC90nzcy7sviKw0NTZoUBUzhQehr3jouizIrVSf6avWI23m1Zv4MKaaft66yVbJvRV88yq93K5UNt2rPPaY6utDqROYIXCrTPYKiWV9r3LnrCi-NROYZ7U%3D&uds=ADvngMio_X9PYu6QBHgDWm5hmfgFIEnlP3EbpX7uyYS_RwF19HsuByWMjUqUBk_uCaOmf32O36XnEwcOf3lQKLvQrhMViilenFTbSGNpO4u7QlUPpvQNdCo&sa=X&ved=2ahUKEwjP6NGFme2JAxVWA9sEHVRyGK8Q3PALegQIHBAE&biw=1912&bih=964&dpr=1" target="_BLANK">
                                    <img src="/images/extern/Google-Review-Logo.png" style="width:100%">
                                </a>
                            </div>
                            <div class="kms-body-column col-sm-12 col-md-6 col-lg-2 bg-gray-800 text-white kms-column-border">
                                <a href="https://www.trustprofile.com/nl/webshop/Kms-apeldoorn_4055625" target="_BLANK">
                                    <img src="/images/extern/trustprofile_logo.png" style="width:100%; margin-top:45%;">
                                </a>

                            </div>
                            <div class="kms-body-column col-sm-12 col-md-6 col-lg-2 bg-gray-800 text-white kms-column-border">
                                <a href="https://www.marktplaats.nl/u/kms-apeldoorn/9959779/" target="_BLANK">
                                    <img src="/images/extern/logo-marktplaats.png" style="width:100%">
                                </a>

                            </div>
                            <div class="kms-body-column col-sm-12 col-md-6 col-lg-3 bg-gray-800 text-white kms-column-border">
                                <a href="https://nl.linkedin.com/in/kms-apeldoorn-803433176" target="_BLANK">
                                    <img src="/images/extern/linkedin.png" style="width:100%">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </AuthenticatedLayout>
</template>
