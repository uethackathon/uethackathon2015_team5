window.onload = function() {

    var canvas = new fabric.Canvas('canvas');

    canvas.setWidth($$('.swiper-wrapper').width());
    canvas.setHeight($$('.swiper-wrapper').height());
    canvas.calcOffset();
    var color = "#000000";
        $$("#text_input").click(function(){

            canvas.isDrawingMode = false;

            if (canvas.getContext) {
                var context = canvas.getContext('2d');
            }

            var text;
            var mouse_pos = { x:0 , y:0 };

            text = $$('#text').val();

            canvas.observe('mouse:down', function(e) {
                mouse_pos = canvas.getPointer(e.e);
                canvas.add(new fabric.IText('Tap and Type', { 
                    fontFamily: 'Arial',
                    fontSize: 18,
                    left: mouse_pos.x,
                    top: mouse_pos.y,
                    textAlign: "left",
                    fontWeight: 'bold'  
                }));
               
                canvas.off('mouse:down');

                canvas.renderAll();
                canvas.calcOffset();
            });
        });
        
        $$("#draw").click(function(){
            canvas.isDrawingMode = true;
            canvas.freeDrawingBrush.color = color;
            canvas.freeDrawingLineWidth = 45;
            canvas.renderAll();
            console.log(canvas.renderAll());
            canvas.calcOffset();
        });

        $$("#rect").click(function(){
            var mouse_pos = { x:0 , y:0 };

            canvas.isDrawingMode = false;

            canvas.observe('mouse:down', function(e) {

                mouse_pos = canvas.getPointer(e.e);
                var rectangle = new fabric.Rect({
                    left: mouse_pos.x,
                    top: mouse_pos.y,
                    width: 75,
                    height: 50,
                    fill: 'transparent',
                    stroke: color,
                    strokeWidth: 3,
                    padding: 10
                });
                canvas.add(rectangle);
                console.log(canvas);
                emitRectangle(JSON.stringify(canvas));
                canvas.off('mouse:down');
            });
        });

        $$("#triangle").click(function(){
            var mouse_pos = { x:0 , y:0 };

            canvas.isDrawingMode = false;

            canvas.observe('mouse:down', function(e) {

                mouse_pos = canvas.getPointer(e.e);

                canvas.add(new fabric.Triangle({
                    left: mouse_pos.x,
                    top: mouse_pos.y,
                    width: 75,
                    height: 50,
                    fill: 'transparent',
                    stroke: color,
                    strokeWidth: 3,
                    padding: 10
                }));

                canvas.off('mouse:down');
            });
        });

        $$("#circle").click(function(){
            var mouse_pos = { x:0 , y:0 };

            canvas.isDrawingMode = false;

            canvas.observe('mouse:down', function(e) {

            mouse_pos = canvas.getPointer(e.e);

                canvas.add(new fabric.Circle({
                    left: mouse_pos.x,
                    top: mouse_pos.y,
                    radius: 30,
                    fill: 'transparent',
                    stroke: color,
                    strokeWidth: 3
                }));

                canvas.off('mouse:down');
            });
        });

        $$("#ellipse").click(function(){
            var mouse_pos = { x:0 , y:0 };

            canvas.isDrawingMode = false;

            canvas.observe('mouse:down', function(e) {

                mouse_pos = canvas.getPointer(e.e);

                canvas.add(new fabric.Ellipse({
                    rx: 45,
                    ry: 25,
                    fill: 'transparent',
                    stroke: color,
                    strokeWidth: 8,
                    left: mouse_pos.x,
                    top: mouse_pos.y
                }));

                canvas.off('mouse:down');
            });
        });

        $$("#highlight").click(function(){
            canvas.isDrawingMode = false;

            if (canvas.getContext) {
                var context = canvas.getContext('2d');
            }

            canvas.observe('mouse:down', function(e) { mousedown(e); });
            canvas.observe('mouse:move', function(e) { mousemove(e); });
            canvas.observe('mouse:up', function(e) { mouseup(e); });

            var started = false;
            var startX = 0;
            var startY = 0;

            /* Mousedown */
            function mousedown(e) {
                var mouse = canvas.getPointer(e.e);
                started = true;
                startX = mouse.x;
                startY = mouse.y;
                canvas.off('mouse:down');
            }

            /* Mousemove */
            function mousemove(e) {
                if(!started) {
                    return false;
                }
                canvas.off('mouse:move');
            }

            /* Mouseup */
            function mouseup(e) {
                if(started) {
                    var mouse = canvas.getPointer(e.e);

                    canvas.add(new fabric.Line([startX, startY, mouse.x, startY],{ 
                        stroke: 'rgba(240,59,59, 0.5)', 
                        fill: 'transparent',
                        strokeWidth: 42 
                    }));
                    canvas.renderAll();
                    canvas.calcOffset(); 

                    started = false;
                    canvas.off('mouse:up');
                }   
            }
        });

        $$("#line").click(function(){
            canvas.isDrawingMode = false;

            if (canvas.getContext) {
                var context = canvas.getContext('2d');
            }

            canvas.observe('mouse:down', function(e) { mousedown(e); });
            canvas.observe('mouse:move', function(e) { mousemove(e); });
            canvas.observe('mouse:up', function(e) { mouseup(e); });

            var started = false;
            var startX = 0;
            var startY = 0;

            /* Mousedown */
            function mousedown(e) {
                var mouse = canvas.getPointer(e.e);
                started = true;
                startX = mouse.x;
                startY = mouse.y;
                canvas.off('mouse:down');
            }

            /* Mousemove */
            function mousemove(e) {
                if(!started) {
                    return false;
                }
                canvas.off('mouse:move');
            }

            /* Mouseup */
            function mouseup(e) {
                if(started) {
                    var mouse = canvas.getPointer(e.e);

                    canvas.add(new fabric.Line([startX, startY, mouse.x, mouse.y],{ 
                        stroke: 'rgba(240,59,59, 0.5)', 
                        fill: 'transparent',
                        strokeWidth: 5 
                    }));
                    canvas.renderAll();
                    canvas.calcOffset(); 

                    started = false;
                    canvas.off('mouse:up');
                }   
            }
        });

        $$("#clear").click(function(){
            canvas.isDrawingMode = false;
            if (confirm('Are you sure?')) {
                canvas.clear();
            }
        });
    
        $$("#remove").click(function(){
            canvas.isDrawingMode = false;

            var activeObject = canvas.getActiveObject(),
            activeGroup = canvas.getActiveGroup();
            
            if (activeObject) {
                if (confirm('Are you sure?')) {
                    canvas.remove(activeObject);
                }
            }else if (activeGroup) {
                if (confirm('Are you sure?')) {
                    var objectsInGroup = activeGroup.getObjects();
                    canvas.discardActiveGroup();
                    objectsInGroup.forEach(function(object) {
                        canvas.remove(object);
                    });
                }
            }
        });

        $$('#myColor').change(function(){
            canvas.freeDrawingBrush.color = this.value;
            color = this.value;
        });

        $$('#drawing-line-width').change(function(){
            canvas.freeDrawingBrush.width = parseInt(this.value, 10) || 1;
            this.previousSibling.innerHTML = this.value;
        });

        canvas.on('text:changed', function(e) {
            console.log('text:changed', e.target, e);
        });

        canvas.on('object:moving', function(e) {
            console.log('object:moving', e.target, e);
        });

        canvas.on('object:rotating', function(e) {
            console.log('object:rotating', e.target, e);
        });

        canvas.on('object:scaling', function(e) {
            console.log('object:scaling', e.target, e);
        });

        canvas.on('mouse:down', function(e) {
            console.log('mouse:down', e.target, e);
        });
    canvas.calcOffset();

    document.onkeyup = function(e) {
      canvas.renderAll();
    };

    setTimeout(function() {
      canvas.calcOffset();
    }, 100);

};