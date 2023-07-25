<?php

namespace App\model\form;

use App\model\BaseModel;
use App\model\User;

/**
 * SiteRegisterForm
 *
 * @property string $name
 * @property string $password
 */
class SiteRegisterForm extends BaseModel
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
     * @throws \Exception
     */
    public function register()
    {
        if ($this->isRegister()) {
            return false;
        }

        $user = new User($this->getAttributes());

        $user->generateAccessToken();
        $user->setPassword($this->password);

        return $user->save();
    }

    /**
     * @return false
     */
    private function isRegister()
    {
        return User::where('name', $this->name)->first() ?? false;
    }
}
