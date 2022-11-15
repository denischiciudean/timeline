<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import {ref, onMounted} from "vue";
import {Inertia} from '@inertiajs/inertia'

const props = defineProps(['timeline'])

const form = ref({
    title: "",
    body: "",
    updates: []
})

const updates = ref([]);

const createEvent = () => Inertia.post(route('events.create', props.timeline.id), {
    ...form.value,
    updates: updates.value.map(it => ({...it, timestamp: new Date(it.timestamp).getTime()})),
})

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add new event to : <span class="rounded-lg px-1 py-1 bg-gray-100">
                <a :href="route('timeline.show', [$page.props.timeline.id])">{{
                        $page.props.timeline.title
                    }} </a>
                </span>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-2xl overflow-hidden p-4 font-bold"> NEW EVENT</div>

                <label for="last-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Record
                    title</label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                           v-model="form.title"
                           class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm"/>
                </div>
                <label for="about" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Record</label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                        <textarea id="about" name="about" rows="3"
                                  v-model="form.body"
                                  placeholder="Write what's hapening, just like a diary note"
                                  class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                </div>


                <div>

                    <div class="my-5">
                        Updates
                        <button class="bg-gray-200 rounded px-2"
                                @click="updates.push( { title: 'New Title', timestamp: new Date(Date.now()).toISOString().replace('Z', '')} )">
                            +
                        </button>
                    </div>

                    <div>
                        <div v-for="update in updates">

                            <div>
                                <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                       v-model="update.title"
                                       class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm inline-block mx-3 "/>
                                <input type="datetime-local" v-model="update.timestamp" class="inline-block mx-3">

                                <button class="bg-red-500 rounded shadow border-b px-2 text-white font-bold text-2xl"
                                        @click="updates = updates.filter(it => it.title != update.title)"> x
                                </button>
                            </div>
                        </div>
                    </div>


                </div>


                <hr class="my-2 w-1/2"/>
                <button type="button"
                        class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Cancel
                </button>
                <button type="submit"
                        @click="createEvent"
                        class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Save
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
