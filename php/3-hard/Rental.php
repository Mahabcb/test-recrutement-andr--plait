<?php
declare(strict_types=1);

/**
 * code review :
 * 
 * 
 * Améliorations possibles :
 * 1) ça serait préférable de déclarer les propriétés en haut de la classe pour les rendre plus lisibles
 * 2) On pourrait utiliser des getters et setters pour les propriétés movie et daysRented et supprimer le constructeur
 * 3) on pourrait rajouter une propriété rentedAt qui ferait référence à la date de location
 * 4) il faudrait importer la classe Movie avec un use
 * 
 * Si on ajoute une propriété rentedAt, on pourrait refactoriser le code de la méthode getCharge de Price
 * en utilisant la méthode diff de la classe DateTime et donc calculer le nombre de jours de location
 * Je pense que ces modifications faciliteront la lecture du code et la compréhension de la logique de calcul du prix
 * ainsi que les tests unitaires
 * 
 * (j'ai mis un exemple de code dans le commentaire plus bas)
 * 
 */

namespace App;


class Rental
{
    public function __construct(Movie $movie, int $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    public function getDaysRented(): int
    {
        return $this->daysRented;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }

    private Movie $movie;
    private int $daysRented;
}

/**
 * namespace App;
 * use App\Movie;
 * 
 * class Rental
 * {
 * 
 * private Movie $movie;
 * private Datetime $rentedAt;
 * 
 * public function getMovie(): Movie
 * {
 * return $this->movie;
 * }
 * 
 * public function getRentedAt(): Datetime
 * {
 * return $this->rentedAt;
 * }
 * 
 * public function setRentedAt(Datetime $rentedAt): self
 * {
 * $this->rentedAt = $rentedAt;
 * }
 * 
 * 
 * public function getDaysRented(): int
 * {
 * return $this->rentedAt->diff(new Datetime())->days;
 * }
 */
