<?php

return [
    'mode' => 'utf-8',
    'format' => 'A4',
    'default_font_size' => 0,
    'default_font' => 'notosansgujarati',
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_top' => 10,
    'margin_bottom' => 10,
    'margin_header' => 0,
    'margin_footer' => 0,
    'orientation' => 'P',

    'fontDir' => [
        base_path('resources/fonts'),
    ],

    'fontdata' => [
        'notosansgujarati' => [
            'R' => 'NotoSansGujarati-Regular.ttf',
            'B' => 'NotoSansGujarati-Bold.ttf',
        ],
    ],
];
