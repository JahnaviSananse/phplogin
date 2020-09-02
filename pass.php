<?php

// define('IV_SIZE', mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

function encrypt ($key, $payload) {
//   $iv = mcrypt_create_iv(IV_SIZE, MCRYPT_DEV_URANDOM);
//   $crypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $payload, MCRYPT_MODE_CBC, $iv);
//   $combo = $iv . $crypt;
//   $garble = base64_encode($iv . $crypt);
//   return $garble;
$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decrypt ($key, $garble) {
  $combo = base64_decode($garble);
  $iv = substr($combo, 0, IV_SIZE);
  $crypt = substr($combo, IV_SIZE, strlen($combo));
  $payload = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $crypt, MCRYPT_MODE_CBC, $iv);
  return $payload;
}


//:::::::::::: TESTING ::::::::::::


// $key = "secret-key-is-secret";
// $payload = "In 1435 the abbey came into conflict with the townspeople of Bamberg and was plundered.";

// ENCRYPTION
//$garble = encrypt($key, $payload);

// DECRYPTION
//$end_result = decrypt($key, $garble);

// Outputting Results
// echo "Encrypted: ", var_dump($garble), "<br/><br/>";
// echo "Decrypted: ", var_dump($end_result);

?>