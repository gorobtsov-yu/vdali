<?php

namespace Database\Seeders\Relations;

use App\Models\EducationLevel;
use App\Models\Employment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmploymentEductaionLevelSeeder extends Seeder
{
    private array $employmentEducationSpheres = [
        'autoslesar' => ['secondary_vocational'], 
        'agent_po_prodazham_nedvizhimosti' => ['secondary_general', 'secondary_vocational'], 
        'agent_reklamny' => ['secondary_vocational', 'higher_bachelor'], 
        'agent_strahovoy' => ['secondary_general', 'secondary_vocational'],
        'agent_torgovyy' => ['secondary_general', 'secondary_vocational'],
        'administrator_dezhurnyy' => ['secondary_general', 'secondary_vocational'],
        'administrator_zala_torgovogo' => ['secondary_general', 'secondary_vocational'],
        'administrator_salona' => ['secondary_general', 'secondary_vocational'],
        'online_redaktor' => ['higher_bachelor'], 
        'ofis_menedzher' => ['secondary_vocational', 'higher_bachelor'],
        'probider' => ['secondary_vocational'], 
        'prouoter' => ['secondary_general'], 
        'rekruter' => ['higher_bachelor'], 
        'sayta_menedzher' => ['higher_bachelor'], 
        'somelye' => ['secondary_vocational'], 
        'stendist' => ['secondary_general'],
        'supervayzer' => ['higher_bachelor'], 
        'dispetcher_na_telefone' => ['secondary_general'],
        'dokumentoved' => ['higher_bachelor'], 
        'zaveduyushchiy_otdelom' => ['higher_specialist_master'], 
    ];

    public function run(): void
    {
        foreach ($this->employmentEducationSpheres as $employmentCode => $educationLevels) {
            $employment = Employment::where('code', $employmentCode)->first();

            if(!$employment) continue;

            foreach ($educationLevels as $educationLevelCode) {
                $educationLevel = EducationLevel::where('code', $educationLevelCode)->first();

                if(!$educationLevel) continue;

                $employment->educationLevels()->attach($educationLevel);
            }
        }
    }
}
