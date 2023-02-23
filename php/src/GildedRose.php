<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    const BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';
    const BRIE = 'Aged Brie';
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';

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

            if ($item->name == self::BRIE or $item->name == self::BACKSTAGE) {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == self::BACKSTAGE) {
                        if ($item->sellIn < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sellIn < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            } else {
                if ($item->quality > 0) {
                    if ($item->name != self::SULFURAS) {
                        $item->quality = $item->quality - 1;
                    }
                }


            }

            if ($item->name != self::SULFURAS) {
                $item->sellIn = $item->sellIn - 1;
            }

            if ($item->sellIn < 0) {
                if ($item->name != self::BRIE) {
                    if ($item->name != self::BACKSTAGE) {
                        if ($item->quality > 0) {
                            if ($item->name != self::SULFURAS) {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        $item->quality = 0;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}
