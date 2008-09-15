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
		settab = this.tabID(elm);
		elm.blur();
        setCk();
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

function nextall(page) {
    $('tab1').innerHTML = '<div style="padding:20px;text-align:center;"><img id="loadicon1"></div>';
    $('loadicon1').src = loadicon.src;
    url = './?m=pc&a=page_h_oneword_all&page=' + page;
    var myAjax = new Ajax.Updater(
        {success: 'tab1'},
        url,
        {
        method: 'get',
        onComplete: function() {
            eval($('all_current').innerHTML);
            makeballoon();
        },
        onFailure: reportError
        });
}

function nextfri(page) {
    $('tab2').innerHTML = '<div style="padding:20px;text-align:center;"><img id="loadicon2"></div>';
    $('loadicon2').src = loadicon.src;
    url = './?m=pc&a=page_h_oneword_fri&page=' + page;
    var myAjax = new Ajax.Updater(
        {success: 'tab2'},
        url,
        {
        method: 'get',
        onComplete: function() {
            eval($('fri_current').innerHTML);
            makeballoon();
        },
        onFailure: reportError
        });
}

function oneword_del(id) {
    if(window.confirm('削除してもよろしいですか？')){
        var url = "./?m=pc&a=do_oneword_delete&sessid=" + sid;
        new Ajax.Request(
            url,
            {
                "method": "get",
                "parameters": "id=" + id,
                onComplete: function() {
                    nextall(all_page);
                    nextfri(fri_page);
                    if(max_oneword_id == id) {
                        if(oneword2 == '') {
                            oneword2 = '・・・・・・';
                        }
                        $('oneword').innerHTML = oneword2;
                    }
                },
                onFailure: function(request) {
                    alert('削除に失敗しました');
                },
                onException: function (request) {
                    alert('処理中にエラーが発生しました');
                }
            }
        );
    }
}

function oneword_comment(id_to, value) {
    var url = "./?m=pc&a=do_oneword_edit&sessid=" + sid;
    new Ajax.Request(
        url,
        {
            "method": "get",
            "parameters": "id_to=" + id_to + "&value=" + encodeURIComponent(value),
            onComplete: function() {
                if(value.replace(/&(?:amp;|)#x([0-9A-F][0-9A-F][0-9A-F][0-9A-F]);/ig, 'e').length > 0 
                && value.replace(/&(?:amp;|)#x([0-9A-F][0-9A-F][0-9A-F][0-9A-F]);/ig, 'e').length < 37) {
                    nextall(1);
                    nextfri(1);
                    value = value.replace(/&(?:amp;|)#x([0-9A-F][0-9A-F][0-9A-F][0-9A-F]);/ig, '<img src="img/moji/x_$1.gif">');
                    if(value.indexOf('<img src="img/moji/', 0) != -1) {
                        $('oneword').innerHTML = value;
                    } else {
                        $('oneword').innerHTML = value.escapeHTML();
                    }
                }
            },
            onFailure: function(request) {
                alert('コメント投稿に失敗しました。文字数をご確認ください。');
            },
            onException: function (request) {
                alert('処理中にエラーが発生しました');
            }
        }
    );
}

function comment_form(id_to, e) {
    if($('comment_form')) {
        if(e.parentNode == $('comment_form').parentNode) {
            $('comment_form').parentNode.style.backgroundColor = "";
            Element.remove($('comment_form'));
        } else {
            $('comment_form').parentNode.style.backgroundColor = "";
            Element.remove($('comment_form'));
            var form = document.createElement('div');
            form.style.textAlign = 'right';
            form.innerHTML = 'へのコメント<input type="text" id="comment_to" style="margin:3px;padding:3px;width:250px"><input type="button" class="submit" value="書込み" onclick="oneword_comment(' + id_to + ', $(\'comment_to\').value);new Effect.Highlight(this.parentNode.parentNode)">';
            form.id = 'comment_form';
            e.parentNode.appendChild(form);
            e.parentNode.style.backgroundColor = "#efefef";
            $('comment_to').focus();
        }
    } else {
        var form = document.createElement('div');
        form.style.textAlign = 'right';
        form.innerHTML = 'へのコメント<input type="text" id="comment_to" style="margin:3px;padding:3px;width:250px"><input type="button" class="submit" value="書込み" onclick="oneword_comment(' + id_to + ', $(\'comment_to\').value);new Effect.Highlight(this.parentNode.parentNode)">';
        form.id = 'comment_form';
        e.parentNode.appendChild(form);
        e.parentNode.style.backgroundColor = "#efefef";
        $('comment_to').focus();
    }
}
