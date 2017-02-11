XML Sitemap Module for Yii2
==========================
Yii2 module for automatically generating [XML Sitemap](http://www.sitemaps.org/protocol.html).

* Configure the `cache` component of your application's configuration file, for example:

```php
'components' => [
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
]
```

* Add a new module in `modules` section of your application's configuration file, for example:

```php
'modules' => [
    'sitemap' => [
        'class' => frontend\modules\sitemap\Module',
        'models' => [
            // your models
            'app\modules\news\models\News',
            // or configuration for creating a behavior
            [
                'class' => 'app\modules\news\models\News',
                'behaviors' => [
					'sitemap' => [
						'class' => SitemapBehavior::className(),
						'scope' => function ($model) {
						    /** @var \yii\db\ActiveQuery $model */
						    $model->select(['url', 'lastmod']);
						    $model->andWhere(['is_deleted' => 0]);
						},
						'dataClosure' => function ($model) {
						    /** @var self $model */
						    return [
						        'loc' => Url::to($model->url, true),
						        'lastmod' => strtotime($model->lastmod),
						        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
						        'priority' => 0.8
						    ];
						}
					],
                ],
            ],
        ],
        'urls'=> [
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
        ],
        'enableGzip' => true, // default is false
        'cacheExpire' => 1, // 1 second. Default is 24 hours
    ],
],
```

* Add behavior in the AR models, for example:

```php
use frontend\modules\sitemap\behaviors\SitemapBehavior;

public function behaviors()
{
    return [
        'sitemap' => [
            'class' => SitemapBehavior::className(),
            'scope' => function ($model) {
                /** @var \yii\db\ActiveQuery $model */
                $model->select(['url', 'lastmod']);
                $model->andWhere(['is_deleted' => 0]);
            },
            'dataClosure' => function ($model) {
                /** @var self $model */
                return [
                    'loc' => Url::to($model->url, true),
                    'lastmod' => strtotime($model->lastmod),
                    'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                    'priority' => 0.8
                ];
            }
        ],
    ];
}
```

* Add a new rule for `urlManager` of your application's configuration file, for example:

```php
'urlManager' => [
    'rules' => [
        ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
    ],
],
```

Resources
---------
* [XML Sitemap](http://www.sitemaps.org/protocol.html)

* [News Sitemap](https://support.google.com/news/publisher/answer/74288?hl=en)

* [Image sitemaps](https://support.google.com/webmasters/an