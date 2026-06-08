import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.data("serviceForm", (config = {}) => ({
    points: config.points?.length ? config.points : [""],
    imagePreview: config.imagePreview || null,

    addPoint() {
        this.points.push("");
    },

    removePoint(index) {
        this.points.splice(index, 1);

        if (!this.points.length) {
            this.addPoint();
        }
    },

    previewImage(event) {
        const file = event.target.files?.[0];

        if (!file) {
            return;
        }

        this.imagePreview = URL.createObjectURL(file);
    },
}));

Alpine.start();
