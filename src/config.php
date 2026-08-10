<?php

use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryUser;
use NetworkRailBusinessSystems\DirectoryLink\Models\DirectoryGroup;

return [
    /* Which Models to use for directory operations */
    'models' => [
        'group' => [
            'directory' => DirectoryGroup::class,
            'local' => 'App\Models\Group',
        ],
        'user' => [
            'directory' => DirectoryUser::class,
            'local' => 'App\Models\User',
        ],
    ],

    /* Which attributes to sync in directory => system format */
    'sync' => [
        'group' => [
            'on' => 'azure_id',
            'attributes' => [
                'description' => 'description',
                'displayName' => 'name',
                'id' => 'azure_id',
                'mail' => 'email',
                'members' => 'members',
                'membersCount' => 'count',
            ],
        ],
        'user' => [
            'on' => 'azure_id',
            'attributes' => [
                'department' => 'business_area',
                'displayName' => 'name',
                'employeeId' => 'employee_number',
                'givenName' => 'first_name',
                'id' => 'azure_id',
                'jobTitle' => 'title',
                'mail' => 'email',
                'officeLocation' => 'location',
                'phone' => 'phone',
                'surname' => 'last_name',
            ],
        ],
    ],

    /* API connection credentials */
    'api' => [
        'endpoint' => env('DIRECTORY_ENDPOINT'),
        'token' => env('DIRECTORY_TOKEN'),
    ],
];
