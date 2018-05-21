<?php

namespace Dawn\Auth;

use Dawn\App\App;
use Dawn\Routing\Request;
use Dawn\Session;
use App\Models\User;
use Firebase\JWT\JWT;
use phpDocumentor\Reflection\Types\Integer;
use PHPUnit\Util\Json;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use TheSeer\Tokenizer\Exception;

/**
 * Handles authentication and authorization.
 */
class Auth
{
    /**
     * The application container instance.
     *
     * @var Dawn\App\App
     */
    protected $app;

    /**
     * String with the JWT token.
     *
     * @var string
     */
    protected $token;

    /**
     * Object that contains the payload of the JWT token.
     *
     * @var object
     */
    protected $decodedToken;

    /**
     * User instance of the request.
     *
     * @var Dawn\Database\Model
     */
    protected $user;

    /**
     * ID of the user.
     *
     * @var mixed
     */
    protected $id;

    /**
     * Instance of the request.
     *
     * @var Dawn\Routing\Request
     */
    protected $request;

    /**
     * Create new Auth instance.
     *
     * @param Dawn\App\App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * Verify that the user is authorized.
     *
     * @param array $options
     * @param mixed ...$parameters
     * @return bool
     */
    public function check(array $options, ...$parameters)
    {
        foreach ($options as $option) {
            if (!$this->$option(...$parameters)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if the user is authenticated.
     *
     * @return bool
     */
    public function authenticated()
    {
        if ($this->user === null) {
            return false;
        }

        return true;
    }

    /**
     * Check if the user is a guest.
     *
     * @return bool
     */
    public function guest()
    {
        if ($this->user !== null) {
            return false;
        }

        return true;
    }

    /**
     * Check if the user is owner of the resource.
     *
     * @param mixed $ownerId
     * @return bool
     */
    public function owner($ownerId)
    {
        if ($this->id !== $ownerId) {
            return false;
        }

        return true;
    }

    /**
     * Check if the user is owner of the resource.
     *
     * @param object $element
     * @return bool
     */
    public function isOwner($element)
    {
        return $this->id === $element->userId();
    }

    /**
     * Authenticate the user saving the token in the session.
     *
     * @param string $token
     * @param integer $expires
     * @return bool
     */
    protected function authenticate(string $token, int $expires = 0)
    {
        $this->app->get('session')->setToken($token);
        $this->app->get('session')->setExpires($expires);

        return $this->app->get('session')->remember();
    }

    /**
     * Return a JWT token with the given data.
     *
     * @param array $tokenData
     * @return string
     */
    protected function generateToken(array $tokenData = [])
    {
        return JWT::encode($tokenData, $this->app->getKey());
    }

    /**
     * Return the payload of a given token.
     *
     * @param string $token
     * @return object
     */
    public function decodeToken($token)
    {
        $decodedToken = null;

        try {
            if ($token !== null) {
                $decodedToken = JWT::decode($token, app()->getKey(), array('HS256'));
            }
        } catch (\Exception $e) {
            $decodedToken = null;
        }

        return $decodedToken;
    }

    /**
     * Destroy the current session.
     *
     * @return void
     */
    public function logout()
    {
        $this->app->get('session')->destroy();
    }

    /**
     * Authenticate the user if the credentials are valid.
     *
     * @param string $username
     * @param string $password
     * @return mixed
     */
    public function login(string $username, string $password)
    {
        $this->user = new User();

        $this->user->setUsername($username);
        $this->user->setPassword($password);

        if ($id = $this->user->getColumnBy('id', 'username', $this->user->username())) {
            if (password_verify($this->user->password(), $this->user->getColumnBy('password', 'id', $id, true))) {
                $tokenData = [
                    'iss' => $_SERVER['SERVER_NAME'],
                    'iat' => time(),
                    'exp' => time() + app()->get('session')->getConfig()['expires'],
                    'id' => $id,
                    'ip' => $this->request->GetIp(),
                    'useragent' => $this->request->getUserAgent()
                ];

                return $this->authenticate(
                    $this->generateToken($tokenData),
                    $tokenData['exp']
                );
            }
        }

        $this->user = null;

        return false;
    }

    /**
     * Register a new user if the credentials are valid.
     *
     * @param string $username
     * @param string $password
     * @return mixed
     */
    public function register(string $email, string $username, string $password)
    {
        $this->user = new User();

        $this->user->setEmail($email);
        $this->user->setUsername($username);
        $this->user->setPassword(password_hash($password, PASSWORD_BCRYPT));

        // check if user already exists
        if (!$this->user->getBy('username', $this->user->username()) && !$this->user->getBy('email', $this->user->email())) {
            if ($this->user->create()) {
                $tokenData = [
                    'iss' => $_SERVER['SERVER_NAME'],
                    'iat' => time(),
                    'exp' => time() + app()->get('session')->getConfig()['expires'],
                    'id' => $this->user->getId(),
                    'ip' => $this->request->getIp(),
                    'useragent' => $this->request->getUserAgent()
                ];

                return $this->authenticate(
                    $this->generateToken($tokenData),
                    $tokenData['exp']
                );
            }
        }

        $this->user = null;

        return false;
    }

    /**
     * Find and set the user if the token is valid.
     *
     * @return bool
     */
    public function findUser()
    {
        if ($this->verifyToken()) {
            $this->user = (new User())->find($this->decodedToken->id);
            $this->id = $this->user->id();

            return true;
        } else {
            $this->user = null;
        }

        return false;
    }

    /**
     * Check if the token is valid.
     *
     * @return bool
     */
    public function verifyToken()
    {
        if ($this->decodedToken === null) {
            return false;
        }

        return true;
    }

    /**
     * Get the app container instance.
     *
     * @return Dawn\App\App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * Set the app container instance.
     *
     * @param Dawn\App\App $app
     * @return void
     */
    public function setApp(App $app)
    {
        $this->app = $app;
    }

    /**
     * Get the JWT token.
     *
     * @return void
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set a JWT token.
     *
     * @param mixed $token
     * @return void
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Get the decoded token object.
     *
     * @return object
     */
    public function getDecodedToken()
    {
        return $this->decodedToken;
    }

    /**
     * Set the decoded token object.
     *
     * @param mixed $decodedToken
     * @return void
     */
    public function setDecodedToken($decodedToken)
    {
        $this->decodedToken = $decodedToken;
    }

    /**
     * Get the current user instance.
     *
     * @return Dawn\App\Models\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the current user instance.
     *
     * @param User $user
     * @return void
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the current user ID.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the current user ID.
     *
     * @param mixed $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the current request.
     *
     * @return Dawn\Routing\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the current request.
     *
     * @param Dawn\Routing\Request $request
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
}
