/*!
 * ZUI
 * Some code copy from Bootstrap v3.0.0 by @fat and @mdo Copyright 2013 Twitter, Inc. Licensed under http://www.apache.org/licenses/LICENSE-2.0
 */
;if(typeof jQuery==="undefined"){throw new Error("ZUI requires jQuery")}+function(c){function b(){var f=document.createElement("bootstrap");var e={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",transition:"transitionend"};for(var d in e){if(f.style[d]!==undefined){return{end:e[d]}}}}c.fn.emulateTransitionEnd=function(f){var e=false,d=this;c(this).one(c.support.transition.end,function(){e=true});var g=function(){if(!e){c(d).trigger(c.support.transition.end)}};setTimeout(g,f);return this};c(function(){c.support.transition=b()})}(jQuery);+function(e){var d='[data-dismiss="alert"]';var c=function(f){e(f).on("click",d,this.close)};c.prototype.close=function(j){var i=e(this);var g=i.attr("data-target");if(!g){g=i.attr("href");g=g&&g.replace(/.*(?=#[^\s]*$)/,"")}var h=e(g);if(j){j.preventDefault()}if(!h.length){h=i.hasClass("alert")?i:i.parent()}h.trigger(j=e.Event("close.bs.alert"));if(j.isDefaultPrevented()){return}h.removeClass("in");function f(){h.trigger("closed.bs.alert").remove()}e.support.transition&&h.hasClass("fade")?h.one(e.support.transition.end,f).emulateTransitionEnd(150):f()};var b=e.fn.alert;e.fn.alert=function(f){return this.each(function(){var h=e(this);var g=h.data("bs.alert");if(!g){h.data("bs.alert",(g=new c(this)))}if(typeof f=="string"){g[f].call(h)}})};e.fn.alert.Constructor=c;e.fn.alert.noConflict=function(){e.fn.alert=b;return this};e(document).on("click.bs.alert.data-api",d,c.prototype.close)}(window.jQuery);+function(d){var c=function(f,e){this.$element=d(f);this.options=d.extend({},c.DEFAULTS,e)};c.DEFAULTS={loadingText:"loading..."};c.prototype.setState=function(g){var i="disabled";var e=this.$element;var h=e.is("input")?"val":"html";var f=e.data();g=g+"Text";if(!f.resetText){e.data("resetText",e[h]())}e[h](f[g]||this.options[g]);setTimeout(function(){g=="loadingText"?e.addClass(i).attr(i,i):e.removeClass(i).removeAttr(i)},0)};c.prototype.toggle=function(){var e=this.$element.closest('[data-toggle="buttons"]');if(e.length){var f=this.$element.find("input").prop("checked",!this.$element.hasClass("active")).trigger("change");if(f.prop("type")==="radio"){e.find(".active").removeClass("active")}}this.$element.toggleClass("active")};var b=d.fn.button;d.fn.button=function(e){return this.each(function(){var h=d(this);var g=h.data("bs.button");var f=typeof e=="object"&&e;if(!g){h.data("bs.button",(g=new c(this,f)))}if(e=="toggle"){g.toggle()}else{if(e){g.setState(e)}}})};d.fn.button.Constructor=c;d.fn.button.noConflict=function(){d.fn.button=b;return this};d(document).on("click.bs.button.data-api","[data-toggle^=button]",function(g){var f=d(g.target);if(!f.hasClass("btn")){f=f.closest(".btn")}f.button("toggle");g.preventDefault()})}(window.jQuery);+function(c){var d=function(f,e){this.$element=c(f);this.$indicators=this.$element.find(".carousel-indicators");this.options=e;this.paused=this.sliding=this.interval=this.$active=this.$items=null;this.options.pause=="hover"&&this.$element.on("mouseenter",c.proxy(this.pause,this)).on("mouseleave",c.proxy(this.cycle,this))};d.DEFAULTS={interval:5000,pause:"hover",wrap:true};d.prototype.cycle=function(f){f||(this.paused=false);this.interval&&clearInterval(this.interval);this.options.interval&&!this.paused&&(this.interval=setInterval(c.proxy(this.next,this),this.options.interval));return this};d.prototype.getActiveIndex=function(){this.$active=this.$element.find(".item.active");this.$items=this.$active.parent().children();return this.$items.index(this.$active)};d.prototype.to=function(g){var f=this;var e=this.getActiveIndex();if(g>(this.$items.length-1)||g<0){return}if(this.sliding){return this.$element.one("slid",function(){f.to(g)})}if(e==g){return this.pause().cycle()}return this.slide(g>e?"next":"prev",c(this.$items[g]))};d.prototype.pause=function(f){f||(this.paused=true);if(this.$element.find(".next, .prev").length&&c.support.transition.end){this.$element.trigger(c.support.transition.end);this.cycle(true)}this.interval=clearInterval(this.interval);return this};d.prototype.next=function(){if(this.sliding){return}return this.slide("next")};d.prototype.prev=function(){if(this.sliding){return}return this.slide("prev")};d.prototype.slide=function(l,g){var n=this.$element.find(".item.active");var f=g||n[l]();var k=this.interval;var m=l=="next"?"left":"right";var h=l=="next"?"first":"last";var i=this;if(!f.length){if(!this.options.wrap){return}f=this.$element.find(".item")[h]()}this.sliding=true;k&&this.pause();var j=c.Event("slide.bs.carousel",{relatedTarget:f[0],direction:m});if(f.hasClass("active")){return}if(this.$indicators.length){this.$indicators.find(".active").removeClass("active");this.$element.one("slid",function(){var e=c(i.$indicators.children()[i.getActiveIndex()]);e&&e.addClass("active")})}if(c.support.transition&&this.$element.hasClass("slide")){this.$element.trigger(j);if(j.isDefaultPrevented()){return}f.addClass(l);f[0].offsetWidth;n.addClass(m);f.addClass(m);n.one(c.support.transition.end,function(){f.removeClass([l,m].join(" ")).addClass("active");n.removeClass(["active",m].join(" "));i.sliding=false;setTimeout(function(){i.$element.trigger("slid")},0)}).emulateTransitionEnd(600)}else{this.$element.trigger(j);if(j.isDefaultPrevented()){return}n.removeClass("active");f.addClass("active");this.sliding=false;this.$element.trigger("slid")}k&&this.cycle();return this};var b=c.fn.carousel;c.fn.carousel=function(e){return this.each(function(){var i=c(this);var h=i.data("bs.carousel");var f=c.extend({},d.DEFAULTS,i.data(),typeof e=="object"&&e);var g=typeof e=="string"?e:f.slide;if(!h){i.data("bs.carousel",(h=new d(this,f)))}if(typeof e=="number"){h.to(e)}else{if(g){h[g]()}else{if(f.interval){h.pause().cycle()}}}})};c.fn.carousel.Constructor=d;c.fn.carousel.noConflict=function(){c.fn.carousel=b;return this};c(document).on("click.bs.carousel.data-api","[data-slide], [data-slide-to]",function(k){var j=c(this),g;var f=c(j.attr("data-target")||(g=j.attr("href"))&&g.replace(/.*(?=#[^\s]+$)/,""));var h=c.extend({},f.data(),j.data());var i=j.attr("data-slide-to");if(i){h.interval=false}f.carousel(h);if(i=j.attr("data-slide-to")){f.data("bs.carousel").to(i)}k.preventDefault()});c(window).on("load",function(){c('[data-ride="carousel"]').each(function(){var e=c(this);e.carousel(e.data())})})}(window.jQuery);+function(c){var d=function(f,e){this.$element=c(f);this.options=c.extend({},d.DEFAULTS,e);this.transitioning=null;if(this.options.parent){this.$parent=c(this.options.parent)}if(this.options.toggle){this.toggle()}};d.DEFAULTS={toggle:true};d.prototype.dimension=function(){var e=this.$element.hasClass("width");return e?"width":"height"};d.prototype.show=function(){if(this.transitioning||this.$element.hasClass("in")){return}var f=c.Event("show.bs.collapse");this.$element.trigger(f);if(f.isDefaultPrevented()){return}var i=this.$parent&&this.$parent.find("> .panel > .in");if(i&&i.length){var g=i.data("bs.collapse");if(g&&g.transitioning){return}i.collapse("hide");g||i.data("bs.collapse",null)}var j=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[j](0);this.transitioning=1;var e=function(){this.$element.removeClass("collapsing").addClass("in")[j]("auto");this.transitioning=0;this.$element.trigger("shown.bs.collapse")};if(!c.support.transition){return e.call(this)}var h=c.camelCase(["scroll",j].join("-"));this.$element.one(c.support.transition.end,c.proxy(e,this)).emulateTransitionEnd(350)[j](this.$element[0][h])};d.prototype.hide=function(){if(this.transitioning||!this.$element.hasClass("in")){return}var f=c.Event("hide.bs.collapse");this.$element.trigger(f);if(f.isDefaultPrevented()){return}var g=this.dimension();this.$element[g](this.$element[g]())[0].offsetHeight;this.$element.addClass("collapsing").removeClass("collapse").removeClass("in");this.transitioning=1;var e=function(){this.transitioning=0;this.$element.trigger("hidden.bs.collapse").removeClass("collapsing").addClass("collapse")};if(!c.support.transition){return e.call(this)}this.$element[g](0).one(c.support.transition.end,c.proxy(e,this)).emulateTransitionEnd(350)};d.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()};var b=c.fn.collapse;c.fn.collapse=function(e){return this.each(function(){var h=c(this);var g=h.data("bs.collapse");var f=c.extend({},d.DEFAULTS,h.data(),typeof e=="object"&&e);if(!g){h.data("bs.collapse",(g=new d(this,f)))}if(typeof e=="string"){g[e]()}})};c.fn.collapse.Constructor=d;c.fn.collapse.noConflict=function(){c.fn.collapse=b;return this};c(document).on("click.bs.collapse.data-api","[data-toggle=collapse]",function(k){var m=c(this),f;var l=m.attr("data-target")||k.preventDefault()||(f=m.attr("href"))&&f.replace(/.*(?=#[^\s]+$)/,"");var g=c(l);var i=g.data("bs.collapse");var j=i?"toggle":m.data();var n=m.attr("data-parent");var h=n&&c(n);if(!i||!i.transitioning){if(h){h.find('[data-toggle=collapse][data-parent="'+n+'"]').not(m).addClass("collapsed")}m[g.hasClass("in")?"addClass":"removeClass"]("collapsed")}g.collapse(j)})}(window.jQuery);+function(h){var f=".dropdown-backdrop";var c="[data-toggle=dropdown]";var b=function(j){var i=h(j).on("click.bs.dropdown",this.toggle)};b.prototype.toggle=function(l){var k=h(this);if(k.is(".disabled, :disabled")){return}var j=g(k);var i=j.hasClass("open");e();if(!i){if("ontouchstart" in document.documentElement&&!j.closest(".navbar-nav").length){h('<div class="dropdown-backdrop"/>').insertAfter(h(this)).on("click",e)}j.trigger(l=h.Event("show.bs.dropdown"));if(l.isDefaultPrevented()){return}j.toggleClass("open").trigger("shown.bs.dropdown");k.focus()}return false};b.prototype.keydown=function(m){if(!/(38|40|27)/.test(m.keyCode)){return}var l=h(this);m.preventDefault();m.stopPropagation();if(l.is(".disabled, :disabled")){return}var k=g(l);var j=k.hasClass("open");if(!j||(j&&m.keyCode==27)){if(m.which==27){k.find(c).focus()}return l.click()}var n=h("[role=menu] li:not(.divider):visible a",k);if(!n.length){return}var i=n.index(n.filter(":focus"));if(m.keyCode==38&&i>0){i--}if(m.keyCode==40&&i<n.length-1){i++}if(!~i){i=0}n.eq(i).focus()};function e(){h(f).remove();h(c).each(function(j){var i=g(h(this));if(!i.hasClass("open")){return}i.trigger(j=h.Event("hide.bs.dropdown"));if(j.isDefaultPrevented()){return}i.removeClass("open").trigger("hidden.bs.dropdown")})}function g(k){var i=k.attr("data-target");if(!i){i=k.attr("href");i=i&&/#/.test(i)&&i.replace(/.*(?=#[^\s]*$)/,"")}var j=i&&h(i);return j&&j.length?j:k.parent()}var d=h.fn.dropdown;h.fn.dropdown=function(i){return this.each(function(){var k=h(this);var j=k.data("dropdown");if(!j){k.data("dropdown",(j=new b(this)))}if(typeof i=="string"){j[i].call(k)}})};h.fn.dropdown.Constructor=b;h.fn.dropdown.noConflict=function(){h.fn.dropdown=d;return this};h(document).on("click.bs.dropdown.data-api",e).on("click.bs.dropdown.data-api",".dropdown form",function(i){i.stopPropagation()}).on("click.bs.dropdown.data-api",c,b.prototype.toggle).on("keydown.bs.dropdown.data-api",c+", [role=menu]",b.prototype.keydown)}(window.jQuery);+function(d){var c=function(f,e){this.options=e;this.$element=d(f);this.$backdrop=this.isShown=null;if(this.options.remote){this.$element.load(this.options.remote)}};c.DEFAULTS={backdrop:true,keyboard:true,show:true};c.prototype.toggle=function(e){return this[!this.isShown?"show":"hide"](e)};c.prototype.show=function(h){var f=this;var g=d.Event("show.bs.modal",{relatedTarget:h});this.$element.trigger(g);if(this.isShown||g.isDefaultPrevented()){return}this.isShown=true;this.escape();this.$element.on("click.dismiss.modal",'[data-dismiss="modal"]',d.proxy(this.hide,this));this.backdrop(function(){var j=d.support.transition&&f.$element.hasClass("fade");if(!f.$element.parent().length){f.$element.appendTo(document.body)}f.$element.show();if(j){f.$element[0].offsetWidth}f.$element.addClass("in").attr("aria-hidden",false);f.enforceFocus();var i=d.Event("shown.bs.modal",{relatedTarget:h});j?f.$element.find(".modal-dialog").one(d.support.transition.end,function(){f.$element.focus().trigger(i)}).emulateTransitionEnd(300):f.$element.focus().trigger(i)})};c.prototype.hide=function(f){if(f){f.preventDefault()}f=d.Event("hide.bs.modal");this.$element.trigger(f);if(!this.isShown||f.isDefaultPrevented()){return}this.isShown=false;this.escape();d(document).off("focusin.bs.modal");this.$element.removeClass("in").attr("aria-hidden",true).off("click.dismiss.modal");d.support.transition&&this.$element.hasClass("fade")?this.$element.one(d.support.transition.end,d.proxy(this.hideModal,this)).emulateTransitionEnd(300):this.hideModal()};c.prototype.enforceFocus=function(){d(document).off("focusin.bs.modal").on("focusin.bs.modal",d.proxy(function(f){if(this.$element[0]!==f.target&&!this.$element.has(f.target).length){this.$element.focus()}},this))};c.prototype.escape=function(){if(this.isShown&&this.options.keyboard){this.$element.on("keyup.dismiss.bs.modal",d.proxy(function(f){f.which==27&&this.hide()},this))}else{if(!this.isShown){this.$element.off("keyup.dismiss.bs.modal")}}};c.prototype.hideModal=function(){var e=this;this.$element.hide();this.backdrop(function(){e.removeBackdrop();e.$element.trigger("hidden.bs.modal")})};c.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove();this.$backdrop=null};c.prototype.backdrop=function(h){var g=this;var f=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var e=d.support.transition&&f;this.$backdrop=d('<div class="modal-backdrop '+f+'" />').appendTo(document.body);this.$element.on("click.dismiss.modal",d.proxy(function(i){if(i.target!==i.currentTarget){return}this.options.backdrop=="static"?this.$element[0].focus.call(this.$element[0]):this.hide.call(this)},this));if(e){this.$backdrop[0].offsetWidth}this.$backdrop.addClass("in");if(!h){return}e?this.$backdrop.one(d.support.transition.end,h).emulateTransitionEnd(150):h()}else{if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");d.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one(d.support.transition.end,h).emulateTransitionEnd(150):h()}else{if(h){h()}}}};var b=d.fn.modal;d.fn.modal=function(e,f){return this.each(function(){var i=d(this);var h=i.data("bs.modal");var g=d.extend({},c.DEFAULTS,i.data(),typeof e=="object"&&e);if(!h){i.data("bs.modal",(h=new c(this,g)))}if(typeof e=="string"){h[e](f)}else{if(g.show){h.show(f)}}})};d.fn.modal.Constructor=c;d.fn.modal.noConflict=function(){d.fn.modal=b;return this};d(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(j){var i=d(this);var g=i.attr("href");var f=d(i.attr("data-target")||(g&&g.replace(/.*(?=#[^\s]+$)/,"")));var h=f.data("modal")?"toggle":d.extend({remote:!/#/.test(g)&&g},f.data(),i.data());j.preventDefault();f.modal(h,this).one("hide",function(){i.is(":visible")&&i.focus()})});d(document).on("show.bs.modal",".modal",function(){d(document.body).addClass("modal-open")}).on("hidden.bs.modal",".modal",function(){d(document.body).removeClass("modal-open")})}(window.jQuery);+function(d){var c=function(f,e){this.type=this.options=this.enabled=this.timeout=this.hoverState=this.$element=null;this.init("tooltip",f,e)};c.DEFAULTS={animation:true,placement:"top",selector:false,template:'<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:false,container:false};c.prototype.init=function(l,j,g){this.enabled=true;this.type=l;this.$element=d(j);this.options=this.getOptions(g);var k=this.options.trigger.split(" ");for(var h=k.length;h--;){var f=k[h];if(f=="click"){this.$element.on("click."+this.type,this.options.selector,d.proxy(this.toggle,this))}else{if(f!="manual"){var m=f=="hover"?"mouseenter":"focus";var e=f=="hover"?"mouseleave":"blur";this.$element.on(m+"."+this.type,this.options.selector,d.proxy(this.enter,this));this.$element.on(e+"."+this.type,this.options.selector,d.proxy(this.leave,this))}}}this.options.selector?(this._options=d.extend({},this.options,{trigger:"manual",selector:""})):this.fixTitle()};c.prototype.getDefaults=function(){return c.DEFAULTS};c.prototype.getOptions=function(e){e=d.extend({},this.getDefaults(),this.$element.data(),e);if(e.delay&&typeof e.delay=="number"){e.delay={show:e.delay,hide:e.delay}}return e};c.prototype.getDelegateOptions=function(){var e={};var f=this.getDefaults();this._options&&d.each(this._options,function(g,h){if(f[g]!=h){e[g]=h}});return e};c.prototype.enter=function(f){var e=f instanceof this.constructor?f:d(f.currentTarget)[this.type](this.getDelegateOptions()).data("bs."+this.type);clearTimeout(e.timeout);e.hoverState="in";if(!e.options.delay||!e.options.delay.show){return e.show()}e.timeout=setTimeout(function(){if(e.hoverState=="in"){e.show()}},e.options.delay.show)};c.prototype.leave=function(f){var e=f instanceof this.constructor?f:d(f.currentTarget)[this.type](this.getDelegateOptions()).data("bs."+this.type);clearTimeout(e.timeout);e.hoverState="out";if(!e.options.delay||!e.options.delay.hide){return e.hide()}e.timeout=setTimeout(function(){if(e.hoverState=="out"){e.hide()}},e.options.delay.hide)};c.prototype.show=function(){var o=d.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(o);if(o.isDefaultPrevented()){return}var k=this.tip();this.setContent();if(this.options.animation){k.addClass("fade")}var j=typeof this.options.placement=="function"?this.options.placement.call(this,k[0],this.$element[0]):this.options.placement;var s=/\s?auto?\s?/i;var t=s.test(j);if(t){j=j.replace(s,"")||"top"}k.detach().css({top:0,left:0,display:"block"}).addClass(j);this.options.container?k.appendTo(this.options.container):k.insertAfter(this.$element);var p=this.getPosition();var f=k[0].offsetWidth;var m=k[0].offsetHeight;if(t){var i=this.$element.parent();var h=j;var q=document.documentElement.scrollTop||document.body.scrollTop;var r=this.options.container=="body"?window.innerWidth:i.outerWidth();var n=this.options.container=="body"?window.innerHeight:i.outerHeight();var l=this.options.container=="body"?0:i.offset().left;j=j=="bottom"&&p.top+p.height+m-q>n?"top":j=="top"&&p.top-q-m<0?"bottom":j=="right"&&p.right+f>r?"left":j=="left"&&p.left-f<l?"right":j;k.removeClass(h).addClass(j)}var g=this.getCalculatedOffset(j,p,f,m);this.applyPlacement(g,j);this.$element.trigger("shown.bs."+this.type)}};c.prototype.applyPlacement=function(j,k){var h;var l=this.tip();var g=l[0].offsetWidth;var o=l[0].offsetHeight;var f=parseInt(l.css("margin-top"),10);var i=parseInt(l.css("margin-left"),10);if(isNaN(f)){f=0}if(isNaN(i)){i=0}j.top=j.top+f;j.left=j.left+i;l.offset(j).addClass("in");var e=l[0].offsetWidth;var m=l[0].offsetHeight;if(k=="top"&&m!=o){h=true;j.top=j.top+o-m}if(/bottom|top/.test(k)){var n=0;if(j.left<0){n=j.left*-2;j.left=0;l.offset(j);e=l[0].offsetWidth;m=l[0].offsetHeight}this.replaceArrow(n-g+e,e,"left")}else{this.replaceArrow(m-o,m,"top")}if(h){l.offset(j)}};c.prototype.replaceArrow=function(g,f,e){this.arrow().css(e,g?(50*(1-g/f)+"%"):"")};c.prototype.setContent=function(){var f=this.tip();var e=this.getTitle();f.find(".tooltip-inner")[this.options.html?"html":"text"](e);f.removeClass("fade in top bottom left right")};c.prototype.hide=function(){var g=this;var i=this.tip();var h=d.Event("hide.bs."+this.type);function f(){if(g.hoverState!="in"){i.detach()}}this.$element.trigger(h);if(h.isDefaultPrevented()){return}i.removeClass("in");d.support.transition&&this.$tip.hasClass("fade")?i.one(d.support.transition.end,f).emulateTransitionEnd(150):f();this.$element.trigger("hidden.bs."+this.type);return this};c.prototype.fixTitle=function(){var e=this.$element;if(e.attr("title")||typeof(e.attr("data-original-title"))!="string"){e.attr("data-original-title",e.attr("title")||"").attr("title","")}};c.prototype.hasContent=function(){return this.getTitle()};c.prototype.getPosition=function(){var e=this.$element[0];return d.extend({},(typeof e.getBoundingClientRect=="function")?e.getBoundingClientRect():{width:e.offsetWidth,height:e.offsetHeight},this.$element.offset())};c.prototype.getCalculatedOffset=function(e,h,f,g){return e=="bottom"?{top:h.top+h.height,left:h.left+h.width/2-f/2}:e=="top"?{top:h.top-g,left:h.left+h.width/2-f/2}:e=="left"?{top:h.top+h.height/2-g/2,left:h.left-f}:{top:h.top+h.height/2-g/2,left:h.left+h.width}};c.prototype.getTitle=function(){var g;var e=this.$element;var f=this.options;g=e.attr("data-original-title")||(typeof f.title=="function"?f.title.call(e[0]):f.title);return g};c.prototype.tip=function(){return this.$tip=this.$tip||d(this.options.template)};c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")};c.prototype.validate=function(){if(!this.$element[0].parentNode){this.hide();this.$element=null;this.options=null}};c.prototype.enable=function(){this.enabled=true};c.prototype.disable=function(){this.enabled=false};c.prototype.toggleEnabled=function(){this.enabled=!this.enabled};c.prototype.toggle=function(g){var f=g?d(g.currentTarget)[this.type](this.getDelegateOptions()).data("bs."+this.type):this;f.tip().hasClass("in")?f.leave(f):f.enter(f)};c.prototype.destroy=function(){this.hide().$element.off("."+this.type).removeData("bs."+this.type)};var b=d.fn.tooltip;d.fn.tooltip=function(e){return this.each(function(){var h=d(this);var g=h.data("bs.tooltip");var f=typeof e=="object"&&e;if(!g){h.data("bs.tooltip",(g=new c(this,f)))}if(typeof e=="string"){g[e]()}})};d.fn.tooltip.Constructor=c;d.fn.tooltip.noConflict=function(){d.fn.tooltip=b;return this}}(window.jQuery);+function(d){var c=function(f,e){this.init("popover",f,e)};if(!d.fn.tooltip){throw new Error("Popover requires tooltip.js")}c.DEFAULTS=d.extend({},d.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'});c.prototype=d.extend({},d.fn.tooltip.Constructor.prototype);c.prototype.constructor=c;c.prototype.getDefaults=function(){return c.DEFAULTS};c.prototype.setContent=function(){var h=this.tip();var f=this.getTarget();if(f){if(f.find(".arrow").length<1){h.addClass("no-arrow")}h.html(f.html());return}var g=this.getTitle();var e=this.getContent();h.find(".popover-title")[this.options.html?"html":"text"](g);h.find(".popover-content")[this.options.html?"html":"text"](e);h.removeClass("fade top bottom left right in");if(!h.find(".popover-title").html()){h.find(".popover-title").hide()}};c.prototype.hasContent=function(){return this.getTarget()||this.getTitle()||this.getContent()};c.prototype.getContent=function(){var e=this.$element;var f=this.options;return e.attr("data-content")||(typeof f.content=="function"?f.content.call(e[0]):f.content)};c.prototype.getTarget=function(){var e=this.$element;var g=this.options;var f=e.attr("data-target")||(typeof g.target=="function"?g.target.call(e[0]):g.target);return(f&&true)?(f=="$next"?e.next(".popover"):d(f)):false};c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")};c.prototype.tip=function(){if(!this.$tip){this.$tip=d(this.options.template)}return this.$tip};var b=d.fn.popover;d.fn.popover=function(e){return this.each(function(){var h=d(this);var g=h.data("bs.popover");var f=typeof e=="object"&&e;if(!g){h.data("bs.popover",(g=new c(this,f)))}if(typeof e=="string"){g[e]()}})};d.fn.popover.Constructor=c;d.fn.popover.noConflict=function(){d.fn.popover=b;return this}}(window.jQuery);(function(b){jQuery.fn.lightbox=function(){var c=0;b("[data-toggle='lightbox']").each(function(){b(this).attr("data-id",c++)});b(this).click(function(){if(!b.fn.modal){throw new Error("modal requires for lightbox")}var e=b(this);var h=e.attr("data-image")||e.attr("src")||e.attr("href")||e.find("img").attr("src");if(!h){return false}if(b("#lightboxModal").size()==0){b('<div id="lightboxModal" class="modal fade modal-lightbox"><div class="modal-dialog"><button class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button><button class="controller prev"><i class="icon icon-chevron-left"></i></button><button class="controller next"><i class="icon icon-chevron-right"></i></button><img id="lightboxImg" src="#" alt="" data-dismiss="modal" /><div class="caption"></div></div></div>').appendTo("body");b("#lightboxModal .controller").click(function(){var k=parseInt(b("#lightboxModal").attr("data-id"))+(b(this).hasClass("prev")?-1:1);var j=b('[data-toggle="lightbox"][data-id="'+k+'"]');if(j){var i=j.attr("data-image")||j.attr("src")||j.attr("href")||j.find("img").attr("src");if(i){b("#lightboxImg").attr("src",i);b("#lightboxModal").attr("data-id",k);b("#lightboxModal .controller").hide();if(b('[data-toggle="lightbox"][data-id="'+(k-1)+'"]').length>0){b("#lightboxModal .prev").show()}if(b('[data-toggle="lightbox"][data-id="'+(k+1)+'"]').length>0){b("#lightboxModal .next").show()}b("#lightboxModal .modal-dialog").width(j.attr("data-width")||"auto").height(j.attr("data-height")||"auto").css("margin-top",Math.max(0,(b(window).height()-j.attr("data-height"))/2))}}})}var g=parseInt(e.attr("data-id"));var d=b("#lightboxImg");var f=b("#lightboxModal");f.find(".controller").hide();f.attr("data-id",g);if(b('[data-toggle="lightbox"][data-id="'+(g-1)+'"]').length>0){f.find(".prev").show()}if(b('[data-toggle="lightbox"][data-id="'+(g+1)+'"]').length>0){f.find(".next").show()}f.find(".modal-dialog").width(e.attr("data-width")||"auto").height(e.attr("data-height")||"auto").css("margin-top",Math.max(0,(b(window).height()-e.attr("data-height"))/2));d.attr("src",h);f.modal();return false})}})(jQuery);window.bootbox=window.bootbox||function a(I,H){function G(d){var c=s[u.locale];return c?c[d]:s.en[d]}function F(b,h,g){b.preventDefault();var f=I.isFunction(g)&&g(b)===!1;f||h.modal("hide")}function E(e){var d,f=0;for(d in e){f++}return f}function D(b,f){var e=0;I.each(b,function(d,c){f(d,c,e++)})}function C(b){var f,e;if("object"!=typeof b){throw new Error("Please supply an object of options")}if(!b.message){throw new Error("Please specify a message")}return b=I.extend({},u,b),b.buttons||(b.buttons={}),b.backdrop=b.backdrop?"static":!1,f=b.buttons,e=E(f),D(f,function(c,g,d){if(I.isFunction(g)&&(g=f[c]={callback:g}),"object"!==I.type(g)){throw new Error("button with key "+c+" must be an object")}g.label||(g.label=c),g.className||(g.className=2>=e&&d===e-1?"btn-primary":"btn-default")}),b}function B(f,e){var h=f.length,g={};if(1>h||h>2){throw new Error("Invalid argument length")}return 2===h||"string"==typeof f[0]?(g[e[0]]=f[0],g[e[1]]=f[1]):g=f[0],g}function A(b,f,e){return I.extend(!0,{},b,B(f,e))}function z(g,f,j,i){var h={className:"bootbox-"+g,buttons:y.apply(null,f)};return x(A(h,i,j),f)}function y(){for(var h={},d=0,l=arguments.length;l>d;d++){var k=arguments[d],j=k.toLowerCase(),i=k.toUpperCase();h[j]={label:G(i)}}return h}function x(e,c){var f={};return D(c,function(g,d){f[d]=!0}),D(e.buttons,function(b){if(f[b]===H){throw new Error("button key "+b+" is not allowed (options are "+c.join("\n")+")")}}),e}var w={dialog:"<div class='bootbox modal' tabindex='-1' role='dialog'><div class='modal-dialog'><div class='modal-content'><div class='modal-body'><div class='bootbox-body'></div></div></div></div></div>",header:"<div class='modal-header'><h4 class='modal-title'></h4></div>",footer:"<div class='modal-footer'></div>",closeButton:"<button type='button' class='bootbox-close-button close'>&times;</button>",form:"<form class='bootbox-form'></form>",inputs:{text:"<input class='bootbox-input bootbox-input-text form-control' autocomplete=off type=text />",email:"<input class='bootbox-input bootbox-input-email form-control' autocomplete='off' type='email' />",select:"<select class='bootbox-input bootbox-input-select form-control'></select>",checkbox:"<div class='checkbox'><label><input class='bootbox-input bootbox-input-checkbox' type='checkbox' /></label></div>"}},v=I("body"),u={locale:"en",backdrop:!0,animate:!0,className:null,closeButton:!0,show:!0},t={};t.alert=function(){var b;if(b=z("alert",["ok"],["message","callback"],arguments),b.callback&&!I.isFunction(b.callback)){throw new Error("alert requires callback property to be a function when provided")}return b.buttons.ok.callback=b.onEscape=function(){return I.isFunction(b.callback)?b.callback():!0},t.dialog(b)},t.confirm=function(){var b;if(b=z("confirm",["cancel","confirm"],["message","callback"],arguments),b.buttons.cancel.callback=b.onEscape=function(){return b.callback(!1)},b.buttons.confirm.callback=function(){return b.callback(!0)},!I.isFunction(b.callback)){throw new Error("confirm requires a callback")}return t.dialog(b)},t.prompt=function(){var r,q,n,m,l,j,g;if(m=I(w.form),q={className:"bootbox-prompt",buttons:y("cancel","confirm"),value:"",inputType:"text"},r=x(A(q,arguments,["title","callback"]),["cancel","confirm"]),j=r.show===H?!0:r.show,r.message=m,r.buttons.cancel.callback=r.onEscape=function(){return r.callback(null)},r.buttons.confirm.callback=function(){var f;switch(r.inputType){case"text":case"email":case"select":f=l.val();break;case"checkbox":var e=l.find("input:checked");f=[],D(e,function(h,i){f.push(I(i).val())})}return r.callback(f)},r.show=!1,!r.title){throw new Error("prompt requires a title")}if(!I.isFunction(r.callback)){throw new Error("prompt requires a callback")}if(!w.inputs[r.inputType]){throw new Error("invalid prompt type")}switch(l=I(w.inputs[r.inputType]),r.inputType){case"text":case"email":l.val(r.value);break;case"select":var c={};if(g=r.inputOptions||[],!g.length){throw new Error("prompt with select requires options")}D(g,function(f,i){var h=l;if(i.value===H||i.text===H){throw new Error("given options in wrong format")}i.group&&(c[i.group]||(c[i.group]=I("<optgroup/>").attr("label",i.group)),h=c[i.group]),h.append("<option value='"+i.value+"'>"+i.text+"</option>")}),D(c,function(e,d){l.append(d)}),l.val(r.value);break;case"checkbox":var b=I.isArray(r.value)?r.value:[r.value];if(g=r.inputOptions||[],!g.length){throw new Error("prompt with checkbox requires options")}if(!g[0].value||!g[0].text){throw new Error("given options in wrong format")}l=I("<div/>"),D(g,function(i,h){var f=I(w.inputs[r.inputType]);f.find("input").attr("value",h.value),f.find("label").append(h.text),D(b,function(e,d){d===h.value&&f.find("input").prop("checked",!0)}),l.append(f)})}return r.placeholder&&l.attr("placeholder",r.placeholder),m.append(l),m.on("submit",function(d){d.preventDefault(),n.find(".btn-primary").click()}),n=t.dialog(r),n.off("shown.bs.modal"),n.on("shown.bs.modal",function(){l.focus()}),j===!0&&n.modal("show"),n},t.dialog=function(b){b=C(b);var n=I(w.dialog),m=n.find(".modal-body"),l=b.buttons,h="",g={onEscape:b.onEscape};if(D(l,function(d,c){h+="<button data-bb-handler='"+d+"' type='button' class='btn "+c.className+"'>"+c.label+"</button>",g[d]=c.callback}),m.find(".bootbox-body").html(b.message),b.animate===!0&&n.addClass("fade"),b.className&&n.addClass(b.className),b.title&&m.before(w.header),b.closeButton){var e=I(w.closeButton);b.title?n.find(".modal-header").prepend(e):e.css("margin-top","-10px").prependTo(m)}return b.title&&n.find(".modal-title").html(b.title),h.length&&(m.after(w.footer),n.find(".modal-footer").html(h)),n.on("hidden.bs.modal",function(c){c.target===this&&n.remove()}),n.on("shown.bs.modal",function(){n.find(".btn-primary:first").focus()}),n.on("escape.close.bb",function(c){g.onEscape&&F(c,n,g.onEscape)}),n.on("click",".modal-footer button",function(c){var f=I(this).data("bb-handler");F(c,n,g[f])}),n.on("click",".bootbox-close-button",function(c){F(c,n,g.onEscape)}),n.on("keyup",function(c){27===c.which&&n.trigger("escape.close.bb")}),v.append(n),n.modal({backdrop:b.backdrop,keyboard:!1,show:!1}),b.show&&n.modal("show"),n},t.setDefaults=function(){var b={};2===arguments.length?b[arguments[0]]=arguments[1]:b=arguments[0],I.extend(u,b)},t.hideAll=function(){I(".bootbox").modal("hide")};var s={br:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Sim"},da:{OK:"OK",CANCEL:"Annuller",CONFIRM:"Accepter"},de:{OK:"OK",CANCEL:"Abbrechen",CONFIRM:"Akzeptieren"},en:{OK:"OK",CANCEL:"Cancel",CONFIRM:"OK"},es:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Aceptar"},fi:{OK:"OK",CANCEL:"Peruuta",CONFIRM:"OK"},fr:{OK:"OK",CANCEL:"Annuler",CONFIRM:"D'accord"},it:{OK:"OK",CANCEL:"Annulla",CONFIRM:"Conferma"},nl:{OK:"OK",CANCEL:"Annuleren",CONFIRM:"Accepteren"},no:{OK:"OK",CANCEL:"Avbryt",CONFIRM:"OK"},pl:{OK:"OK",CANCEL:"Anuluj",CONFIRM:"Potwierdź"},ru:{OK:"OK",CANCEL:"Отмена",CONFIRM:"Применить"},zh_CN:{OK:"OK",CANCEL:"取消",CONFIRM:"确认"},zh_TW:{OK:"OK",CANCEL:"取消",CONFIRM:"確認"}};return t.init=function(b){window.bootbox=a(b||I)},t}(window.jQuery);
