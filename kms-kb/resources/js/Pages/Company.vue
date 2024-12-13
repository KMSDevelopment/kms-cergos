<script setup>
import { defineProps, reactive } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    company: Array,
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
                    <div :class="'kms-body-column col-md-12 col-sm-12 col-lg-5 bg-gray-800 text-white kms-column-border car'" style="position:relative; overflow:hidden;">
                        <h3 class="kms-column-subtitle" style="font-size:17px;">
                            <img src="https://st.depositphotos.com/2101611/4338/v/600/depositphotos_43381243-stock-illustration-male-avatar-profile-picture.jpg" style="height:65px; border-radius:50%; float:left; margin-right:15px;"> {{ company.company_name }}
                        </h3>
                        <hr>
                        <br/>
                        <div class="row">
                            <div class="col-lg-12 mt-4">
                                <table class="table table-dark">
                                    <tbody>
                                        <tr>
                                            <td>Belasting nummer</td>
                                            <td class="vat">{{ company.vat }}</td>
                                        </tr>
                                        <tr>
                                            <td>E-mailadres</td>
                                            <td class="company_email">{{ company.email }}</td>
                                        </tr>
                                        <tr>
                                            <td>E-mailadres facturatie</td>
                                            <td class="company_invoice_email">{{ company.invoice_email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Telefoonnummer</td>
                                            <td class="company_phonenr">{{ company.invoice_email }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="kms-body-column col-md-12 col-sm-12 col-lg-4 bg-gray-800 text-white kms-column-border car" style="position:relative; overflow:hidden;">
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
                                            <td style="font-weight: bold;">Vestigingsadres</td>
                                            <td style="font-weight: bold;">nummer</td>
                                        </tr>
                                        <tr>
                                            <td class="company_address">{{ company.address }}</td>
                                            <td class="company_address">{{ company.updateHousenr }}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;">Postcode</td>
                                            <td style="font-weight: bold;">vestigingslocatie</td>
                                        </tr>
                                        <tr>
                                            <td class="company_zipcode">{{ company.zipcode	 }}</td>
                                            <td class="company_city">{{ company.city }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td style="font-weight: bold;">Land</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="company_country"><{{ company.country }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="kms-body-column col-md-12 col-sm-12 col-lg-2 bg-gray-800 text-white kms-column-border car" style="position:relative; overflow:hidden;">
                        <div class="col-lg-12 mt-2 mb-4 text-center">
                            <img :src="company.logo" style="margin-left:auto; margin-right:auto;">
                        </div>
                        <div class="col-lg-12 mt-5">
                            <a class="btn btn-warning" :href="'tel:'+company.phonenr"><i class="bx bx-phone"></i> bellen</a>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <a class="btn btn-danger" :href="'mailto:'+company.email"><i class="bx bx-envelope"></i> E-mailen</a>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <a class="btn btn-success"><i class="fa fa-whatsapp"></i> Whatsapp</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>



