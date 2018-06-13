<?php

require_once __DIR__ . '/vendor/autoload.php';

use Database\DBlite;


$db = DBlite::table('new_table')->find(3);

// DBlite::table('new_table')->create([
//     'city'      => 'kyoto',
//     'country'   => 'japan',
// ]);

// DBlite::table('new_table')->where('id', 2)
//         ->delete();

var_dump($db);