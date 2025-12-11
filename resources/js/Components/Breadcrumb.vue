<template>
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">{{ title }}</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <Link :href="route('dashboard')" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </Link>
            </li>
            <li>-</li>

            <template v-for="(breadcrumb, index) in breadcrumbs" :key="index">
                <li class="fw-medium">
                    <template v-if="breadcrumb.link">
                        <Link :href="route(breadcrumb.link)" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon v-if="breadcrumb.icon" :icon="breadcrumb.icon"
                                class="icon text-lg"></iconify-icon>
                            {{ breadcrumb.name }}
                        </Link>
                    </template>
                    <template v-else>
                        {{ breadcrumb.name }}
                    </template>
                </li>
                <li v-if="index !== breadcrumbs.length - 1">-</li>
            </template>

        </ul>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    title: {
        type: String,
        required: true
    },
    breadcrumbs: {
        type: Array,
        default: () => []
    }
})
</script>
