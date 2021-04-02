<?php

if (!defined("WP_UNINSTALL_PLUGIN")) {
    die;
}

// clear Database stored data

$absens = get_post(['post_type' => 'book', 'numberposts' => -1]);

foreach ($absens as $absen) {
    wp_delete_post($absen->ID, true);
}
