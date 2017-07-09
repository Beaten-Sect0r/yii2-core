<?php

/**
 * Gets the value of an environment variable. Supports boolean.
 *
 * @param  string $key
 * @param  mixed $default
 * @return mixed
 */
function env($key, $default = null)
{
    $value = getenv($key);
    if ($value === false) {
        return $default;
    }
    switch (strtolower($value)) {
        case 'true':
            return true;
        case 'false':
            return false;
    }

    return $value;
}
