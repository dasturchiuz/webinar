<aside class="main-sidebar">

    <section class="sidebar">
        <?php if(\app\models\User::isAgent()): ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Alior.uz', 'options' => ['class' => 'header']],
                    ['label' => 'Панель управления', 'icon' => 'tachometer-alt', 'url' => ['/administration']],
                    [
                        'label' => 'Клиенты',
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/clientjuridical']],
                            ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/client']],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],


                    ['label' => 'Принять заказ', 'icon' => 'cart-arrow-down', 'url' => ['/administration/accepted-order/index']],
                    [
                        'label' => 'Принятые заказы',
                        'icon' => 'shopping-bag',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/history-order/me', 'client'=>'client_juridical']],
                            ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/history-order/me', 'client'=>'client']],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],
                    ['label' => 'Коментарии', 'icon' => 'comment-alt', 'url' => ['/administration/comments']],

                    [
                        'label' => 'Территория',
                        'icon' => 'globe',
                        'url' => '#',
                        'items' => [
                            ['label' => 'ПН', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>1]],
                            ['label' => 'ВТ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>2]],
                            ['label' => 'СР', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>3]],
                            ['label' => 'ЧТ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>4]],
                            ['label' => 'ПТ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>5]],
                            ['label' => 'СБ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>6]],
                            ['label' => 'ВС', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>7]],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],
                    ['label' => 'Чёрный список', 'icon' => 'lock', 'url' => ['/administration/black-list']],
                    [
                        'label' => 'Отчёты',
                        'icon' => 'signal',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/report/clientjuridical']],
                            ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/report/client']],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],

                ],
            ]
        ) ?>

        <?php endif;?>
        <?php if(\app\models\User::isCourier()): ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Alior.uz', 'options' => ['class' => 'header']],
                    ['label' => 'Панель управления', 'icon' => 'tachometer-alt', 'url' => ['/administration']],
                    [
                        'label' => 'Клиенты',
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/clientjuridical']],
                            ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/client']],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],[
                        'label' => 'Доставка',
                        'icon' => 'truck',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Все доставки', 'icon' => 'bars', 'url' => ['/administration/delivery/all']],
                            ['label' => 'Доставить сегодня', 'icon' => 'calendar-o', 'url' => ['/administration/delivery/today']],
                            ['label' => 'Доставка на завтра', 'icon' => 'calendar', 'url' => ['/administration/delivery/tomorrow']],
                            ['label' => 'Доставлено сегодня', 'icon' => 'calendar-check-o', 'url' => ['/administration/delivery/delivered']],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],


                    ['label' => 'Принять заказ', 'icon' => 'cart-arrow-down', 'url' => ['/administration/accepted-order/index']],
                    [
                        'label' => 'Принятые заказы',
                        'icon' => 'shopping-bag',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/history-order/me', 'client'=>'client_juridical']],
                            ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/history-order/me', 'client'=>'client']],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],
                    ['label' => 'Коментарии', 'icon' => 'comment-alt', 'url' => ['/administration/comments']],

                    [
                        'label' => 'Территория',
                        'icon' => 'globe',
                        'url' => '#',
                        'items' => [
                            ['label' => 'ПН', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>1]],
                            ['label' => 'ВТ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>2]],
                            ['label' => 'СР', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>3]],
                            ['label' => 'ЧТ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>4]],
                            ['label' => 'ПТ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>5]],
                            ['label' => 'СБ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>6]],
                            ['label' => 'ВС', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>7]],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],
                    ['label' => 'Чёрный список', 'icon' => 'lock', 'url' => ['/administration/black-list']],
                    ['label' => 'Должники', 'icon' => 'info-circle', 'url' => ['/administration/doljniki']],
                    [
                        'label' => 'Товары',
                        'icon' => 'tags',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Загрузка товара', 'icon' => 'share', 'url' => ['/administration/courier-actions/load-products']],
                            ['label' => 'Возврат товара', 'icon' => 'reply', 'url' => ['/administration/courier-actions/return-products']],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],
                    

                ],
            ]
        ) ?>

        <?php endif;?>

        <?php if(\app\models\User::isRegman()): ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Alior.uz', 'options' => ['class' => 'header']],
                    ['label' => 'Панель управления', 'icon' => 'tachometer-alt', 'url' => ['/administration']],
                    [
                        'label' => 'Клиенты',
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/clientjuridical']],
                            ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/client']],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],[
                        'label' => 'Доставка',
                        'icon' => 'truck',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Все доставки', 'icon' => 'bars', 'url' => ['/administration/delivery/all']],
                            ['label' => 'Доставить сегодня', 'icon' => 'calendar-o', 'url' => ['/administration/delivery/today']],
                            ['label' => 'Доставка на завтра', 'icon' => 'calendar', 'url' => ['/administration/delivery/tomorrow']],
                            ['label' => 'Доставлено сегодня', 'icon' => 'calendar-check-o', 'url' => ['/administration/delivery/delivered']],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],


                    ['label' => 'Принять заказ', 'icon' => 'cart-arrow-down', 'url' => ['/administration/accepted-order/index']],
                    [
                        'label' => 'Принятые заказы',
                        'icon' => 'shopping-bag',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/history-order/me', 'client'=>'client_juridical']],
                            ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/history-order/me', 'client'=>'client']],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],
                    ['label' => 'Коментарии', 'icon' => 'comment-alt', 'url' => ['/administration/comments']],

//                    [
//                        'label' => 'Территория',
//                        'icon' => 'globe',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'ПН', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>1]],
//                            ['label' => 'ВТ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>2]],
//                            ['label' => 'СР', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>3]],
//                            ['label' => 'ЧТ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>4]],
//                            ['label' => 'ПТ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>5]],
//                            ['label' => 'СБ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>6]],
//                            ['label' => 'ВС', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>7]],
//
//                        ],
//                        //'visible'=>\app\models\User::isSuperadmin()
//                    ],

                    ['label' => 'Чёрный список', 'icon' => 'lock', 'url' => ['/administration/black-list']],
                    ['label' => 'Должники', 'icon' => 'info-circle', 'url' => ['/administration/doljniki']],
                    ['label' => 'Агенты', 'icon' => 'file-code', 'url' => ['/administration/agent']],
                    ['label' => 'Курьеры', 'icon' => 'truck', 'url' => ['/administration/courier']],
                    [
                        'label' => 'Отчёты',
                        'icon' => 'signal',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/report/clientjuridical']],
                            ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/report/client']],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],

                ],
            ]
        ) ?>

        <?php endif;?>

        <?php if(\app\models\User::isManager()): ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Alior.uz', 'options' => ['class' => 'header']],
                    ['label' => 'Панель управления', 'icon' => 'tachometer-alt', 'url' => ['/administration']],
                    [
                        'label' => 'Клиенты',
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/clientjuridical']],
                            ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/client']],

                        ],
                        //'visible'=>\app\models\User::isSuperadmin()
                    ],
                    [
                        'label' => 'Товары',
                        'icon' => 'tags',
                        'url' => '#',
                        'items' => [

                                ['label' => 'Товары', 'icon' => 'tag', 'url' => ['/administration/product'],],
                                ['label' => 'Регистрация товара ', 'icon' => 'plus', 'url' => ['/administration/product/create'],],

                        ]
                    ],
                    [
                        'label' => 'Отправка товара',
                        'icon' => 'truck',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Заг. тав Курьеру', 'icon' => 'file-code', 'url' => ['/administration/courier-actions/today-load']],
                            ['label' => 'Воз. тав от Курьера', 'icon' => 'file-code', 'url' => ['/administration/courier-actions/today-return']],
                        ]
                    ],
                    ['label' => 'Принять заказ', 'icon' => 'cart-arrow-down', 'url' => ['/administration/accepted-order/index']],
                    [
                        'label' => 'Принятые заказы',
                        'icon' => 'shopping-bag',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/history-order/me', 'client'=>'client_juridical']],
                            ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/history-order/me', 'client'=>'client']],

                        ],
                    ],
                    ['label' => 'Коментарии', 'icon' => 'comment-alt', 'url' => ['/administration/comments']],
                    ['label' => 'Чёрный список', 'icon' => 'lock', 'url' => ['/administration/black-list']],
                    ['label' => 'Должники', 'icon' => 'info-circle', 'url' => ['/administration/doljniki']],
                    ['label' => 'Оплата от клиента', 'icon' => 'file-code', 'url' => ['/administration/payments/region-payments']],

                ],
            ]
        ) ?>

        <?php endif;?>


        <?php if(\app\models\User::isAdmin()): ?>
            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        ['label' => 'Alior.uz', 'options' => ['class' => 'header']],
                        ['label' => 'Панель управления', 'icon' => 'tachometer-alt', 'url' => ['/administration']],
                        [
                            'label' => 'Клиенты',
                            'icon' => 'users',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/clientjuridical']],
                                ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/client']],

                            ],
                            //'visible'=>\app\models\User::isSuperadmin()
                        ],
                        [
                            'label' => 'Сатрудники',
                            'icon' => 'users',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Менеджеры', 'icon' => 'user', 'url' => ['/administration/manager']],
                                ['label' => 'Рег.менеджеры', 'icon' => 'user', 'url' => ['/administration/regmanager']],
                                ['label' => 'Бухгалтеры', 'icon' => 'user', 'url' => ['/administration/buxgalters']],

                                ['label' => 'Агенты', 'icon' => 'user', 'url' => ['/administration/agent']],
                                ['label' => 'Курьеры', 'icon' => 'user', 'url' => ['/administration/courier']],

                            ],
                            //'visible'=>\app\models\User::isSuperadmin()
                        ],
                        ['label' => 'Принять заказ', 'icon' => 'cart-arrow-down', 'url' => ['/administration/accepted-order/index']],
                        [
                            'label' => 'Принятые заказы',
                            'icon' => 'shopping-bag',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/history-order/me', 'client'=>'client_juridical']],
                                ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/history-order/me', 'client'=>'client']],

                            ],
                            //'visible'=>\app\models\User::isSuperadmin()
                        ],
                        ['label' => 'Коментарии', 'icon' => 'comment-alt', 'url' => ['/administration/comments']],

