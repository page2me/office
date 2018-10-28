<?php
/**
 * @filesource modules/index/models/menu.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Index\Menu;

/**
 * รายการเมนู.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Model
{
    /**
     * รายการเมนู.
     *
     * @param array $login
     *
     * @return array
     */
    public static function getMenus($login)
    {
        $menus = array(
            'home' => array(
                'text' => '{LNG_Home}',
                'url' => 'index.php?module=home',
            ),
            'module' => array(
                'text' => '{LNG_Module}',
                'submenus' => array(),
            ),
            'member' => array(
                'text' => '{LNG_Users}',
                'submenus' => array(
                    array(
                        'text' => '{LNG_Member list}',
                        'url' => 'index.php?module=member',
                    ),
                    array(
                        'text' => '{LNG_Register}',
                        'url' => 'index.php?module=register',
                    ),
                ),
            ),
            'settings' => array(
                'text' => '{LNG_Settings}',
                'submenus' => array(
                    array(
                        'text' => '{LNG_Site settings}',
                        'url' => 'index.php?module=system',
                    ),
                    array(
                        'text' => '{LNG_Email settings}',
                        'url' => 'index.php?module=mailserver',
                    ),
                    array(
                        'text' => '{LNG_Member status}',
                        'url' => 'index.php?module=memberstatus',
                    ),
                    array(
                        'text' => '{LNG_Language}',
                        'url' => 'index.php?module=language',
                    ),
                ),
            ),
            'signout' => array(
                'text' => '{LNG_Sign out}',
                'url' => 'index.php?action=logout',
            ),
        );

        return $menus;
    }
}
