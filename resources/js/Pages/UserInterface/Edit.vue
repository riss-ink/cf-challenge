<template>
<AppLayout>
    <form @submit.prevent="submit">
        <div v-for="(order, index) in interfaceOrder" :key="order.order" class="flex items-center">
            <label for="location" class="block text-sm font-medium text-gray-700 w-10">{{ index + 1 }}</label>
            <select v-model="interfaceOrder[index]" id="location" name="location" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <option v-for="poll in polls" :value="{poll_id :poll.id, order: index}" v-bind:selected="poll.id === order.poll_id">{{poll.name}}</option>
            </select>
            <button type="button">
                <XMarkIcon @click="removePoll(index)" class="h-10 text-red-500"/>
            </button>
            <button type="button">
                <PlusIcon @click="addPoll(index)" class="h-10 text-green-500"/>
            </button>
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
</AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {ref} from "vue";
import {router} from "@inertiajs/vue3";
import {XMarkIcon, PlusIcon} from "@heroicons/vue/24/outline";

const props = defineProps(['pollsData'])
const interfaceOrder = ref([{}])
const polls = ref(props.pollsData)

function submit(){
    router.post('/userinterface', interfaceOrder)
}
function addPoll(){
    interfaceOrder.value.push({order: interfaceOrder.value.length + 1, poll_id : ''})
}
function removePoll(index) {
    interfaceOrder.value.splice(index, 1)
}
</script>

<style scoped>

</style>
