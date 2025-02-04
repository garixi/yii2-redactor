<?php

namespace yii\redactor\actions;

use Yii;
use yii\base\Action;
use yii\redactor\models\FileUploadModel;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class FileUploadAction extends Action
{
    function run()
    {
        if (isset($_FILES)) {
            
            $dir = Yii::$app->request->get('dir');
            if($dir){
                Yii::$app->getModule('redactor')->authUserDir = $dir;
            }

            $model = new FileUploadModel();
            if ($model->upload()) {
                return $model->getResponse();
            } else {
                return ['error' => 'Unable to save file'];
            }
        }
    }

}
