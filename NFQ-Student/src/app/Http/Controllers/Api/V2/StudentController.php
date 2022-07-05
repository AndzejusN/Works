<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResourceCollection;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return StudentResourceCollection
     */
    public function index()
    {
        $students = Student::get();

        return new StudentResourceCollection($students);
    }
}
