<?php
/**
 * Created by PhpStorm.
 * User: nix
 * Date: 12.06.2015
 * Time: 11:33
 */

namespace app\modules\simpleactiveform\models;


use yii\db\ActiveRecord;

class FormInput extends ActiveRecord
{
    public $text;
    public $textArea;
    public $password;
    public $email;
    public $fileUpload;
    public $filesUpload;
    public $checkbox;
    public $checkboxList;
    public $radioButton;
    public $radioButtonList;
    public $listBox;
    public $dropdownList;


}