<?php
function getRandom($a,$b){
    return rand($a,$b);
  }

  function getRandomAlcool($a){
    $listeCocktail=array();
    $file = 'cocktailDB.json';
    $data = file_get_contents($file);
    $obj = json_decode($data,true);
    foreach ($obj['drinks'] as $drink ) {
      if($drink['strIngredient1'] == $a){
        $listeCocktail[]=$drink;
      }
    }

    $nb=getRandom(0,count($listeCocktail));

    return $listeCocktail[$nb];
  }

  if (isset ($_GET['alcool'])){
    $resultat=getRandomAlcool($_GET['alcool']);
  }
  else
  {
    $resultat = array('error' => "no parameters", "use" => "url?alcool=nomAlcool");
  }
  echo json_encode($resultat);

 ?>
