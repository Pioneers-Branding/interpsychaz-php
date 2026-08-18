(function(w,d){'use strict';var api=w.dmmConsent;var root=d.getElementById('dmm-cg');if(!api||!root){return}
var cats=root.querySelector('.dmm-cg__cats');var saveBtn=root.querySelector('[data-dmm-action="save"]');var customizeBtn=root.querySelector('[data-dmm-action="customize"]');var lastFocus=null;function checked(){var boxes=root.querySelectorAll('[data-dmm-cat-input]');var out=[];for(var i=0;i<boxes.length;i++){if(boxes[i].checked){out.push(boxes[i].value)}}
return out}
function show(){lastFocus=d.activeElement;root.hidden=!1;d.documentElement.classList.add('dmm-cg-showing');var first=root.querySelector('.dmm-cg__btn');if(first){first.focus()}}
function hide(){root.hidden=!0;d.documentElement.classList.remove('dmm-cg-showing');if(lastFocus&&lastFocus.focus){lastFocus.focus()}}
function expand(){if(!cats||!saveBtn||!customizeBtn){return}
cats.hidden=!1;saveBtn.hidden=!1;customizeBtn.hidden=!0;var current=api.get()||[];var boxes=root.querySelectorAll('[data-dmm-cat-input]');for(var i=0;i<boxes.length;i++){boxes[i].checked=current.indexOf(boxes[i].value)>-1&&!(api.gpc&&boxes[i].value==='marketing')}}
root.addEventListener('click',function(ev){var btn=ev.target.closest?ev.target.closest('[data-dmm-action]'):null;if(!btn){return}
var action=btn.getAttribute('data-dmm-action');if(action==='customize'){expand();return}
if(action==='acknowledge'){api.acknowledge();hide();return}
if(action==='accept'){api.acceptAll();hide();return}
if(action==='reject'){api.rejectAll();hide();return}
if(action==='save'){api.save(checked());hide()}});root.addEventListener('keydown',function(ev){if(ev.key==='Escape'&&api.get()){hide()}});d.addEventListener('click',function(ev){if(!ev.target.closest){return}
var trigger=ev.target.closest('.dmm-cg-open, a[href="#cookie-settings"], a[href$="#cookie-settings"]');if(!trigger||root.contains(trigger)){return}
ev.preventDefault();expand();show()});d.addEventListener('dmm:open',function(){expand();show()});if(!api.get()){show()}}(window,document))