//                        [
//                            'label' => 'Территория',
//                            'icon' => 'globe',
//                            'url' => '#',
//                            'items' => [
//                                ['label' => 'ПН', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>1]],
//                                ['label' => 'ВТ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>2]],
//                                ['label' => 'СР', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>3]],
//                                ['label' => 'ЧТ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>4]],
//                                ['label' => 'ПТ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>5]],
//                                ['label' => 'СБ', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>6]],
//                                ['label' => 'ВС', 'icon' => 'calendar-check-o', 'url' => ['/administration/week/by', 'week_num'=>7]],
//
//                            ],
//                            //'visible'=>\app\models\User::isSuperadmin()
//                        ],
                        ['label' => 'Чёрный список', 'icon' => 'lock', 'url' => ['/administration/black-list']],
                        ['label' => 'Должники', 'icon' => 'info-circle', 'url' => ['/administration/doljniki']],
                        [
                            'label' => 'Товары',
                            'icon' => 'tags',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Товары', 'icon' => 'tag', 'url' => ['/administration/product'],],
                                ['label' => 'Регистрация товара ', 'icon' => 'plus', 'url' => ['/administration/product/create'],],
                                //['label' => 'Приём товара', 'icon' => 'tachometer-alt', 'url' => ['#'],],


                            ]
                        ],
