import "./bootstrap";
import Alpine from "alpinejs";
import intersect from "@alpinejs/intersect";
import collapse from "@alpinejs/collapse";

// Alpine plugins
Alpine.plugin(intersect);
Alpine.plugin(collapse);

// Global Alpine data
window.Alpine = Alpine;

Alpine.start();
