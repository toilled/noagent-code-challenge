<?php

namespace src;

class Basket
{
    /** @var Offer|null */
    private ?Offer $offer;
    /** @var BasketItem[] */
    private array $items = [];

    public function __construct(Offer $offer = null)
    {
        if ($offer !== null) {
            $this->offer = $offer;
        }
    }

    /**
     * @throws DuplicateItem
     */
    public function addItem(BasketItem $item)
    {
        if (in_array($item, $this->items)) {
            throw new DuplicateItem("Item {$item->getCode()} is already in the basket!");
        }
        $this->items[] = $item;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function total(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getPrice();
        }

        if (isset($this->offer)) {
            $discountAmount = ($this->offer->getDiscountPercentage() / 100) * $total;
            $total -= $discountAmount;
        }

        return $total;
    }
}
