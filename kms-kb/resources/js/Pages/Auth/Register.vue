<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
        <Head title="Register" />

        <div class="hero">
            <div class="bg-vid-wrapper">
                <video muted loop autoplay id="bgVid">
                    <source src="/video/bg-vid.mp4" type="video/mp4">
                </video>
            </div>
            <div class="main-box" style="opacity: 0.9;">
                <div class="form-box">
                    <div id="after"></div>
                    <div class="button-box">
                        <div id="btn"></div>
                        <button id="reg" type="button" class="toggle-btn text-left;" style="text-align:left !important;" onclick="register()">Registreren</button>
                    </div>
                    <form @submit.prevent="submit" id="register" class="input-group">
                        <TextInput type="text" class="input-field" placeholder="Uw voor -en achternaam" v-model="form.name" required>
                        <InputError class="mt-2" :message="form.errors.name" /></TextInput>

                        <TextInput type="email" class="input-field" placeholder="E-mailadres" v-model="form.email" required>
                        <InputError class="mt-2" :message="form.errors.email" /></TextInput>

                        <TextInput id="pwd" type="Password" class="input-field" placeholder="Wachtwoord" required>
                        <InputError class="mt-2" :message="form.errors.password" /></TextInput>

                        <TextInput id="pwd" type="Password" class="input-field" v-model="form.password_confirmation" placeholder="Bevestig uw wachtwoord" required></TextInput>
                        <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                        <Link :href="route('login')" class="rounded-md text-sm text-white-600 underline hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mt-2 mb-2" style="color:#FFF; margin-bottom:0px; !important;">
                           Klik hier om in te loggen
                        </Link>

                        <PrimaryButton class="submit-btn justify-center text-center" style="margin-top:10px; padding-top: 0px;;" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" >
                            Registreren
                        </PrimaryButton>
                    </form>
                </div>
                <span class="sp sp-t"></span>
                <span class="sp sp-r"></span>
                <span class="sp sp-b"></span>
                <span class="sp sp-l"></span>
            </div>
        </div>
</template>
