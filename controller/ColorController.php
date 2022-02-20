<?php

require_once "model/ColorDAO.php";
require_once "model/Color.php";
require_once "view/View.php";

class ColorController
{
    const TEMPLATE_HEADER = 'view/template/header.html';
    const TEMPLATE_FOOTER = 'view/template/footer.html';
    const TEMPLATE_FOLDER = 'view/color/';
    const HOME = 'index.php?color=index';

    private $data;

    public function index()
    {
        $this->data = array();
        $colorDAO = new colorDAO();

        try {
            $colors = $colorDAO->selectAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['colors'] = $colors;

        View::load(self::TEMPLATE_HEADER);
        View::load(self::TEMPLATE_FOLDER.'index.php', $this->data);
        View::load(self::TEMPLATE_FOOTER);
    }

    public function create()
    {
        $this->data = [];

        View::load(self::TEMPLATE_HEADER);
        View::load(self::TEMPLATE_FOLDER.'create.php', $this->data);
        View::load(self::TEMPLATE_FOOTER);
    }

    public function edit($id)
    {
        $this->data = array();
        $colorDAO = new ColorDAO();

        try {
            $color = $colorDAO->select($id);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }


        $this->data['color'] = $color[0];
        View::load(self::TEMPLATE_HEADER);
        View::load(self::TEMPLATE_FOLDER.'edit.php', $this->data);
        View::load(self::TEMPLATE_FOOTER);
    }

    public function store($data)
    {
        try {
            $colorDAO = new ColorDAO();

            $newColor = new Color();
            $newColor->setName($data['name']);
            $colorDAO->insert($newColor);
            header('location: '.self::HOME);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($data)
    {
        try {
            $colorDAO = new ColorDAO();
            
            $color = new Color();
            
            $color->setName($data['name']);
            $color->setId($data['id']);
            $colorDAO->update($color);
            header('location: '.self::HOME);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $colorDAO = new ColorDAO();
        try {
            $colorDAO->delete($id);
            header('location: '.self::HOME);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}