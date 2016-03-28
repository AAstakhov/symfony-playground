<?php

namespace AppBundle\Security;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\VarDumper\VarDumper;

class FormLoginGuard extends AbstractFormLoginAuthenticator
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Constructor
     *
     * @param UserPasswordEncoderInterface $encoder
     * @param LoggerInterface $logger
     */
    public function __construct(UserPasswordEncoderInterface $encoder, LoggerInterface $logger)
    {
        $this->encoder = $encoder;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    protected function getLoginUrl()
    {
        return 'login';
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultSuccessRedirectUrl()
    {
        return '/';
    }

    /**
     * @inheritdoc
     */
    public function getCredentials(Request $request)
    {
        $this->logger->debug('getCredentials. Requested: '.$request->getPathInfo());

        if ($request->getPathInfo() != '/login_check') {
            return;
        }
        $username = $request->request->get('_username');
        $request->getSession()->set(Security::LAST_USERNAME, $username);
        $password = $request->request->get('_password');
        return [
            'username' => $username,
            'password' => $password
        ];
    }

    /**
     * @inheritdoc
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['username'];

        return $userProvider->loadUserByUsername($username);
    }

    /**
     * @inheritdoc
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        $plainPassword = $credentials['password'];

        $this->logger->info('!!!! Password' . $plainPassword);

        if (!$this->encoder->isPasswordValid($user, $plainPassword)) {
            // throw any AuthenticationException
            throw new BadCredentialsException('Invalid credentials');
        }

        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new Response('Access denied: ' . $exception->getMessage(), Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent
     * @param Request $request
     * @param AuthenticationException $authException
     *
     * @return Response
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new Response('Auth required: ' . $authException->getMessage(), Response::HTTP_UNAUTHORIZED);
    }
}