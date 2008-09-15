/**
 *
 * @category   Application of SNS
 * @project    OpenPNE UsagiProject 2006-2007
 * @package    MyNETS
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/menber.html>
 * @version    MyNETS,v 1.0.0 Nighty 2007/02/14
 * @since      File available since Release 1.1.0 Nighty
 *
 */

var onLoadNumber=0;
onLoadArray = new Array();

function onLoad() {
  for (i = 0; i < onLoadArray.length; i++) {
    eval(onLoadArray[i]);
  }
}
