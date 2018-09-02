<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 02.09.2018
 * Time: 21:11
 */

declare(strict_types=1);

namespace Recruitment\Entity;

class Order
{
    public $items = [];

    public function __construct($id, $items, $totalPrice)
    {
        $this->items = [
            'id' => $id,
            'items' => $items,
            'total_price' => $totalPrice
        ];
    }

    /**
     * @return array
     */
    public function getDataForView(): array
    {
        return $this->items;
    }
}
