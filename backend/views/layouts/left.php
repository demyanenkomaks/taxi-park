<aside class="main-sidebar">

    <section class="sidebar">
        <?php
        use mdm\admin\components\Helper;

        function thisPage($controller,$action="*"){
            if(!is_array($action)&&$action!='*')
            {
                $action = explode(",",$action);
            }
            $_this = \Yii::$app ;
            return ($_this->controller->id==$controller)&&($action=="*")?1:($_this->controller->id==$controller&&in_array($_this->controller->action->id,$action));
        }

//        debug(\Yii::$app->controller->id);
//        debug(\Yii::$app->controller->action->id);
//        die;

        $menuItems = [
            ['label' => 'Профиль', 'icon' => 'user', 'url' => ['/cabinet/index'], 'active' => thisPage( 'cabinet')],
            ['label' => 'Пользователи', 'icon' => 'users', 'url' => ['/user/index'], 'active' => thisPage( 'user')],
            ['label' => 'Обработка профилей', 'icon' => 'id-card', 'url' => ['/act-tested/index'], 'active' => thisPage( 'act-tested')],

            ['label' => 'Мои адреса', 'icon' => 'map-marker', 'url' => ['/passenger/routes/index'], 'active' => thisPage( 'routes')],
            ['label' => 'Мои заказы', 'icon' => 'map', 'url' => ['/passenger/order/index'], 'active' => thisPage( 'order')],
            ['label' => 'График работы', 'icon' => 'drivers-license', 'url' => ['/driver/driver-work/index'], 'active' => thisPage( 'driver-work')],
            [
                'label' => 'Контент сайта',
                'icon' => 'th-list',
                'url' => '#',
                'items' => [
                    [
                        'label' => 'Главная страница',
                        'icon' => 'th-list',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Пункты на главной', 'icon' => 'bars', 'url' => ['/main-names/index'], 'active' => thisPage('main-names')],
                            ['label' => 'Слайдер', 'icon' => 'bars', 'url' => ['/main-items/index?identifier=1'], 'active' => thisPage('')],
                            ['label' => 'О нас и наших услугах', 'icon' => 'bars', 'url' => ['/main-items/index?identifier=2'], 'active' => thisPage('')],
                            ['label' => 'Условия работы', 'icon' => 'bars', 'url' => ['/main-items/index?identifier=3'], 'active' => thisPage('')],
                            ['label' => 'О финансах', 'icon' => 'bars', 'url' => ['/main-items/index?identifier=4'], 'active' => thisPage('')],
                            ['label' => 'Причины отключения', 'icon' => 'bars', 'url' => ['/main-items/index?identifier=5'], 'active' => thisPage('')],
                        ],
                    ],
                    ['label' => 'Статические страницы', 'icon' => 'file-code-o', 'url' => ['/static-page/index'], 'active' => thisPage( 'static-page')],
                    ['label' => 'Загрузка картинок', 'icon' => 'file-image-o', 'url' => ['/file-manager/index'], 'active' => thisPage( 'file-manager')],
                ],
            ],
            [
                'label' => 'Доступы',
                'icon' => 'group',
                'url' => '#',
                'items' => [
                    ['label' => 'Маршруты', 'icon' => 'exchange', 'url' => ['/admin/route/'], 'active' => thisPage( 'route')],
                    ['label' => 'Права доступа', 'icon' => 'bars', 'url' => ['/admin/permission/'], 'active' => thisPage('permission')],
                    ['label' => 'Роли', 'icon' => 'user-times', 'url' => ['/admin/role/'], 'active' => thisPage('role')],
                    ['label' => 'Назначения', 'icon' => 'money', 'url' => ['/admin/assignment/'], 'active'=>thisPage('assignment')],
                ],
            ],
            ['label' => 'FAQ', 'icon' => 'exclamation-triangle', 'url' => ['/faq/index'], 'active' => thisPage( 'faq')],

        ];
        $menuItem = Helper::filter($menuItems);
        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $menuItem,
            ]
        ) ?>

    </section>

</aside>
