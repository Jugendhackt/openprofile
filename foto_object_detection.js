window.onload = function() {
    var img = document.getElementById('img');
    console.log(img);
    var tracker = new tracking.ObjectTracker(['face', 'eye', 'mouth']);
    tracker.setStepSize(1.7);
    tracking.track('#img', tracker);
    tracker.on('track', function(event) {
        event.data.forEach(function(rect) {
            window.plot(rect.x, rect.y, rect.width, rect.height);
        });
    });

    window.plot = function(x, y, w, h) {
        var rect = document.createElement('div');
        document.querySelector('.demo-container').appendChild(rect);
        rect.classList.add('rect');
        rect.style.width = w + 'px';
        rect.style.height = h + 'px';
        rect.style.left = (img.offsetLeft + x) + 'px';
        rect.style.top = (img.offsetTop + y) + 'px';
    };
};