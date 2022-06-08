<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor\actions;

use Yii;
use yii\redactor\models\ImageUploadModel;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class ImageClipUploadAction extends \yii\base\Action
{
    function run()
    {
        //Yii::debug($_POST['contentType']);
        // e.g.
        // image/png
        // image/jpeg
        // image/webp
        // image/gif
        // text/plain
        // application/pdf
        
        $mimeType = $fileExt = $fileLink = "";
        $fileStatus = "Fail";
        switch ($_POST['contentType']) {
            case 'image/png':
                $mimeType = "PNG";
                $fileExt = "png";
                break;
            case 'image/jpeg':
                $mimeType = "JPG";
                $fileExt = "jpg";
                break;
            case 'image/webp':
                $mimeType = "WEBP";
                $fileExt = "webp";
                break;
            default:
                break;
        }
        if ($mimeType != "") {
            if ((isset($_POST['data'])) && ($_POST['data'] != "")) {
                $decodedData = base64_decode($_POST['data']);
                if ($decodedData != false) {    // Decode was sucessful
                    $fileName = substr(uniqid(md5(rand()), true), 0, 10);
                    $fileName .= '-clip';
                    $fileName .= '.' . $fileExt;
                    //Yii::debug("fileName:" . $fileName);
                    // e.g. fileName:72a84d81b0-clip.png

                    $saveDir = Yii::$app->controller->module->getSaveDir();
                    //Yii::debug("saveDir:" . $saveDir);
                    // e.g. saveDir:/Volumes/Dev/Valet/yii2adv/backend/web/uploads/files
                    
                    //S3 switch to go here... <manuel>eventually...</manuel>
                    $file = $saveDir . "/" . $fileName;
                    if (!(file_exists($file))) {
                        $fp = fopen($file, "w");
                        fwrite($fp, $decodedData);
                        fclose($fp);
                        //Yii::debug("fp:" . $fp);
                        
                        $url = Yii::$app->controller->module->getUrl(pathinfo($file, PATHINFO_BASENAME));
                        //Yii::debug("url:" . $url);
                        // e.g. url:/uploads/files/6d82ba4ab5-clip.png

                        //Check if file was written
                        if (file_exists($file)) {
                            $fileLink = $url;
                            $fileStatus = "Sucess";
                        }
                    }
                    
                }
            }

            //Yii::debug(print_r($decodedData,true));
        }
        
        return '{"status":"' . $fileStatus . '","filelink":"'  . $fileLink . '"}';
    }

}
