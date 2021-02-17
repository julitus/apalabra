<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Result Entity
 *
 * @property int $id
 * @property int $player_id
 * @property int $challenge_id
 * @property float $best_score
 * @property int $attemps
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Player $player
 * @property \App\Model\Entity\Challenge $challenge
 * @property \App\Model\Entity\Record[] $records
 */
class Result extends Entity
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
        'best_score' => true,
        'attemps' => true,
        'created' => true,
        'modified' => true,
        'player' => true,
        'challenge' => true,
        'records' => true,
    ];
}
