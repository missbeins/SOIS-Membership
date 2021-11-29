<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Expected_Applicants;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class ExpectedStudentsImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    use SkipsErrors, Importable, SkipsFailures;

    private $courses;

    public function __construct(){
        $this->courses = Course::select('course_id','course_acronym')->get();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $course = $this->courses->where('course_acronym',$row['course_acronym'])->first();

        return new Expected_Applicants([

            'course_id' => $course->course_id ?? NULL,
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            'student_number' => $row['student_number'],


        ]);
    }

    public function rules(): array
    {
        return [
            '*.student_number' => ['string', 'unique:expected_applicants,student_number']
        ];
    }

    
   
}
