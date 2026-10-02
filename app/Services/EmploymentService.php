<?php

namespace App\Services;

use App\Models\Employment;
use Illuminate\Support\Collection;
use App\Models\EmploymentVisit;
use App\Models\UserEmploymentVisit;
use Illuminate\Support\Facades\Auth;

class EmploymentService extends Service
{
    public static function getEmploymentsRecommendation(Collection $activityTypes, int $depth = 1): Collection
    {   
        $employments = Employment::all();
        
        // $activityTypes = $activityTypes->values();

        // for ($i = 0; $i < $depth && $i < $activityTypes->count(); $i++) {
        //     $activityType = $activityTypes->get($i);

        //     $activityType->employments
        //         ->map(function (Employment $e) {
        //                 return [
        //                     'employment' => $e,
        //                     'activity_types_count' => $e->activityTypes->count(),
        //                 ];
        //             }
        //         )
        //         ->sortBy(
        //             ['activity_types_count', 'asc']
        //         )
        //         ->map(fn(array $el) => $el['employment'])
        //         ->each(function (Employment $e) use ($employments, $i) {
        //             if (!$employments->contains(function ($employment, $key) use ($e) {
        //                 return $e->code == $employment->code;
        //             })) {
        //                 $employments->push($e);
        //             }
        //         });
        // }
        
        return $employments;
    }
}
