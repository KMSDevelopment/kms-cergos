<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" style="z-index: 99999; position: relative;">
            <div>
                <InputLabel for="email" value="E-mailadres" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full kms-txt-input"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="jij@kms-apeldoorn.nl"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Wachtwoord" />

                <TextInput
                    id="password"
                    
                    type="password"
                    class="mt-1 block w-full kms-txt-input"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 block">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-white-600"
                        >Remember me</span
                    >
                </label>
            </div>

            <div class="mt-4 flex items-center justify-center text-center">

                <PrimaryButton
                    class="w-full text-center kms-primary-btn"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="float:right;"> <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" /> </svg>Inloggen voor werknemers
                </PrimaryButton>
            </div>
            <div class="mt-4 flex items-center justify-center text-center">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="rounded-md text-sm text-white-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Ben je je wachtwoord vergeten?
                </Link>

            </div>
        </form>
    </GuestLayout>
</template>
