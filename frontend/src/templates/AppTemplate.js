import React, {Component} from 'react';
import PropTypes from 'prop-types';
import { ThemeProvider} from "styled-components";
import PageContext from "../context";
import GlobalStyle from "../theme/GlobalStyle";
import {theme} from "../theme/AppTheme";

class AppTemplate extends Component{
    render(){
        const { children } = this.props;
        return(
            <div>
                <PageContext.Provider>
                    <GlobalStyle/>
                    <ThemeProvider theme={theme}>
                        {children}
                    </ThemeProvider>
                </PageContext.Provider>
            </div>
        );
    }
}

AppTemplate.propTypes = {
    children: PropTypes.element.isRequired,
};

export default AppTemplate;