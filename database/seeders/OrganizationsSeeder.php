<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'organization_type_id' => '1',
                'organization_name' => 'Association of Electronics Engineering Students',
                'organization_acronym' => 'AECES',
            ],

            [
                'organization_type_id' => '1',
                'organization_name' => 'Computer Society',
                'organization_acronym' => 'CS',
            ],

            [
                'organization_type_id' => '1',
                'organization_name' => 'Junior Marketing Association',
                'organization_acronym' => 'JMA',
            ],

            [
                'organization_type_id' => '1',
                'organization_name' => 'Junior Philippine Institutes of Accountants',
                'organization_acronym' => 'JPIA',
            ],

            [
                'organization_type_id' => '1',
                'organization_name' => 'Junior People Management Association of the Philippines',
                'organization_acronym' => 'JPMAP',
            ],

            [
                'organization_type_id' => '1',
                'organization_name' => 'Junior Philippine Society of Mechanical Engineering',
                'organization_acronym' => 'JPSME',
            ],

            [
                'organization_type_id' => '1',
                'organization_name' => 'Mentor\'s Society',
                'organization_acronym' => 'MS',
            ],

            [
                'organization_type_id' => '1',
                'organization_name' => 'Philippine Association of Students in Office Administration',
                'organization_acronym' => 'PASOA',
            ],

            [
                'organization_type_id' => '2',
                'organization_name' => 'Central Student Council',
                'organization_acronym' => 'CSC',
            ],

            [
                'organization_type_id' => '2',
                'organization_name' => 'Radio Engineering Circle',
                'organization_acronym' => 'REC',
            ],

            [
                'organization_type_id' => '2',
                'organization_name' => 'Emergency Response Group',
                'organization_acronym' => 'ERG',
            ],

            [
                'organization_type_id' => '2',
                'organization_name' => 'iRock Campus',
                'organization_acronym' => 'IC',
            ],
        ];
        DB::table('organizations')->insert($data);
    }
}
