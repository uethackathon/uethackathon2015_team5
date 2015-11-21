socket = io();
socket.on('update',function(event){
	processEvents(event);
});
function emitNext(index){
	socket.emit("next",index);
}
function emitPrev(index){
	socket.emit("prev",index);
}
function emitIText(data){
	socket.emit("IText",data);
}
function emitRectangle(data){
	socket.emit("rectangle",data);
}
function emitTriangle(data){
	socket.emit("Triangle",data);
}
socket.on('next',function(data)
{
	console.log(data);
	swiper.nextClick=false;
	swiper.slideNext();
	swiper.nextClick=true;
	// currentIndex = index;
	// for(var i = 1;i<=(currentIndex-index);i++)
	// {
		
	// }
});
socket.on('prev',function(data)
{
	console.log(data);
	swiper.prevClick=false;
	swiper.slidePrev();
	swiper.prevClick=true;
	// currentIndex = index;
	// for(var i = 1;i<=(index-currentIndex);i++)
	// {
	// 	swiper.slidePrev();
	// }
});
socket.on('rectangle',function(data, id)
{
	var c = $$('canvas').data('id')
	var canvas = new fabric.Canvas('canvas');
	var data_parse = JSON.parse(data);
	console.log(data_parse.objects[0]['left']);
	for (i = 0; i < data_parse.objects.length; i++) {
		if(data_parse.objects[i]['type'] == 'rect'){
			var rectangle = new fabric.Rect({
                left: data_parse.objects[i]['left'],
                top: data_parse.objects[i]['top'],
                width: 75,
                height: 50,
                fill: 'transparent',
                stroke: data_parse.objects[i]['stroke'],
                strokeWidth: 3,
                padding: 10
            });
			canvas.add(rectangle);
		}
	};
	// console.log(data_parse);
	canvas.renderAll();
});
