<?php
header('Content-Type: application/json');

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[rand(0, $max)];
    }
    return implode('', $pieces);
}

function errorMessage($number = 800){

    switch ($number) {
        case 801:
            $msg = 'Invalid service id.';
            break;

        case 802:
            $msg = 'Invalid auth method.';
            break;

        case 803:
            $msg = 'Invalid function method.';
            break;

        case 804:
            $msg = 'Invalid method.';
            break;

        case 805:
            $msg = 'This request needs a auth token.';
            break;

        case 806:
            $msg = 'invalid auth token.';
            break;
            
        case 807:
            $msg = 'This request needs an email and password.';
            break;

        case 808:
            $msg = 'Email address not found.';
            break;

        case 809:
            $msg = 'Invalid password.';
            break;
            
        case 810:
            $msg = 'This method requires a username input.';
            break;

        case 811:
            $msg = 'Username not found.';
            break;

        case 812:
            $msg = 'Missing data.';
            break;

        case 813:
            $msg = 'Invalid username.';
            break;

        case 814:
            $msg = 'Invalid name.';
            break;

        case 815:
            $msg = 'Invalid email.';
            break;

        case 816:
            $msg = 'Invalid password.';
            break;

        case 817:
            $msg = 'Username already taken.';
            break;

        case 818:
            $msg = 'Email already registered.';
            break;
            
        case 819:
            $msg = 'Email or username not found.';
            break;
            
        
        default:
            $msg = 'Server error.';
            break;
    }

    $data = ['status' => $number, 'message' => $msg];
    return $data;
}

/**
 * Encrypt a message
 * 
 * @param string $message - message to encrypt
 * @param string $key - encryption key
 * @return string
 */
function safeEncrypt($message, $key)
{
    $nonce = \Sodium\randombytes_buf(
        \Sodium\CRYPTO_SECRETBOX_NONCEBYTES
    );

    return base64_encode(
        $nonce.
        \Sodium\crypto_secretbox(
            $message,
            $nonce,
            $key
        )
    );
}

/**
 * Decrypt a message
 * 
 * @param string $encrypted - message encrypted with safeEncrypt()
 * @param string $key - encryption key
 * @return string
 */
function safeDecrypt($encrypted, $key)
{   
    $decoded = base64_decode($encrypted);
    $nonce = mb_substr($decoded, 0, \Sodium\CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
    $ciphertext = mb_substr($decoded, \Sodium\CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');

    return \Sodium\crypto_secretbox_open(
        $ciphertext,
        $nonce,
        $key
    );
}   

?>