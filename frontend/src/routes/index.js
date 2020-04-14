import Routing from '../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';
const fosRoutes = require('../../../public/js/fos_js_routes.json');

Routing.setRoutingData(fosRoutes);

export const routes = {
    home: '/',
    login: Routing.generate('app_login'),
    login_check: Routing.generate('app_login_check'),
    register: '/api/register',
    logout: '/api/logout'
}