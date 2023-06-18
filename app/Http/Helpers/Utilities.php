<?php

/**
 * Utilities
 *
 * @author Mohamed Alansary
 */
namespace App\Http\Helpers;

use Exception;
use Excel;
use App\Exports\SheetsExport;
class Utilities
{
    public static function export($file_name, $sheet_name, $array,$headers)
    {
        return Excel::download(new SheetsExport($array,$headers),$file_name.'.xlsx');
    }

    public static function storeFile($file, $path, $default = null)
    {
        if ($file) {
            $file_name_with_extension = $file->getClientOriginalName();
            $file_name_without_extension = pathinfo($file_name_with_extension, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $file_name_to_store = $file_name_without_extension.'_'.time().'.'.$extension;
            $file->move(public_path($path), $file_name_to_store);
            $file_name_to_store = $path.'/'.$file_name_to_store;
            return $file_name_to_store;
        } else {
            return $default;
        }
    }

    /********************************************************
     * Purpose: Method to execute a command in the terminal Uses:
     * 1. system
     * 2. passthru
     * 3. exec
     * 4. shell_exec
     * Author: Mohamed Alansary
     ********************************************************/
    public static function terminal($command)
    {
        if(function_exists('system')) {
            //system
            ob_start();
            system($command , $return_var);
            $output = ob_get_contents();
            ob_end_clean();
        } else if(function_exists('passthru')) {
            //passthru
            ob_start();
            passthru($command , $return_var);
            $output = ob_get_contents();
            ob_end_clean();
        } else if(function_exists('exec')) {
            //exec
            exec($command , $output , $return_var);
            $output = implode('n' , $output);
        } else if(function_exists('shell_exec')) {
            //shell_exec
            $output = shell_exec($command);
        } else {
            $output = 'Command execution not possible on this system';
            $return_var = 1;
        }
        
        return array('output' => $output , 'status' => $return_var);
    }

    /********************************************************
     * Purpose: Solves SyntaxError: "" string literal
     *          contains an unescaped line break javascript
     *          error.
     * Author: Mohamed Alansary
     ********************************************************/
    public static function escapeJavaScriptText($string)
    {
        return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$string), "\0..\37'\\")));
    }

    /********************************************************
     * Purpose: Removing special characters from text.
     * Author: Mohamed Alansary
     ********************************************************/
    public static function clearString($string)
    {
        return preg_replace('/[^\x{0600}-\x{06FF}A-Za-z !@#$%^&*()]/u', '', $string);
    }
}