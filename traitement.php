<?php
$NAME = $_GET['name'];
$WORD = $_GET['word'];

function isPalindrome($string) {
    $string = strtolower($string);
    $reverse = strrev($string);
    return $string == $reverse;
}

// Connect to the database
$base = new PDO('mysql:host=localhost; dbname=id20172939_ajax', 'id20172939_id20172939_root', 'C>3Gmt-4_2h3Fp)/');
$base->exec("SET CHARACTER SET utf8");

// Check if the name exists in the database
$query = $base->prepare("SELECT * FROM names WHERE name = :name");
$query->bindParam(':name', $NAME);
$query->execute();

$result = array();

if (isPalindrome($WORD)) {
    $result['palindrome'] = 'Le mot '.$WORD.' est un palindrome.';
} else {
    $result['palindrome'] = 'Le mot '.$WORD.' n\'est pas un palindrome.';
}

if ($query->rowCount() > 0) {
    $result['status'] = 'success';
    $result['message'] = 'Votre nom est présent dans la BDD.';
} else {
    $result['status'] = 'error';
    $result['message'] = 'Nom NON présent dans la BDD.';
}

echo json_encode($result);
?>
