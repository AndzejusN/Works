<script>
export default {
    name: "status",
};
</script>

<script setup>

import SpinnerView from '../../components/partials/SpinnerComponent';
import {ref, reactive} from "vue";

let spinner = ref(false);

const state = reactive({
    students: [],
})

function listStudents(url = '/students') {
    spinner.value = true;
    fetch(url).then(response => response.json()).then(data => {
        state.students = data.students;
        spinner.value = false;
    });
}

listStudents();

</script>

<template>
    <SpinnerView v-if="spinner"/>
    <div class="col-8 d-flex flex-wrap mt-3 px-3">
        <div class="row input-group" style="display:inline-flex; width:auto;">
            <div class="card text-center" style="width: 40rem;">
                <div class="card-body">
                    <table>
                        <thead>
                        <tr>
                            <th style="min-width: 16rem">Student</th>
                            <th style="min-width: 10rem">Group</th>
                            <th style="min-width: 10rem">Actions</th>
                        </tr>
                        </thead>
                        <tbody v-for="student in state.students" :key="student.id">
                        <tr>
                            <td>{{ student.name }}</td>
                            <td>{{ student.id }}</td>
                            <td>Delete</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
