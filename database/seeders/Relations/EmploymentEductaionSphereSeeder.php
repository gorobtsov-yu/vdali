<?php

namespace Database\Seeders\Relations;

use App\Models\EducationSphere;
use App\Models\Employment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmploymentEductaionSphereSeeder extends Seeder
{
    private array $employmentEducationSpheres = [
        'autoslesar' => ['technological'], 
        'agent_po_prodazham_nedvizhimosti' => ['economical'], 
        'agent_reklamny' => ['social', 'economical'], 
        'agent_strahovoy' => ['economical'],
        'agent_torgovyy' => ['economical'],
        'administrator_dezhurnyy' => ['social', 'economical'],
        'administrator_zala_torgovogo' => ['economical'],
        'administrator_salona' => ['social', 'economical'],
        'online_redaktor' => ['social'], 
        'ofis_menedzher' => ['economical', 'social'],
        'probider' => ['fundamental', 'technological'], 
        'prouoter' => ['economical', 'social'], 
        'rekruter' => ['social', 'economical'], 
        'sayta_menedzher' => ['it', 'economical'], 
        'somelye' => ['creative', 'ecological'], 
        'stendist' => ['economical', 'social'],
        'supervayzer' => ['economical', 'technological'], 
        'dispetcher_na_telefone' => ['social'],
        'dokumentoved' => ['social'], 
        'zaveduyushchiy_otdelom' => ['economical', 'social', 'technological'], 
    ];    

    public function run(): void
    {
        foreach ($this->employmentEducationSpheres as $employmentCode => $educationSpheres) {
            $employment = Employment::where('code', $employmentCode)->first();

            if(!$employment) continue;

            foreach ($educationSpheres as $educationSphereCode) {
                $educationSphere = EducationSphere::where('code', $educationSphereCode)->first();

                if(!$educationSphere) continue;

                $employment->educationSpheres()->attach($educationSphere);
            }
        }
    }
}
