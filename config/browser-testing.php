<?php

return [
    'screenshot' => [
        // Allow small differences in screenshots
        'threshold' => 0.1, // 10% pixel difference tolerance
        'fail_on_diff' => true,

        // Save failed screenshots for debugging
        'save_failed' => true,
        'failed_path' => 'tests/Browser/Screenshots/Failed',

        // Path for reference screenshots
        'reference_path' => 'tests/Browser/Screenshots',
    ],
];
