/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @category   Application of MyNETS
 * @project    OpenPNE UsagiProject 2006-2008
 * @package    MyNETS
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @authoe     Kazuo Ide [K&X inc.] UsagiProject
 * @copyright  2006-2008 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
8 * @chengelog  [2008/07/22] skypeチャット小窓
 * ========================================================================
 */

function url2cmd(url) {
    if (!url.match(/^http:\/\/www\.skype\.com\/go\/joinpublicchat\?skypename=([a-zA-Z0-9_\-\.]+)&amp;topic=([a-zA-Z0-9_\-\@-~%]+)&amp;blob=([a-zA-Z0-9_\-]+)$/)) {
        return;
    }
    var id_1 = RegExp.$1;
    var id_2 = RegExp.$2;
    var id_3 = RegExp.$3;
    main(id_1, id_2, id_3);
}

function main(id_1, id_2, id_3) {
    document.write('<script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>');
    var html = '<div id="skype-publicchat" style="background: white url(http://download.skype.com/share/publicchat/background.png) left bottom repeat-x !important; font: 11px/16px Arial, Helvetica, sans-serif !important;border: 1px solid #ed6e1f !important;"><h1 style="padding: 50px 10px 9px 10px !important;margin: 0 !important;font: 12px/16px Arial, Helvetica, sans-serif !important;font-weight: bold !important;color: #999999 !important; background: transparent url(http://download.skype.com/share/publicchat/snippet_head_orange.png) left top no-repeat !important;"><a style="color: #006699 !important;text-decoration: none !important;" href="skype:?chat&blob=' + id_3 + '">' + decodeURIComponent(id_2).escapeHTML() + '</a><br>主催者：<a style="color: #006699 !important;text-decoration: none !important;" href="skype:' + id_1 + '?userinfo">' + id_1 + '</a><img src="http://mystatus.skype.com/mediumicon/' + id_1 + '?' + (new Date).getTime() + '" style="border: none;" width="26" height="26" alt="My status" align="absmiddle"></h1><p style="margin: 0 10px 10px 10px!important;"><a href="skype:?chat&blob=' + id_3 + '" style="color: #006699 !important; background: transparent url(http://download.skype.com/share/publicchat/chat_icon.png) left center no-repeat !important;padding-left: 20px !important;display: block !important;">参加する</a></p><hr style="margin: 5px 10px !important;height: 1px !important;background: #cccccc !important;border: none;" /><p style="margin: 0 10px 10px 10px!important;"><small style="font-size: 9px; color: #515151 !important;">色んな人と色んなお話。<a href="http://www.skype.com/go/publicchats" style="font-size: 9px; color: #006699 !important;">オープンチャット詳細</a></small></p></div>';
    document.write(html);
}
