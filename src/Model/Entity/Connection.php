<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Connection Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $player_id
 * @property int $attemps
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Player $player
 */
class Connection extends Entity
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
        'user_id' => true,
        'player_id' => true,
        'attemps' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'player' => true,
    ];
}
