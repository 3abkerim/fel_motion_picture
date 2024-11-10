<?php

class Sponsor
{
    private $db;
    private $name;
    private $deleted;


    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function save()
    {
        try {
            $req = "INSERT INTO sponsors (sponsor,deleted) VALUES (?,?)";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$this->name, $this->deleted]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `sponsors`");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }
    public function getAllNotDeleted()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `sponsors` Join `images` ON images.id_sponsor = sponsors.id_sponsor  WHERE sponsors.deleted = 0");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    function insertSponsor($sponsor, $image)
    {
        try {
            $db = $this->db;
            $db->beginTransaction();

            $insertHomeQuery = $db->prepare('INSERT INTO sponsors (sponsor, deleted) VALUES (?,?)');
            $insertHomeQuery->execute([$sponsor, 0]);
            $idImagesHome = $db->lastInsertId();

            $insertImageQuery = $db->prepare('INSERT INTO images (image, id_sponsor) VALUES (?,?)');
            $result = $insertImageQuery->execute([$image, $idImagesHome]);

            $db->commit();

            return $result;
        } catch (Exception $e) {
            $db->rollBack();
            echo "Failed: " . $e->getMessage();
            return false;
        }
    }


    public function delete($id)
    {
        try {
            $req = "UPDATE sponsors SET deleted = 1 WHERE id_sponsor = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$id]);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Unable to delete image : " . $e->getMessage());
        }
    }
}
