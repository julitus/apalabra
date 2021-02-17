<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Record Entity
 *
 * @property int $id
 * @property int $player_id
 * @property int $challenge_id
 * @property int $result_id
 * @property float $score
 * @property int $time
 * @property int $successful
 * @property int $wrong
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Player $player
 * @property \App\Model\Entity\Challenge $challenge
 * @property \App\Model\Entity\Result $result
 */
class Record extends Entity
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
        'player_id' => true,
        'challenge_id' => true,
        'result_id' => true,
        'score' => true,
        'time' => true,
        'successful' => true,
        'wrong' => true,
        'created' => true,
        'player' => true,
        'challenge' => true,
        'result' => true,
    ];
}
