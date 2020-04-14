import styled, { css } from "styled-components";

const Button = styled.button`

  padding: 0;
  background-color: ${({theme, activeColor}) => theme[activeColor]};
  width: 220px;
  height: 47px;
  border: none;
  border-radius: 50px;
  font-weight: 500;
  font-size: 1rem;
  text-transform: uppercase;
  
  ${({secondary}) => 
    secondary && css`
      background-color: ${({theme}) => theme.grey100 };
      width: 105px;
      height: 30px;
      font-size: 0.8rem;
  `}
  
`;

export default Button;