<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;


class AppController extends AbstractController
{
    private $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    /**
     *@Route("/{reactRouting}", name="index", defaults={"reactRouting": null})
     */
    // * @Route("/app", name="app")
    // @Route("/{reactRouting}", name="index", defaults={"reactRouting": null})
    public function index()
    {
        return $this->render('app/index.html.twig');
    }

    /**
     * @Route("/api/user/logins",options={"expose"=true}, name="api_users")
     * @return JsonResponse
     */
    public function userLogin(Request $request)
    {
        $data = $request->getContent();
        $data = json_decode($data, true);

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent(json_encode($data));

        return $response;
    }


    /**
     * @Route("/api/user/login",options={"expose"=true}, name="api_login_action")
     * @return JsonResponse
     */
    public function loginAction(Request $request)
    {
        $data = $request->request->all();

        $_username = $data["_username"];
        $_password = $data["_password"];

        // Retrieve the security encoder of symfony
        //$factory = $this->get('security.encoder_factory');
        $factory = $this->encoderFactory;

        /// Start retrieve user
        // Let's retrieve the user by its username:
        $user = $this->getDoctrine()->getManager()->getRepository("App:User")
            ->findOneBy(array('username' => $_username));
        /// End Retrieve user

        // Check if the user exists !
        if(!$user){
            return new Response(
                'Username doesnt exists',
                Response::HTTP_UNAUTHORIZED,
                array('Content-type' => 'application/json')
            );
        }


        /// Start verification
        $encoder = $factory->getEncoder($user);
        $salt = $user->getSalt();


        if(!$encoder->isPasswordValid($user->getPassword(), $_password, $salt)) {
            return new Response(
                'Username or Password not valid.',
                Response::HTTP_UNAUTHORIZED,
                array('Content-type' => 'application/json')
            );
        }
        /// End Verification

        // The password matches ! then proceed to set the user in session

        //Handle getting or creating the user entity likely with a posted form
        // The third parameter "main" can change according to the name of your firewall in security.yml
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->get('security.token_storage')->setToken($token);

        // If the firewall name is not main, then the set value would be instead:
        // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
        $this->get('session')->set('_security_main', serialize($token));

        // Fire the login event manually
        $event = new InteractiveLoginEvent($request, $token);
        //$this->get('app.login.listener')->onSecurityInteractiveLogin($event);

        /*
         * Now the user is authenticated !!!!
         * Do what you need to do now, like render a view, redirect to route etc.
         */
        return new Response(
            json_encode(['id' => $user->getId()]),
            Response::HTTP_OK,
            array('Content-type' => 'application/json')
        );
    }
}
