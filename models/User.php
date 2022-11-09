<?php

namespace UF1\Models;

use Exception;
use UF1\Config\Database;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $createdAt;
    private string $updatedAt;

    private $db;

    public function __construct() {
        $this->db = database::Connect();
    }

    /**
     * Funciona como constructor interno de la clase, lo hacemos de esta manera para que
     * en el controlador tengamos que usar los setters para crear un usuario
     * @return User
     */
    protected function builder($rs): User{
        foreach ($rs as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    /**
     * @return int id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $this->db->real_escape_string($name);
    }

    /**
     * @return string email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $this->db->real_escape_string($email);
    }

    /**
     * @return string password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT,['cost'=>4]);
    }

    /**
     * @return string created_at
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string updated_at
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function save(): bool{
        try {
            $name = $this->getName();
            $email = $this->getEmail();
            $password = $this->getPassword();
            $stmt = $this->db->prepare("INSERT INTO users VALUES(null,?,?,?,NOW(),NOW())");
            $stmt->bind_param('sss', $name, $email, $password);
            return $stmt->execute();
        }
        catch (Exception $e){
            return false;
        }
    }

    public function login($email,$password): bool|User{
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $rs = $stmt->get_result();
        if($rs && $rs->num_rows == 1){
            $user = $rs->fetch_object();
            if(password_verify($password, $user->password)){
                return $this->builder($user);
            }
        }
        return false;
    }

    public function getActivities(): array{
        $id = $this->getId();
        $stmt = $this->db->prepare('SELECT * FROM activities WHERE user_id = ?');
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $activities = [];
        if($rs = $stmt->get_result()){
            while ($activity = $rs->fetch_object()){
                $activities[] = (new Activity())->builder($activity);
            }
        }
        return $activities;
    }

}