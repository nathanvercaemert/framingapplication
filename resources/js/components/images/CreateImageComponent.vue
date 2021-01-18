<template>
</template>

<script>
    export default {
        props: ['createimagetest', 'isold', 'isediting'],
        mounted() {
            this.$root.resetCanvas();

            let canvas = this.__canvas = new fabric.Canvas('c', {
                isDrawingMode: false,
                allowTouchScrolling: true,
            });
            if (this.isold || this.isediting) {
                this.getCanvasJSON()
            } else {
                canvas.setHeight(Math.floor(.8 * window.innerHeight))
                canvas.setWidth(Math.floor($("#drawingButtonRow").width() - 10))
            }
            fabric.Object.prototype.transparentCorners = false;
            fabric.Object.prototype.selectable = false;
            canvas.on('object:added', function(event) {
                this.updateCanvasJSON()
            }.bind(this))
            canvas.on('object:modified', function(event) {
                this.updateCanvasJSON()
            }.bind(this));

            let hammer = new Hammer.Manager(canvas.upperCanvasEl);
            let pinch = new Hammer.Pinch();
            hammer.add([pinch]);

            hammer.on('pinchin',  (ev) => {
                let point = new fabric.Point(ev.center.x, ev.center.y);
                var zoom = canvas.getZoom();
                zoom *= 0.999 ** (.1 * ev.distance);
                if (zoom > 10) zoom = 20;
                if (zoom < 1) zoom = 1;
                canvas.zoomToPoint(point, zoom);

                // var vpt = canvas.viewportTransform;
                // vpt[4] += ev.deltaX;
                // vpt[5] += ev.deltaY;
            });
            hammer.on('pinchout',  (ev) => {
                let point = new fabric.Point(ev.center.x, ev.center.y);
                var zoom = canvas.getZoom();
                zoom *= 0.999 ** (-.1 * ev.distance);
                if (zoom > 10) zoom = 20;
                if (zoom < 1) zoom = 1;
                canvas.zoomToPoint(point, zoom);

                // var vpt = canvas.viewportTransform;
                // vpt[4] += (.001 * ev.deltaX);
                // vpt[5] += (.001 * ev.deltaY);
            });

            let drawingButton = document.getElementById('drawingButton')
            drawingButton.addEventListener("click", this.showHideCanvas)
            let drawingModeButton = document.getElementById('drawingModeButton')
            drawingModeButton.addEventListener("click", this.drawingModeButton)
            let pencilButton = document.getElementById('pencilButton')
            pencilButton.addEventListener("click", this.pencilButton)
            let eraserButton = document.getElementById('eraserButton')
            eraserButton.addEventListener("click", this.eraserButton)
            let textButton = document.getElementById('textButton')
            textButton.addEventListener("click", this.textButton)
            let undoButton = document.getElementById('undoButton')
            undoButton.addEventListener("click", this.undoButton)
        },
        methods: {
            getCanvasJSON: function getCanvasJSON() {
                this.$root.getCanvasJSON(document.getElementById('orderNumber').value);
            },
            getCanvasJSONCallback: function getCanvasJSONCallback(response) {
                let fabricCanvas = this.__canvas
                let json = response.data
                fabricCanvas.width = json.width
                fabricCanvas.height = json.height
                fabricCanvas.setHeight(fabricCanvas.getHeight())
                fabricCanvas.setWidth(fabricCanvas.getWidth())
                fabricCanvas.loadFromJSON(json, function() {
                    fabricCanvas.renderAll()
                }.bind(this));
            },
            updateCanvasJSON: function updateCanvasJSON() {
                let fabricCanvas = this.__canvas
                this.$root.canvasJSON = JSON.stringify(fabricCanvas.toJSON(['width', 'height']))
            },
            testFunction: function testFunction() {
                console.log('test')
            },
            showHideCanvas: function showHideCanvas() {
                this.$root.canvasIsHidden = ( this.$root.canvasIsHidden + 1 ) % 2
                let drawingButton = document.getElementById('drawingButton')
                if (this.$root.canvasIsHidden) {
                    drawingButton.innerHTML = "Show Drawing"
                } else {
                    drawingButton.innerHTML = "Hide Drawing"
                }
            },
            drawingModeButton: function drawingModeButton() {
                let drawingModeButton = document.getElementById('drawingModeButton')
                let fabricCanvas = this.__canvas
                this.$root.isDrawingMode = !this.$root.isDrawingMode
                if (this.$root.isDrawingMode) {
                    fabricCanvas.isDrawingMode = true
                    fabricCanvas.freeDrawingBrush.color = 'black'
                    fabricCanvas.freeDrawingBrush.width = 1
                    drawingModeButton.innerHTML = 'Save';
                }
                else {
                    fabricCanvas.isDrawingMode = false
                    drawingModeButton.innerHTML = 'Enter Drawing Mode';
                }
            },
            pencilButton: function pencilButton() {
                let fabricCanvas = this.__canvas
                fabricCanvas.isDrawingMode = true
                fabricCanvas.freeDrawingBrush.color = 'black'
                fabricCanvas.freeDrawingBrush.width = 1
            },
            eraserButton: function eraserButton() {
                let fabricCanvas = this.__canvas
                fabricCanvas.isDrawingMode = true
                fabricCanvas.freeDrawingBrush.color = 'white'
                fabricCanvas.freeDrawingBrush.width = 10
            },
            textButton: function textButton() {
                let text = null
                if (document.getElementById('canvasInputText').value) {
                    text = document.getElementById('canvasInputText').value
                    let fabricCanvas = this.__canvas
                    let xCenter = fabricCanvas.width / 2
                    let yCenter = fabricCanvas.height / 2
                    let fabricText = fabricCanvas.add(new fabric.IText(text, {
                        fontFamily: 'Delicious_500',
                        left: xCenter,
                        top: yCenter,
                        selectable: true,
                    }));
                }
            },
            undoButton: function undoButton() {
                var fabricCanvas = this.__canvas
                var lastItemIndex = (fabricCanvas.getObjects().length - 1);
                var item = fabricCanvas.item(lastItemIndex);
                if(item.get('type') === 'path') {
                    fabricCanvas.remove(item);
                    fabricCanvas.renderAll();
                }
                this.updateCanvasJSON();
            },
        }
    }
</script>
