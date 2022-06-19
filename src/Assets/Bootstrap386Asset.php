<?php

declare(strict_types=1);

namespace RedCatGirl\YiiBootstrap386\Assets;

use RedCatGirl\Jquery\JqueryAsset;
use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * Asset bundle for the Twitter bootstrap css files.
 *
 * BootstrapAsset.
 *
 * @package Bootstrap386
 */
final class Bootstrap386Asset extends AssetBundle
{
    public ?string $basePath = '@assets';

    public ?string $baseUrl = '@assetsUrl';

    public ?string $sourcePath = '@vendor/redcatgirl/bootstrap.386/dist';

    public array $css = [
        'css/bootstrap.css',
    ];

    public array $js = [
        'js/bootstrap.bundle.js',
    ];

    public array $depends = [
        JqueryAsset::class
    ];
}
