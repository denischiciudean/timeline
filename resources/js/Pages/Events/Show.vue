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
            <span class="rounded-lg px-1 py-1 bg-gray-100"> <a :href="route('timeline.show', [$page.props.timeline.id])">{{
            $page.props.timeline.title
            }}</a>  </span>
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-2xl overflow-hidden p-4 font-bold"> {{ $page.props.event.title }}</div>
                <pre> {{ $page.props.event.body }}</pre>
                <div class="my-2"> Consemnat la : {{ $page.props.event.created_at }}</div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-2xl overflow-hidden p-4 font-bold">Updates</div>
                <div class="flex flex-row flex-wrap" v-for="update in $page.props.event.updates_relation"
                     :key="`upd-${update.id}`">
                     {{ update.text }} {{ update.remind_at }}
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
