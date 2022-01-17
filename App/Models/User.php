<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{

    public function __construct(public int $id = 0,
                                public ?string $login = null,
                                public ?string $password = null,
                                public ?string $email = null,
                                public ?string $name = null,
                                public ?string $last_name = null,
                                public ?string $date = null,
                                public ?string $authorization = "user",
                                public ?string $image = null)
    {
    }

    static public function setDbColumns()
    {
        return ['id', 'login', 'password', 'email', 'name', 'last_name', 'date', 'authorization', 'image'];
    }

    static public function setTableName()
    {
        return "users";
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @param string|null $last_name
     */
    public function setLastName(?string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getFullName(): ?string
    {
        return ($this->name ." ". $this->last_name);
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @return string|null
     */
    public function getDateEU(): ?string
    {
        $date = date_create($this->date);
        return date_format($date,"d.m.Y");
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getAuthorization(): ?string
    {
        return $this->authorization;
    }

    /**
     * @param string|null $authorization
     */
    public function setAuthorization(?string $authorization): void
    {
        $this->authorization = $authorization;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }


}