import React from 'react';
import { NavLink } from 'react-router-dom';
import PropTypes from 'prop-types';
import ButtonIcon from "../../atoms/ButtonIcon/ButtonIcon";
import styled from 'styled-components';
import withContext from '../../../hoc/withContext';
import logoIcon from '../../../assets/logo.png';
import logoutIcon from '../../../assets/icons/logout.svg';
import profileIcon from '../../../assets/icons/social.svg';
import gameIcon from '../../../assets/icons/card-game.svg';
import ranksIcon from '../../../assets/icons/business.svg';

const StyledWrapper = styled.nav`
  position: fixed;
  left: 0;
  top: 0;
  padding: 25px 0;
  width: 150px;
  height: 100vh;
  background-color: lightblue;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
`;

const StyledLogoLink = styled(NavLink)`
  display: block;
  width: 67px;
  height: 67px;
  background-image: url(${logoIcon});
  background-repeat: no-repeat;
  background-position: 50% 50%;
  background-size: 80%;
  border: none;
  margin-bottom: 10vh;
`;

const StyledLogoutButton = styled(ButtonIcon)`
  margin-top: auto;
`;

const StyledLinksList = styled.ul`
  margin: 0;
  padding: 0;
  list-style: none;
`;

const Sidebar = ({ pageContext }) => (
    <StyledWrapper activeColor={pageContext}>
        <StyledLogoLink to="/" />
        <StyledLinksList>
            <li>
                <ButtonIcon as={NavLink} to="/account" icon={profileIcon} activeclass="active" />
            </li>
            <li>
                <ButtonIcon as={NavLink} to="/game/lobby" icon={gameIcon} activeclass="active" />
            </li>
            <li>
                <ButtonIcon as={NavLink} to="/rank" icon={ranksIcon} activeclass="active" />
            </li>
        </StyledLinksList>
        <StyledLogoutButton as={NavLink} to="/logout" icon={logoutIcon} />
    </StyledWrapper>
);

export default withContext(Sidebar);
