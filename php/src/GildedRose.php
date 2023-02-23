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
            switch ($item->name){
                case self::BRIE:
                {
                    if($item->quality < 50) $item->quality++;
                    if($item->quality < 50 and $item->sellIn < 0) $item->quality++;
                    break;
                }
                case self::BACKSTAGE:
                {
                    if($item->sellIn < 1) $item->quality = 0;
                    else {
                        if ($item->quality < 50) $item->quality++;
                        if ($item->sellIn < 11 and $item->quality < 50) $item->quality++;
                        if ($item->sellIn < 6 and $item->quality < 50) $item->quality++;
                    }
                    break;
                }
                case self::SULFURAS:
                {
                    break;
                }

                default:{
                    if($item->quality > 0) $item->quality--;
                    if($item->sellIn < 0 and $item->quality > 0) $item->quality--;
                }
            }
        }
    }
}
