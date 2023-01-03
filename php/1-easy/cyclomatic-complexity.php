<?php
/**
 * CODE REVIEW : 
 * 
 * Le nom des variables est clair et explicite et le nom de la fonction aussi.
 * On comprend ce que le code fait sans avoir besoin de documentation; ça c'est top
 * 
 * J'ai remarqué quelques petites erreurs dans ce code (des fautes de frappes pour les noms des unités de mesure par exemple TB au lieu de PB, et ZB au lieu de YB)
 * Ce code n'est pas trop compliqué à lire mais je pense qu'on peut le factoriser pour qu'il soit plus lisible et maintenable :)
 * Je te propose ces différentes solutions :
 * 
 * 1) Le code ne gère pas encore le cas ou l'argument $bytes est négatif, on peut le gérer en ajoutant une condition au début de la fonction
 * 2) On pourrait utiliser un tableau pour stocker les unités de mesure et les valeurs associées, et ensuite parcourir ce tableau pour trouver la bonne unité de mesure
 * ça permettrait aussi d'éviter les répétitions de code et les fautes de frappes.
 * 3) On pourrait stocker 1024 dans une constante pour que ce soit plus facile à maintenir
 * 4) Enfin on pourrait écrire des tests pour vérifier que le code fonctionne bien
 */

 // Voici le code que je te propose pour faciliter les tests et que ce code soit plus facile à réutiliser et moins répétitif

function convertSizeWithLoop($bytes, $precision = 2) {
  $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']; // on définit un tableau qui contient les unités de mesure
  define('KILO_MULTIPLE', 1024); // on définit une constante pour stocker la valeur 1024
  if($bytes >= 0) { // on gère le cas ou l'argument $bytes est négatif
      $precision = min($precision, 2); // on limite la précision à 2
      $unit = 'B'; // on définit l'unité de mesure par défaut

  foreach ($units as $u) {
    if ($bytes < KILO_MULTIPLE) { // on vérifie si la valeur est inférieure à 1024
      $unit = $u; // on définit l'unité de mesure
      break; // on arrête la boucle
    }
    $bytes /= KILO_MULTIPLE; // on divise la valeur par 1024
  }
  return round($bytes, $precision) . ' ' . $unit; // on retourne la valeur arrondie avec la bonne unité de mesure
  }
  return '0 B'; // on retourne 0 B si l'argument $bytes est négatif
}


function convertSize($bytes, $precision = 2) {
  $kilobytes = $bytes / 1024;

  if ($kilobytes < 1024) {
    return round($bytes, $precision) . ' KB';
  }

  $megabytes = $kilobytes / 1024;

  if ($megabytes < 1024) {
    return round($megabytes, $precision) . ' MB';
  }

  $gigabytes = $megabytes / 1024;

  if ($gigabytes < 1024) {
    return round($gigabytes, $precision) . ' GB';
  }

  $terabytes = $gigabytes / 1024;

  if ($terabytes < 1024) {
    return round($terabytes, $precision) . ' TB';
  }

  $petabytes = $terabytes / 1024;

  if ($petabytes < 1024) {
    return round($petabytes, $precision) . ' TB';
  }

  $exabytes = $petabytes / 1024;

  if ($exabytes < 1024) {
    return round($exabytes, $precision) . ' EB';
  }

  $zettabytes = $exabytes / 1024;

  if ($zettabytes < 1024) {
    return round($zettabytes, $precision) . ' ZB';
  }

  $yottabytes = $zettabytes / 1024;

  if ($yottabytes < 1024) {
    return round($yottabytes, $precision) . ' ZB';
  }

  $hellabyte = $yottabytes / 1024;

  if ($hellabyte < 1024) {
    return round($hellabyte, $precision) . ' HB';
  }
  
  return $bytes . ' B';
}
