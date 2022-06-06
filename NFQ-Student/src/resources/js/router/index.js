import {createRouter, createWebHistory} from 'vue-router';

import IndexView from '../views/IndexView.vue';
import SecondView from '../views/SecondView.vue';

const router = createRouter({
    history: createWebHistory('/'),
    routes: [
        {
            path: '/',
            name: 'test1',
            component: IndexView
        },
        {
            path: '/second',
            name: 'test2',
            component: SecondView
        },
    ]
});

export default router;
