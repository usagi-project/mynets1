/* ========================================================================
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *
 * @author     Kazuomi Suematsu <suematsu@UsagiProject.org>
 * @copyright  Kazuomi Suematsu <suematsu@UsagiProject.org>
 * ========================================================================
 */

function url2cmd(url) {
    if (!url.match(/^http:\/\/ustream\.tv\/([a-zA-Z0-9_\-]+)\/videos\/([a-zA-Z0-9_\-]+)/)) {
        document.write('<font color="red">'+url+'</font>');
        return;
    }
    var id1 = RegExp.$1;
    var id2 = RegExp.$2;
    main(id1,id2);
}

function main(id1,id2) {
    var html = '<embed width="416" height="340" flashvars="autoplay=false" src="http://ustream.tv/'
    + id2
    + '.usv" type="application/x-shockwave-flash" wmode="transparent" \>';
    document.write(html);
}
