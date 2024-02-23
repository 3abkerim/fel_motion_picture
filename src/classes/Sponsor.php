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
}
