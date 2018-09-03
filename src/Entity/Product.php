<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 31.08.2018
 * Time: 20:44
 */
declare(strict_types=1);

namespace Recruitment\Entity;

use InvalidArgumentException;
use Recruitment\Entity\Exception\InvalidUnitPriceException;

class Product
{

    public $id;
    public $name;
    public $price;
    public $minQuantity = 1;
    public $taxes = [
        '0%' => 1,
        '5%' => 1.05,
        '8%' => 1.08,
        '23%' => 1.23
    ];

    public $tax;

    /**
     * @param int $id
     * @return Product
     */
    public function setId(int $id): Product
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $tax
     * @return Product
     */
    public function setTax(string $tax): Product
    {
        $this->tax = $this->taxes[$tax];

        return $this;
    }

    /**
     * @return float
     */
    public function getPriceGross(): float
    {
            return $this->price * $this->tax;
    }

    /**
     * @param float $price
     * @return Product
     * @throws InvalidUnitPriceException
     */
    public function setUnitPrice(float $price): Product
    {
        if ($price <= 0) {
            throw new InvalidUnitPriceException("Price is less or equal 0");
        } else {
            $this->price = $price;
        }

        return $this;
    }

    /**
     * @param int $minQuantity
     * @return Product
     */
    public function setMinimumQuantity(int $minQuantity): Product
    {
        if ($minQuantity < 1) {
            throw new InvalidArgumentException('Quantity must be bigger than 0');
        } else {
            $this->minQuantity = $minQuantity;
        }
        return $this;
    }
}
