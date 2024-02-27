<?php

use App\Models\Wallet;
use GeoSot\EnvEditor\Facades\EnvEditor;

/**
 * Get Status Meta
 *
 * @param string $status_key
 * @return array Status
 */
function get_status_meta($status_key = '')
{
    $metas = [
        'active'   => [
            'label' => 'Active',
            'class' => 'success',
        ],
        'inactive' => [
            'label' => 'Inactive',
            'class' => 'warning',
        ],
        'blocked'  => [
            'label' => 'Blocked',
            'class' => 'danger',
        ],
    ];

    if (empty($status_key)) {
        return $metas;
    }

    if (in_array($status_key, array_keys($metas))) {
        return $metas[$status_key];
    }

    return [];
}

/**
 * Get Status Class
 *
 * @param string $status_key
 * @return string Status Class
 */
function get_status_class($status_key = '')
{

    $status_meta = get_status_meta($status_key);

    if (empty($status_meta['class'])) {
        return '';
    }

    return $status_meta['class'];
}

/**
 * Get Status label
 *
 * @param string $status_key
 * @return string Status label
 */
function get_status_label($status_key = '')
{
    $status_meta = get_status_meta($status_key);

    if (empty($status_meta['label'])) {
        return '';
    }

    return $status_meta['label'];
}


if (!function_exists('formatCurrency')) {
    /**
     * Get Status label
     *
     * @param string $status_key
     * @return string Status label
     */
    function formatCurrency($amount)
    {
        return "$ {$amount}";
    }
}


// seller total earning

if (!function_exists('seller_total_earning')) {

    function seller_total_earning($user_id)
    {
        $my_wallet = Wallet::where('user_id', $user_id)->first();
        $total_earning =  $my_wallet?->balance + $my_wallet?->total_withdrawn + $my_wallet?->pending_withdraw;
        return $total_earning;
    }
}

if (!function_exists('envWrite')) {
    function envWrite($key, $value)
    {
        try {
            if (EnvEditor::keyExists($key)) {
                EnvEditor::editKey($key, '"' . trim($value) . '"');
            } else {
                EnvEditor::addKey($key, '"' . trim($value) . '"');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}

if (!function_exists('update_env')) {
    function update_env($data)
    {
        try {
            envWrite('DB_HOST', $data['DB_HOST']);
            envWrite('DB_DATABASE', $data['DB_DATABASE']);
            envWrite('DB_USERNAME', $data['DB_USERNAME']);
            envWrite('DB_PASSWORD', $data['DB_PASSWORD']);
        } catch (\Exception $e) {
            return 'Unable to write env file!';
        }

        return 'success';
    }
}

if (!function_exists('isAppMode')) {
    function isAppMode(): bool
    {
        return config('app.mobile_mode') == 'on';
    }
}

if (!function_exists('getArrayValue')) {
    function getArrayValue($key, $array, $default = null)
    {
        return arrayCheck($key, $array) ? $array[$key] : $default;
    }
}

if (!function_exists('setting')) {
    function setting($title, $lang = null)
    {
        // if (! $lang) {
        //     $lang = app()->getLocale();
        // }
        // try {
        //     $settings = app('settings');
        //     if (! blank($title)) {
        //         if (in_array($title, get_yrsetting('setting_array')) || in_array($title, get_yrsetting('setting_image'))) {
        //             $data = $settings->where('title', $title)->first();
        //             if (! blank($data)) {
        //                 return $data->value ? unserialize($data->value) : [];
        //             }
        //         } else {
        //             if (in_array($title, get_yrsetting('setting_by_lang'))) {
        //                 $data = $settings->where('title', $title)->where('lang', $lang)->first();

        //                 if (blank($data)) {
        //                     $data = $settings->where('title', $title)->where('lang', 'en')->first();

        //                     return ! blank($data) ? $data->value : '';
        //                 }

        //                 return $data->value;
        //             } else {
        //                 $data = $settings->where('title', $title)->first();
        //             }

        //             return ! blank($data) ? $data->value : '';
        //         }
        //     } else {
        //         return '';
        //     }
        // } catch (\Exception $e) {
        //     // dd($e);
        //     return '';
        // }
    }
}

if (!function_exists('arrayCheck')) {
    function arrayCheck($key, $array): bool
    {
        return is_array($array) && count($array) > 0 && array_key_exists($key, $array) && !empty($array[$key]) && $array[$key] != 'null';
    }
}

if (!function_exists('curlRequest')) {
    function curlRequest($url, $fields, $method = 'POST', $headers = [], $is_array = false)
    {
        $client   = new \GuzzleHttp\Client(['verify' => false]);

        if (is_string($fields)) {
            $data = [
                'body'    => $fields,
                'headers' => $headers,
            ];
        } else {
            $data = [
                'form_params' => $fields,
                'headers'     => $headers,
            ];
        }

        $response = $client->request($method, $url, $data);

        $result   = $response->getBody()->getContents();

        return json_decode($result, $is_array);
    }
}
if (!function_exists('isInstalled')) {

    function isInstalled(): bool
    {
        if (strtolower(config('app.app_installed')) == 'yes') {
            return true;
        }

        return false;
    }
}
