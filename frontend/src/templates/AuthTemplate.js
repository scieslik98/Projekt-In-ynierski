import React, {Component} from 'react';
import PropTypes from 'prop-types';
import styled from "styled-components";
import Heading from "../components/atoms/Heading/Heading";
import withContext from "../hoc/withContext";
import logoImg from '../assets/logo.png';

const StyledWrapper = styled.div`
    width: 100%;
    height: 100vh;
    background-color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
`;


const StyledLogo = styled.img`
width: 200px;
height: auto;
margin-bottom: 20px;
`;


const StyledAuthCard = styled.div`
width: 400px;
height: 400px;
background-color: white;
border-radius: 10px;
box-shadow: 0 10px 30px -10px rgba(0,0,0,0.2);
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
`;

class AuthTemplate extends Component {

    render() {

        const {children} = this.props;


        return (

                <StyledWrapper>
                    <StyledLogo src={logoImg} alt="" />
                    <StyledAuthCard>
                        {children}
                    </StyledAuthCard>
                </StyledWrapper>

        );
    }
}



export default withContext(AuthTemplate);
