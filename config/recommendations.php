<?php

return [
    
    /*
    | --------------------------------------------------------------------------
    | Recommendations settings.
    | --------------------------------------------------------------------------
    | 
    | Used in recommendation technologies (so far, only for employment).
    */

    'default' => [
        'metrics_value_limit' => 100,   // percents
    ],

    /*
    | --------------------------------------------------------------------------
    | Employment recommendations settings.
    | --------------------------------------------------------------------------
    */

    'employments' => [
        'metrics_count' => 2,
        'settings' => [
            'characteristics_limit' => 5,
        ],
    ]
];
