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
                    <form action="/register/new" method="POST" id="register" class="input-group registerform">
                        <input type="hidden" name="_token" class="csrf_token">
                        <TextInput type="text" name="name" class="input-field " placeholder="Uw voor -en achternaam" style="color:#000 !important" required></TextInput>
                        <TextInput type="email" name="email" class="input-field " placeholder="E-mailadres" style="color:#000 !important"  required></TextInput>
                        <TextInput id="pwd" type="Password" class="input-field " placeholder="Wachtwoord" style="color:#000 !important" required></TextInput>
                        <TextInput id="pwd" name="password" type="Password" class="input-field " style="color:#000 !important" placeholder="Bevestig uw wachtwoord" required></TextInput>
                        <PrimaryButton type="button" class="submit-btn justify-center text-center inp_regis" style="margin-top:10px; padding-top: 0px;;" :class="{ 'opacity-25': form.processing }"  >
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
