<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Expected_Applicants;
use App\Models\Organizations;
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

    private $organizations;

    public function __construct(){
        $this->organizations = Organizations::select('organization_id','organization_acronym')->get();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $organization = $this->organizations->where('organization_acronym',$row['organization'])->first();

        return new Expected_Applicants([

            'organization_id' => $organization->organization_id ?? NULL,
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            'suffix' => $row['suffix'],
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
