<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderProduct Entity.
 *
 * @property int $ID
 * @property int $Order_Guest_ID
 * @property int $Product_ID
 * @property int $Quantity
 * @property float $Price
 * @property float $PriceTotal
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\OrderGuest $order_guest
 */
class OrderProduct extends Entity
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
