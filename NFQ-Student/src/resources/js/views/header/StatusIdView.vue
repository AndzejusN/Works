<script setup>

import SpinnerView from '../../components/partials/SpinnerComponent';
import {ref, reactive} from "vue";
import {useRoute} from "vue-router";

const route = useRoute();
const id = route.params.id;


let spinner = ref(false);

const state = reactive({
    project: [],

})

function initData(id) {

    let url = 'http://localhost:8080/v1/projects/project/';
    url += id;

    spinner.value = true;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            state.project = data;
            spinner.value = false;
        })
}

initData(id);

</script>

<template>
    <SpinnerView v-if="spinner"/>
    <div class="col-8 d-flex flex-wrap mt-3 px-3">
        <div class="row input-group" style="display:inline-flex; width:auto;">
            <div class="card text-center" style="width: 40rem;">
                <div class="card-body">
                    <table style="width:50%">
                        <tr>
                            <th style="text-align: start">Project name:</th>
                            <td>{{ state.project?.project?.name ?? null }}</td>
                        </tr>
                        <tr>
                            <th style="text-align: start">Number of groups:</th>
                            <td>{{ state.project?.project?.groups ?? null }}</td>
                        </tr>
                        <tr>
                            <th style="text-align: start">Students per group:</th>
                            <td>{{ state.project?.project?.students ?? null }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
