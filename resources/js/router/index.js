import {createWebHistory, createRouter} from "vue-router";

import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import Main from '../components/Main';
import AddBook from '../components/AddBook';


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
        name: 'addbook',
        path: '/books/add',
        component: AddBook
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
