<?php

/**
 * Auto Loaded Functions
 *
 * @author Mohamed Alansary
 */

/**
 * Check host has module.
 *
 * @param  [string] host
 * @param  [string] module
 * @return boolean
 */
function hasModule($fqdn, $module)
{
    // Check the hostnames that has this module
    $module = DB::connection('mysql')->table('modules')->where('name', $module)->first();

    // If module not found
    if (!$module) {
        return false;
    }

    $module_packages = DB::connection('mysql')->table('package_modules')->where('module_id', $module->id)->pluck('package_id')->toArray();
    $package_hosts = DB::connection('mysql')->table('host_details')->whereIn('package_id', $module_packages)->pluck('fqdn')->toArray();

    return in_array($fqdn, $package_hosts) ? true : false;
}
