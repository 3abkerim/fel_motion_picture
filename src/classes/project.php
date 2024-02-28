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

    public function getAllNotDeleted($lang)
    {
        try {
            $stmt = $this->db->prepare("SELECT * 
            FROM projects p 
            LEFT JOIN projects_translations pt ON pt.id_project = p.id_project
            WHERE p.deleted = 0 AND pt.lang_code = ?");
            $stmt->execute([$lang]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getAllByOrder($lang)
    {
        try {
            $stmt = $this->db->prepare(
                "SELECT * FROM projects p
                JOIN project_type pty ON pty.id_project_type = p.id_project_type
                LEFT JOIN project_type_translations ptt ON ptt.id_project_type = p.id_project_type AND ptt.lang_code = ?
                LEFT JOIN images i ON i.id_project = p.id_project
                LEFT JOIN projects_translations pt ON pt.id_project = p.id_project AND pt.lang_code = ?
                WHERE p.deleted = 0
                ORDER BY p.order ASC;"
            );
            $stmt->execute([$lang, $lang]);
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
