<?php

namespace App\model\form;

use App\model\BaseModel;
use App\model\User;

/**
 * SiteLoginForm
 *
 * @property string $name
 * @property string $password
 */
class SiteLoginForm extends BaseModel
{
    protected $fillable = ['name', 'password'];

    protected $rules = [
        'name' => 'required|string|min:2|max:60',
        'password' => 'required|string|min:6|max:60',
    ];

    /**
     * @param $data
     */
    public function __construct($data = [])
    {
        parent::__construct($data);

        $this->fill($data);
    }

    /**
     * @return bool
     */
    public function login()
    {
        $user = User::where('name', $this->name)->first();

        if ($user && password_verify($this->password, $user->password)) {
            return setcookie('access_token', $user->access_token, time() + 3600, '/');
        }

        return false;
    }
}
