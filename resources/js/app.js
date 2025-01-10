import './bootstrap';
import '../css/app.css';

import { createApp } from "vue";
import Images from "./Components/Images.vue";
import App from "@/Components/App.vue";

const app = createApp({});

app.component("test-component", App);

app.mount("#app");