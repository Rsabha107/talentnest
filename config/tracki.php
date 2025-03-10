<?php

return [
    'send_task_assignment_emails' => true,
    'gantt_event_color' => 'green',
    'gantt_task_color' => 'orange',
    'gantt_text_color' => 'white',
    'gantt_progress_color' => 'orange',

    'task_status' => [
        'completed' => 13,
        'inprogress' => 11,
        'active' => 10,
    ],

    // 'white_list_ip_address' => ['127.1.0.1'],
    'white_list_ip_address' => ['1.1.1.1'],
    'project_status' => [
        'completed' => 13,
        'inprogress' => 11,
        'active' => 10,
    ],

    'fund_type' => [
        'budgeted' => 1,
        'unbudgeted' => 2,
    ],

    'show_task_progress' => false,
    'project_strict_save' => false,
    'show_project_status_field' => false,

    // 'use_otp' => false,
    'use_otp' => env('USE_OTP_AUTH', true),

    // 'component_table_style' => 'table-bordered',
    'component_table_style' => 'table-hover  fs-9 mb-0 border-top border-translucent',
];
