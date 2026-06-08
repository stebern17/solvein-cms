import Quill from "quill";
import "quill/dist/quill.snow.css";
window.Quill = Quill;

/**
 * Content Editor Module
 * Initializes Quill rich text editors for content management (Hero Section & About Solvein)
 */



function initializeContentEditors() {
    if (typeof Quill === "undefined") {
        console.error("Quill library not loaded");
        return;
    }

    const form = document.getElementById("contentForm");
    if (!form) {
        console.error("contentForm not found");
        return;
    }

    const toolbar = [
        [{ header: [1, 2, 3, false] }],
        ["bold", "italic", "underline"],
        [{ list: "ordered" }, { list: "bullet" }],
        ["blockquote", "link"],
        ["clean"],
    ];

    const fields = ["hero_section", "about_solvein"];
    const editors = {};

    // Initialize Quill editors for each field
    fields.forEach((field) => {
        const editorEl = document.getElementById(`editor-${field}`);
        if (!editorEl) {
            console.error(`Editor element #editor-${field} not found`);
            return;
        }

        editors[field] = new Quill(`#editor-${field}`, {
            theme: "snow",
            modules: { toolbar },
        });
    });

    // Load existing data from data attribute on form
    const existingDataAttr = form.dataset.existingData;
    let existingData = {};

    if (existingDataAttr) {
        try {
            existingData = JSON.parse(existingDataAttr);
        } catch (e) {
            console.error("Failed to parse existing data:", e);
        }
    }

    // Set initial content for each editor
    fields.forEach((field) => {
        if (!editors[field]) return;

        const data = existingData[field];
        if (!data) return;

        if (typeof data === "object" && data.html) {
            editors[field].root.innerHTML = data.html;
        } else if (typeof data === "object" && data.ops) {
            editors[field].setContents(data, "silent");
        } else if (typeof data === "string") {
            editors[field].root.innerHTML = data;
        }
    });

    // Sync editor content to hidden inputs before form submission
    form.addEventListener("submit", function () {
        fields.forEach((field) => {
            const input = document.getElementById(field);
            if (!input || !editors[field]) return;

            const data = {
                html: editors[field].root.innerHTML,
                delta: editors[field].getContents(),
                text: editors[field].getText().trim(),
            };

            input.value = JSON.stringify(data);
        });
    });
}

// Auto-initialize
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initializeContentEditors);
} else {
    initializeContentEditors();
}