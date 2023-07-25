<?php

namespace App\model;

/**
 * User
 *
 * @property string $name
 * @property string $password
 * @property string $access_token
 */
class User extends BaseModel
{
    public $timestamps = true;
    protected $table = 'user';
    protected $fillable = ['name', 'password', 'access_token'];
    protected $rules = [
        'name' => 'required|string|max:255|unique:user,name',
        'password' => 'required|string|max:255',
        'access_token' => 'required|string|max:255',
    ];

    /**
     * @param $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function generateAccessToken()
    {
        $this->access_token = bin2hex(random_bytes(30));
    }
}
