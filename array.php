<?php

function encrypt($text, $s) 
{ 
    $result = ""; 
  
    // traverse text 
    for ($i = 0; $i < strlen($text); $i++) 
    { 
        // apply transformation to each  
        // character Encrypt Uppercase letters 
        if (ctype_upper($text[$i])) 
            $result = $result.chr((ord($text[$i]) +  
                               $s - 65) % 26 + 65); 
  
    // Encrypt Lowercase letters 
    else
        $result = $result.chr((ord($text[$i]) +  
                           $s - 97) % 26 + 97); 
    } 
  
    // Return the resulting string 
    return $result; 
} 
  
// Driver Code 
$text = "ATTACK.5"; 
$s = 3; 
echo json_encode("Text : " . strtolower($text)); 
echo json_encode("Cript: " . strtolower(encrypt($text, $s))); 

?>
