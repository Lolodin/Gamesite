import RegisterComponent from "./components/RegisterComponent.vue";
import LoginComponent from "./components/LoginComponent.vue";
import News from "./components/News.vue";
import Home from "./components/Home.vue";
import CreateArticle from "./components/CreateArticle.vue";
import ArticlePage from "./components/ArticlePage.vue";
export default {
    mode: 'history',
    routes: [
        {

            path: '/',
            component: News,

        },
        {

            path: '/news',
            component: News,

        },
        {
            path: '/login',
            component: LoginComponent

        },
        {
            path: '/registration',
            component: RegisterComponent
        },
        {
            path: '/create',
            component: CreateArticle
        },
        {
            path: '/home',
            component: Home
        }
        ,
        {
            path: '/articles/:id',
            component: ArticlePage
        }
    ]
}

