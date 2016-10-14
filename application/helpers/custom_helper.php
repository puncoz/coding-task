<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function assets($path)
{
    return base_url('assets/'.$path);
}

function url_encrypt($string)
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'ZwZSUU50OW2doUTXNHSUNYaGZOWUwQ0c3Z2doUwQ0cNYUU3ZUT09SNHX5wZSUaG9';
    $secret_iv = 'Zw0c3Z2d0OW2doUTXNoUwQ0cNYUU3ZUT09SU5HSUUwQUaG9NYaGNHX5wZSZSUZOWZw0c3Z2d5wZSZSUZOWoUwQ0cN0OWYUU3ZUT09SU5HSUUwQUaG2doUTXN9NYaGNHX';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    return base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
}

function url_decrypt($enc_string)
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'ZwZSUU50OW2doUTXNHSUNYaGZOWUwQ0c3Z2doUwQ0cNYUU3ZUT09SNHX5wZSUaG9';
    $secret_iv = 'Zw0c3Z2d0OW2doUTXNoUwQ0cNYUU3ZUT09SU5HSUUwQUaG9NYaGNHX5wZSZSUZOWZw0c3Z2d5wZSZSUZOWoUwQ0cN0OWYUU3ZUT09SU5HSUUwQUaG2doUTXN9NYaGNHX';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    return openssl_decrypt(base64_decode($enc_string), $encrypt_method, $key, 0, $iv);
}