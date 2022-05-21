# StuMP90/yii2-redactor

A redactor extension for Yii2 Framework.
This version is a fork of yiidoc/yii2-redactor to allow some additional
settings and options.

For install, replace "yiidoc/" with "stump90/" along with a repository if this
has not been published on packagelist yet...

## Changes

### English (UK) language added
    'clientOptions' => [
        ...
        'lang' => 'en_gb',
        ...
    ]

### .size()

.size() replaced with .length for JQuery compatibility.



# Original yiidoc/yii2-redactor Readme:


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiidoc/yii2-redactor "*"
```

 or
```
 "yiidoc/yii2-redactor": "*"
```

to the require section of your composer.json.

Configure
-----------------

Add to config file (config/web.php or common\config\main.php) 

```
    'modules' => [
        'redactor' => 'yii\redactor\RedactorModule',
    ],
```
or if you want to change the upload directory.
to path/to/uploadfolder
default value `@webroot/uploads`

```
    'modules' => [
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/path/to/uploadfolder',
            'uploadUrl' => '@web/path/to/uploadfolder',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
    ],
```

note: You need to create uploads folder and chmod and set security for folder upload
reference: [Protect Your Uploads Folder with .htaccess](http://tomolivercv.wordpress.com/2011/07/24/protect-your-uploads-folder-with-htaccess/),
[How to Setup Secure Media Uploads](http://digwp.com/2012/09/secure-media-uploads/)

Config view/form

```
<?= $form->field($model, 'body')->widget(\yii\redactor\widgets\Redactor::className()) ?>
```

or not use ActiveField

```
<?= \yii\redactor\widgets\Redactor::widget([
    'model' => $model,
    'attribute' => 'body'
]) ?>
```    
or config advanced redactor reference [Docs](http://imperavi.com/redactor/docs/)

```
<?= $form->field($model, 'body')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'imageManagerJson' => ['/redactor/upload/image-json'],
        'imageUpload' => ['/redactor/upload/image'],
        'fileUpload' => ['/redactor/upload/file'],
        'lang' => 'zh_cn',
        'plugins' => ['clips', 'fontcolor','imagemanager']
    ]
])?>
```
