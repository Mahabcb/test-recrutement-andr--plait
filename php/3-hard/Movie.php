<?php
declare(strict_types=1);

/**
 * CODE REVIEW:
 * 
 * La fonction de cette class est assez clair : elle représente un film
 * Les noms des variables sont assez explicites
 * 
 * On a deux propriétés title et code prix avec deux méthodes getPriceCode et setPriceCode
 * On pourrait rajouter une méthode getTitle pour récupérer le nom du film 
 * Ainsi qu'une méthode setTitle pour modifier le nom du film. ça nous permettrait de retirer le constructeur
 * Si on a une méthode setPricecode et setTittle, on peut retirer le constructeur
 * La fonction setPrice code ne retourne rien : on peut la modifier pour qu'elle retourne self
 * 
 * Si on veut aller plus loin, on pourrait même se poser la question de la responsabilité de cette classe;
 * Est-ce que cette classe devrait être responsable de la logique de calcul du prix d'un film ?
 * On pourrait  refactoriser ce code en utilisant l'héritage et l'agrégation au lieu de constantes pour les différents codes de prix;
 * par ecemple, on pourrait créer une classe abstraite Price qui contient la méthode getCharge et ensuite les classes héritant de Price (ChildrenPrice, RegularPrice, NewReleasePrice)
 * Ensuite dans cette classe Movie on utilise l'agrégation pour créer une propriété price qui est de type Price
 * 
 * En résumé cette class aurait la propriété titre et la propriété price qui est de type Price
 * et Price est une classe abstraite qui contient la méthode getCharge
 * et les classes ChildrenPrice, RegularPrice, NewReleasePrice héritent de Price
 * (une classe  = une responsabilité = une raison de changer = une raison de tester selon SOLID)
 * 
 * Enfin il faudrait rajouter des tests unitaires pour cette classe
 * 
 */

namespace App;


class Movie
{
    public const CHILDREN = 2;
    public const REGULAR = 0;
    public const NEW_RELEASE = 1;

    private string $title;
    private int $priceCode;

    public function __construct(string $title, int $priceCode)
    {
        $this->title = $title;
        $this->priceCode = $priceCode;
    }

    public function getPriceCode(): int
    {
        return $this->priceCode;
    }

    public function setPriceCode(int $code)
    {
        return $this->priceCode = $code;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}

// abstract class Price // dans un fichier séparé avec le namespace App\Price
// {
//     abstract public function getCharge(int $daysRented): float;
// }

// class ChildrenPrice extends Price // dans un fichier séparé avec le namespace App\Price
// {
//     public function getCharge(int $daysRented): float
//     {
//         $result = 1.5;
//         if ($daysRented > 3) {
//             $result += ($daysRented - 3) * 1.5;
//         }
//         return $result;
//     }
// }

// class NewReleasePrice extends Price // dans un fichier séparé avec le namespace App\Price
// {
//     public function getCharge(int $daysRented): float
//     {
//         return $daysRented * 3;
//     }
// }

// class RegularPrice extends Price // dans un fichier séparé avec le namespace App\Price
// {
//     public function getCharge(int $daysRented): float
//     {
//         $result = 2;
//         if ($daysRented > 2) {
//             $result += ($daysRented - 2) * 1.5;
//         }
//         return $result;
//     }
// }

// class Movie
// {
//     private string $title;
//     private Price $price;
//  
//     public function getPrice(): Price
//     {
//         return $this->price;
//     }
//
//     public function setPrice(Price $price): self
//     {
//         $this->price = $price;
//         return $this;
//     }
//
//     public function getTitle(): string
//     {
//         return $this->title;
//     }
//
//     public function setTitle(string $title): self
//     {
//         $this->title = $title;
//         return $this;
//     }
// }