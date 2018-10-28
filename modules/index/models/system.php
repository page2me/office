<?php
/**
 * @filesource modules/index/models/system.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Index\System;

use Gcms\Config;
use Gcms\Login;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * บันทึกการตั้งค่าเว็บไซต์.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model extends \Kotchasan\KBase
{
    /**
     * บันทึกการตั้งค่าเว็บไซต์ (system.php).
     *
     * @param Request $request
     */
    public function submit(Request $request)
    {
        $ret = array();
        // session, token, member, can_config, ไม่ใช่สมาชิกตัวอย่าง
        if ($request->initSession() && $request->isSafe() && $login = Login::isMember()) {
            if (Login::checkPermission($login, 'can_config') && Login::notDemoMode($login)) {
                // โหลด config
                $config = Config::load(ROOT_PATH.'settings/config.php');
                foreach (array('web_title', 'web_description') as $key) {
                    $value = $request->post($key)->quote();
                    if (empty($value)) {
                        $ret['ret_'.$key] = 'Please fill in';
                    } else {
                        $config->$key = $value;
                    }
                }
                $config->timezone = $request->post('timezone')->text();
                if (empty($ret)) {
                    // อัปโหลดไฟล์
                    foreach ($request->getUploadedFiles() as $item => $file) {
                        if (in_array($item, array('logo', 'bg_image'))) {
                            /* @var $file \Kotchasan\Http\UploadedFile */
                            if ($request->post('delete_'.$item)->toBoolean() == 1) {
                                // ลบ
                                if (is_file(ROOT_PATH.DATA_FOLDER.$item.'.png')) {
                                    unlink(ROOT_PATH.DATA_FOLDER.$item.'.png');
                                }
                            } elseif ($file->hasUploadFile()) {
                                if (!$file->validFileExt(array('jpg', 'jpeg', 'png'))) {
                                    // ชนิดของไฟล์ไม่รองรับ
                                    $ret['ret_'.$item] = Language::get('The type of file is invalid');
                                } else {
                                    try {
                                        $file->moveTo(ROOT_PATH.DATA_FOLDER.$item.'.png');
                                    } catch (\Exception $exc) {
                                        // ไม่สามารถอัปโหลดได้
                                        $ret['ret_'.$item] = Language::get($exc->getMessage());
                                    }
                                }
                            } elseif ($file->hasError()) {
                                // ข้อผิดพลาดการอัปโหลด
                                $ret['ret_'.$item] = Language::get($file->getErrorMessage());
                            }
                        }
                    }
                }
                if (empty($ret)) {
                    // save config
                    if (Config::save($config, ROOT_PATH.'settings/config.php')) {
                        $ret['alert'] = Language::get('Saved successfully');
                        $ret['location'] = 'reload';
                        // เคลียร์
                        $request->removeToken();
                    } else {
                        // ไม่สามารถบันทึก config ได้
                        $ret['alert'] = sprintf(Language::get('File %s cannot be created or is read-only.'), 'settings/config.php');
                    }
                }
            }
        }
        if (empty($ret)) {
            $ret['alert'] = Language::get('Unable to complete the transaction');
        }
        // คืนค่าเป็น JSON
        echo json_encode($ret);
    }
}
