<?php

function generateIndonesiaCompany($prefix = FALSE, $suffix = FALSE)
{
    $remove_list = [
        'PJ',
        'PT',
        'CV',
        'UD',
        '(PERSERO)',
        'Tbk',
        'Fa',
        '(Persero)',
        'Yayasan',
    ];

    $temp_prefix =  [];
    $temp_suffix =  [];

    $try = fake('id_ID')->company();

    // remove array words from $try
    foreach ($remove_list as $word) {
        $try = str_replace($word, '', $try);
    }

    if (is_string($prefix)) {
        $temp_prefix[] = $prefix;
    }

    if (is_string($suffix)) {
        $temp_suffix[] = $suffix;
    }

    if (!$prefix && !$suffix) return $try;

    // get random prefix from temp_prefix
    if (count($temp_prefix) > 0) {
        $prefix = fake('id_ID')->randomElement($temp_prefix);
        $try = $prefix . ' ' . $try;
    }

    // get random suffix from temp_suffix
    if (count($temp_suffix) > 0) {
        $suffix = fake('id_ID')->randomElement($temp_suffix);
        $try = $try . ' ' . $suffix;
    }

    return $try;
}
