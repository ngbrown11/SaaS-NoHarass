<?php

//see http://php.net/manual/en/function.call-user-func-array.php how to use extensively
// if(isset($_GET['runFunction']) && function_exists($_GET['runFunction']))
// call_user_func($_GET['runFunction']);
// else
// echo "Function not found or wrong input";

$person = $_POST["message"] . "\n";
$messages =  explode(" ", $person);
// Write the contents to the file,
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time

// function test()
// {
// echo("test");
// }
//
// function submitMessage()
// {
// }


$harassmentMultiplier;
$bad_words_mild = array();
$bad_words_medium = array();
$bad_words_harsh = array();



$filename = 'badWordsMild.txt';
$myfile = fopen($filename, "r");
while(!feof($myfile)) {
    // echo fgets($myfile) . "<br>";
    $bad_words_mild[] = fgets($myfile);
}
fclose($myfile);

$filename = 'badWordsMedium.txt';
$myfile = fopen($filename, "r");
while(!feof($myfile)) {
    // echo fgets($myfile) . "<br>";
    $bad_words_medium[] = fgets($myfile);
}
fclose($myfile);

$filename = 'badWordsHarsh.txt';
$myfile = fopen($filename, "r");
while(!feof($myfile)) {
    // echo fgets($myfile) . "<br>";
    $bad_words_harsh[] = fgets($myfile);
}
fclose($myfile);


foreach ($messages as $word) {

  if(isset($word) && $word !== '') {
    foreach ($bad_words_mild as $badWord) {
      if (trim($word) === trim($badWord)) {
        $harassmentMultiplier = $harassmentMultiplier + 3;
      }
    }
  }
}

foreach ($messages as $word) {

  if(isset($word) && $word !== '') {
    foreach ($bad_words_medium as $badWord) {
      if (trim($word) === trim($badWord)) {
        $harassmentMultiplier = $harassmentMultiplier + 6;
      }
    }
  }
}

foreach ($messages as $word) {

  if(isset($word) && $word !== '') {
    foreach ($bad_words_harsh as $badWord) {
      if (trim($word) === trim($badWord)) {
        $harassmentMultiplier = $harassmentMultiplier + 9;
      }
    }
  }
}





echo $harassmentMultiplier * 3;
if ($harassmentMultiplier < 8) {
  $filename = 'sub.txt';
  file_put_contents($filename, $person, FILE_APPEND | LOCK_EX);
}



?>
