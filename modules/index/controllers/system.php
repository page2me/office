<?php
/**
 * @filesource modules/index/controllers/system.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Index\System;

use Gcms\Login;
use Kotchasan\Config;
use Kotchasan\Html;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * module=system.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Gcms\Controller
{
    /**
     * ตั้งค่าเว็บไซต์.
     *
     * @param Request $request
     *
     * @return string
     */
    public function render(Request $request)
    {
        // ข้อความ title bar
        $this->title = Language::get('General site settings');
        // เลือกเมนู
        $this->menu = 'settings';
        // สามารถตั้งค่าระบบได้
        if (Login::checkPermission(Login::isMember(), 'can_config')) {
            // แสดงผล
            $section = Html::create('section', array(
                'class' => 'content_bg',
            ));
            // breadcrumbs
            $breadcrumbs = $section->add('div', array(
                'class' => 'breadcrumbs',
            ));
            $ul = $breadcrumbs->add('ul');
            $ul->appendChild('<li><span class="icon-settings">{LNG_Settings}</span></li>');
            $ul->appendChild('<li><span>{LNG_Site settings}</span></li>');
            $section->add('header', array(
                'innerHTML' => '<h2 class="icon-index">'.$this->title.'</h2>',
            ));
            // โหลด config
            $config = Config::load(ROOT_PATH.'settings/config.php');
            // แสดงฟอร์ม
            $section->appendChild(createClass('Index\System\View')->render($config));

            return $section->render();
        }
        // 404

        return \Index\Error\Controller::execute($this);
    }
}
