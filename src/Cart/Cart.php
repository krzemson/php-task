<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 02.09.2018
 * Time: 14:46
 */

declare(strict_types=1);

namespace Recruitment\Cart;

use Recruitment\Entity\Order;
use Recruitment\Entity\Product;

class Cart
{
    public $item;
    public $items = [];

    /**
     * @param Product $product
     * @param $quantity
     * @return Cart
     */
    public function addProduct(Product $product, $quantity = 1): Cart
    {

        $id = $product->id;

        if (sizeof($this->items) > 0) {
            foreach ($this->items as $item) {
                if ($item->getProduct()->id === $id) {
                    $newQuantity = $item->getQuantity() + $quantity;
                    $item->setQuantity($newQuantity);
                    break;
                } else {
                    $this->item = new Item($product, $quantity);
                    $this->items[] = $this->item;
                    break;
                }
            }
        } else {
            $this->item = new Item($product, $quantity);
            $this->items[] = $this->item;
        }



        return $this;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        $totalPrice = 0;
        foreach ($this->items as $item) {
            $totalPrice = $item->getTotalPrice() + $totalPrice;
        }

        return $totalPrice;
    }

    /**
     * @param $index
     * @return Item
     */
    public function getItem($index): Item
    {
        if (isset($this->items[$index])) {
            return $this->items[$index];
        } else {
            throw new \OutOfBoundsException("Not found Item");
        }
    }

    /**
     * @param Product $product
     */
    public function removeProduct(Product $product): void
    {
        $id = $product->id;

        $found = false;

        $index = 0;

        foreach ($this->items as $key => $item) {
            if ($item->getProduct()->id === $id) {
                $found = true;
                $index = $key;
                break;
            }
        }

        if ($found) {
            array_splice($this->items, $index, 1);
        }
    }

    /**
     * @param Product $product
     * @param int $quantity
     */
    public function setQuantity(Product $product, int $quantity): void
    {
        $id = $product->id;
        if (sizeof($this->items) > 0) {
            foreach ($this->items as $item) {
                if ($item->getProduct()->id === $id) {
                    $item->setQuantity($quantity);
                    break;
                } else {
                    $this->addProduct($product, $quantity);
                }
            }
        } else {
            $this->addProduct($product, $quantity);
        }
    }

    /**
     * @param int $id
     * @return Order
     */
    public function checkout(int $id): Order
    {
        $newItems = [];
        foreach ($this->items as $item) {
            $newItems[] = [
                'id' => $item->getProduct()->id,
                'quantity' => $item->getQuantity(),
                'total_price' => $item->getTotalPrice()
            ];
        }

        $order = new Order($id, $newItems, $this->getTotalPrice());

        foreach ($this->items as $item) {
            $this->removeProduct($item->getProduct());
        }

        return $order;
    }
}
