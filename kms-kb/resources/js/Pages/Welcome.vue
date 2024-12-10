<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}


setTimeout(() => {
    window.location.replace('./register');
}, "5600");
</script>

<template>
    <div class="header">
        <video muted autoplay loop id="bgVid">
            <source src="/video/logo_cergos_reveal.mp4" type="video/mp4">
        </video>
    </div>
</template>
