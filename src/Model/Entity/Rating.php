<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rating Entity.
 *
 * @property int $ID
 * @property string $Guest_Name
 * @property string $Comment
 * @property int $Question1
 * @property int $Question2
 * @property int $Question3
 * @property int $Question4
 * @property int $Question5
 * @property int $Guest_ID
 * @property int $Restaurant_ID
 */
class Rating extends Entity
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
