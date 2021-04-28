<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class User
 * @package App\Models
 */
class User implements Authenticatable
{
    /**
     * User constructor.
     * @param string $id
     * @param string $name
     * @param string $email
     * @param string $token
     */
    public function __construct(public string $id, public string $name, public string $email, public string $token)
    {
    }

    public function getAuthIdentifierName()
    {
        return $this->email;
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * @throws Exception
     */
    public function getAuthPassword()
    {
        throw new Exception('Not implemented');
    }

    /**
     * @throws Exception
     */
    public function getRememberToken()
    {
        throw new Exception('Not implemented');
    }

    /**
     * @throws Exception
     */
    public function setRememberToken($value)
    {
        throw new Exception('Not implemented');
    }

    /**
     * @throws Exception
     */
    public function getRememberTokenName()
    {
        throw new Exception('Not implemented');
    }
}
