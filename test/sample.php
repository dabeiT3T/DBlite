<?php

require_once __DIR__ . '/vendor/autoload.php';

use Database\DBlite;


// var_dump(DBlite::table('products')
//             ->join('vendors', 'products.vend_id = vendors.vend_id')
//             ->get()
// );