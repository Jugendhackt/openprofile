function getScreenHeight(){
    return window.screen.height;
}

function getScreenWidth(){
    return window.screen.width;
}

function getWindowHeight(){
    return window.screen.availHeight;
}
function getWindowWidth(){
    return window.screen.availWidth;
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
