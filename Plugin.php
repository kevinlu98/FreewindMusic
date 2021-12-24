<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * Freewind主题音乐播放器(老王重制版)
 *
 * @package Freewind Music
 * @author Mr丶冷文 & 老王
 * @version 1.4
 * @link https://kevinlu98.cn/
 */
class FreewindMusic_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->header = array('FreewindMusic_Plugin', 'header');
        Typecho_Plugin::factory('Widget_Archive')->footer = array('FreewindMusic_Plugin', 'footer');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
    {
    }

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $server = new Typecho_Widget_Helper_Form_Element_Radio('server', ['tencent' => 'QQ音乐', 'netease' => '网易云音乐', 'kugou' => '酷狗', 'baidu' => '百度音乐'], 'tencent', _t('服务平台'));
        $form->addInput($server);

        $id = new Typecho_Widget_Helper_Form_Element_Text('id', NULL, '7715576205', _t('歌单ID'));
        $form->addInput($id);

        $auto_play = new Typecho_Widget_Helper_Form_Element_Radio('auto_play', ['0' => '否', '1' => '是'], '0', _t('自动播放'));
        $form->addInput($auto_play);

    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }


    public static function header()
    {
        echo '<link rel="stylesheet" href="' . Helper::options()->siteUrl . __TYPECHO_PLUGIN_DIR__ . '/FreewindMusic/css/style.css">';
    }

    public static function footer()
    {
        ?>
        <script>
            $(function () {
                $(".top-list.fr.hide-sm").prepend(`<li id="freewind-music" style="margin: 0;">
<meting-js
                id="<?php echo Typecho_Widget::widget('Widget_Options')->plugin('FreewindMusic')->id ?>"
                server="<?php echo Typecho_Widget::widget('Widget_Options')->plugin('FreewindMusic')->server ?>"
                type="playlist"
                autoplay="<?php echo Typecho_Widget::widget('Widget_Options')->plugin('FreewindMusic')->auto_play == 1 ? 'true' : 'false' ?>"
                mutex="true"
                preload="auto"
                list-folded="true"
        >
        </meting-js>
</li>`)
                // console.log($(".aplayer-button.aplayer-play"));

            })
        </script>
        <?php

    }
}
