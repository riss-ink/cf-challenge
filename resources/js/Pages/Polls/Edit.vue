<template>
    <AppLayout>
        <PollForm :edit="true" :poll_data="poll" :poll_options_data="poll_options" />
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PollForm from "@/Pages/Polls/Partials/PollForm.vue";

defineProps({ poll: Object, poll_options: Array })

</script>

<style scoped>

</style>
