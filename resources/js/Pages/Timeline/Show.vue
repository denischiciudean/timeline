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

                <div class="overflow-hidden p-4">
                    <div class="inline-block text-2xl">Events</div>
                    <div class="inline-block float-right bg-white shadow px-4 py-2 rounded cursor-pointer">
                        <a :href="route('events.create-form', [$page.props.timeline.id])">
                            add event
                        </a>
                    </div>
                </div>
                <div class="flex flex-row flex-wrap">
                    <div class="my-5 mx-5" v-for="(ev, index) in $page.props.timeline.events" :key="`ev-${ev.id}`">
                        <div @click="Inertia.get(route('events.show', [ev.timeline_id, ev.id]))"
                             class="bg-white cursor-pointer p-2 rounded shadow inline-block">
                            <div class="text-center underline">
                                {{ ev.title }}
                            </div>
                            <div class="">
                                {{ ev.created_at }}
                            </div>
                        </div>
                        <div v-if="index != $page.props.timeline.events.length-1"
                             class="inline-block flex-row justify-center my-5 mx-5"> &lt;-
                        </div>
                    </div>
                </div>


                <div class="overflow-hidden p-4">
                    <div class="inline-block text-2xl">Updates</div>
                </div>
                <div class="flex flex-row flex-wrap">
                <div class="my-5 mx-5" v-for="(up, index) in $page.props.updates" :key="`evupd-${up.id}`">
                <div @click="Inertia.get(route('events.show', [$page.props.timeline.id, up.event_id]))"
                             class="bg-white cursor-pointer p-2 rounded shadow inline-block">
                            <div class="text-center underline">
                                {{ up.text }}
                            </div>
                            <div class="">
                                {{ up.remind_at }}
                            </div>
                        </div>
<!--                        <div v-if="index != $page.props.updates.remind.length-1"-->
<!--                             class="inline-block flex-row justify-center my-5 mx-5"> &lt;--->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
