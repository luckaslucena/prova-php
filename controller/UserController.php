<?php

require_once "model/UserDAO.php";
require_once "model/ColorDAO.php";
require_once "model/User.php";
require_once "model/UserColors.php";
require_once "view/View.php";

class UserController
{
    const TEMPLATE_HEADER = 'view/template/header.html';
    const TEMPLATE_FOOTER = 'view/template/footer.html';
    const TEMPLATE_FOLDER = 'view/user/';
    const HOME = 'index.php?user=index';

    private $data;

    public function index()
    {
        $this->data = array();
        $userDAO = new UserDAO();

        try {
            $users = $userDAO->selectAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['users'] = $users;

        View::load(self::TEMPLATE_HEADER);
        View::load(self::TEMPLATE_FOLDER.'index.php', $this->data);
        View::load(self::TEMPLATE_FOOTER);
    }

    public function create()
    {
        $this->data = [];
        $colorDAO = new colorDAO;

        try {
            $colors = $colorDAO->selectAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $this->data['colors'] =  $colors;
        View::load(self::TEMPLATE_HEADER);
        View::load(self::TEMPLATE_FOLDER.'create.php', $this->data);
        View::load(self::TEMPLATE_FOOTER);
    }

    public function edit($id)
    {
        $this->data = array();
        $userDAO = new userDAO();
        $colorDAO = new colorDAO();

        try {
            $user = $userDAO->select($id);
            $colors = $colorDAO->selectAll();
            $userColors = $userDAO->selectColors($id);

            $this->data['checked'] = [];
            foreach($userColors as $userColor) {
                $id = $userColor->getColorId();
                $this->data['checked'][$id] = $id;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
        $this->data['user'] = $user[0];
        $this->data['colors'] = $colors;

        View::load(self::TEMPLATE_HEADER);
        View::load(self::TEMPLATE_FOLDER.'edit.php', $this->data);
        View::load(self::TEMPLATE_FOOTER);
    }

    public function store($data)
    {
        try {
            $userDAO = new UserDAO();

            $newUser = new User();
            $newUser->setName($data['name']);
            $newUser->setEmail($data['email']);
            $id = $userDAO->insert($newUser);

            if($id) {
                foreach($data['color'] as $color) {
                    $userColors = new UserColors();
                    $userColors->setUserId($id);
                    $userColors->setColorId($color);
                    $userDAO->insertColor($userColors);
                }
            }
 
            header('location: '.self::HOME);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($data)
    {
        try {
            $userDAO = new UserDAO();
            
            $user = new User();
            
            $user->setName($data['name']);
            $user->setEmail($data['email']);
            $user->setId($data['id']);
            $userDAO->update($user);
            
            $userDAO->deleteColors($data['id']);

            foreach($data['color'] as $color) {
                $userColors = new UserColors();
                $userColors->setUserId($data['id']);
                $userColors->setColorId($color);
                $userDAO->insertColor($userColors);
            }

            header('location: '.self::HOME);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $userDAO = new UserDAO();
        try {
            $userDAO->delete($id);
            header('location: '.self::HOME);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}