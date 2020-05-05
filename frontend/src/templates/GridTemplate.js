import React, { Component } from 'react';
import styled from 'styled-components';
import PageTemplate from '../templates/PageTemplate';
import Heading from '../components/atoms/Heading/Heading';
import Paragraph from '../components/atoms/Paragraph/Paragraph';
import withContext from '../hoc/withContext';


const StyledWrapper = styled.div`
  position: relative;
  padding: 25px 150px 25px 70px;
`;

const StyledLoadingIndicator = styled(Heading)`
  font-size: 3em;
  color: white;
  position: fixed;
  top: 40vh;
  left: 40%;
  z-index: 10001;

  ::before {
    content: '';
    z-index: -1;
    background-color: rgba(0, 0, 0, 0.5);
    position: absolute;
    width: 300vw;
    height: 200vh;
    top: -100vh;
    left: -100vw;
  }
`;

const StyledGrid = styled.div`
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-gap: 85px;

  @media (max-width: 1500px) {
    grid-gap: 45px;
    grid-template-columns: repeat(2, 1fr);
  }

  @media (max-width: 1100px) {
    grid-template-columns: 1fr;
  }
`;

const StyledPageHeader = styled.div`
  margin: 25px 0 50px 0;
`;

const StyledHeading = styled(Heading)`
  margin: 25px 0 0 0;

  ::first-letter {
    text-transform: uppercase;
  }
`;

const StyledParagraph = styled(Paragraph)`
  margin: 0;
  font-weight: ${({ theme }) => theme.bold};
`;

/*const StyledButtonIcon = styled(ButtonIcon)`
  position: fixed;
  bottom: 40px;
  right: 40px;
  background-color: ${({ activecolor, theme }) => theme[activecolor]};
  background-size: 35%;
  border-radius: 50px;
  z-index: 10000;
`;*/

class GridTemplate extends Component {

    render() {
        const { children} = this.props;

        return (
            <PageTemplate>
                <StyledWrapper>
              {/*      <StyledPageHeader>
                    </StyledPageHeader>*/}
                    <StyledGrid>{children}</StyledGrid>
                  {/*  <StyledButtonIcon
                        onClick={this.toggleNewItemBar}
                        icon={plusIcon}
                        activecolor={pageContext}
                    />*/}
                 {/*   <NewItemBar handleClose={this.toggleNewItemBar} isVisible={isNewItemBarVisible} />*/}
                </StyledWrapper>
            </PageTemplate>
        );
    }
}

/*GridTemplate.propTypes = {
    children: PropTypes.arrayOf(PropTypes.object).isRequired,
    pageContext: PropTypes.oneOf(['notes', 'twitters', 'articles']),
};

GridTemplate.defaultProps = {
    pageContext: 'notes',
};*/


export default withContext(GridTemplate);
