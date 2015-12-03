<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Localization Entity.
 *
 * @property int $ID
 * @property string $Code
 * @property string $Czech
 * @property string $English
 * @property string $German
 * @property string $Slovak
 * @property string $Polish
 */
class Localization extends Entity
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
