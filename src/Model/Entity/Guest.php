<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Guest Entity.
 *
 * @property int $ID
 * @property string $Name
 * @property string $Code
 * @property bool $Active
 * @property int $Place_ID
 * @property \Cake\I18n\Time $LastActive
 */
class Guest extends Entity
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
