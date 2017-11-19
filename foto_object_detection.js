window.onload = function() {
    var img = document.getElementById('img');
    console.log(img);
    var tracker = new tracking.ObjectTracker(['face','mouth','eye']);
    tracker.setStepSize(1.5);
    tracker.setEdgesDensity(0.2);
    tracker.setInitialScale(1)
    tracking.track('#img', tracker);
    tracker.on('track', function(event) {
        event.data.forEach(function(rect) {
            window.plot(rect.x, rect.y, rect.width, rect.height);
        });
    });

    window.plot = function(x, y, w, h) {
        var rect = document.createElement('div');
        document.getElementById('demo-container').appendChild(rect);
        rect.classList.add('rect');
        rect.style.width = w + 'px';
        rect.style.height = h + 'px';
        rect.style.left = (img.offsetLeft + x) + 'px';
        rect.style.top = (img.offsetTop + y) + 'px';
    };
};