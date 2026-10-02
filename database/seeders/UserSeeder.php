<?php

namespace Database\Seeders;

use App\Models\EducationLevel;
use App\Models\EducationSphere;
use App\Models\User;
use App\ValueObject\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function __construct(
    ) {}

    public function run(): void
    {
        $admin = User::factory()->create(
            [
                'first_name' => 'Chicho',
                'last_name' => 'Don',
                'login' => 'don_chicho',
            ]
        );

        $manager = User::factory()->create(
            [
                'first_name' => 'Jiro',
                'last_name' => 'Don',
                'login' => 'don_jiro',
            ]
        );

        $admin->educationLevels()->attach(EducationLevel::where('code', 'higher_bachelor')->first());
        $admin->educationSpheres()->attach([
            EducationSphere::where('code', 'technological')->first(),
            EducationSphere::where('code', 'it')->first(),
        ]);

        $admin->assignRole(Role::SUPER_ADMIN->value);
    }
}
