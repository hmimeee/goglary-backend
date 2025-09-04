<?php

if (!function_exists('setting')) {
    /**
     * Get setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        return \App\Models\Setting::get($key, $default);
    }
}

if (!function_exists('settings_group')) {
    /**
     * Get all settings for a group
     *
     * @param string $group
     * @return array
     */
    function settings_group(...$groups)
    {
        return \App\Models\Setting::getGroup($groups);
    }
}
