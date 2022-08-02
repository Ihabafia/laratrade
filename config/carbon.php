<?php

    return [
        'holidays' => [
            'region' => 'ca-on',
            'with' => [
                '2nd-sunday-after-05-01'    => null,
                '3rd-sunday-after-06-01'    => null,
                'easter'                    => null,
                'easter-p1'                 => null,
                'new-year'                  => '= 01-01 substitute',
                //'day-after-new-year'        => '= 01-02 substitute',
                'day-after-new-year'        => null,
                //'3rd-monday-after-02-01'    => '= second Monday after 02-01', // Should comment it out after year 2021
                '3rd-monday-after-02-01'    => '= third Monday after 02-01', // Should be uncommented out after year 2021
                '07-01'                     => '= 07-01 if weekend then next Monday',
                'christmas'                 => '= 12-25 if weekend then next Monday',
                'christmas-next-day'        => '= 12-26 if Saturday then Monday and if Sunday then Tuesday and if Monday then Tuesday',
                'st-jean-baptiste-day'      => null,
                '06-24'                     => null,
                'truth-and-reconciliation'  => '=09-30',
            ],
        ],
    ];
