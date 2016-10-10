<?php 

function Rec($text)
{
    $text = htmlspecialchars(trim($text), ENT_QUOTES);
    if (1 === get_magic_quotes_gpc()) 
    {
        $text = stripcslashes($text);
    }

    $text = nl2br($text);
    return $text;
}


?>