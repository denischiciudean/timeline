<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import {ref, onMounted} from "vue";
import {Inertia} from '@inertiajs/inertia'

const timeline_title = ref("A new timeline starts");
const handle_title_change = e => timeline_title.value = e.target.value;

const handle_create_timeline = async () => {
    Inertia.post("/timeline/create-root-tl", {
        title: timeline_title.value
    })
}

onMounted(async () => {
// CSRF TOKEN HERE : $page.props.csrf_token
});

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-2xl overflow-hidden p-4"> Timelines</div>

            <div class="overflow-hidden p-4 grid grid-cols-4 gap-4 justify-around">

                    <div v-for="tl in $page.props.timelines" :key="`tl-${tl.id}`"
                         class="px-4 my-4 py-2 rounded bg-gray-200 shadow cursor-pointer text-center ">
                    <a :href="route('timeline.show', tl.id)">
                            {{ tl.title }}
                        </a>
                    </div>

                </div>

                <div class=" overflow-hidden p-4">
                    <label for="email" class="sr-only">Timeline</label>
                    <input type="email" name="email" id="email"
                           v-model="timeline_title"
                           @keyup="handle_title_change"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           placeholder="you@example.com"/>

                    <div class="flex flex-row justify-center my-4">
                        <button class="bg-purple-300 shadow border-purple-300 rounded-lg px-4 py-2"
                                @click="handle_create_timeline">
                            Create timeline
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
