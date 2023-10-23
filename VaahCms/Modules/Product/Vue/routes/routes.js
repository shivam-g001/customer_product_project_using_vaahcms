let routes= [];

import dashboard from "./vue-routes-dashboard";
import product from "./vue-routes-products"; // add this line in above path
import blog from "./vue-routes-blogs"; // add this line in above path
import taxonomies from "./vue-routes-taxonomies";

routes = routes.concat(taxonomies);

routes = routes.concat(dashboard);
routes = routes.concat(product); // add this line in above path
routes = routes.concat(blog); // add this line in above path

export default routes;
