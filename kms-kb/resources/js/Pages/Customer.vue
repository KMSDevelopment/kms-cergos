<script setup>
import { defineProps, reactive } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    customer: Array,
    companies: Array,
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







async function updateGender(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/gender/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}

async function updateMiddlename(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/middlename/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}

async function updateBirthdate(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/birthdate/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}


async function updateHousenr(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/housenr/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}

async function updateCountry(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/country/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}





async function updateReference(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/reference/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}

async function updateMgrid(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/mgrid/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}

async function UpdateOdooid(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/odooid/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}

async function updateEmail(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/email/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}

async function updatePhonenr(e) {
  try {
    var id = e.target.id;
    var value = e.target.value;
    const response = await axios.post('/customer/phonenr/edit', {
        value: value,
        id: id,
    });
  } catch (error) {
    console.error('Error updating customer');
  }
}
</script>

<template>

    <div class="modal fade mdl-customer-business-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog kms-modal" role="document">
            <div class="modal-content" style="overflow:hidden;">
                <div class="modal-header kms-modal-header kms-column-subtitle">
                    <h5 class="modal-title" id="exampleModalLabel"> Bedrijfsinformatie</h5>
                    <button type="button" class="close closemdl closereload" data-dismiss="modal" aria-label="Close" style="font-size: 32px; position: absolute; right: 11px; top: 0px;">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body kms-modal-body" style="max-height: 400px; overflow-y:scroll; overflow-x:hidden;">
                    <div class="complogo"></div>
                    <table class="table table-dark">
                        <tbody>
                            <tr>
                                <td>Bedrijfsnaam</td>
                                <td class="company_name"></td>
                            </tr>
                            <tr>
                                <td>Belasting nummer</td>
                                <td class="vat"></td>
                            </tr>
                            <tr>
                                <td>E-mailadres</td>
                                <td class="company_email"></td>
                            </tr>
                            <tr>
                                <td>E-mailadres facturatie</td>
                                <td class="company_invoice_email"></td>
                            </tr>
                            <tr>
                                <td>Telefoonnummer</td>
                                <td class="company_phonenr"></td>
                            </tr>
                            <tr>
                                <td>Vestigingsadres</td>
                                <td class="company_address"></td>
                            </tr>
                            <tr>
                                <td>Postcode</td>
                                <td class="company_zipcode"></td>
                            </tr>
                            <tr>
                                <td>vestigingslocatie</td>
                                <td class="company_city"></td>
                            </tr>
                            <tr>
                                <td>Land</td>
                                <td class="company_country"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer kms-modal-footer">
                    <form action="/customer/company/link" method="POST">
                        <div class="row">
                            <input type="hidden" name="_token" class="_token" :value="csrf">
                            <input type="hidden" name="id" :value="customer.id">
                            <div class="col-lg-6">
                                <select class="form from-control" name="companyid" style="margin-top: -2px; border-radius: 15px; color:#333; max-width:225px;" required>
                                    <option selected disabled value="">Maak een keuze..</option>
                                    <option v-for="company in companies" :value="company.id" style="color:#000;">{{ company.company_name }}</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-warning" style="width:100%;"><i class='bx bx-plus' ></i> Aanpassen</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                        <td class="menubar-button btn-new-car">
                            Nieuw
                        </td>
                        <td class="menubar-button btn-import-cars">
                            Importeren
                        </td>
                        <td class="menubar-button btn-export-cars">
                            Exporteren
                        </td>
                        <td class="menubar-button btn-del-cars">
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
                    <div :class="'kms-body-column col-md-12 col-sm-12 col-lg-4 bg-gray-800 text-white kms-column-border car'" style="position:relative; overflow:hidden;">
                        <h3 class="kms-column-subtitle" style="font-size:17px;">
                            <img src="https://st.depositphotos.com/2101611/4338/v/600/depositphotos_43381243-stock-illustration-male-avatar-profile-picture.jpg" style="height:65px; border-radius:50%; float:left; margin-right:15px;"> {{ customer.firstname }} {{ customer.lastname }}
                        </h3>
                        <hr>
                        <br/>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-dark">
                                    <tbody>
                                        <tr>
                                            <td>Voornaam</td>
                                            <td><input type="text" :value="customer.firstname" @keydown="updateFirstname($event)" @keyup="updateFirstname($event)" @change="updateFirstname($event)" :id="customer.id" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                        </tr>
                                        <tr>
                                            <td>Middelnaam </td>
                                            <td><input type="text" :value="customer.middlename" @keydown="updateMiddlename($event)" @keyup="updateMiddlename($event)" @change="updateMiddlename($event)" :id="customer.id" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                        </tr>
                                        <tr>
                                            <td>Achternaam</td>
                                            <td><input type="text" :value="customer.lastname" @keydown="updateLastname($event)" @keyup="updateLastname($event)" @change="updateLastname($event)" :id="customer.id" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                        </tr>
                                        <tr>
                                            <td>Geslacht</td>
                                            <td><input type="text" :value="customer.gender" @keydown="updateGender($event)" @keyup="updateGender($event)" @change="updateGender($event)" :id="customer.id" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                        </tr>
                                        <tr>
                                            <td>Geboortdatum</td>
                                            <td><input type="text" :value="customer.birthdate" @keydown="updateBirthdate($event)" @keyup="updateBirthdate($event)" @change="updateBirthdate($event)" :id="customer.id" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                        </tr>
                                        <tr>
                                            <td><br/></td>
                                            <td><br/></td>
                                        </tr>
                                        <tr>
                                            <td>Bedrijfsnaam</td>
                                            <td><a href="#" :id="customer.id" class="btncheckbusiness" style="cursor:pointer;">Bekijk bedrijfsgegevens</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div :class="'kms-body-column col-md-12 col-sm-12 col-lg-4 bg-gray-800 text-white kms-column-border car'" style="position:relative; overflow:hidden;">
                        <h3 class="kms-column-subtitle" style="font-size:17px;">
                            Adresgegevens
                        </h3>
                        <hr>
                        <br/>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-dark">
                                    <tbody>
                                        <tr>
                                            <td>Straatnaam</td>
                                            <td>Huisnummer</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" :value="customer.address" @keydown="updateAddress($event)" @keyup="updateAddress($event)" @change="updateAddress($event)" :id="customer.id" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                            <td><input type="text" class="form form-control" :value="customer.housenr" @keydown="updateHousenr($event)" @keyup="updateHousenr($event)" @change="updateHousenr($event)" :id="customer.id" style="border:none; background:transparent; color:#FFF;" required></td>
                                        </tr>
                                        <tr>
                                            <td>Postcode</td>
                                            <td>Woonplaats</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" :value="customer.zipcode" @keydown="updateZipcode($event)" @keyup="updateZipcode($event)" @change="updateZipcode($event)" :id="customer.zipcode" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                            <td><input type="text" :value="customer.city" @keydown="updateCity($event)" @keyup="updateCity($event)" @change="updateCity($event)" :id="customer.city" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right;">Land</td>
                                            <td><input type="text" :value="customer.country" @keydown="updateCountry($event)" @keyup="updateCountry($event)" @change="updateCountry($event)" :id="customer.id" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div :class="'kms-body-column col-md-12 col-sm-12 col-lg-3 bg-gray-800 text-white kms-column-border car'" style="position:relative; overflow:hidden;">
                        <h3 class="kms-column-subtitle" style="font-size:17px;">
                            Contactgegevens
                        </h3>
                        <hr>
                        <br/>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-dark">
                                    <tbody>
                                        <tr>
                                            <td>Referentie</td>
                                            <td><input type="text" :value="customer.reference" @keydown="updateReference($event)" @keyup="updateReference($event)" @change="updateReference($event)" :id="customer.id" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                        </tr>
                                        <tr>
                                            <td>MGR ID</td>
                                            <td><input type="text" :value="customer.mgr_id" @keydown="updateMgrid($event)" @keyup="updateMgrid($event)" @change="updateMgrid($event)" :id="customer.id" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                        </tr>
                                        <tr>
                                            <td>ODOO ID</td>
                                            <td><input type="text" :value="customer.odoo_id" @keydown="UpdateOdooid($event)" @keyup="UpdateOdooid($event)" @change="UpdateOdooid($event)" :id="customer.id" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                        </tr>
                                        <tr>
                                            <td>E-mailadres</td>
                                            <td><input type="text" :value="customer.email" @keydown="updateEmail($event)" @keyup="updateEmail($event)" @change="updateEmail($event)" :id="customer.id" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                        </tr>
                                        <tr>
                                            <td>Telefoonnummer</td>
                                            <td><input type="text" :value="customer.phonenr" @keydown="updatePhonenr($event)" @keyup="updatePhonenr($event)" @change="updatePhonenr($event)" :id="customer.id" class="form form-control" style="border:none; background:transparent; color:#FFF;" required></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-lg-4 mt-4">
                                <a class="btn btn-warning"><i class="bx bx-phone"></i> bellen</a>
                            </div>
                            <div class="col-lg-5 mt-4">
                                <a class="btn btn-danger"><i class="bx bx-envelope"></i> E-mailen</a>
                            </div>
                            <div class="col-lg-3 mt-4">
                                <a class="btn btn-success"><i class="fa fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>



