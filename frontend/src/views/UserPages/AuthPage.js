import  React from 'react';
import styled from 'styled-components';
import { Link, Redirect } from "react-router-dom";
import { Formik, Form} from 'formik';
import { connect } from 'react-redux';
import  { routes} from "../../routes/index";
import AuthTemplate from "../../templates/AuthTemplate";
import Heading from "../../components/atoms/Heading/Heading";
import Input from "../../components/atoms/Input/Input";
import Button from "../../components/atoms/Button/Button";
import { authenticate as authenticateAction } from "../../actions";

const StyledForm = styled(Form)`
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
`;

const StyledInput = styled(Input)`
  margin: 0 0 30px 0;
  height: 40px;
  width: 300px;
`;

const StyledLink = styled(Link)`
    display: block;
    font-weight: ${({ theme }) => theme.bold };
    font-size: ${({theme}) => theme.fontSize.xs };
    color: ${({theme}) => theme.black};
    text-transform: uppercase;
    margin: 20px 0 50px;
`;

const AuthPage = ({ userId, authenticate }) => (
    <AuthTemplate>
        <Formik
            initialValues={{username: '', password: ''}}
            onSubmit={({username, password}) => {
                authenticate(username, password);
            }}>
            {({ handleChange, handleBlur, values}) => {
                if(userId){
                    return <Redirect to={routes.home} />
                }
                return(
                    <>
                    <Heading>Zaloguj się</Heading>
                        <StyledForm>
                           <StyledInput
                               type="text"
                               name="username"
                               placeholder="Nazwa użytkownika"
                               onChange={handleChange}
                               onBlur={handleBlur}
                               value={values.username}
                           />
                            <StyledInput
                                type="password"
                                name="password"
                                placeholder="Hasło"
                                onChange={handleChange}
                                onBlur={handleBlur}
                                value={values.password}
                            />
                            <Button
                                type="submit"
                            >
                                Zaloguj się
                            </Button>
                        </StyledForm>
                        <StyledLink to={routes.register}>
                            Rejestracja
                        </StyledLink>
                    </>
                )
            }}
        </Formik>
    </AuthTemplate>
);

const mapStateToProps = ({ userId = null }) => ({
    userId,
});

const mapDispatchToProps = dispatch => ({
    authenticate: (username, password) => dispatch(authenticateAction(username, password)),
});

export default connect(mapStateToProps, mapDispatchToProps)(AuthPage);