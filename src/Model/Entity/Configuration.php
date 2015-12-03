<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Configuration Entity.
 *
 * @property int $ID
 * @property int $Restaurant_ID
 * @property string $CurrencySign
 * @property string $WelcomeText
 * @property string $AdminText
 * @property string $PlaceText
 * @property string $NoteTextHolder
 * @property int $Archive
 * @property bool $CashEnabled
 * @property bool $MPEnabled
 * @property bool $GPEnabled
 * @property bool $ShowMainBadges
 * @property string $Question1
 * @property string $Question2
 * @property string $Question3
 * @property string $Question4
 * @property string $Question5
 */
class Configuration extends Entity
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
