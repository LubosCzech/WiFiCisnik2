<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Note Entity.
 *
 * @property int $ID
 * @property int $OrderGuest_ID
 * @property string $Text
 * @property int $Guest_ID
 */
class Note extends Entity
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
        '*' => true,
        'ID' => false,
    ];
}
