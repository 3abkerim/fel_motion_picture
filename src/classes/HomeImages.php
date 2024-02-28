<?php

class HomeImages
{
    private $db;
    private $image;
    private $order;
    private $deleted;




    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function save()
    {
        try {
            $req = "INSERT INTO `images_home` (image,order) VALUES (?,?)";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$this->image, $this->order]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM images_home ih JOIN images i ON ih.id_image = i.id_images_home");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getAllByOrder()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM images_home ih JOIN images i ON ih.id_image = i.id_images_home ORDER BY `order` ASC");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getAllByOrderNotDeleted()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM images_home ih JOIN images i ON ih.id_image = i.id_images_home WHERE ih.deleted = 0 ORDER BY `order` ASC");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM `about_us` WHERE `id_about_us` = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }
}
