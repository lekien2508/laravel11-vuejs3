import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia'
import router from './router/index.js';
import axios from 'axios';

window.axios = axios;

import { Drawer, Button, List, Menu, message, Card, Table, Avatar, Select, Input, Checkbox } from 'ant-design-vue';
import App from './App.vue';

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core';
/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
/* import specific icons */
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
/* add icons to the library */
library.add(fas, fab, far);

import 'ant-design-vue/dist/reset.css';
import 'bootstrap/dist/css/bootstrap-grid.min.css';
import 'bootstrap/dist/css/bootstrap-utilities.min.css';

const app = createApp(App);

app.component('font-awesome-icon', FontAwesomeIcon);
app.use(createPinia());
app.use(router);
app.use(Select);
app.use(Input);
app.use(Table);
app.use(Card);
app.use(Button);
app.use(Drawer);
app.use(List);
app.use(Menu);
app.use(Avatar);
app.use(Checkbox);
app.mount("#app");

app.config.globalProperties.$message = message;

