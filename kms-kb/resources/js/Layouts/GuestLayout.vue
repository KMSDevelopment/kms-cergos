<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex min-h-screen flex-col items-center bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 pt-6 sm:justify-center sm:pt-0" style="background:#000;">
        <div>
            <Link href="/">
                <img src="/images/logo/logo_cockpit.png" style="width:285px;">
            </Link>
        </div>

        <div class="mt-6 w-full overflow-hidden bg-dark text-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
            <slot />
        </div>
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" style="z-index: 0;"/>
    </div>
</template>
