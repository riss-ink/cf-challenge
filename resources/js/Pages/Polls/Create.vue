<template>
    <AppLayout>
        <PollForm :edit="false" :poll_options_data="[]" :poll_form_data="{}" />
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PollForm from "@/Pages/Polls/Partials/PollForm.vue";

</script>

<style scoped>

</style>
