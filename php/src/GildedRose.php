<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    const BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';
    const BRIE = 'Aged Brie';
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';
    const CONJURAS = 'Conjured Mana Cake';

    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if($this->isBrie($item)){
                if($item->quality < 50) $item->quality++;
                if($item->quality < 50 and $item->sellIn < 0) $item->quality++;
            }
            if($this->isBackstage($item)){
                if($item->sellIn < 1) $item->quality = 0;
                else {
                    if ($item->quality < 50) $item->quality++;
                    if ($item->sellIn < 11 and $item->quality < 50) $item->quality++;
                    if ($item->sellIn < 6 and $item->quality < 50) $item->quality++;
                }
            }
            if($this->isConjuras($item)){
                if($item->quality > 0) $item->quality -= 2;
                if($item->sellIn < 0 and $item->quality > 0) $item->quality -=2;
            }
            if(!$this->isBrie($item) and !$this->isBackstage($item) and !$this->isConjuras($item) and !$this->isSulfuras($item)){
                if($item->quality > 0) $item->quality--;
                if($item->sellIn < 0 and $item->quality > 0) $item->quality--;
            }
        }
    }
    private function isBrie(Item $item): bool{
        return $item->name == self::BRIE;
    }
    private function isBackstage(Item $item): bool{
        return $item->name == self::BACKSTAGE;
    }
    private function isSulfuras(Item $item): bool{
        return $item->name == self::SULFURAS;
    }
    private function isConjuras(Item $item): bool{
        return $item->name == self::CONJURAS;
    }
}
