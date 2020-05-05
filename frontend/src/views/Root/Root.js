import React from 'react';
import {BrowserRouter, Switch, Route, Redirect} from "react-router-dom";
import { Provider } from "react-redux";
import store from "../../store/index";
import {routes} from "../../routes/index";
import AppTemplate from "../../templates/AppTemplate";
import AuthPage from "../UserPages/AuthPage";
import Home from "./Home";
import AccountPage from "../UserPages/AccountPage";
import LobbyPage from "../Game/LobbyPage";
import RankPage from "../Rank/RankPage";

const Root = () => (
    <Provider store={store}>
        <BrowserRouter>
            <AppTemplate>
                <Switch>
                    <Route exact path={routes.home} render={() => <Redirect to="/start" />} />
                    <Route exact path={routes.start} component={Home} />
                    <Route exact path={routes.login} component={AuthPage}/>
                    <Route exact path={routes.register} component={AuthPage} />
                    <Route exact path={routes.profile} component={AccountPage} />
                    <Route exact path={routes.games} component={LobbyPage} />
                    <Route exact path={routes.ranking} component={RankPage} />
                </Switch>
            </AppTemplate>
        </BrowserRouter>
    </Provider>
);

export default Root;