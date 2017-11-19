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
    var windowScreenHeight = document.getElementById("windowScreenHeight");
    windowScreenHeight.innerHTML = getScreenHeight();
    var windowScreenWidth = document.getElementById("windowScreenWidth");
    windowScreenWidth.innerHTML = getScreenWidth();
    var windowDisplayHeight = document.getElementById("windowDisplayHeight");
    windowDisplayHeight.innerHTML = getWindowHeight();
    var windowDisplayWidth = document.getElementById("windowDisplayWidth");
    windowDisplayWidth.innerHTML = getWindowWidth();
}

window.onresize = function() {
    var windowDisplayHeight = document.getElementById("windowDisplayHeight");
    windowDisplayHeight.innerHTML = getWindowHeight();
    var windowDisplayWidth = document.getElementById("windowDisplayWidth");
    windowDisplayWidth.innerHTML = getWindowWidth();
}
