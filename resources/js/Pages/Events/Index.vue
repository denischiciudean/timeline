<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import {ref, onMounted} from "vue";
import {Inertia} from '@inertiajs/inertia'

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $page.props.timeline.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-2xl overflow-hidden p-4"> Sub - Timelines</div>


                <div class="verflow-hidden p-4">
                    <div class="inline-block text-2xl">Events</div>
                    <div class="inline-block float-right bg-white shadow px-4 py-2 rounded cursor-pointer">
                        <a :href="route('events.create', $page.props.timeline.id)">
                            add event
                        </a>
                    </div>
                </div>
                <div class="overflow-hidden p-4 flex flex-row justify-around">
                    <div v-for="tl of $page.props.timelines" :key="`tl-${tl.id}`"
                         class="px-4 py-2 rounded bg-white shadow cursor-pointer">
                        <a :href="route('timeline.show', tl.id)">
                            {{ tl.title }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
