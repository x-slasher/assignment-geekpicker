import {createWebHistory, createRouter} from "vue-router";

import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import Main from '../components/Main';
import AddTransfer from '../components/AddTransfer';


export const routes = [
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'main',
        path: '/main',
        component: Main
    },
    {
        name: 'AddTransfer',
        path: '/transfer/add',
        component: AddTransfer
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
