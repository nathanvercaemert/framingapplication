<template>
</template>

<script>
    export default {
        props: ['createimagetest',],
        mounted() {
            this.$root.resetCreateCanvas();

            var canvas = this.__canvas = new fabric.Canvas('c', {
                isDrawingMode: true
            });
            canvas.setHeight(Math.floor(.9 * window.innerHeight))
            canvas.setWidth(Math.floor($("#drawingButtonRow").width() - 10))
            fabric.Object.prototype.transparentCorners = false;

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
                    fabric.Object.prototype.transparentCorners = false;
                }
            },
            drawingModeButton: function drawingModeButton() {
                let drawingModeButton = document.getElementById('drawingModeButton')
                this.$root.isDrawingMode = !this.$root.isDrawingMode
                if (this.$root.isDrawingMode) {
                    drawingModeButton.innerHTML = 'Save';
                }
                else {
                    drawingModeButton.innerHTML = 'Enter Drawing Mode';
                }
            },
            pencilButton: function pencilButton() {
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
