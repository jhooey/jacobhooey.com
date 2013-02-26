/* <![CDATA[ */
function init() {
 var inputs = document.getElementsByTagName('input');
 for(var i=0; i < inputs.length; i++) {
  inputs[i].setAttribute('rel',inputs[i].defaultValue);
  inputs[i].onfocus = function() {
   if (this.value == this.getAttribute('rel') && this.getAttribute('type') != 'submit' && this.getAttribute('type') != 'reset') {
    this.value = '';
   } else {
    return false;
   }
  }
  inputs[i].onblur = function() {
   if(this.value=='' && this.getAttribute('type') != 'submit' && this.getAttribute('type') != 'reset') {
    this.value = this.getAttribute('rel');
   } else {
    return false;
   }
  }
  inputs[i].ondblclick = function() {
   this.value = this.getAttribute('rel')
  }
 }
}
 
if(document.childNodes) {
 window.onload = init;
}
/* ]]> */