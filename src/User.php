<?php

namespace sdwru\LaravelFirebaseAuth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

class User implements Authenticatable
{
    use Notifiable;
    /**
     * The claims decoded from the JWT token.
     *
     * @var array
     */
    private $claims;

    /**
     * Creates a new authenticatable user from Firebase.
     */
    public function __construct($claims)
    {
        $this->claims = $claims;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'sub';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return (string) $this->claims['sub'];
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        throw new \Exception('No password for Firebase User');
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        throw new \Exception('No remember token for Firebase User');
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     *
     * @return void
     */
    public function setRememberToken($value)
    {
        throw new \Exception('No remember token for Firebase User');
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        throw new \Exception('No remember token for Firebase User');
    }
    
    /**
     * Check role.
     *
     * @return bool
     */
    public function hasRole($roles)
    {
        if (!isset($this->claims['role'])) {
            return false;
        }

        $roleClaim = (string) $this->claims['role'];

        foreach ($roles as $role) {
            //remove white spaces
            $role = trim($role);
            if ($roleClaim == $role) {
                return true;
            }
        } 
        return false;
    }
}
