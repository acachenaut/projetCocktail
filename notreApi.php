<?php


  if (isset ($_GET['alcool'])){
    do{

    $urlCocktail = "http://164.132.52.230/cocktailRandom.php?alcool=".$_GET['alcool'];

	  $curl = curl_init();

	  curl_setopt($curl, CURLOPT_URL, $urlCocktail);
	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	  $resultatRandomCocktail = curl_exec($curl);

	  curl_close($curl);

	  $cocktail = json_decode($resultatRandomCocktail,true);
  }while ($cocktail['strDrink']==null);

    $recetteAtraduire=urlencode($cocktail['strInstructions']);

    $urlTraduction = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20200325T134219Z.58726c5658221c9c.66519b955b3e3d2988042005cb584d29db19cd30&text=".$recetteAtraduire."&lang=en-fr&format=plain";

    $curl2 = curl_init();

	  curl_setopt($curl2, CURLOPT_URL, $urlTraduction);
	  curl_setopt($curl2, CURLOPT_RETURNTRANSFER, 1);

	  $resultatTraduction = curl_exec($curl2);

	  curl_close($curl2);

    $traduction = json_decode($resultatTraduction, true);


    if ($cocktail['strIngredient1']!=null){
      $ingredients=$cocktail['strIngredient1'];
    }
    if ($cocktail['strIngredient2']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient2'];
    }
    if ($cocktail['strIngredient3']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient3'];
    }
    if ($cocktail['strIngredient4']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient4'];
    }
    if ($cocktail['strIngredient5']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient5'];
    }
    if ($cocktail['strIngredient6']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient6'];
    }
    if ($cocktail['strIngredient7']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient7'];
    }
    if ($cocktail['strIngredient8']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient8'];
    }
    if ($cocktail['strIngredient9']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient9'];
    }
    if ($cocktail['strIngredient10']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient10'];
    }
    if ($cocktail['strIngredient11']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient11'];
    }
    if ($cocktail['strIngredient12']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient12'];
    }
    if ($cocktail['strIngredient13']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient13'];
    }
    if ($cocktail['strIngredient14']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient14'];
    }
    if ($cocktail['strIngredient14']!=null){
      $ingredients=$ingredients.",".$cocktail['strIngredient15'];
    }

    $ingredientsAtraduire=urlencode($ingredients);

    $urlTraductionIngredients = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20200325T134219Z.58726c5658221c9c.66519b955b3e3d2988042005cb584d29db19cd30&text=".$ingredientsAtraduire."&lang=en-fr&format=plain";

    $curl3 = curl_init();

	  curl_setopt($curl3, CURLOPT_URL, $urlTraductionIngredients);
	  curl_setopt($curl3, CURLOPT_RETURNTRANSFER, 1);

	  $resultatTraductionIngredients = curl_exec($curl3);

	  curl_close($curl3);

    $traductionIngredients = json_decode($resultatTraductionIngredients, true);


    $resultat = [ 'nom' => $cocktail['strDrink'], 'recette' => $traduction['text'][0], 'imageUrl' => $cocktail['strDrinkThumb'], 'ingredients' => $traductionIngredients['text'][0]];
  }
  else
  {
    $resultat = array('error' => "no parameters", "use" => "url?alcool=nomAlcool");
  }
  echo json_encode($resultat);

 ?>
