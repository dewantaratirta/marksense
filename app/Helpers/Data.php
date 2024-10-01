<?php


/**
 * Check type of first children
 *
 * @param  mixed  $data
 * @return boolean
 */
function isChildrenIsArray($data): bool
{
    if ($data instanceof \Illuminate\Support\Collection && gettype($data->first()) == 'string') return true;
    if (is_array($data)) return true;
    return false;
}
