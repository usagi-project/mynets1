/*
 * Fabtabulous! Simple tabs using Prototype
 * http://tetlaw.id.au/view/blog/fabtabulous-simple-tabs-using-prototype/
 * Andrew Tetlaw
 * version 1.1 2006-05-06
 * http://creativecommons.org/licenses/by-sa/2.5/
 * customized by UsagiProject 2008
 */
var Fabtabs = Class.create();

Fabtabs.prototype = {
	initialize : function(element,first) {
		this.element = $(element);
		var options = Object.extend({}, arguments[1] || {});
		if(this.element) {
		    this.menu = $A(this.element.getElementsByTagName('a'));
		} else {
		    this.menu = [];
		}
		this.firsttab = first;
		this.show(this.getInitialTab());
		this.menu.each(this.setupTab.bind(this));
	},
	setupTab : function(elm) {
		Event.observe(elm,'click',this.activate.bindAsEventListener(this),false)
	},
	activate :  function(ev) {
		var elm = Event.findElement(ev, "a");
		Event.stop(ev);
		this.show(elm);
		this.menu.without(elm).each(this.hide.bind(this));
		elm.blur();
	},
	hide : function(elm) {
		$(elm).removeClassName('active-tab');
		$(this.tabID(elm)).removeClassName('active-tab-body');
	},
	show : function(elm) {
	    if(elm) {
    		$(elm).addClassName('active-tab');
    		$(this.tabID(elm)).addClassName('active-tab-body');
        }
	},
	tabID : function(elm) {
		return elm.href.match(/#(\w.+)/)[1];
	},
	getInitialTab : function() {
		if(this.firsttab) {
			var loc = this.firsttab;
			var elm = this.menu.find(function(value) { return value.href.match(/#(\w.+)/)[1] == loc; });
			return elm || this.menu.first();
		} else {
			return this.menu.first();
		}
	}
}

function nextother(page, target_c_member_id) {
    $('tab1').innerHTML = '<div style="padding:20px;text-align:center;"><img id="loadicon"></div>';
    $('loadicon').src = "./skin/default/img/loading.gif";
    url = './?m=pc&a=page_h_oneword_other&page=' + page + '&target_c_member_id=' + target_c_member_id;
    var myAjax = new Ajax.Updater(
        {success: 'tab1'},
        url,
        {
            method: 'get',
            onComplete: function() {
                makeballoon();
            },
            onFailure: function() {
                alert('エラーが発生しました');
            }
        }
    );
}
