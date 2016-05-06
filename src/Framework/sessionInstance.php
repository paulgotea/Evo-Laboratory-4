<?php

namespace Framework;

use model\entity\User as User;

/**
 * Manage the browser session 
 *
 * @author paulgotea
 */
class sessionInstance
{

    public function __construct()
    {
        $this->session = $_SESSION;
    }

    /*
     * Set the session data
     * @param User object - the user to get data from
     */

    public function setSession(User $user)
    {
        $_SESSION['user'] = array(
            'username' => $user->getAttr('username'),
            'email' => $user->getAttr('email'),
            'access' => $user->getAttr('access'),
        );
    }

    /*
     * Get choosed data from the browser session
     * @param string $value - the parameter from where you want to get data
     * @return string - session data for the choosed value or null if doesn' exist
     */

    public static function get($value)
    {
        if (isset($_SESSION['user']) && isset($_SESSION['user'][$value])) {
            return $_SESSION['user'][$value];
        }

        return null;
    }

}
