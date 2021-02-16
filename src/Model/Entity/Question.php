<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Question Entity
 *
 * @property int $id
 * @property int $challenge_id
 * @property string $label
 * @property string $title
 * @property string $clue
 * @property string $answer
 * @property float $points
 *
 * @property \App\Model\Entity\Challenge $challenge
 */
class Question extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'challenge_id' => true,
        'label' => true,
        'title' => true,
        'clue' => true,
        'answer' => true,
        'points' => true,
        'challenge' => true,
    ];
}
