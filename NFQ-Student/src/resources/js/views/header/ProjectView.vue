<script>
export default {
    name: "index",
};
</script>

<script setup>

import SpinnerView from '../../components/partials/SpinnerComponent';
import {ref, reactive} from "vue";

let spinner = ref(false);

</script>

<template>
    <SpinnerView v-if="spinner"/>
</template>

<style scoped>

</style>
