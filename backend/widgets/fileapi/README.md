Yii2 FileAPI widget.
==================
This widget is a Yii 2 wrapper of [FileAPI](https://github.com/RubaXa/jquery.fileapi) plugin.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist rubaxa/fileapi "*"
```

or add

```
"rubaxa/fileapi": "*"
```

to the require section of your `composer.json` file.

Usage:
------

```php
// MyController.php

use backend\widgets\fileapi\actions\UploadAction as FileAPIUpload;
...

public function actions()
{
    return [
        'fileapi-upload' => [
            'class' => FileAPIUpload::className(),
            'path' => '/path/to/temp/files'
        ]
    ];
}
```

```php
// MyModel.php

use backend\widgets\fileapi\behaviors\UploadBehavior;
...

public function behaviors()
{
    return [
        'uploadBehavior' => [
            'class' => UploadBehavior::className(),
            'attributes' => [
                'preview_url' => [
                    'path' => '/path/to/previews',
                    'tempPath' => '/path/to/temp/files/previews',
                    'url' => '/url/to/previews'
                ],
                'image_url' => [
                    'path' => '/path/to/images',
                    'tempPath' => '/path/to/temp/files/images',
                    'url' => '/url/to/images'
                ]
            ]
        ]
    ];
}
```

```php
// _form.php

use backend\widgets\fileapi\Widget as FileAPI;
...

echo $form->field($model, 'preview_url')->widget(
    FileAPI::className(),
    [
        'settings' => [
            'url' => ['/controller/fileapi-upload']
        ]
    ]
);
```
