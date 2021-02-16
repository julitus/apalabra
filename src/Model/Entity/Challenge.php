<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Challenge Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $time
 * @property string|null $code
 * @property float $points
 * @property int $rows
 * @property int $attemps
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Question[] $questions
 */
class Challenge extends Entity
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
        'name' => true,
        'time' => true,
        'code' => true,
        'points' => true,
        'rows' => true,
        'attemps' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'questions' => true,
    ];
}
