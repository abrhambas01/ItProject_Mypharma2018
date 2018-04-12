//main JS file

$.fn.openModal = function () {
	this.modal();
	this.modal('open');
};

$.fn.closeModal = function () {
	this.modal('close');
};














/* Router JS */
!function(t){function e(){return""===c.hash||"#"===c.hash}function r(t,e){for(var r=0;r<t.length;r+=1)if(e(t[r],r,t)===!1)return}function i(t){for(var e=[],r=0,i=t.length;i>r;r++)e=e.concat(t[r]);return e}function n(t,e,r){if(!t.length)return r();var i=0;!function n(){e(t[i],function(e){e||e===!1?(r(e),r=function(){}):(i+=1,i===t.length?r():n())})}()}function o(t,e,r){r=t;for(var i in e)if(e.hasOwnProperty(i)&&(r=e[i](t),r!==t))break;return r===t?"([._a-zA-Z0-9-%()]+)":r}function h(t,e){for(var r,i=0,n="";r=t.substr(i).match(/[^\w\d\- %@&]*\*[^\w\d\- %@&]*/);)i=r.index+r[0].length,r[0]=r[0].replace(/^\*/,"([_.()!\\ %@&a-zA-Z0-9-]+)"),n+=t.substr(0,r.index)+r[0];t=n+=t.substr(i);var s,h,a=t.match(/:([^\/]+)/gi);if(a){h=a.length;for(var c=0;h>c;c++)s=a[c],t="::"===s.slice(0,2)?s.slice(1):t.replace(s,o(s,e))}return t}function a(t,e,r,i){var n,o=0,s=0,h=0,r=(r||"(").toString(),i=(i||")").toString();for(n=0;n<t.length;n++){var a=t[n];if(a.indexOf(r,o)>a.indexOf(i,o)||~a.indexOf(r,o)&&!~a.indexOf(i,o)||!~a.indexOf(r,o)&&~a.indexOf(i,o)){if(s=a.indexOf(r,o),h=a.indexOf(i,o),~s&&!~h||!~s&&~h){var c=t.slice(0,(n||1)+1).join(e);t=[c].concat(t.slice((n||1)+1))}o=(h>s?h:s)+1,n=0}else o=0}return t}var c=document.location,u={mode:"modern",hash:c.hash,history:!1,check:function(){var t=c.hash;t!=this.hash&&(this.hash=t,this.onHashChanged())},fire:function(){"modern"===this.mode?this.history===!0?window.onpopstate():window.onhashchange():this.onHashChanged()},init:function(t,e){function r(t){for(var e=0,r=f.listeners.length;r>e;e++)f.listeners[e](t)}var i=this;if(this.history=e,f.listeners||(f.listeners=[]),"onhashchange"in window&&(void 0===document.documentMode||document.documentMode>7))this.history===!0?setTimeout(function(){window.onpopstate=r},500):window.onhashchange=r,this.mode="modern";else{var n=document.createElement("iframe");n.id="state-frame",n.style.display="none",document.body.appendChild(n),this.writeFrame(""),"onpropertychange"in document&&"attachEvent"in document&&document.attachEvent("onpropertychange",function(){"location"===event.propertyName&&i.check()}),window.setInterval(function(){i.check()},50),this.onHashChanged=r,this.mode="legacy"}return f.listeners.push(t),this.mode},destroy:function(t){if(f&&f.listeners)for(var e=f.listeners,r=e.length-1;r>=0;r--)e[r]===t&&e.splice(r,1)},setHash:function(t){return"legacy"===this.mode&&this.writeFrame(t),this.history===!0?(window.history.pushState({},document.title,t),this.fire()):c.hash="/"===t[0]?t:"/"+t,this},writeFrame:function(t){var e=document.getElementById("state-frame"),r=e.contentDocument||e.contentWindow.document;r.open(),r.write("<script>_hash = '"+t+"'; onload = parent.listener.syncHash;<script>"),r.close()},syncHash:function(){var t=this._hash;return t!=c.hash&&(c.hash=t),this},onHashChanged:function(){}},f=t.Router=function(t){return this instanceof f?(this.params={},this.routes={},this.methods=["on","once","after","before"],this.scope=[],this._methods={},this._insert=this.insert,this.insert=this.insertEx,this.historySupport=null!=(null!=window.history?window.history.pushState:null),this.configure(),void this.mount(t||{})):new f(t)};f.prototype.init=function(t){var r,i=this;return this.handler=function(t){var e=t&&t.newURL||window.location.hash,r=i.history===!0?i.getPath():e.replace(/.*#/,"");i.dispatch("on","/"===r.charAt(0)?r:"/"+r)},u.init(this.handler,this.history),this.history===!1?e()&&t?c.hash=t:e()||i.dispatch("on","/"+c.hash.replace(/^(#\/|#|\/)/,"")):(this.convert_hash_in_init?(r=e()&&t?t:e()?null:c.hash.replace(/^#/,""),r&&window.history.replaceState({},document.title,r)):r=this.getPath(),(r||this.run_in_init===!0)&&this.handler()),this},f.prototype.explode=function(){var t=this.history===!0?this.getPath():c.hash;return"/"===t.charAt(1)&&(t=t.slice(1)),t.slice(1,t.length).split("/")},f.prototype.setRoute=function(t,e,r){var i=this.explode();return"number"==typeof t&&"string"==typeof e?i[t]=e:"string"==typeof r?i.splice(t,e,s):i=[t],u.setHash(i.join("/")),i},f.prototype.insertEx=function(t,e,r,i){return"once"===t&&(t="on",r=function(t){var e=!1;return function(){return e?void 0:(e=!0,t.apply(this,arguments))}}(r)),this._insert(t,e,r,i)},f.prototype.getRoute=function(t){var e=t;if("number"==typeof t)e=this.explode()[t];else if("string"==typeof t){var r=this.explode();e=r.indexOf(t)}else e=this.explode();return e},f.prototype.destroy=function(){return u.destroy(this.handler),this},f.prototype.getPath=function(){var t=window.location.pathname;return"/"!==t.substr(0,1)&&(t="/"+t),t};var l=/\?.*/;f.prototype.configure=function(t){t=t||{};for(var e=0;e<this.methods.length;e++)this._methods[this.methods[e]]=!0;return this.recurse=t.recurse||this.recurse||!1,this.async=t.async||!1,this.delimiter=t.delimiter||"/",this.strict="undefined"==typeof t.strict?!0:t.strict,this.notfound=t.notfound,this.resource=t.resource,this.history=t.html5history&&this.historySupport||!1,this.run_in_init=this.history===!0&&t.run_handler_in_init!==!1,this.convert_hash_in_init=this.history===!0&&t.convert_hash_in_init!==!1,this.every={after:t.after||null,before:t.before||null,on:t.on||null},this},f.prototype.param=function(t,e){":"!==t[0]&&(t=":"+t);var r=new RegExp(t,"g");return this.params[t]=function(t){return t.replace(r,e.source||e)},this},f.prototype.on=f.prototype.route=function(t,e,r){var i=this;return r||"function"!=typeof e||(r=e,e=t,t="on"),Array.isArray(e)?e.forEach(function(e){i.on(t,e,r)}):(e.source&&(e=e.source.replace(/\\\//gi,"/")),Array.isArray(t)?t.forEach(function(t){i.on(t.toLowerCase(),e,r)}):(e=e.split(new RegExp(this.delimiter)),e=a(e,this.delimiter),void this.insert(t,this.scope.concat(e),r)))},f.prototype.path=function(t,e){var r=this.scope.length;t.source&&(t=t.source.replace(/\\\//gi,"/")),t=t.split(new RegExp(this.delimiter)),t=a(t,this.delimiter),this.scope=this.scope.concat(t),e.call(this,this),this.scope.splice(r,t.length)},f.prototype.dispatch=function(t,e,r){function i(){o.last=s.after,o.invoke(o.runlist(s),o,r)}var n,o=this,s=this.traverse(t,e.replace(l,""),this.routes,""),h=this._invoked;return this._invoked=!0,s&&0!==s.length?("forward"===this.recurse&&(s=s.reverse()),n=this.every&&this.every.after?[this.every.after].concat(this.last):[this.last],n&&n.length>0&&h?(this.async?this.invoke(n,this,i):(this.invoke(n,this),i()),!0):(i(),!0)):(this.last=[],"function"==typeof this.notfound&&this.invoke([this.notfound],{method:t,path:e},r),!1)},f.prototype.invoke=function(t,e,i){var o,s=this;this.async?(o=function(r,i){return Array.isArray(r)?n(r,o,i):void("function"==typeof r&&r.apply(e,(t.captures||[]).concat(i)))},n(t,o,function(){i&&i.apply(e,arguments)})):(o=function(i){return Array.isArray(i)?r(i,o):"function"==typeof i?i.apply(e,t.captures||[]):void("string"==typeof i&&s.resource&&s.resource[i].apply(e,t.captures||[]))},r(t,o))},f.prototype.traverse=function(t,e,r,i,n){function o(t){function e(t){for(var r=[],i=0;i<t.length;i++)r[i]=Array.isArray(t[i])?e(t[i]):t[i];return r}function r(t){for(var e=t.length-1;e>=0;e--)Array.isArray(t[e])?(r(t[e]),0===t[e].length&&t.splice(e,1)):n(t[e])||t.splice(e,1)}if(!n)return t;var i=e(t);return i.matched=t.matched,i.captures=t.captures,i.after=t.after.filter(n),r(i),i}var s,h,a,c,u=[];if(e===this.delimiter&&r[t])return c=[[r.before,r[t]].filter(Boolean)],c.after=[r.after].filter(Boolean),c.matched=!0,c.captures=[],o(c);for(var f in r)if(r.hasOwnProperty(f)&&(!this._methods[f]||this._methods[f]&&"object"==typeof r[f]&&!Array.isArray(r[f]))){if(s=h=i+this.delimiter+f,this.strict||(h+="["+this.delimiter+"]?"),a=e.match(new RegExp("^"+h)),!a)continue;if(a[0]&&a[0]==e&&r[f][t])return c=[[r[f].before,r[f][t]].filter(Boolean)],c.after=[r[f].after].filter(Boolean),c.matched=!0,c.captures=a.slice(1),this.recurse&&r===this.routes&&(c.push([r.before,r.on].filter(Boolean)),c.after=c.after.concat([r.after].filter(Boolean))),o(c);if(c=this.traverse(t,e,r[f],s),c.matched)return c.length>0&&(u=u.concat(c)),this.recurse&&(u.push([r[f].before,r[f].on].filter(Boolean)),c.after=c.after.concat([r[f].after].filter(Boolean)),r===this.routes&&(u.push([r.before,r.on].filter(Boolean)),c.after=c.after.concat([r.after].filter(Boolean)))),u.matched=!0,u.captures=c.captures,u.after=c.after,o(u)}return!1},f.prototype.insert=function(t,e,r,i){var n,o,s,a,c;if(e=e.filter(function(t){return t&&t.length>0}),i=i||this.routes,c=e.shift(),/\:|\*/.test(c)&&!/\\d|\\w/.test(c)&&(c=h(c,this.params)),e.length>0)return i[c]=i[c]||{},this.insert(t,e,r,i[c]);if(c||e.length||i!==this.routes){if(o=typeof i[c],s=Array.isArray(i[c]),i[c]&&!s&&"object"==o)switch(n=typeof i[c][t]){case"function":return void(i[c][t]=[i[c][t],r]);case"object":return void i[c][t].push(r);case"undefined":return void(i[c][t]=r)}else if("undefined"==o)return a={},a[t]=r,void(i[c]=a);throw new Error("Invalid route context: "+o)}switch(n=typeof i[t]){case"function":return void(i[t]=[i[t],r]);case"object":return void i[t].push(r);case"undefined":return void(i[t]=r)}},f.prototype.extend=function(t){function e(t){i._methods[t]=!0,i[t]=function(){var e=1===arguments.length?[t,""]:[t];i.on.apply(i,e.concat(Array.prototype.slice.call(arguments)))}}var r,i=this,n=t.length;for(r=0;n>r;r++)e(t[r])},f.prototype.runlist=function(t){var e=this.every&&this.every.before?[this.every.before].concat(i(t)):i(t);return this.every&&this.every.on&&e.push(this.every.on),e.captures=t.captures,e.source=t.source,e},f.prototype.mount=function(t,e){function r(e,r){var n=e,o=e.split(i.delimiter),s=typeof t[e],h=""===o[0]||!i._methods[o[0]],c=h?"on":n;return h&&(n=n.slice((n.match(new RegExp("^"+i.delimiter))||[""])[0].length),o.shift()),h&&"object"===s&&!Array.isArray(t[e])?(r=r.concat(o),void i.mount(t[e],r)):(h&&(r=r.concat(n.split(i.delimiter)),r=a(r,i.delimiter)),void i.insert(c,r,t[e]))}if(t&&"object"==typeof t&&!Array.isArray(t)){var i=this;e=e||[],Array.isArray(e)||(e=e.split(i.delimiter));for(var n in t)t.hasOwnProperty(n)&&r(n,e.slice(0))}}}("object"==typeof exports?exports:window);