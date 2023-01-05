<?php

declare(strict_types=1);

/**
 * 
 * Code review :
 * 
 * 1) Le switch case de la méthode statement peut être difficile à maintenir dans le futur 
 * (dans le cas ou on ajoute un nouveau type de film par exemple)
 * Il faudraut repenser la logique de ce switch case pour qu'elle soit plus facile à maintenir
 * 
 * 2) on pourrait ajouter une propriété point de fidélité dans la classe Customer
 * et la mettre à jour dans la méthode statement
 * ainsi on pourrait récuperer le nombre de points de fidélité avec un getter
 * je me demande meme si on ne devrait pas créer une classe PointsFidelite
 * 
 * 3) dans la méthode statement, il faudrait changer la variable $each par $rental, c'est plus parlant. 
 * pareil pour $thisAmount; on pourrait le remplacer par $rentalAmount
 * 
 * 4) toujours dans la méthode statement, on pourrait utiliser une approche gabarit pour la variable $result
 * on pourrait imaginer une fonction privée getHeader() qui retourne le nom du client et le titre de la facture
 * une fonction privée getFooter() qui retourne le total et le nombre de points de fidélité
 * et une fonction privée getBody() qui retourne le détail de la facture avec l'ensemble des films loués
 * 
 * 5) il faudrait importer la classe Movie et Rental avec un use
 * 
 * 6) il faudrait ajouter des tests unitaires pour cette classe
 * 
 * 7) enfin pour le calcul du prix, j'ai proposé d'utiliser une class Price qui contiendrait la méthode getCharge
 * donc les calculs serait facilité vu qu'on aura juste à appeler la méthode getCharge
 * 
 * 8) enfin il faudrait placer les propriétés de la classe Customer en haut de la classe
 */
namespace App;


class Customer
{
    public function __construct(String $name)
    {
        $this->name = $name;
    }

    public function addRental(Rental $rental)
    {
        return $this->rentals[] = $rental;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function statement(): string {
        $totalAmount = 0.0;
        $frequentRenterPoints = 0;
        $result = "Rental Record for " . $this->getName() . "\n";

        foreach ($this->rentals as $each){
           $thisAmount = 0.0;

           /* @var $each Rental */
           // determines the amount for each line
           switch($each->getMovie()->getPriceCode()) {
               case Movie::REGULAR:
                   $thisAmount += 2;
                   if($each->getDaysRented() > 2)
                       $thisAmount += ($each->getDaysRented() - 2) * 1.5;
                   break;
               case Movie::NEW_RELEASE:
                   $thisAmount += $each->getDaysRented() * 3;
                   break;
               case Movie::CHILDREN:
                   $thisAmount += 1.5;
                   if($each->getDaysRented() > 3) {
                       $thisAmount += ($each->getDaysRented() - 3) * 1.5;
                   }
                   break;
           }

           $frequentRenterPoints++;

           if($each->getMovie()->getPriceCode() == Movie::NEW_RELEASE
                && $each->getDaysRented() > 1)
               $frequentRenterPoints++;

            $result .= "\t" . $each->getMovie()->getTitle() . "\t"
                . number_format($thisAmount, 1) . "\n";
            $totalAmount += $thisAmount;

        }

        $result .= "You owed " . number_format($totalAmount, 1)  . "\n";
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points\n";

        return $result;
    }

    private string $name;
    private array $rentals = [];
}
