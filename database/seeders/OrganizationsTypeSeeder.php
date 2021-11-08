<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'organization_type_id' => '1',
                'organization_type' => 'academic'
            ],
            [
                'organization_type_id' => '2',
                'organization_type' => 'non-academic'
            ]
        ];
        DB::table('organizations_type')->insert($data);
    }
}
