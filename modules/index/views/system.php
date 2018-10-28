<?php
/**
 * @filesource modules/index/views/system.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Index\System;

use Kotchasan\Html;
use Kotchasan\Language;

/**
 * module=system.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class View extends \Gcms\View
{
    /**
     * ฟอร์มตั้งค่า system.
     *
     * @param object $config
     *
     * @return string
     */
    public function render($config)
    {
        $form = Html::create('form', array(
            'id' => 'setup_frm',
            'class' => 'setup_frm',
            'autocomplete' => 'off',
            'action' => 'index.php/index/model/system/submit',
            'onsubmit' => 'doFormSubmit',
            'ajax' => true,
            'token' => true,
        ));
        $fieldset = $form->add('fieldset', array(
            'title' => '{LNG_General}',
        ));
        // web_title
        $fieldset->add('text', array(
            'id' => 'web_title',
            'labelClass' => 'g-input icon-home',
            'itemClass' => 'item',
            'label' => '{LNG_Website title}',
            'comment' => '{LNG_Site Name}',
            'maxlength' => 255,
            'value' => isset($config->web_title) ? $config->web_title : self::$cfg->web_title,
        ));
        // web_description
        $fieldset->add('text', array(
            'id' => 'web_description',
            'labelClass' => 'g-input icon-home',
            'itemClass' => 'item',
            'label' => '{LNG_Description}',
            'comment' => '{LNG_Short description about your website}',
            'maxlength' => 255,
            'value' => isset($config->web_description) ? $config->web_description : self::$cfg->web_description,
        ));
        // timezone
        $datas = array();
        foreach (\DateTimeZone::listIdentifiers() as $item) {
            $datas[$item] = $item;
        }
        $fieldset->add('select', array(
            'id' => 'timezone',
            'labelClass' => 'g-input icon-clock',
            'itemClass' => 'item',
            'label' => '{LNG_Time zone}&nbsp;({LNG_Server time}&nbsp;<em id=server_time>'.date('H:i:s').'</em>&nbsp;{LNG_Local time}&nbsp;<em id=local_time></em>)',
            'comment' => '{LNG_Settings the timing of the server to match the local time}',
            'options' => $datas,
            'value' => isset($config->timezone) ? $config->timezone : self::$cfg->timezone,
        ));
        $fieldset = $form->add('fieldset', array(
            'title' => '{LNG_Style}',
        ));
        // bg_image
        if (is_file(ROOT_PATH.DATA_FOLDER.'bg_image.png')) {
            $img = WEB_URL.DATA_FOLDER.'bg_image.png';
        } else {
            $img = WEB_URL.'skin/img/blank.gif';
        }
        // bg_image
        $fieldset->add('file', array(
            'id' => 'bg_image',
            'labelClass' => 'g-input icon-image',
            'itemClass' => 'item',
            'label' => '{LNG_Background image}',
            'comment' => Language::replace('Upload :type files no larger than :size', array(':type' => 'jpg, jpeg, png', ':size' => \Kotchasan\Http\UploadedFile::getUploadSize())),
            'accept' => array('jpg', 'jpeg', 'png'),
            'dataPreview' => 'bgImage',
            'previewSrc' => $img,
        ));
        // delete_bg_image
        $fieldset->add('checkbox', array(
            'id' => 'delete_bg_image',
            'itemClass' => 'subitem',
            'label' => '{LNG_Remove} {LNG_Background image}',
            'value' => 1,
        ));
        // logo
        if (is_file(ROOT_PATH.DATA_FOLDER.'logo.png')) {
            $img = WEB_URL.DATA_FOLDER.'logo.png';
        } else {
            $img = WEB_URL.'skin/img/blank.gif';
        }
        // logo
        $fieldset->add('file', array(
            'id' => 'logo',
            'labelClass' => 'g-input icon-image',
            'itemClass' => 'item',
            'label' => '{LNG_Logo}',
            'comment' => Language::replace('Browse image uploaded, type :type size :width*:height pixel', array(':type' => 'jpg, jpeg, png', ':width' => 144, ':height' => 51)),
            'accept' => array('jpg', 'jpeg', 'png'),
            'dataPreview' => 'logoImage',
            'previewSrc' => $img,
        ));
        // delete_logo
        $fieldset->add('checkbox', array(
            'id' => 'delete_logo',
            'itemClass' => 'subitem',
            'label' => '{LNG_Remove} {LNG_Logo}',
            'value' => 1,
        ));
        $fieldset = $form->add('fieldset', array(
            'class' => 'submit',
        ));
        // submit
        $fieldset->add('submit', array(
            'class' => 'button save large icon-save',
            'value' => '{LNG_Save}',
        ));
        $form->script('initSystem();');

        return $form->render();
    }
}
