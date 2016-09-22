<?php

/**
 * Sidebar menu layout.
 *
 * @var \yii\web\View $this View
 *
 * icons: https://almsaeedstudio.com/themes/AdminLTE/pages/UI/icons.html
 */

use backend\widgets\Menu;
//use app\modules\admin\models\AdminAuth;

$controller = Yii::$app->controller;

echo Menu::widget(
    [
        'options' => [
            'class' => 'sidebar-menu',
        ],
        'encodeLabels' => false,
        'activateParents' => true,
        'items' => [
            [
                'label' => Yii::t('app', 'MAIN NAVIGATION'),
                'options' => ['class' => 'header']
            ],
            [
                'label' => '<span>' . Yii::t('admin', 'Content') . '</span>',
                'url' => '#',
                'icon' => 'fa-file-text',
                'option' => 'treeview',
                'visible' => (
                    Yii::$app->user->can('/post/index') || Yii::$app->user->can('/note/index') ||
                    Yii::$app->user->can('/category/index') || Yii::$app->user->can('/tag/index') ||
                    Yii::$app->user->can('/seo/index')
                ),
                'items' => [
                    [
                        'label' => Yii::t('admin', 'Posts'),
                        'url' => ['/post'],
                        'active' => $controller->id === 'post',
                        'visible' => Yii::$app->user->can('/post/index'),
                    ],
                    [
                        'label' => Yii::t('admin', 'Notes'),
                        'url' => ['/note'],
                        'active' => $controller->id === 'note',
                        'visible' => Yii::$app->user->can('/note/index'),
                    ],
                    [
                        'label' => Yii::t('admin', 'Categories'),
                        'url' => ['/category'],
                        'active' => $controller->id === 'category',
                        'visible' => Yii::$app->user->can('/category/index'),
                    ],
                    [
                        'label' => Yii::t('admin', 'Tags'),
                        'url' => ['/tag'],
                        'active' => $controller->id === 'tag',
                        'visible' => Yii::$app->user->can('/tag/index'),
                    ],
                    [
                        'label' => Yii::t('admin', 'SEO'),
                        'url' => ['/seo'],
                        'active' => $controller->id === 'seo',
                        'visible' => Yii::$app->user->can('/seo/index'),
                    ],
                ]
            ],
            [
                'label' => '<span>' . Yii::t('admin', 'Administrators') . '</span>',
                'url' => ['/administrator'],
                'icon' => 'fa-group',
                'active' => $controller->id === 'administrator',
                'visible' => Yii::$app->user->can('/administrator/index'),
            ],
            [
                'label' => '<span>' . Yii::t('admin', 'Settings') . '</span>',
                'url' => '#',
                'icon' => 'fa-cogs',
                'option' => 'treeview',
                'visible' => Yii::$app->user->can('/setting/index') || Yii::$app->user->can('/sms-text/index'),
                'items' => [
                    [
                        'label' => Yii::t('admin', 'Settings'),
                        'url' => ['/setting'],
                        'active' => $controller->id === 'setting',
                        'visible' => Yii::$app->user->can('/setting/index'),
                    ],
                    [
                        'label' => '<span>' . Yii::t('admin', 'Data cleaning') . '</span>',
                        'url' => ['/data'],
                        'active' => $controller->id === 'data',
                        'visible' => Yii::$app->user->can('/data/index'),
                    ],
                ]
            ],
            [
                'label' => '<span>' . Yii::t('admin', 'Translations') . '</span>',
                'url' => '#',
                'icon' => 'fa-language',
                'option' => 'treeview',
                'visible' => Yii::$app->user->can('/translation-admin/index') || Yii::$app->user->can('/translation-public/index'),
                'items' => [
                    [
                        'label' => Yii::t('admin', 'Translation admin'),
                        'url' => ['/translation-admin'],
                        'active' => $controller->id === 'translation-admin',
                        'visible' => Yii::$app->user->can('/translation-admin/index'),
                    ],
                    [
                        'label' => Yii::t('admin', 'Translation public'),
                        'url' => ['/translation-public'],
                        'active' => $controller->id === 'translation-public',
                        'visible' => Yii::$app->user->can('/translation-public/index'),
                    ]
                ]
            ],
            [
                'label' => '<span>' . Yii::t('admin', 'Access rules') . '</span>',
                'url' => '#',
                'icon' => 'fa-user-secret',
                'option' => 'treeview',
                'visible' => (
                    Yii::$app->user->can('/rbac/assignment/index') || Yii::$app->user->can('/rbac/role/index') ||
                    Yii::$app->user->can('/rbac/permission/index') || Yii::$app->user->can('/rbac/route/index') ||
                    Yii::$app->user->can('/rbac/rule/index')
                ),
                'items' => [
                    [
                        'label' => Yii::t('admin', 'Assignment'),
                        'url' => ['/rbac/assignment'],
                        'active' => $controller->id === 'assignment',
                        'visible' => Yii::$app->user->can('/rbac/assignment/index'),
                    ],
                    [
                        'label' => Yii::t('admin', 'Role'),
                        'url' => ['/rbac/role'],
                        'active' => $controller->id === 'role',
                        'visible' => Yii::$app->user->can('/rbac/role/index'),
                    ],
                    [
                        'label' => Yii::t('admin', 'Permission'),
                        'url' => ['/rbac/permission'],
                        'active' => $controller->id === 'permission',
                        'visible' => Yii::$app->user->can('/rbac/permission/index'),
                    ],
                    [
                        'label' => Yii::t('admin', 'Route'),
                        'url' => ['/rbac/route'],
                        'active' => $controller->id === 'route',
                        'visible' => Yii::$app->user->can('/rbac/route/index'),
                    ],
                    [
                        'label' => Yii::t('admin', 'Rule'),
                        'url' => ['/rbac/rule'],
                        'active' => $controller->id === 'rule',
                        'visible' => Yii::$app->user->can('/rbac/rule/index'),
                    ],
                ]
            ],
        ]
    ]
);