<?php

declare(strict_types=1);

namespace RedCatGirl\YiiBootstrap386\Tests;

use RuntimeException;
use RedCatGirl\YiiBootstrap386\Carousel;

/**
 * Tests for Carousel widget.
 *
 * CarouselTest.
 */
final class CarouselTest extends TestCase
{
    public function testRender(): void
    {
        Carousel::counter(0);

        $html = Carousel::widget()
            ->items([
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">',
                    'caption' => '<h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=Second+slide" class="d-block w-100">',
                    'caption' => '<h5>Second slide label</h5><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=Third+slide" class="d-block w-100">',
                    'caption' => '<h5>Third slide label</h5><p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
            ])
            ->render();

        $expected = <<<'HTML'
        <div id="w0-carousel" class="carousel slide" data-bs-ride="carousel"><ol class="carousel-indicators"><li class="active" data-bs-target="#w0-carousel" data-bs-slide-to="0"></li>
        <li data-bs-target="#w0-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#w0-carousel" data-bs-slide-to="2"></li></ol><div class="carousel-inner"><div class="carousel-item active"><img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">
        <div class="d-none d-md-block carousel-caption"><h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p></div></div>
        <div class="carousel-item"><img src="https://via.placeholder.com/800x400?text=Second+slide" class="d-block w-100">
        <div class="d-none d-md-block carousel-caption"><h5>Second slide label</h5><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div></div>
        <div class="carousel-item"><img src="https://via.placeholder.com/800x400?text=Third+slide" class="d-block w-100">
        <div class="d-none d-md-block carousel-caption"><h5>Third slide label</h5><p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p></div></div></div><a class="carousel-control-prev" href="#w0-carousel" data-bs-slide="prev" role="button"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a>
        <a class="carousel-control-next" href="#w0-carousel" data-bs-slide="next" role="button"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></a></div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testCrossfade(): void
    {
        Carousel::counter(0);

        $html = Carousel::widget()
            ->withCrossfade()
            ->items([
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">',
                    'caption' => '<h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=Second+slide" class="d-block w-100">',
                    'caption' => '<h5>Second slide label</h5><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=Third+slide" class="d-block w-100">',
                    'caption' => '<h5>Third slide label</h5><p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
            ])
            ->render();
        $this->assertStringContainsString('class="carousel slide carousel-fade"', $html);
    }

    public function testControlsEmpty(): void
    {
        Carousel::counter(0);

        $html = Carousel::widget()
            ->controls([])
            ->items([
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">',
                    'caption' => '<h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-carousel" class="carousel slide" data-bs-ride="carousel"><ol class="carousel-indicators"><li class="active" data-bs-target="#w0-carousel" data-bs-slide-to="0"></li></ol><div class="carousel-inner"><div class="carousel-item active"><img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">
        <div class="d-none d-md-block carousel-caption"><h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p></div></div></div></div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testControlsException(): void
    {
        $this->expectException(RuntimeException::class);
        Carousel::widget()
            ->controls(
                [
                    '<span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span>',
                ],
            )
            ->items([
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">',
                    'caption' => '<h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
            ])
            ->render();
    }

    public function testItemContentEmpty(): void
    {
        $this->expectException(RuntimeException::class);
        Carousel::widget()
            ->items([
                [
                    'caption' => '<h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
            ])
            ->render();
    }

    public function testItemContentString(): void
    {
        Carousel::counter(0);

        $html = Carousel::widget()
            ->items([
                '<img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">',
            ])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-carousel" class="carousel slide" data-bs-ride="carousel"><ol class="carousel-indicators"><li class="active" data-bs-target="#w0-carousel" data-bs-slide-to="0"></li></ol><div class="carousel-inner"><div class="carousel-item active"><img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">
        </div></div><a class="carousel-control-prev" href="#w0-carousel" data-bs-slide="prev" role="button"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a>
        <a class="carousel-control-next" href="#w0-carousel" data-bs-slide="next" role="button"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></a></div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testWithOptions(): void
    {
        Carousel::counter(0);

        $html = Carousel::widget()
            ->items([
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">',
                    'caption' => '<h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
            ])
            ->options(['class' => 'testMe'])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-carousel" class="testMe carousel slide"><ol class="carousel-indicators"><li class="active" data-bs-target="#w0-carousel" data-bs-slide-to="0"></li></ol><div class="carousel-inner"><div class="carousel-item active"><img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">
        <div class="d-none d-md-block carousel-caption"><h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p></div></div></div><a class="carousel-control-prev" href="#w0-carousel" data-bs-slide="prev" role="button"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a>
        <a class="carousel-control-next" href="#w0-carousel" data-bs-slide="next" role="button"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></a></div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testShowIndicator(): void
    {
        Carousel::counter(0);

        $html = Carousel::widget()
            ->items([
                [
                    'content' => '<img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">',
                    'caption' => '<h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>',
                    'captionOptions' => [
                        'class' => ['d-none', 'd-md-block'],
                    ],
                ],
            ])
            ->withoutShowIndicators()
            ->render();
        $expected = <<<'HTML'
        <div id="w0-carousel" class="carousel slide" data-bs-ride="carousel"><div class="carousel-inner"><div class="carousel-item active"><img src="https://via.placeholder.com/800x400?text=First+slide" class="d-block w-100">
        <div class="d-none d-md-block carousel-caption"><h5>First slide label</h5><p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p></div></div></div><a class="carousel-control-prev" href="#w0-carousel" data-bs-slide="prev" role="button"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a>
        <a class="carousel-control-next" href="#w0-carousel" data-bs-slide="next" role="button"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></a></div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
