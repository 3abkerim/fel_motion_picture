<?php
class Project
{
    private $db;
    private $name;
    private $date;
    private $content;
    private $type;
    private $order;
    private $deleted;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function save()
    {
        try {
            $req = "INSERT INTO projects (project_name,project_date,project_info,id_project_type,order,deleted) VALUES (?,?,?,?,?,?)";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$this->name, $this->date, $this->content, $this->type, $this->order, $this->deleted]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `projects`");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getAllNotDeleted()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `projects` WHERE `deleted` = 0");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getAllByOrder()
    {
        try {
            $stmt = $this->db->prepare(
                "SELECT * FROM `projects`
            JOIN `project_type` ON project_type.id_project_type = projects.id_project_type
            LEFT JOIN `images` ON images.id_project = projects.id_project
            WHERE `projects`.`deleted` = 0 
            ORDER BY `projects`.`order` ASC;"
            );
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `projects` WHERE `id_project` = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve message: " . $e->getMessage());
        }
    }
}
