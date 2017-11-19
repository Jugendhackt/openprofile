function getScreenHeight(){
    return window.screen.height;
}

function getScreenWidth(){
    return window.screen.width;
}

function getWindowHeight(){
    return window.innerHeight;
}
function getWindowWidth(){
    return window.innerWidth;
}

window.onload = function(){
    let windowScreenHeight = document.getElementById("windowScreenHeight");
    windowScreenHeight.innerHTML = getScreenHeight() + "px";
    let windowScreenWidth = document.getElementById("windowScreenWidth");
    windowScreenWidth.innerHTML = getScreenWidth() + "px";
    let windowDisplayHeight = document.getElementById("windowDisplayHeight");
    windowDisplayHeight.innerHTML = getWindowHeight() + "px";
    let windowDisplayWidth = document.getElementById("windowDisplayWidth");
    windowDisplayWidth.innerHTML = getWindowWidth() + "px";
}

window.onresize = function() {
    let windowDisplayHeight = document.getElementById("windowDisplayHeight");
    windowDisplayHeight.innerHTML = getWindowHeight() + "px";
    let windowDisplayWidth = document.getElementById("windowDisplayWidth");
    windowDisplayWidth.innerHTML = getWindowWidth() + "px";
}
