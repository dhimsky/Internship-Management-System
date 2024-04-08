<?php

namespace Database\Seeders;

use App\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = [
            [
                'user_id' => 2,
                'name' => 'Dhimas Afrisetiawan',
                'age' => 20,
                'campus_origin' => 'PNC',
                'division' => 'Eng',
                'intern_period' => '2021-12-09'
            ],
        ];
        foreach($employee as $key => $value){
            Employee::create($value);
        }
    }
}