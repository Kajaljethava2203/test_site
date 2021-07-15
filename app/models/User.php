<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //Register user
    public function register($data)
    {
        $this->db->query('INSERT INTO users (name ,email,password) VALUES (:name ,:email,:password)');

        //Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Login user
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email= :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        // echo $hashed_password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    public function adminLogin($email, $password)
    {
        $this->db->query('SELECT * FROM admin WHERE email= :email');
        $this->db->bind(':email', $email);

        if ($this->db->single()) {
            return true;
        } else {
            return false;
        }
    }

    //Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email= :email');

        //Bind value
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        //Check Row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
 //Get User By Id
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id= :id');

        //Bind value
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }
}