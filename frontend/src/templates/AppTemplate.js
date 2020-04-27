import React, {Component} from 'react';
import PropTypes from 'prop-types';
import { ThemeProvider} from "styled-components";
import PageContext from "../context";
import GlobalStyle from "../theme/GlobalStyle";
import {theme} from "../theme/AppTheme";
import { withRouter } from 'react-router';

class AppTemplate extends Component{

    state = {
        pageType: 'login',
    };

    componentDidMount (){
        this.setCurrentPage();
    }

    componentDidUpdate(prevProps, prevState){
        this.setCurrentPage(prevState);
    }

    setCurrentPage = (prevState = '') => {
        const pageTypes = [ 'login', 'register'];
        const {
            location: { pathname },
        } = this.props;

        const [currentPage] = pageTypes.filter(page => pathname.includes(page));

        if (prevState.pageType !== currentPage) {
            this.setState({ pageType: currentPage });
        }
    }

    render(){

        const {children} = this.props;
        const {pageType} = this.state;

        return(
            <div>
                <PageContext.Provider value={pageType}>
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

export default withRouter(AppTemplate);