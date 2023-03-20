/* Size of the screen */

var w = window.innerWidth;
var h = window.innerHeight;

var windowSize = document.createElement('body');
windowSize.style.width = w;
windowSize.style.height = h;


ELEMENT.style.setProperty('--element-width', w);
ELEMENT.style.setProperty('--element-height', h);

var x = document.getElementById("demo");
x.innerHTML = "Browser width: " + w + ", height: " + h + ".";
