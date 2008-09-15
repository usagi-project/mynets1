/* ========================================================================
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *
 * @author     Kazuomi Suematsu <suematsu@UsagiProject.org>
 * @copyright  Kazuomi Suematsu <suematsu@UsagiProject.org>
 * ========================================================================
 */

function main(id,channel) {
    if (!id.match(/^[a-zA-Z0-9_\-]+$/)) {
        return;
    }

document.write('<embed width="416" height="340" flashvars="autoplay=false" src="http://ustream.tv/'
 + id
 + '.usc" type="application/x-shockwave-flash" wmode="transparent" \>');
document.write("<br>");
document.write('<embed width="416" height="200" type="application/x-shockwave-flash" flashvars="channel=#'
 + channel
 + '" pluginspage="http://www.adobe.com/go/getflashplayer" src="http://ustream.tv/IrcClient.swf"\><br><a href="http://ustream.tv/channel/'
 + channel
 + '" target="blank">■別ウィンドウで開く■</a>　←サインアップして、チャットを楽しみましょう！！');
}
