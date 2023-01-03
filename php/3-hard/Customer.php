<?php

declare(strict_types=1);

/**
 * 
 * Code review :
 * 
 * 1) Le switch case de la méthode statement peut être difficile à maintenir dans le futur 
 * (dans le cas ou on ajoute un nouveau type de film par exemple)
 * 
 * 2) on pourrait ajouter une propriété point de fidélité dans la classe Customer
 * et la mettre à jour dans la méthode statement
 * 
 * 3) dans la méthode statement, il faudrait changer la variable $each par $rental, c'est plus parlant. pareil pour $thisAmount
 * on pourrait le remplacer par $rentalAmount
 * 
 * 4) toujours dans la méthode statement, on pourrait utiliser une approche gabarit pour la variable $result
 * on pourrait imaginer une fonction privée getHeader() qui retourne le nom du client et le titre de la facture
 * une fonction privée getFooter() qui retourne le total et le nombre de points de fidélité
 * et une fonction privée getBody() qui retourne le détail de la facture avec l'ensemble des films loués
 * 
 * 5) il faudrait importer la classe Movie et Rental avec un use
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
