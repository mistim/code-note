<?php
use frontend\modules\sitemap\behaviors\SitemapBehavior;
use yii\helpers\Url;
use common\models\Post;
use common\models\Note;
use common\models\Category;
use common\models\Tag;

return [
    'class' => 'frontend\modules\sitemap\Module',
    'models' => [
        // your models
        //'common\models\Post',
        //'common\models\Note',
        //'common\models\Category',
        //'common\models\Tag',
        [
            'class' => 'common\models\Post',
            'behaviors' => [
                'sitemap' => [
                    'class' => SitemapBehavior::className(),
                    'scope' => function ($model) {
                        /** @var \yii\db\ActiveQuery $model */
                        $model->select(['alias', 'updated_at']);
                        $model->andWhere(['status' => Post::STATUS_ACTIVE]);
                    },
                    'dataClosure' => function ($model) {
                        /** @var common\models\Post $model */
                        return [
                            'loc' => Url::to($model->alias, true),
                            'lastmod' => strtotime($model->updated_at),
                            'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                            'priority' => 0.8
                        ];
                    }
                ],
            ],
        ], [
            'class' => 'common\models\Note',
            'behaviors' => [
                'sitemap' => [
                    'class' => SitemapBehavior::className(),
                    'scope' => function ($model) {
                        /** @var \yii\db\ActiveQuery $model */
                        $model->select(['alias', 'updated_at']);
                        $model->andWhere(['status' => Note::STATUS_ACTIVE]);
                    },
                    'dataClosure' => function ($model) {
                        /** @var common\models\Note $model */
                        return [
                            'loc' => Url::to($model->alias, true),
                            'lastmod' => strtotime($model->updated_at),
                            'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                            'priority' => 0.8
                        ];
                    }
                ],
            ],
        ], [
            'class' => 'common\models\Category',
            'behaviors' => [
                'sitemap' => [
                    'class' => SitemapBehavior::className(),
                    'scope' => function ($model) {
                        /** @var \yii\db\ActiveQuery $model */
                        $model->select(['alias', 'updated_at']);
                        $model->andWhere(['status' => Category::STATUS_ACTIVE]);
                    },
                    'dataClosure' => function ($model) {
                        /** @var common\models\Category $model */
                        return [
                            'loc' => Url::to($model->alias, true),
                            'lastmod' => strtotime($model->updated_at),
                            'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                            'priority' => 0.8
                        ];
                    }
                ],
            ],
        ], [
            'class' => 'common\models\Tag',
            'behaviors' => [
                'sitemap' => [
                    'class' => SitemapBehavior::className(),
                    'scope' => function ($model) {
                        /** @var \yii\db\ActiveQuery $model */
                        $model->select(['alias']);
                        $model->andWhere(['status' => Tag::STATUS_ACTIVE]);
                    },
                    'dataClosure' => function ($model) {
                        /** @var common\models\Tag $model */
                        return [
                            'loc' => Url::to($model->alias, true),
                            'lastmod' => null, //strtotime($model->updated_at),
                            'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                            'priority' => 0.8
                        ];
                    }
                ],
            ],
        ],

    ],
    /*'urls'=> [
        // your additional urls
        [
            'loc' => '/news/index',
            'changefreq' => \frontend\modules\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
            'priority' => 0.8,
            'news' => [
                'publication'   => [
                    'name'          => 'Example Blog',
                    'language'      => 'en',
                ],
                'access'            => 'Subscription',
                'genres'            => 'Blog, UserGenerated',
                'publication_date'  => 'YYYY-MM-DDThh:mm:ssTZD',
                'title'             => 'Example Title',
                'keywords'          => 'example, keywords, comma-separated',
                'stock_tickers'     => 'NASDAQ:A, NASDAQ:B',
            ],
            'images' => [
                [
                    'loc'           => 'http://example.com/image.jpg',
                    'caption'       => 'This is an example of a caption of an image',
                    'geo_location'  => 'City, State',
                    'title'         => 'Example image',
                    'license'       => 'http://example.com/license',
                ],
            ],
        ],
    ],*/
    'enableGzip' => true, // default is false
    'cacheExpire' => 1, // 1 second. Default is 24 hours
];