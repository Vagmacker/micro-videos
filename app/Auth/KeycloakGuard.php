<?php

namespace App\Auth;

use App\Models\User;
use BadMethodCallException;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Traits\Macroable;
use mysql_xdevapi\Exception;
use Tymon\JWTAuth\JWT;

/**
 * Class KeycloakGuard
 * @package App\Auth
 */
class KeycloakGuard implements Guard
{
    use GuardHelpers, Macroable {
        __call as macroCall;
    }

    /**
     * KeycloakGuard constructor.
     * @param JWT $jwt
     * @param Request $request
     */
    public function __construct(public JWT $jwt, public Request $request)
    {
    }

    /**
     * Magically call the JWT instance.
     *
     * @param string $method
     * @param array $parameters
     *
     * @return mixed
     * @throws BadMethodCallException
     *
     */
    public function __call($method, $parameters)
    {
        if (method_exists($this->jwt, $method)) {
            return call_user_func_array([$this->jwt, $method], $parameters);
        }

        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        throw new BadMethodCallException("Method [$method] does not exist.");
    }

    /**
     * Get the currently authenticated user.
     *
     * @return Authenticatable
     */
    public function user()
    {
        if ($this->user !== null) {
            return $this->user;
        }

        if ($token = $this->jwt->setRequest($this->request)->getToken() &&
            ($payload = $this->jwt->check(true))
        ) {
            return $this->user = new User($payload['sub'], $payload['name'], $payload['email'], $token);
        }
    }

    public function validate(array $credentials = [])
    {
        throw new Exception('Not implemented');
    }
}
