<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Factory;
use Illuminate\Validation\DatabasePresenceVerifier;
use Illuminate\Translation\Translator;
use Illuminate\Translation\FileLoader;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Container\Container;
use App\config\Database;

/**
 * BaseModel
 */
class BaseModel extends Model
{
    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var Factory
     */
    protected $validation;

    /**
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $database = new Database();
        $capsule = $database->getCapsule();

        $loader = new FileLoader(new Filesystem(), __DIR__ . '/lang');
        $translator = new Translator($loader, 'en');
        $validation = new Factory($translator, new Container());

        // Set the presence verifier
        $validation->setPresenceVerifier(new DatabasePresenceVerifier($capsule->getDatabaseManager()));

        $this->validation = $validation;
    }

    /**
     * @return bool
     */
    public function validate()
    {
        $validator = $this->validation->make($this->attributes, $this->rules);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }
}
