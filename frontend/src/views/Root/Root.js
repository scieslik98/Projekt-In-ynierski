import React from 'react';
import {BrowserRouter, Switch, Route} from "react-router-dom";
import { Provider } from "react-redux";
import store from "../../store/index";
import {routes} from "../../routes/index";
import AppTemplate from "../../templates/AppTemplate";
import AuthPage from "../UserPages/AuthPage";

const Root = () => (
    <Provider store={store}>
        <BrowserRouter>
            <AppTemplate>
                <Switch>
                    <Route exact path={routes.login} component={AuthPage}/>
                    <Route exact path={routes.home} />
                </Switch>
            </AppTemplate>
        </BrowserRouter>
    </Provider>
);

export default Root;