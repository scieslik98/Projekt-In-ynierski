import React from 'react';
import styled from 'styled-components';
import PropTypes from 'prop-types';
import Sidebar from '../components/organisms/Sidebar/Sidebar';

const StyledWrapper = styled.div`
  padding-left: 150px;
`;

const PageTemplate = ({ children }) => (
    <StyledWrapper>
        <Sidebar />
        {children}
    </StyledWrapper>
);

PageTemplate.propTypes = {
    children: PropTypes.oneOfType([PropTypes.element, PropTypes.node]).isRequired,
};

export default PageTemplate;