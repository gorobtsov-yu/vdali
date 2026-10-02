<?php

namespace Database\Seeders\Relations;

use App\Models\ActivityType;
use App\Models\Employment;
use Illuminate\Database\Seeder;

class EmploymentActivityTypeSeeder extends Seeder
{
    private array $relations = [
        'autoslesar' => [
            'analytical',
        ],
        'agent_po_prodazham_nedvizhimosti' => [
            'social-communicative', 
            'organizational',
        ],
        'agent_reklamny' => [
            'social-communicative', 
            'creative',
        ],
        'agent_strahovoy' => [
            'social-communicative', 
            'analytical',
        ],
        'agent_torgovyy' => [
            'social-communicative', 
            'organizational',
        ],
        'administrator_dezhurnyy' => [
            'organizational', 
            'social-communicative',
        ],
        'administrator_zala_torgovogo' => [
            'organizational', 
            'social-communicative',
        ],
        'administrator_salona' => [
            'organizational', 
            'social-communicative',
        ],
        'online_redaktor' => [
            'creative', 
            'analytical',
        ],
        'ofis_menedzher' => [
            'organizational', 
            'social-communicative',
        ],
        'probider' => [
            'analytical',
        ],
        'prouoter' => [
            'social-communicative',
        ],
        'rekruter' => [
            'social-communicative', 
            'analytical',
        ],
        'sayta_menedzher' => [
            'analytical', 
            'organizational',
        ],
        'somelye' => [
            'social-communicative', 
            'analytical',
        ],
        'stendist' => [
            'social-communicative',
        ],
        'supervayzer' => [
            'organizational', 
            'analytical',
        ],
        'dispetcher_na_telefone' => [
            'organizational', 
            'social-communicative',
        ],
        'dokumentoved' => [
            'organizational', 
            'analytical',
        ],
        'zaveduyushchiy_otdelom' => [
            'organizational', 
            'social-communicative', 
            'analytical',
        ],
    ];

    public function run(): void
    {
        foreach ($this->relations as $employmentCode => $activityTypeCodes) {
            $employment = Employment::where('code', $employmentCode)->first();

            if(!$employment) continue;

            foreach ($activityTypeCodes as $activityTypeCode) {
                $activityType = ActivityType::where('code', $activityTypeCode)->first();

                if(!$employment) continue;

                $activityType->employments()->attach($employment);
            }
        }
    }
}
