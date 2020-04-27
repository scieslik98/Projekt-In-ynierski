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
import withContext from "../../hoc/withContext";

const StyledForm = styled(Form)`
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top:20px;
`;

const StyledInput = styled(Input)`
  margin: 0 0 30px 0;
  height: 40px;
  width: 300px;
`;

const StyledLink = styled(Link)`
    display: block;
    font-weight: ${({ theme }) => theme.light };
    font-size: ${({theme}) => theme.fontSize.xs };
    color: ${({theme}) => theme.black};
    margin: 35px 0 50px;
    text-decoration: none;
`;

const StyledHeading = styled(Heading)`
  margin: 50px 0 0;
`;

const AuthPage = ({pageContext, userId, authenticate }) => (
    <AuthTemplate>
        <Formik
            initialValues={{username: '', password: '', password_confirmation: ''}}
            onSubmit={({username, password, password_confirmation}) => {
                authenticate(username, password);
            }}>
            {({ handleChange, handleBlur, values}) => {
                if(userId){
                    return <Redirect to={routes.home} />
                }
                return(
                    <>
                    <StyledHeading>{pageContext === 'login' ? 'Zaloguj się' : 'Rejestracja'}</StyledHeading>
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
                            { pageContext === 'register' &&
                                <StyledInput
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="Powtórz hasło"
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                    value={values.password_confirmation}
                                />
                            }
                            <Button
                                type="submit"
                                activeColor={'main'}
                                auth
                            >
                                {pageContext === 'login' ? 'Zaloguj się' : 'Utwórz konto'}
                            </Button>
                        </StyledForm>
                        <StyledLink to={routes[ pageContext === 'login' ? 'register' : 'login' ]}>
                            {pageContext === 'login' ? 'Utwórz swoje konto ➔' : 'Zaloguj się ➔'}
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

export default withContext(connect(mapStateToProps, mapDispatchToProps)(AuthPage));