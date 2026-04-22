<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'business_name' => 'Tech Solutions S.A.',
            'phone' => '123456789',
            'email' => 'contact@techsolutions.com',
        ]);

        Company::create([
            'business_name' => 'Innovatech Services',
            'phone' => '987654321',
            'email' => 'info@innovatech.com',
        ]);
    }
}
