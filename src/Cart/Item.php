<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 01.09.2018
 * Time: 17:47
 */

declare(strict_types=1);

namespace Recruitment\Cart;

use InvalidArgumentException;
use Recruitment\Cart\Exception\QuantityTooLowException;
use Recruitment\Entity\Product;

class Item
{
    public $product;
    public $quantity;

    public function __construct(Product $product, $quantity)
    {
        $this->product = $product;
        if ($this->product->minQuantity > $quantity) {
            throw new InvalidArgumentException("Quantity is to low");
        } else {
            $this->quantity = $quantity;
        }
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->quantity * $this->product->price;
    }

    /**
     * @return float
     */
    public function getTotalPriceGross(): float
    {
        return $this->quantity * $this->product->getPriceGross();
    }

    /**
     * @param int $quantity
     * @throws QuantityTooLowException
     */
    public function setQuantity(int $quantity): void
    {
        if ($this->quantity > $quantity) {
            throw new QuantityTooLowException("Quantity is to low");
        } else {
            $this->quantity = $quantity;
        }
    }
}
