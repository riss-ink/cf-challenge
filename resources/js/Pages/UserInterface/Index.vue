<template>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8">
        <div v-for="(poll, index) in userinterface">
            <label class="text-base font-medium text-gray-900">{{poll.poll.name}}</label>
            <p class="text-sm leading-5 text-gray-500">{{ poll.poll.description }}</p>
            <fieldset class="mt-4">
                <legend class="sr-only">Notification method</legend>
                <div class="space-y-4">
                    <div v-for="option in poll.poll.poll_options" :key="option.id"
                         class="flex items-center">
                        <input @input="updateSelection(poll.poll.id, option.id)" :id="option.id" name="notification-method" type="radio"
                               class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                        <label :for="option.id" class="ml-3 block text-sm font-medium text-gray-700">{{
                                option.option
                            }}</label>
                    </div>
                </div>
            </fieldset>
            <div class="pt-5">
                <div class="flex justify-end">

                    <button type="button" @click="submitPoll(index, poll.poll.id)"
                            class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-primary py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Save
                    </button>
                </div>
            </div>

        </div>
        <div v-for="chartData in charData">
            <Bar :data="chartData" />
        </div>
    </div>
</template>

<script setup>
import {ref} from "vue";
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale
} from 'chart.js'
import { Bar } from 'vue-chartjs'
ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend)
const charData = ref([]);

const props = defineProps({interface: Object, poll_selection: Object})
const selections = ref(props.poll_selection)
const userinterface = ref(props.interface)

function updateSelection(id, option_id){
    selections.value[id] = option_id
}
function submitPoll(index, poll_id){
    axios.post('/polls/vote/' + selections.value[poll_id]).then((response) => {
        userinterface.value.splice(index, 1)
        charData.value.push({labels: [
                ...response.data.options
            ],
            datasets: [
                {
                    label: response.data.name,
                    backgroundColor: '#002D40',
                    data: [...response.data.results]
                }
            ]
        })
    })
}
</script>

<style scoped>

</style>
