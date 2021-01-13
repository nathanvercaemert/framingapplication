<template>
</template>

<script>
    export default {
        props: [],
        mounted() {
            this.$root.resetCanvas();
            let canvas = this.__canvas = new fabric.Canvas('c', {
                isDrawingMode: false,
            });
            this.viewGetCanvasJSON()
            fabric.Object.prototype.transparentCorners = false;
            fabric.Object.prototype.selectable = false;

            let viewDrawingButton = document.getElementById('viewDrawingButton')
            viewDrawingButton.addEventListener("click", this.viewShowHideCanvas)
        },
        methods: {
            viewGetCanvasJSON: function viewGetCanvasJSON() {
                this.$root.viewGetCanvasJSON(document.getElementById('orderNumber').getAttribute('value'));
            },
            viewGetCanvasJSONCallback: function viewGetCanvasJSONCallback(response) {
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
            viewShowHideCanvas: function viewShowHideCanvas() {
                this.$root.canvasIsHidden = ( this.$root.canvasIsHidden + 1 ) % 2
                let viewDrawingButton = document.getElementById('viewDrawingButton')
                if (this.$root.canvasIsHidden) {
                    viewDrawingButton.innerHTML = "Show Drawing"
                } else {
                    viewDrawingButton.innerHTML = "Hide Drawing"
                }
            },
        }
    }
</script>
