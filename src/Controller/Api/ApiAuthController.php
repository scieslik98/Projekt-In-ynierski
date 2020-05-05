<?php

namespace App\Controller\Api;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Model\Auth\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @Route("/auth")
 */
class ApiAuthController extends AbstractController
{
    private $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @Route("/register", name="api_auth_register",  methods={"POST"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return Response
     */
    public function register(Request $request, UserManagerInterface $userManager)
    {

        $data = $request->request->all();

        $username = $data["_username"];
        $password = $data["_password"];

        $data = [
            'username' => $username,
            'password' => $password
        ];

        $validator = Validation::createValidator();
        $constraint = new Assert\Collection(array(
            'username' => new Assert\Length(array('min' => 1)),
            'password' => new Assert\Length(array('min' => 1)),
            //'email' => new Assert\Email(),
        ));
        $violations = $validator->validate($data, $constraint);
        if ($violations->count() > 0) {
            return new JsonResponse(["error" => (string)$violations], 500);
        }

        $user = new User();
        $user
            ->setUsername($username)
            ->setPlainPassword($password)
            ->setEmail($username.'@'.$username.'.pl')
            ->setEnabled(true)
            ->setRoles(['ROLE_USER'])
            ->setSuperAdmin(false)
        ;
        try {
            $userManager->updateUser($user, true);
        } catch (\Exception $e) {
            return new JsonResponse(["error" => $e->getMessage()], 500);
        }
        //return new JsonResponse(["success" => $user->getUsername(). " has been registered!"], 200);
        return new JsonResponse(
            json_encode(['id' => $user->getId()]),
            Response::HTTP_OK,
            array(
                'Content-type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            )
        );
    }

    /**
     * @Route("/login", name="api_auth_login",  methods={"POST"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return Response
     */
    public function login(Request $request, UserManagerInterface $userManager)
    {
        $data = $request->request->all();

        $_username = $data["_username"];
        $_password = $data["_password"];


        $user = $this->getDoctrine()->getManager()->getRepository("App:Auth\User")
            ->findOneBy(array('username' => $_username));

        if(!$user){
            return new Response(
                'Username doesnt exists',
                Response::HTTP_UNAUTHORIZED,
                array(
                    'Content-type' => 'application/json',
                    'Access-Control-Allow-Origin' => '*'
                )

            );
        }

        $factory = $this->encoderFactory;

        $encoder = $factory->getEncoder($user);
        $salt = $user->getSalt();


        if(!$encoder->isPasswordValid($user->getPassword(), $_password, $salt)) {
            return new Response(
                'Username or Password not valid.',
                Response::HTTP_UNAUTHORIZED,
                array(
                    'Content-type' => 'application/json',
                    'Access-Control-Allow-Origin' => '*')
            );
        }

        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->get('security.token_storage')->setToken($token);

        $this->get('session')->set('_security_main', serialize($token));
        $event = new InteractiveLoginEvent($request, $token);



        return new Response(
            json_encode(['id' => $user->getId()]),
            Response::HTTP_OK,
            array(
                'Content-type' => 'application/json',
                'Access-Control-Allow-Origin' => '*')
        );

    }

    /**
     * @Route("/tokens", name="tokens", methods={"POST"})
     */
    public function newTokenAction(Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findOneBy(['username' => $request->getUser()]);
        if (!$user) {
            throw $this->createNotFoundException();
        }
        $isValid = $this->get('security.password_encoder')
            ->isPasswordValid($user, $request->getPassword());
        if (!$isValid) {
            throw new BadCredentialsException();
        }
        $token = $this->get('lexik_jwt_authentication.encoder')
            ->encode([
                'username' => $user->getUsername(),
                'exp' => time() + 3600 // 1 hour expiration
            ]);
        return new JsonResponse(['token' => $token]);
    }
}