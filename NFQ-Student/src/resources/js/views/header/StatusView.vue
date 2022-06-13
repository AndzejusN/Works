<script>

export default {
    name: "status",
    data() {
        return {
            dialog: false,
        }
    },
}

</script>

<script setup>

import SpinnerView from '../../components/partials/SpinnerComponent';
import {ref, reactive} from "vue";

let spinner = ref(false);
let errorMessage = ref(null);
let confirmationMessage = ref(null);
const name = ref('');

const state = reactive({
    students: []
})

function listStudents(url = 'v1/students/') {
    spinner.value = true;
    fetch(url).then(response => response.json()).then(data => {
        state.students = data.students;
        spinner.value = false;
    });
}

function createStudent() {
    confirmationMessage.value = null;
    errorMessage.value = null;
    spinner.value = true;

    let url = './v1/students/create';
    const requestOptions = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({"name": name.value})
    };

    fetch(url, requestOptions)
        .then(response => response.json())
        .then(data => {
            confirmationMessage.value = data.confirmation;
            errorMessage.value = data.error;

            name.value = '';
            listStudents();
            spinner.value = false;
        });
}

function deleteStudent(id) {
    let url = 'v1/students/delete/';
    url += id;
    spinner.value = true;
    fetch(url).then(response => response.json()).then(data => {
        this.listStudents();
        spinner.value = false;
    });
}

listStudents();
</script>

<template>
    <SpinnerView v-if="spinner"/>
<div>{{ $route.params.id }}</div>
    <div class="col-8 d-flex flex-wrap mt-3 px-3">
        <div class="row input-group" style="display:inline-flex; width:auto;">
            <div class="card text-center" style="width: 40rem;">
                <div class="card-body">
                    <table style="width:50%">
                        <tr>
                            <th style="text-align: start">Project name:</th>
                            <td>Data 1</td>
                        </tr>
                        <tr>
                            <th style="text-align: start">Number of groups:</th>
                            <td>Data 2</td>
                        </tr>
                        <tr>
                            <th style="text-align: start">Students per group:</th>
                            <td>Data 3</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-8 d-flex flex-wrap mt-3 px-3">
        <div class="row input-group" style="display:inline-flex; width:auto;">
            <div class="card text-center" style="width: 40rem;">
                <div class="card-body">
                    <table class="student-table">
                        <thead>
                        <tr>
                            <th style="min-width: 16rem">Student full name</th>
                            <th style="min-width: 10rem">Group</th>
                            <th style="min-width: 10rem">Action</th>
                        </tr>
                        </thead>
                        <tbody v-for="student in state.students" :key="student.id">
                        <tr>
                            <td>{{ student.name }}</td>
                            <td>Group #{{ student.group_id }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-danger btn-sm"
                                        @click="deleteStudent(student.id)">Delete
                                </button>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>
                                <input v-model="name">
                            </td>
                            <td></td>
                            <td>
                                <button type="button" class="btn btn-outline-success btn-sm"
                                        @click="createStudent">
                                    Add Student
                                </button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
