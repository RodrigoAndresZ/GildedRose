<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{

    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }

    public function testBrieUpdateQuality(): void
    {
        $items = [new Item('Aged Brie', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(11, $items[0]->quality);
    }

    public function testBackstageUpdateQualityLess10Days(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 9, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(12, $items[0]->quality);
    }

    public function testBackstageUpdateQualityLess5Days(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 2, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(13, $items[0]->quality);
    }

    public function testBackstageUpdateQuality0Days(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }

    public function testSulfurasQualityNoChange(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 32, 36)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(36, $items[0]->quality);
    }

    public function testItemNegativeSellInDecrease2(): void
    {
        $items = [new Item('Foo', -1, 36)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(34, $items[0]->quality);
    }

    public function testBackstageNegativeSellIn(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', -1, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }

    public function testSulfurasNegativeSellIn(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', -1, 36)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(36, $items[0]->quality);
    }

    public function testConjurasDoubleDecrease(): void
    {
        $items = [new Item('Conjured Mana Cake', 10, 36)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(34, $items[0]->quality);
    }

    public function testOver50(): void
    {
        $items = [new Item('Aged Brie', 10, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(50, $items[0]->quality);
    }
}
