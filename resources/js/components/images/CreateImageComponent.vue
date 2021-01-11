<template>
    <style>
        .canvas-container {
            position: relative,
        }
    </style>
</template>

<script>
    export default {
        props: ['createimagetest',],
        mounted() {
            this.$root.resetCreateCanvas();

            var canvas = document.getElementById('canvas')
            let canvasWidth = $("#drawingButtonRow").width() - 10 // for padding
            let canvasHeight = .9 * window.innerHeight
            canvas.parentElement.setAttribute('height', canvasHeight)
            canvas.parentElement.setAttribute('min-height', canvasHeight)
            canvas.parentElement.style.height = canvasHeight.toString() + "px"
            this.$root.fabricCanvas = new fabric.Canvas('canvas', {  height: canvasHeight, width: canvasWidth,
                                                                                                    selection : false,
                                                                                                    controlsAboveOverlay:true,
                                                                                                    centeredScaling:true,
                                                                                                    allowTouchScrolling: true })
            fabric.Object.prototype.selectable = false;
            this.$root.fabricCanvas.on('selection:created', (e) => {
                if(e.target.type === 'activeSelection') {
                    canvas.discardActiveObject();
                } else {
                    //do nothing
                }
            })
            var enableScroll = function(){
                canvas.allowTouchScrolling = true;
            };
            this.$root.fabricCanvas.on('mouse:up', enableScroll);

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

            // this.$root.fabricCanvas.setWidth(window.innerWidth)
            // this.$root.fabricCanvas.setHeight(.9 * window.innerHeight)
            canvas.style.border = '5px solid #AAA'
            canvas.style.width = "100%"
            canvas.style.margin = '0px'
            canvas.style.minHeight = '90vh'

            // var canvasContainer = document.getElementById('canvasContainer')
            // var canvas = document.getElementById('canvas')
            // var context = canvas.getContext('2d');
        },
        methods: {
            testFunction: function testFunction() {
                console.log('test')
            },
            showHideCanvas: function showHideCanvas() {
                this.$root.canvasIsHidden = ( this.$root.canvasIsHidden + 1 ) % 2
                let drawingButton = document.getElementById('drawingButton')
                if (this.$root.canvasIsHidden) {
                    drawingButton.innerHTML = "Show Drawing"
                } else {
                    // canvas.height = window.innerHeight
                    drawingButton.innerHTML = "Hide Drawing"
                }
            },
            drawingModeButton: function drawingModeButton() {
                var fabricCanvas = this.$root.fabricCanvas
                let drawingModeButton = document.getElementById('drawingModeButton')

                fabricCanvas.isDrawingMode = !fabricCanvas.isDrawingMode
                this.$root.isDrawingMode = fabricCanvas.isDrawingMode
                if (fabricCanvas.isDrawingMode) {
                    fabricCanvas.freeDrawingBrush.color = "purple";
                    fabricCanvas.freeDrawingBrush.width = 10;
                    fabricCanvas.renderAll();
                    drawingModeButton.innerHTML = 'Save';
                }
                else {
                    drawingModeButton.innerHTML = 'Enter Drawing Mode';
                }
            },
            pencilButton: function pencilButton() {
                let fabricCanvas = this.$root.fabricCanvas
            },
            eraserButton: function eraserButton() {

            },
            textButton: function textButton() {

            },
            undoButton: function undoButton() {

            },
        }
    }
</script>
