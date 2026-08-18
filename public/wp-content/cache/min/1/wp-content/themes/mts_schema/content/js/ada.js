document.addEventListener("DOMContentLoaded",function(){const toolbarToggle=document.querySelector(".wda-toolbar-toggle-link");const toolbar=document.querySelector("#wda-toolbar");const increaseTextBtn=document.querySelector(".wda-btn-resize-plus");const decreaseTextBtn=document.querySelector(".wda-btn-resize-minus");const grayscaleBtn=document.querySelector(".wda-btn-grayscale");const invertColorsBtn=document.querySelector(".wda-btn-invert");const underlineLinksBtn=document.querySelector(".wda-btn-links-underline");const highlightLinksBtn=document.querySelector(".wda-btn-links-highlight");const readableFontBtn=document.querySelector(".wda-btn-readable-font");const resetBtn=document.querySelector(".wda-btn-reset-font");let zoomLevel=1.0;function updateZoom(){Array.from(document.body.children).forEach(child=>{child.style.zoom=zoomLevel})}
function resetWidget(){zoomLevel=1;Array.from(document.body.children).forEach(child=>{child.style.zoom=''});document.body.classList.remove("wda-grayscale","wda-invert","wda-underline-links","wda-highlight-links","wda-readable-font");console.log("Widget settings reset.")}
increaseTextBtn.addEventListener("click",function(){if(zoomLevel<1.59){zoomLevel+=0.2;updateZoom()}
console.log(zoomLevel)});decreaseTextBtn.addEventListener("click",function(){if(zoomLevel>0.8){zoomLevel-=0.2;updateZoom()}
console.log(zoomLevel)});toolbarToggle.addEventListener("click",function(){document.body.classList.toggle("wda-toolbar-open")});grayscaleBtn.addEventListener("click",function(){document.body.classList.toggle("wda-grayscale")});invertColorsBtn.addEventListener("click",function(){document.body.classList.toggle("wda-invert")});underlineLinksBtn.addEventListener("click",function(){document.body.classList.toggle("wda-underline-links")});highlightLinksBtn.addEventListener("click",function(){document.body.classList.toggle("wda-highlight-links")});readableFontBtn.addEventListener("click",function(){document.body.classList.toggle("wda-readable-font")});resetBtn.addEventListener("click",function(){resetWidget()});const style=document.createElement("style");style.innerHTML=`
        .wda-grayscale {
            filter: grayscale(100%);
        }
        .wda-invert {
            filter: invert(100%);
        }
        .wda-underline-links a {
            text-decoration: underline !important;
        }
        .wda-highlight-links a {
            background-color: yellow !important;
            color: black !important;
            padding: 2px 4px;
        }
        .wda-readable-font {
            font-family: Arial, sans-serif !important;
        }
    `;document.head.appendChild(style)})