//                        [
//                            'label' => 'Отправка товара',
//                            'icon' => 'tachometer',
//                            'url' => '#',
//                            'items' => [
//                                ['label' => 'загрузка товара курьеру', 'icon' => 'file-code', 'url' => ['/administration/product'],],
//                                ['label' => 'возврат товара от курьера', 'icon' => 'file-code', 'url' => ['/administration/product/create'],],
//                            ]
//                        ],

                        ['label' => 'Склад', 'icon' => 'cart-arrow-down', 'url' => ['/administration/sklad']],

                        ['label' => 'Оплата от клиента', 'icon' => 'file-code', 'url' => ['/administration/payments/region-payments']],

                        [
                            'label' => 'Отчёты',
                            'icon' => 'signal',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/report/clientjuridical']],
                                ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/report/client']],

                            ],
                            //'visible'=>\app\models\User::isSuperadmin()
                        ],

                    ],
                ]
            ) ?>

        <?php endif;?>


        <?php if(\app\models\User::isBuxgalter()): ?>
            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        ['label' => 'Alior.uz', 'options' => ['class' => 'header']],
                        ['label' => 'Панель управления', 'icon' => 'tachometer-alt', 'url' => ['/administration']],
                        [
                            'label' => 'Клиенты',
                            'icon' => 'users',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/clientjuridical']],
                                ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/client']],

                            ],
                            //'visible'=>\app\models\User::isSuperadmin()
                        ],
                        ['label' => 'Агенты', 'icon' => 'user', 'url' => ['/administration/agent']],

                    ],
                ]
            ) ?>

        <?php endif;?>

        <?php if(\app\models\User::isSuperAdmin()): ?>
            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        ['label' => 'Alior.uz', 'options' => ['class' => 'header']],
                        ['label' => 'Панель управления', 'icon' => 'tachometer-alt', 'url' => ['/administration']],
                        [
                            'label' => 'Клиенты',
                            'icon' => 'users',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/clientjuridical']],
                                ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/client']],

                            ],
                            //'visible'=>\app\models\User::isSuperadmin()
                        ],
                        [
                            'label' => 'Сатрудники',
                            'icon' => 'users',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Админы', 'icon' => 'user', 'url' => ['/administration/admins']],
                                ['label' => 'Менеджеры', 'icon' => 'user', 'url' => ['/administration/manager']],
                                ['label' => 'Бухгалтеры', 'icon' => 'user', 'url' => ['/administration/buxgalters']],
                                ['label' => 'Рег.менеджеры', 'icon' => 'user', 'url' => ['/administration/regmanager']],
                                ['label' => 'Агенты', 'icon' => 'user', 'url' => ['/administration/agent']],
                                ['label' => 'Курьеры', 'icon' => 'user', 'url' => ['/administration/courier']],

                            ],
                            //'visible'=>\app\models\User::isSuperadmin()
                        ],


                        ['label' => 'Принять заказ', 'icon' => 'cart-arrow-down', 'url' => ['/administration/accepted-order/index']],
                        ['label' => 'Cтраницы', 'icon' => 'list', 'url' => ['/administration/page/index']],
                        [
                            'label' => 'Принятые заказы',
                            'icon' => 'shopping-bag',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/history-order/me', 'client'=>'client_juridical']],
                                ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/history-order/me', 'client'=>'client']],

                            ],
                            //'visible'=>\app\models\User::isSuperadmin()
                        ],
                        ['label' => 'Оплата от клиента', 'icon' => 'dollar-sign', 'url' => ['/administration/payments/all-payments'],],
                        ['label' => 'Search log', 'icon' => 'search', 'url' => ['/administration/searchlog/index'],],
                        [
                            'label' => 'Товары',
                            'icon' => 'tags',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Товары', 'icon' => 'tag', 'url' => ['/administration/product'],],
                                ['label' => 'Категории', 'icon' => 'list', 'url' => ['/administration/category'],],
                                ['label' => 'Регистрация товара ', 'icon' => 'plus', 'url' => ['/administration/product/create'],],
                                ['label' => 'Отзывы на товары', 'icon' => 'tachometer-alt', 'url' => ['/administration/reviews'], 'visible'=>\app\models\User::isSuperadmin() ],


                            ]
                        ],
                        [
                            'label' => 'Отправка и загрузка',
                            'icon' => 'truck',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Заг. тав Курьеру', 'icon' => 'file-code', 'url' => ['/administration/courier-actions/today-load']],
                                ['label' => 'Воз. тав от Курьера', 'icon' => 'file-code', 'url' => ['/administration/courier-actions/today-return']],
                            ]
                        ],

                        [
                            'label' => 'Настройки',
                            'icon' => 'cogs',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Способ оплаты', 'icon' => 'tachometer-alt', 'url' => ['/administration/paymethod', 'visible'=>\app\models\User::isSuperadmin()],],
                                ['label' => 'Условия доставки', 'icon' => 'tachometer-alt', 'url' => ['/administration/delivery-method', 'visible'=>\app\models\User::isSuperadmin()],],
                                ['label' => 'Единица измерения', 'icon' => 'tachometer-alt', 'url' => ['/administration/unit'], 'visible'=>\app\models\User::isSuperadmin(),],
                                ['label' => 'Производитель', 'icon' => 'tachometer-alt', 'url' => ['/administration/manufacturer'], 'visible'=>\app\models\User::isSuperadmin()],
                                ['label' => 'Тип уведомления', 'icon' => 'tachometer-alt', 'url' => ['/administration/notifytype'], 'visible'=>\app\models\User::isSuperadmin()],
                                ['label' => 'Организация', 'icon' => 'tachometer-alt', 'url' => ['/administration/organization'], 'visible'=>\app\models\User::isSuperadmin()],
                                ['label' => 'Вид деятельности', 'icon' => 'tachometer-alt', 'url' => ['/administration/statusshop'], 'visible'=>\app\models\User::isSuperadmin()],
                                ['label' => 'Страны', 'icon' => 'tachometer-alt', 'url' => ['/administration/strana'], 'visible'=>\app\models\User::isSuperadmin()],
                                ['label' => 'Область', 'icon' => 'tachometer-alt', 'url' => ['/administration/regions'], 'visible'=>\app\models\User::isSuperadmin()],
                                ['label' => 'Город ', 'icon' => 'tachometer-alt', 'url' => ['/administration/cities'], 'visible'=>\app\models\User::isSuperadmin()],
                            ],
                            'visible'=>\app\models\User::isSuperadmin()
                        ],
                        ['label' => 'Чёрный список', 'icon' => 'lock', 'url' => ['/administration/black-list']],
                        ['label' => 'Должники', 'icon' => 'info-circle', 'url' => ['/administration/doljniki']],
                        ['label' => 'Склад', 'icon' => 'cart-arrow-down', 'url' => ['/administration/sklad']],
                        ['label' => 'Коментарии', 'icon' => 'comment-alt', 'url' => ['/administration/comments']],

                        [
                            'label' => 'Отчёты',
                            'icon' => 'signal',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Юридическое лицо', 'icon' => 'user', 'url' => ['/administration/report/clientjuridical']],
                                ['label' => 'Физическое лицо', 'icon' => 'user', 'url' => ['/administration/report/client']],

                            ],
                            //'visible'=>\app\models\User::isSuperadmin()
                        ],

                    ],
                ]
            ) ?>

        <?php endif;?>

        <?php /*= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Alior.uz', 'options' => ['class' => 'header']],
                   // ['label' => 'Панель управления', 'icon' => 'tachometer-alt', 'url' => ['/administration']],

                    [
                        'label' => 'Товары',
                        'icon' => 'tachometer',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Товары', 'icon' => 'file-code', 'url' => ['/administration/product'],],
                            ['label' => 'Категории', 'icon' => 'tachometer-alt', 'url' => ['/administration/category'],],


                        ],
                        'visible'=>\app\models\User::isSuperadmin() || \app\models\User::isAdmin()
                    ],
					['label' => 'Продажи', 'icon' => 'fa fa-tags fw', 'url' => ['/administration/orders'], 'visible'=>\app\models\User::isSuperadmin() || \app\models\User::isAdmin()],
                    // [
                        // 'label' => 'Новости',
                        // 'icon' => 'tachometer',
                        // 'url' => '#',
                        // 'items' => [
                            // ['label' => 'Новости', 'icon' => 'file-code', 'url' => ['/administration/news'],  'visible'=>\app\models\User::isSuperadmin()],
                            // ['label' => 'Категории', 'icon' => 'tachometer-alt', 'url' => ['/administration/newscategory'],  'visible'=>\app\models\User::isSuperadmin()],


                        // ],
						// 'visible'=>\app\models\User::isSuperadmin()
                    // ],
                    //['label' => 'Отзывы', 'icon' => 'tachometer-alt', 'url' => ['/administration/reviews'], 'visible'=>\app\models\User::isSuperadmin() || \app\models\User::isAdmin() || \app\models\User::isRegman()],
//                    ['label' => 'Страницы', 'icon' => 'tachometer-alt', 'url' => ['/administration/page'],  'visible'=>\app\models\User::isSuperadmin()],


					['label' => 'Агенты', 'icon' => 'file-code', 'url' => ['/administration/agent'], 'visible'=>\app\models\User::isSuperadmin() || \app\models\User::isAdmin() || \app\models\User::isRegman()],
					['label' => 'Курьеры', 'icon' => 'truck', 'url' => ['/administration/courier'], 'visible'=>\app\models\User::isSuperadmin() || \app\models\User::isAdmin() || \app\models\User::isRegman()],
                    ['label' => 'Менеджеры', 'icon' => 'male', 'url' => ['/administration/manager'], 'visible'=>\app\models\User::isSuperadmin() || \app\models\User::isAdmin() || \app\models\User::isRegman()],
					['label' => 'Рег. менеджеры', 'icon' => 'male', 'url' => ['/administration/regmanager'], 'visible'=>\app\models\User::isSuperadmin() || \app\models\User::isAdmin()],
					['label' => 'Админ', 'icon' => 'user', 'url' => ['/administration/admins'],  'visible'=>\app\models\User::isSuperadmin()],
					//['label' => 'Cотрудников', 'icon' => 'user', 'url' => ['/administration/employees'], 'visible'=>\app\models\User::isSuperadmin()],

                    [
                        'label' => 'Настройки',
                        'icon' => 'cogs',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Способ оплаты', 'icon' => 'tachometer-alt', 'url' => ['/administration/paymethod', 'visible'=>\app\models\User::isSuperadmin()],],
                            ['label' => 'Условия доставки', 'icon' => 'tachometer-alt', 'url' => ['/administration/delivery-method', 'visible'=>\app\models\User::isSuperadmin()],],
                            ['label' => 'Единица измерения', 'icon' => 'tachometer-alt', 'url' => ['/administration/unit'], 'visible'=>\app\models\User::isSuperadmin(),],
                            ['label' => 'Производитель', 'icon' => 'tachometer-alt', 'url' => ['/administration/manufacturer'], 'visible'=>\app\models\User::isSuperadmin()],
                            ['label' => 'Тип уведомления', 'icon' => 'tachometer-alt', 'url' => ['/administration/notifytype'], 'visible'=>\app\models\User::isSuperadmin()],
                            ['label' => 'Организация', 'icon' => 'tachometer-alt', 'url' => ['/administration/organization'], 'visible'=>\app\models\User::isSuperadmin()],
                            ['label' => 'Вид деятельности', 'icon' => 'tachometer-alt', 'url' => ['/administration/statusshop'], 'visible'=>\app\models\User::isSuperadmin()],
                            ['label' => 'Страны', 'icon' => 'tachometer-alt', 'url' => ['/administration/strana'], 'visible'=>\app\models\User::isSuperadmin()],
                            ['label' => 'Область', 'icon' => 'tachometer-alt', 'url' => ['/administration/regions'], 'visible'=>\app\models\User::isSuperadmin()],
                            ['label' => 'Город ', 'icon' => 'tachometer-alt', 'url' => ['/administration/cities'], 'visible'=>\app\models\User::isSuperadmin()],
                        ],
                        'visible'=>\app\models\User::isSuperadmin()
                    ],
//                    ['label' => 'Debug', 'icon' => 'tachometer-alt', 'url' => ['/debug']],
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
//                    [
//                        'label' => 'Some tools',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Gii', 'icon' => 'file-code', 'url' => ['/gii'],],
//                            ['label' => 'Debug', 'icon' => 'tachometer-alt', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
                ],
            ]
        )*/?>

    </section>

</aside>
