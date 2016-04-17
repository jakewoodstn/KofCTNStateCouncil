// MooTools: the javascript framework.
// Load this file's selection again by visiting: http://mootools.net/more/a800feb51797ade87d0c46f0048a54af 
// Or build this file again with packager using: packager build More/Fx.Elements More/Fx.Accordion More/Fx.Move More/Fx.Reveal More/Fx.Scroll More/Fx.Slide More/Fx.SmoothScroll More/Fx.Sort
/*
---
copyrights:
  - [MooTools](http://mootools.net)

licenses:
  - [MIT License](http://mootools.net/license.txt)
...
*/
MooTools.More={version:"1.3.0.1",build:"6dce99bed2792dffcbbbb4ddc15a1fb9a41994b5"};Fx.Elements=new Class({Extends:Fx.CSS,initialize:function(b,a){this.elements=this.subject=$$(b);
this.parent(a);},compute:function(g,h,j){var c={};for(var d in g){var a=g[d],e=h[d],f=c[d]={};for(var b in a){f[b]=this.parent(a[b],e[b],j);}}return c;
},set:function(b){for(var c in b){if(!this.elements[c]){continue;}var a=b[c];for(var d in a){this.render(this.elements[c],d,a[d],this.options.unit);}}return this;
},start:function(c){if(!this.check(c)){return this;}var h={},j={};for(var d in c){if(!this.elements[d]){continue;}var f=c[d],a=h[d]={},g=j[d]={};for(var b in f){var e=this.prepare(this.elements[d],b,f[b]);
a[b]=e.from;g[b]=e.to;}}return this.parent(h,j);}});Fx.Accordion=new Class({Extends:Fx.Elements,options:{fixedHeight:false,fixedWidth:false,display:0,show:false,height:true,width:false,opacity:true,alwaysHide:false,trigger:"click",initialDisplayFx:true,returnHeightToAuto:true},initialize:function(){var d=function(e){return e!=null;
};var c=Array.link(arguments,{container:Type.isElement,options:Type.isObject,togglers:d,elements:d});this.parent(c.elements,c.options);this.togglers=$$(c.togglers);
this.previous=-1;this.internalChain=new Chain();if(this.options.alwaysHide){this.options.wait=true;}if(this.options.show||this.options.show===0){this.options.display=false;
this.previous=this.options.show;}if(this.options.start){this.options.display=false;this.options.show=false;}this.effects={};if(this.options.opacity){this.effects.opacity="fullOpacity";
}if(this.options.width){this.effects.width=this.options.fixedWidth?"fullWidth":"offsetWidth";}if(this.options.height){this.effects.height=this.options.fixedHeight?"fullHeight":"scrollHeight";
}for(var b=0,a=this.togglers.length;b<a;b++){this.addSection(this.togglers[b],this.elements[b]);}this.elements.each(function(f,e){if(this.options.show===e){this.fireEvent("active",[this.togglers[e],f]);
}else{for(var g in this.effects){f.setStyle(g,0);}}},this);if(this.options.display||this.options.display===0||this.options.initialDisplayFx===false){this.display(this.options.display,this.options.initialDisplayFx);
}if(this.options.fixedHeight!==false){this.options.returnHeightToAuto=false;}this.addEvent("complete",this.internalChain.callChain.bind(this.internalChain));
},addSection:function(e,c){e=document.id(e);c=document.id(c);this.togglers.include(e);this.elements.include(c);var f=this.togglers.contains(e);var a=this.togglers.indexOf(e);
var b=this.display.pass(a,this);e.store("accordion:display",b).addEvent(this.options.trigger,b);if(this.options.height){c.setStyles({"padding-top":0,"border-top":"none","padding-bottom":0,"border-bottom":"none"});
}if(this.options.width){c.setStyles({"padding-left":0,"border-left":"none","padding-right":0,"border-right":"none"});}c.fullOpacity=1;if(this.options.fixedWidth){c.fullWidth=this.options.fixedWidth;
}if(this.options.fixedHeight){c.fullHeight=this.options.fixedHeight;}c.setStyle("overflow","hidden");if(!f){for(var d in this.effects){c.setStyle(d,0);
}}return this;},removeSection:function(e,b){var a=this.togglers.indexOf(e);var c=this.elements[a];var d=function(){this.togglers.erase(e);this.elements.erase(c);
this.detach(e);}.bind(this);if(this.now==a||b!=null){this.display(b!=null?b:(a-1>=0?a-1:0)).chain(d);}else{d();}return this;},detach:function(b){var a=function(c){c.removeEvent(this.options.trigger,c.retrieve("accordion:display"));
}.bind(this);if(!b){this.togglers.each(a);}else{a(b);}return this;},display:function(a,b){if(!this.check(a,b)){return this;}b=b!=null?b:true;a=(typeOf(a)=="element")?this.elements.indexOf(a):a;
if(a==this.previous&&!this.options.alwaysHide){return this;}if(this.options.returnHeightToAuto){var d=this.elements[this.previous];if(d&&!this.selfHidden){for(var c in this.effects){d.setStyle(c,d[this.effects[c]]);
}}}if((this.timer&&this.options.wait)||(a===this.previous&&!this.options.alwaysHide)){return this;}this.previous=a;var e={};this.elements.each(function(h,g){e[g]={};
var f;if(g!=a){f=true;}else{if(this.options.alwaysHide&&((h.offsetHeight>0&&this.options.height)||h.offsetWidth>0&&this.options.width)){f=true;this.selfHidden=true;
}}this.fireEvent(f?"background":"active",[this.togglers[g],h]);for(var j in this.effects){e[g][j]=f?0:h[this.effects[j]];}},this);this.internalChain.clearChain();
this.internalChain.chain(function(){if(this.options.returnHeightToAuto&&!this.selfHidden){var f=this.elements[a];if(f){f.setStyle("height","auto");}}}.bind(this));
return b?this.start(e):this.set(e);}});var Accordion=new Class({Extends:Fx.Accordion,initialize:function(){this.parent.apply(this,arguments);var a=Array.link(arguments,{container:Type.isElement});
this.container=a.container;},addSection:function(c,b,e){c=document.id(c);b=document.id(b);var d=this.togglers.contains(c);var a=this.togglers.length;if(a&&(!d||e)){e=e!=null?e:a-1;
c.inject(this.togglers[e],"before");b.inject(c,"after");}else{if(this.container&&!d){c.inject(this.container);b.inject(this.container);}}return this.parent.apply(this,arguments);
}});(function(){var a=function(d,c){var e=[];Object.each(c,function(f){Object.each(f,function(g){d.each(function(h){e.push(h+"-"+g+(h=="border"?"-width":""));
});});});return e;};var b=function(e,d){var c=0;Object.each(d,function(g,f){if(f.test(e)){c=c+g.toInt();}});return c;};Element.implement({measure:function(h){var d=function(j){return !!(!j||j.offsetHeight||j.offsetWidth);
};if(d(this)){return h.apply(this);}var g=this.getParent(),i=[],e=[];while(!d(g)&&g!=document.body){e.push(g.expose());g=g.getParent();}var f=this.expose();
var c=h.apply(this);f();e.each(function(j){j();});return c;},expose:function(){if(this.getStyle("display")!="none"){return function(){};}var c=this.style.cssText;
this.setStyles({display:"block",position:"absolute",visibility:"hidden"});return function(){this.style.cssText=c;}.bind(this);},getDimensions:function(c){c=Object.merge({computeSize:false},c);
var h={x:0,y:0};var g=function(i,e){return(e.computeSize)?i.getComputedSize(e):i.getSize();};var d=this.getParent("body");if(d&&this.getStyle("display")=="none"){h=this.measure(function(){return g(this,c);
});}else{if(d){try{h=g(this,c);}catch(f){}}}return Object.append(h,(h.x||h.x===0)?{width:h.x,height:h.y}:{x:h.width,y:h.height});},getComputedSize:function(c){if(c&&c.plains){c.planes=c.plains;
}c=Object.merge({styles:["padding","border"],planes:{height:["top","bottom"],width:["left","right"]},mode:"both"},c);var e={},d={width:0,height:0};if(c.mode=="vertical"){delete d.width;
delete c.planes.width;}else{if(c.mode=="horizontal"){delete d.height;delete c.planes.height;}}a(c.styles,c.planes).each(function(f){e[f]=this.getStyle(f).toInt();
},this);Object.each(c.planes,function(g,f){var h=f.capitalize();e[f]=this.getStyle(f).toInt();d["total"+h]=e[f];g.each(function(j){var i=b(j,e);d["computed"+j.capitalize()]=i;
d["total"+h]+=i;});},this);return Object.append(d,e);}});})();(function(){var a=Element.prototype.position;Element.implement({position:function(g){if(g&&(g.x!=null||g.y!=null)){return a?a.apply(this,arguments):this;
}Object.each(g||{},function(u,t){if(u==null){delete g[t];}});g=Object.merge({relativeTo:document.body,position:{x:"center",y:"center"},offset:{x:0,y:0}},g);
var r={x:0,y:0},e=false;var c=this.measure(function(){return document.id(this.getOffsetParent());});if(c&&c!=this.getDocument().body){r=c.measure(function(){return this.getPosition();
});e=c!=document.id(g.relativeTo);g.offset.x=g.offset.x-r.x;g.offset.y=g.offset.y-r.y;}var s=function(t){if(typeOf(t)!="string"){return t;}t=t.toLowerCase();
var u={};if(t.test("left")){u.x="left";}else{if(t.test("right")){u.x="right";}else{u.x="center";}}if(t.test("upper")||t.test("top")){u.y="top";}else{if(t.test("bottom")){u.y="bottom";
}else{u.y="center";}}return u;};g.edge=s(g.edge);g.position=s(g.position);if(!g.edge){if(g.position.x=="center"&&g.position.y=="center"){g.edge={x:"center",y:"center"};
}else{g.edge={x:"left",y:"top"};}}this.setStyle("position","absolute");var f=document.id(g.relativeTo)||document.body,d=f==document.body?window.getScroll():f.getPosition(),l=d.y,h=d.x;
var n=this.getDimensions({computeSize:true,styles:["padding","border","margin"]});var j={},o=g.offset.y,q=g.offset.x,k=window.getSize();switch(g.position.x){case"left":j.x=h+q;
break;case"right":j.x=h+q+f.offsetWidth;break;default:j.x=h+((f==document.body?k.x:f.offsetWidth)/2)+q;break;}switch(g.position.y){case"top":j.y=l+o;break;
case"bottom":j.y=l+o+f.offsetHeight;break;default:j.y=l+((f==document.body?k.y:f.offsetHeight)/2)+o;break;}if(g.edge){var b={};switch(g.edge.x){case"left":b.x=0;
break;case"right":b.x=-n.x-n.computedRight-n.computedLeft;break;default:b.x=-(n.totalWidth/2);break;}switch(g.edge.y){case"top":b.y=0;break;case"bottom":b.y=-n.y-n.computedTop-n.computedBottom;
break;default:b.y=-(n.totalHeight/2);break;}j.x+=b.x;j.y+=b.y;}j={left:((j.x>=0||e||g.allowNegative)?j.x:0).toInt(),top:((j.y>=0||e||g.allowNegative)?j.y:0).toInt()};
var i={left:"x",top:"y"};["minimum","maximum"].each(function(t){["left","top"].each(function(u){var v=g[t]?g[t][i[u]]:null;if(v!=null&&((t=="minimum")?j[u]<v:j[u]>v)){j[u]=v;
}});});if(f.getStyle("position")=="fixed"||g.relFixedPosition){var m=window.getScroll();j.top+=m.y;j.left+=m.x;}if(g.ignoreScroll){var p=f.getScroll();
j.top-=p.y;j.left-=p.x;}if(g.ignoreMargins){j.left+=(g.edge.x=="right"?n["margin-right"]:g.edge.x=="center"?-n["margin-left"]+((n["margin-right"]+n["margin-left"])/2):-n["margin-left"]);
j.top+=(g.edge.y=="bottom"?n["margin-bottom"]:g.edge.y=="center"?-n["margin-top"]+((n["margin-bottom"]+n["margin-top"])/2):-n["margin-top"]);}j.left=Math.ceil(j.left);
j.top=Math.ceil(j.top);if(g.returnPos){return j;}else{this.setStyles(j);}return this;}});})();Fx.Move=new Class({Extends:Fx.Morph,options:{relativeTo:document.body,position:"center",edge:false,offset:{x:0,y:0}},start:function(a){var b=this.element,c=b.getStyles("top","left");
if(c.top=="auto"||c.left=="auto"){b.setPosition(b.getPosition(b.getOffsetParent()));}return this.parent(b.position(Object.merge(this.options,a,{returnPos:true})));
}});Element.Properties.move={set:function(a){this.get("move").cancel().setOptions(a);return this;},get:function(){var a=this.retrieve("move");if(!a){a=new Fx.Move(this,{link:"cancel"});
this.store("move",a);}return a;}};Element.implement({move:function(a){this.get("move").start(a);return this;}});Element.implement({isDisplayed:function(){return this.getStyle("display")!="none";
},isVisible:function(){var a=this.offsetWidth,b=this.offsetHeight;return(a==0&&b==0)?false:(a>0&&b>0)?true:this.style.display!="none";},toggle:function(){return this[this.isDisplayed()?"hide":"show"]();
},hide:function(){var b;try{b=this.getStyle("display");}catch(a){}if(b=="none"){return this;}return this.store("element:_originalDisplay",b||"").setStyle("display","none");
},show:function(a){if(!a&&this.isDisplayed()){return this;}a=a||this.retrieve("element:_originalDisplay")||"block";return this.setStyle("display",(a=="none")?"block":a);
},swapClass:function(a,b){return this.removeClass(a).addClass(b);}});Document.implement({clearSelection:function(){if(document.selection&&document.selection.empty){document.selection.empty();
}else{if(window.getSelection){var a=window.getSelection();if(a&&a.removeAllRanges){a.removeAllRanges();}}}}});Fx.Reveal=new Class({Extends:Fx.Morph,options:{link:"cancel",styles:["padding","border","margin"],transitionOpacity:!Browser.ie6,mode:"vertical",display:function(){return this.element.get("tag")!="tr"?"block":"table-row";
},opacity:1,hideInputs:Browser.ie?"select, input, textarea, object, embed":null},dissolve:function(){if(!this.hiding&&!this.showing){if(this.element.getStyle("display")!="none"){this.hiding=true;
this.showing=false;this.hidden=true;this.cssText=this.element.style.cssText;var c=this.element.getComputedSize({styles:this.options.styles,mode:this.options.mode});
if(this.options.transitionOpacity){c.opacity=this.options.opacity;}var b={};Object.each(c,function(e,d){b[d]=[e,0];});this.element.setStyles({display:Function.from(this.options.display).call(this),overflow:"hidden"});
var a=this.options.hideInputs?this.element.getElements(this.options.hideInputs):null;if(a){a.setStyle("visibility","hidden");}this.$chain.unshift(function(){if(this.hidden){this.hiding=false;
this.element.style.cssText=this.cssText;this.element.setStyle("display","none");if(a){a.setStyle("visibility","visible");}}this.fireEvent("hide",this.element);
this.callChain();}.bind(this));this.start(b);}else{this.callChain.delay(10,this);this.fireEvent("complete",this.element);this.fireEvent("hide",this.element);
}}else{if(this.options.link=="chain"){this.chain(this.dissolve.bind(this));}else{if(this.options.link=="cancel"&&!this.hiding){this.cancel();this.dissolve();
}}}return this;},reveal:function(){if(!this.showing&&!this.hiding){if(this.element.getStyle("display")=="none"){this.hiding=false;this.showing=true;this.hidden=false;
this.cssText=this.element.style.cssText;var c;this.element.measure(function(){c=this.element.getComputedSize({styles:this.options.styles,mode:this.options.mode});
}.bind(this));if(this.options.heightOverride!=null){c.height=this.options.heightOverride.toInt();}if(this.options.widthOverride!=null){c.width=this.options.widthOverride.toInt();
}if(this.options.transitionOpacity){this.element.setStyle("opacity",0);c.opacity=this.options.opacity;}var b={height:0,display:Function.from(this.options.display).call(this)};
Object.each(c,function(e,d){b[d]=0;});b.overflow="hidden";this.element.setStyles(b);var a=this.options.hideInputs?this.element.getElements(this.options.hideInputs):null;
if(a){a.setStyle("visibility","hidden");}this.$chain.unshift(function(){this.element.style.cssText=this.cssText;this.element.setStyle("display",Function.from(this.options.display).call(this));
if(!this.hidden){this.showing=false;}if(a){a.setStyle("visibility","visible");}this.callChain();this.fireEvent("show",this.element);}.bind(this));this.start(c);
}else{this.callChain();this.fireEvent("complete",this.element);this.fireEvent("show",this.element);}}else{if(this.options.link=="chain"){this.chain(this.reveal.bind(this));
}else{if(this.options.link=="cancel"&&!this.showing){this.cancel();this.reveal();}}}return this;},toggle:function(){if(this.element.getStyle("display")=="none"){this.reveal();
}else{this.dissolve();}return this;},cancel:function(){this.parent.apply(this,arguments);this.element.style.cssText=this.cssText;this.hiding=false;this.showing=false;
return this;}});Element.Properties.reveal={set:function(a){this.get("reveal").cancel().setOptions(a);return this;},get:function(){var a=this.retrieve("reveal");
if(!a){a=new Fx.Reveal(this);this.store("reveal",a);}return a;}};Element.Properties.dissolve=Element.Properties.reveal;Element.implement({reveal:function(a){this.get("reveal").setOptions(a).reveal();
return this;},dissolve:function(a){this.get("reveal").setOptions(a).dissolve();return this;},nix:function(a){var b=Array.link(arguments,{destroy:Type.isBoolean,options:Type.isObject});
this.get("reveal").setOptions(a).dissolve().chain(function(){this[b.destroy?"destroy":"dispose"]();}.bind(this));return this;},wink:function(){var b=Array.link(arguments,{duration:Type.isNumber,options:Type.isObject});
var a=this.get("reveal").setOptions(b.options);a.reveal().chain(function(){(function(){a.dissolve();}).delay(b.duration||2000);});}});(function(){Fx.Scroll=new Class({Extends:Fx,options:{offset:{x:0,y:0},wheelStops:true},initialize:function(c,b){this.element=this.subject=document.id(c);
this.parent(b);if(typeOf(this.element)!="element"){this.element=document.id(this.element.getDocument().body);}if(this.options.wheelStops){var d=this.element,e=this.cancel.pass(false,this);
this.addEvent("start",function(){d.addEvent("mousewheel",e);},true);this.addEvent("complete",function(){d.removeEvent("mousewheel",e);},true);}},set:function(){var b=Array.flatten(arguments);
if(Browser.firefox){b=[Math.round(b[0]),Math.round(b[1])];}this.element.scrollTo(b[0]+this.options.offset.x,b[1]+this.options.offset.y);},compute:function(d,c,b){return[0,1].map(function(e){return Fx.compute(d[e],c[e],b);
});},start:function(c,h){if(!this.check(c,h)){return this;}var e=this.element,f=e.getScrollSize(),b=e.getScroll(),d=e.getSize();values={x:c,y:h};for(var g in values){if(!values[g]&&values[g]!==0){values[g]=b[g];
}if(typeOf(values[g])!="number"){values[g]=f[g]-d[g];}values[g]+=this.options.offset[g];}return this.parent([b.x,b.y],[values.x,values.y]);},toTop:function(){return this.start(false,0);
},toLeft:function(){return this.start(0,false);},toRight:function(){return this.start("right",false);},toBottom:function(){return this.start(false,"bottom");
},toElement:function(d){var c=document.id(d).getPosition(this.element),b=a(this.element)?{x:0,y:0}:this.element.getScroll();return this.start(c.x+b.x,c.y+b.y);
},scrollIntoView:function(d,g,e){g=g?Array.from(g):["x","y"];d=document.id(d);var i={},f=d.getPosition(this.element),j=d.getSize(),h=this.element.getScroll(),b=this.element.getSize(),c={x:f.x+j.x,y:f.y+j.y};
["x","y"].each(function(k){if(g.contains(k)){if(c[k]>h[k]+b[k]){i[k]=c[k]-b[k];}if(f[k]<h[k]){i[k]=f[k];}}if(i[k]==null){i[k]=h[k];}if(e&&e[k]){i[k]=i[k]+e[k];
}},this);if(i.x!=h.x||i.y!=h.y){this.start(i.x,i.y);}return this;},scrollToCenter:function(e,f,h){f=f?Array.from(f):["x","y"];e=document.id(e);var i={},c=e.getPosition(this.element),d=e.getSize(),b=this.element.getScroll(),g=this.element.getSize();
["x","y"].each(function(j){if(f.contains(j)){i[j]=c[j]-(g[j]-d[j])/2;}if(i[j]==null){i[j]=b[j];}if(h&&h[j]){i[j]=i[j]+h[j];}},this);if(i.x!=b.x||i.y!=b.y){this.start(i.x,i.y);
}return this;}});function a(b){return(/^(?:body|html)$/i).test(b.tagName);}})();Fx.Slide=new Class({Extends:Fx,options:{mode:"vertical",wrapper:false,hideOverflow:true,resetHeight:false},initialize:function(b,a){this.addEvent("complete",function(){this.open=(this.wrapper["offset"+this.layout.capitalize()]!=0);
if(this.open&&this.options.resetHeight){this.wrapper.setStyle("height","");}},true);this.element=this.subject=document.id(b);this.parent(a);var d=this.element.retrieve("wrapper");
var c=this.element.getStyles("margin","position","overflow");if(this.options.hideOverflow){c=Object.append(c,{overflow:"hidden"});}if(this.options.wrapper){d=document.id(this.options.wrapper).setStyles(c);
}this.wrapper=d||new Element("div",{styles:c}).wraps(this.element);this.element.store("wrapper",this.wrapper).setStyle("margin",0);this.now=[];this.open=true;
},vertical:function(){this.margin="margin-top";this.layout="height";this.offset=this.element.offsetHeight;},horizontal:function(){this.margin="margin-left";
this.layout="width";this.offset=this.element.offsetWidth;},set:function(a){this.element.setStyle(this.margin,a[0]);this.wrapper.setStyle(this.layout,a[1]);
return this;},compute:function(c,b,a){return[0,1].map(function(d){return Fx.compute(c[d],b[d],a);});},start:function(b,e){if(!this.check(b,e)){return this;
}this[e||this.options.mode]();var d=this.element.getStyle(this.margin).toInt();var c=this.wrapper.getStyle(this.layout).toInt();var a=[[d,c],[0,this.offset]];
var g=[[d,c],[-this.offset,0]];var f;switch(b){case"in":f=a;break;case"out":f=g;break;case"toggle":f=(c==0)?a:g;}return this.parent(f[0],f[1]);},slideIn:function(a){return this.start("in",a);
},slideOut:function(a){return this.start("out",a);},hide:function(a){this[a||this.options.mode]();this.open=false;return this.set([-this.offset,0]);},show:function(a){this[a||this.options.mode]();
this.open=true;return this.set([0,this.offset]);},toggle:function(a){return this.start("toggle",a);}});Element.Properties.slide={set:function(a){this.get("slide").cancel().setOptions(a);
return this;},get:function(){var a=this.retrieve("slide");if(!a){a=new Fx.Slide(this,{link:"cancel"});this.store("slide",a);}return a;}};Element.implement({slide:function(d,e){d=d||"toggle";
var b=this.get("slide"),a;switch(d){case"hide":b.hide(e);break;case"show":b.show(e);break;case"toggle":var c=this.retrieve("slide:flag",b.open);b[c?"slideOut":"slideIn"](e);
this.store("slide:flag",!c);a=true;break;default:b.start(d,e);}if(!a){this.eliminate("slide:flag");}return this;}});var SmoothScroll=Fx.SmoothScroll=new Class({Extends:Fx.Scroll,initialize:function(c,d){d=d||document;
this.doc=d.getDocument();this.parent(this.doc,c);var e=d.getWindow(),a=e.location.href.match(/^[^#]*/)[0]+"#",b=$$(this.options.links||this.doc.links);
b.each(function(g){if(g.href.indexOf(a)!=0){return;}var f=g.href.substr(a.length);if(f){this.useLink(g,f);}},this);},useLink:function(b,a){b.addEvent("click",function(d){var c=document.id(a)||this.doc.getElement("a[name="+a+"]");
if(!c){return;}d.preventDefault();this.toElement(c).chain(function(){this.fireEvent("scrolledTo",[b,c]);}.bind(this));}.bind(this));return this;}});Fx.Sort=new Class({Extends:Fx.Elements,options:{mode:"vertical"},initialize:function(b,a){this.parent(b,a);
this.elements.each(function(c){if(c.getStyle("position")=="static"){c.setStyle("position","relative");}});this.setDefaultOrder();},setDefaultOrder:function(){this.currentOrder=this.elements.map(function(b,a){return a;
});},sort:function(){if(!this.check(arguments)){return this;}var e=Array.flatten(arguments);var i=0,a=0,c={},h={},d=this.options.mode=="vertical";var f=this.elements.map(function(m,k){var l=m.getComputedSize({styles:["border","padding","margin"]});
var n;if(d){n={top:i,margin:l["margin-top"],height:l.totalHeight};i+=n.height-l["margin-top"];}else{n={left:a,margin:l["margin-left"],width:l.totalWidth};
a+=n.width;}var j=d?"top":"left";h[k]={};var o=m.getStyle(j).toInt();h[k][j]=o||0;return n;},this);this.set(h);e=e.map(function(j){return j.toInt();});
if(e.length!=this.elements.length){this.currentOrder.each(function(j){if(!e.contains(j)){e.push(j);}});if(e.length>this.elements.length){e.splice(this.elements.length-1,e.length-this.elements.length);
}}var b=i=a=0;e.each(function(l,j){var k={};if(d){k.top=i-f[l].top-b;i+=f[l].height;}else{k.left=a-f[l].left;a+=f[l].width;}b=b+f[l].margin;c[l]=k;},this);
var g={};Array.clone(e).sort().each(function(j){g[j]=c[j];});this.start(g);this.currentOrder=e;return this;},rearrangeDOM:function(a){a=a||this.currentOrder;
var b=this.elements[0].getParent();var c=[];this.elements.setStyle("opacity",0);a.each(function(d){c.push(this.elements[d].inject(b).setStyles({top:0,left:0}));
},this);this.elements.setStyle("opacity",1);this.elements=$$(c);this.setDefaultOrder();return this;},getDefaultOrder:function(){return this.elements.map(function(b,a){return a;
});},forward:function(){return this.sort(this.getDefaultOrder());},backward:function(){return this.sort(this.getDefaultOrder().reverse());},reverse:function(){return this.sort(this.currentOrder.reverse());
},sortByElements:function(a){return this.sort(a.map(function(b){return this.elements.indexOf(b);},this));},swap:function(c,b){if(typeOf(c)=="element"){c=this.elements.indexOf(c);
}if(typeOf(b)=="element"){b=this.elements.indexOf(b);}var a=Array.clone(this.currentOrder);a[this.currentOrder.indexOf(c)]=b;a[this.currentOrder.indexOf(b)]=c;
return this.sort(a);}});