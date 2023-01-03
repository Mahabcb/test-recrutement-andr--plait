<?php
declare(strict_types=1);

/**
 * Code Review : 
 * 
 * On comprend ce que le code fait, mais il est difficile de le lire par rapport aux else if.
 * Je pense qu'on peut l'améliorer en découpant la méthode receive en plusieurs méthodes.
 * Aussi, je pense qu'il est mieux de définir des constantes pour les directions pour éviter les fautes de frappes
 * et faciliter la lecture du code ainsi que les tests.
 * 
 * Voici les suggestions que je propose :
 * 1) Comme je l'ai dit on peut découper la méthode receive; on peut créer deux méthode privés pour la rotation et le déplacement
 * et ensuite les utiliser dans la méthode receive.
 * 2) on peut définir des constantes pour les commandes de rotation et de déplacement
 * 3) on peut refactoriser la méthode receive en utilisant un foreach pour parcourir la séquence de commandes, on vérifie si la commande est une rotation ou un déplacement
 * et on appelle la méthode de rotation ou de déplacement en fonction de la commande.
 * 4) On peut utiliser des switch case pour les rotations et les déplacements pour éviter les else if
 */
namespace App;

class Rover
{
    private string $direction;
    private int $y;
    private int $x;

    public function __construct(int $x, int $y, string $direction)
    {
        $this->direction = $direction;
        $this->y = $y;
        $this->x = $x;
    }

    public function receive(string $commandsSequence): void
    {
        $commandsSequenceLenght = strlen($commandsSequence);
        for ($i = 0; $i < $commandsSequenceLenght; ++$i) {
            $command = substr($commandsSequence, $i, 1);
            if ($command === "l" || $command === "r") {
                // Rotate Rover
                if ($this->direction === "N") {
                    if ($command === "r") {
                        $this->direction = "E";
                    } else {
                        $this->direction = "W";
                    }
                } else if ($this->direction === "S") {
                    if ($command === "r") {
                        $this->direction = "W";
                    } else {
                        $this->direction = "E";
                    }
                } else if ($this->direction === "W") {
                    if ($command === "r") {
                        $this->direction = "N";
                    } else {
                        $this->direction = "S";
                    }
                } else {
                    if ($command === "r") {
                        $this->direction = "S";
                    } else {
                        $this->direction = "N";
                    }
                }
            } else {
                // Displace Rover
                $displacement1 = -1;

                if ($command === "f") {
                    $displacement1 = 1;
                }
                $displacement = $displacement1;

                if ($this->direction === "N") {
                    $this->y += $displacement;
                } else if ($this->direction === "S") {
                    $this->y -= $displacement;
                } else if ($this->direction === "W") {
                    $this->x -= $displacement;
                } else {
                    $this->x += $displacement;
                }
            }
        }
    }
}

// class Rover
// {
//     private const DIRECTION_NORTH = 'N';
//     private const DIRECTION_SOUTH = 'S';
//     private const DIRECTION_EAST = 'E';
//     private const DIRECTION_WEST = 'W';

//     private const COMMAND_ROTATE_LEFT = 'l';
//     private const COMMAND_ROTATE_RIGHT = 'r';
//     private const COMMAND_MOVE_BACKWARD = 'b';
//     private const COMMAND_MOVE_FORWARD = 'f';

//     private const DISPLACEMENT_BACKWARD = -1;
//     private const DISPLACEMENT_FORWARD = 1;

//     private string $direction;
//     private int $y;
//     private int $x;

//     public function __construct(int $x, int $y, string $direction)
//     {
//         $this->direction = $direction;
//         $this->y = $y;
//         $this->x = $x;
//     }

//     public function receive(string $commandsSequence): void
//     {
//         foreach (str_split($commandsSequence) as $command) {
//             if (in_array($command, [self::COMMAND_ROTATE_LEFT, self::COMMAND_ROTATE_RIGHT])) {
//                 $this->rotate($command);
//             } else {
//                 $this->move($command);
//             }
//         }
//     }

//  private function rotate(string $command): void

//     switch ($this->direction) {
//         case self::DIRECTION_NORTH:
//             $this->direction = $command === self::COMMAND_ROTATE_RIGHT ? self::DIRECTION_EAST : self::DIRECTION_WEST;
//             break;
//         case self::DIRECTION_SOUTH:
//             $this->direction = $command === self::COMMAND_ROTATE_RIGHT ? self::DIRECTION_WEST : self::DIRECTION_EAST;
//             break;
//         case self::DIRECTION_WEST:
//             $this->direction = $command === self::COMMAND_ROTATE_RIGHT ? self::DIRECTION_NORTH : self::DIRECTION_SOUTH;
//             break;
//         case self::DIRECTION_EAST:
//             $this->direction = $command === self::COMMAND_ROTATE_RIGHT ? self::DIRECTION_SOUTH : self::DIRECTION_NORTH;
//             break;
//     }

//     $this->direction = $direction;
// }


//     private function move(string $command): void
//     {
//     $displacement = $command === self::COMMAND_MOVE_BACKWARD ? self::DISPLACEMENT_BACKWARD : self::DISPLACEMENT_FORWARD;

//     switch ($this->direction) {
//         case self::DIRECTION_NORTH:
//             $this->y += $displacement;
//             break;
//         case self::DIRECTION_SOUTH:
//             $this->y -= $displacement;
//             break;
//         case self::DIRECTION_WEST:
//             $this->x -= $displacement;
//             break;
//         case self::DIRECTION_EAST:
//             $this->x += $displacement;
//             break;
//         }
//     }

// }