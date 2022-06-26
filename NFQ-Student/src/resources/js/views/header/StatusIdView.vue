<script setup>

import SpinnerView from '../../components/partials/SpinnerComponent';
import {ref, reactive} from "vue";
import {useRoute} from "vue-router";

const route = useRoute();
const id = route.params.id;
let studentsNumber = parseInt(route.params.students);
let groupsNumber = parseInt(route.params.groups);

let spinner = ref(false);
let errorMessage = ref(null);
let confirmationMessage = ref(null);
const name = ref('');

const state = reactive({
    project: [],
    students: [],
    change: {
        student_id: 0,
        project_id: 0,
        group_id: 0
    }
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


function listStudents(url = 'http://localhost:8080/v1/students/') {
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

    let url = 'http://localhost:8080/v1/students/create';
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
    let url = 'http://localhost:8080/v1/students/delete/';
    url += id;
    spinner.value = true;
    fetch(url).then(response => response.json()).then(data => {
        this.listStudents();
        spinner.value = false;
    });
}

function selectedStudent(){
    console.log(state.students.name);
}

initData(id);

listStudents();

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

    <div class="col-8 d-flex flex-wrap mt-3 mb-5 px-3" style="height: auto">
        <div class="row input-group" style="display:inline-flex; width:auto;">
            <div class="card text-center" style="width: 40rem; margin: 3px 0" v-for="group in groupsNumber"
                 :key="group">
                <div class="card-body">
                    <div>
                        Group #{{ group }}
                    </div>
                    <div v-for="one in studentsNumber" :key="one">
                        <br>
                        <div style="width: 36rem;">
                            <label class="form-label">Select a student Nr. {{ one }}:</label>
                            <select class="form-control" onchange="selectedStudent()">
                                <option value="null" selected="selected" disabled="disabled">Select student by name</option>
                                <option
                                    v-for="student in state.students"
                                    :key="student.id"
                                    v-model="student.name">
                                    {{ student.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
