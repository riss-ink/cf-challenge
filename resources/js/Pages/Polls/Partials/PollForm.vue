<template>
    <form @submit.prevent="submit" class="space-y-8 divide-y divide-gray-200">
        <div class="space-y-8 divide-y divide-gray-200">
            <div>

                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input v-model="poll_form.name" type="text" name="name" id="name" autocomplete="name"
                                   class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="about" class="block text-sm font-medium text-gray-700">Description</label>
                        <div class="mt-1">
                                <textarea v-model="poll_form.description" id="about" name="about" rows="3"
                                          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label class="block text-sm font-medium text-gray-700">Start Date</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <Datepicker v-model="poll_form.start_date"/>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label class="block text-sm font-medium text-gray-700">End Date</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <Datepicker v-model="poll_form.end_date"/>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="pt-8">
            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">Poll Options</h3>
            </div>
            <div v-for="(option, index) in poll_options"
                 class="mt-6 mb-6 grid grid-cols-2 gap-y-6 gap-x-4 sm:grid-cols-6 items-end">
                <div class="sm:col-span-3">
                    <label :for="'option-' + index" class="block text-sm font-medium text-gray-700">Option
                        {{ index + 1 }}</label>
                    <div class="mt-1">
                        <input v-model="option.option" type="text" :name="'option-' + index" :id="'option-' + index"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
                    </div>
                </div>
                <button type="button">
                    <XMarkIcon @click="removeOption(index)" class="h-12 text-red-500"/>
                </button>
            </div>
            <div class="flex">
                <PrimaryButton @click="addOption" type="button">Add Option</PrimaryButton>
            </div>
        </div>
        <div class="pt-5">
            <div class="flex justify-end">
                <button type="button"
                        class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Cancel
                </button>
                <button type="submit"
                        class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-primary py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Save
                </button>
            </div>
        </div>
    </form>

</template>

<script setup>
import {ref, computed, onMounted} from 'vue'
import {router} from '@inertiajs/vue3'
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import {XMarkIcon} from "@heroicons/vue/24/outline";

const props = defineProps(['poll_data', 'poll_options_data', 'edit'])
const poll_form = ref({
    name: '',
    description: '',
    start_date: '',
    end_date: ''
})
const poll_options = ref([{option: ''}])
onMounted(() => {
    if (props.edit) {
        poll_form.value = {
            id: props.poll_data.id,
            name: props.poll_data.name,
            description: props.poll_data.description,
            start_date: props.poll_data.start_date,
            end_date: props.poll_data.end_date
        }
        poll_options.value = props.poll_options_data

    }
})

function addOption() {
    poll_options.value.push({option: ''})
}

function removeOption(index) {
    poll_options.value.splice(index, 1)
}

function submit() {
    if (!props.edit) {
        router.post('/polls', {poll: poll_form, options: poll_options})
    } else {
        router.patch('/polls/' + poll_form.value.id, {poll: poll_form, options: poll_options})
    }
}
</script>

<style scoped>

</style>
