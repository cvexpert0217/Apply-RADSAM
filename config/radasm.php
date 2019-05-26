<?php

return [
	'session' => [
        'user' => 'RADASM_USER',
    ],
	
    'failed' => [
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => 'failed_jobs',
    ],

];
