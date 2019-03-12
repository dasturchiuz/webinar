<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
<<<<<<< HEAD
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
=======

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/site.css',
        'css/bootstrapp.min.css',
        'css/bootstrap-custom.css',
        'css/uikit.css',
        'css/responsive.css',
        'fonts/fontawesome/css/fontawesome-all.min.css',
        'plugins/fancybox/fancybox.min.css',
        'plugins/owlcarousel/assets/owl.carousel.min.css',
        'plugins/owlcarousel/assets/owl.theme.default.min.css',
        'css/notifyMessage.min.css',
    ];
    public $js = [
        //'js/jquery-3.3.1.min.js',
        'js/jquery-migrate-1.4.1.min.js',
        'js/pusher.min.js',
        // 'js/InputSpinner.js',
        'js/bootstrap.bundle.min.js',
        'plugins/fancybox/fancybox.min.js',
        'plugins/owlcarousel/owl.carousel.min.js',
//        'js/InputSpinner.js',
        'js/script.js',

        'js/alior.js',
        'js/notifyMessage.min.js',


    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

>>>>>>> origin/master
}
