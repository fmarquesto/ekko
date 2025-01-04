import './bootstrap';

import { createApp } from "vue";
import Images from "./Components/Images.vue";

const app = createApp({});

app.component("test-component", Images);

app.mount("#app");