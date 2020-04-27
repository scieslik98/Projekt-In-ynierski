import Routing from '../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';
const fosRoutes = require('../../../public/js/fos_js_routes.json');

Routing.setRoutingData(fosRoutes);

export const routes = {
    home: '/',
    login: '/login',
    register: '/register',
    logout: '/api/logout'
}