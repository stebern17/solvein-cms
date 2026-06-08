import Quill from "quill";
import "quill/dist/quill.snow.css";

window.Quill = Quill;

function initializeServiceEditor() {
    if (typeof Quill === "undefined") {
        console.error("Quill library not loaded");
        return;
    }

    const form = document.getElementById("serviceForm");
    const editorEl = document.getElementById("editor-description");
    const input = document.getElementById("description");

    if (!form || !editorEl || !input) {
        return;
    }

    const toolbar = [
        [{ header: [1, 2, 3, false] }],
        ["bold", "italic", "underline"],
        [{ list: "ordered" }, { list: "bullet" }],
        ["blockquote", "link"],
        ["clean"],
    ];

    const editor = new Quill(editorEl, {
        theme: "snow",
        modules: { toolbar },
    });

    editor
        .getModule("toolbar")
        .container.querySelectorAll("button")
        .forEach((button) => {
            button.type = "button";
        });

    let existingData = {};

    if (form.dataset.existingData) {
        try {
            existingData = JSON.parse(form.dataset.existingData);
        } catch (error) {
            console.error("Failed to parse service existing data:", error);
        }
    }

    const description = existingData.description;

    if (description) {
        if (typeof description === "object" && description.delta) {
            editor.setContents(description.delta, "silent");
        } else if (typeof description === "object" && description.ops) {
            editor.setContents(description, "silent");
        } else if (typeof description === "object" && description.html) {
            editor.root.innerHTML = description.html;
        } else if (typeof description === "string") {
            editor.root.innerHTML = description;
        }
    }

    function syncDescription() {
        input.value = JSON.stringify({
            html: editor.root.innerHTML,
            delta: editor.getContents(),
            text: editor.getText().trim(),
        });
    }

    editor.on("text-change", syncDescription);
    editor.on("editor-change", syncDescription);
    form.addEventListener("submit", syncDescription);
    syncDescription();
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initializeServiceEditor);
} else {
    initializeServiceEditor();
}
