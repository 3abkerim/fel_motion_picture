<?php
class Project
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function save1($date, $id)
    {
        try {
            $maxOrderQuery = $this->db->prepare('SELECT MAX(`order`) as max_order FROM projects');
            $maxOrderQuery->execute();
            $row = $maxOrderQuery->fetch();

            $max_order = $row['max_order'] ?? 0;
            $next_order = $max_order + 1;

            $req = "INSERT INTO projects (project_date, id_project_type, `order`) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$date, $id, $next_order]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Unable to insert project: " . $e->getMessage());
        }
    }

    public function save2($id, $name, $info, $lang)
    {
        try {
            $req = "INSERT INTO projects_translations (id_project,project_name,project_info,lang_code) VALUES (?,?,?,?)";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$id, $name, $info, $lang]);
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getAllFrench()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM projects p LEFT JOIN projects_translations pt ON p.id_project = pt.id_project WHERE lang_code = 'fr' ");
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
            $stmt = $this->db->prepare("SELECT * FROM projects p LEFT JOIN projects_translations pt ON p.id_project = pt.id_project WHERE p.id_project = ? AND lang_code = 'fr'");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve message: " . $e->getMessage());
        }
    }


    public function getByIdEn($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * 
            FROM projects p 
            LEFT JOIN projects_translations pt ON p.id_project = pt.id_project
            LEFT JOIN project_type pty ON pty.id_project_type = p.id_project_type
            JOIN project_type_translations ptyt ON pty.id_project_type = ptyt.id_project_type
            WHERE p.id_project = ? AND pt.lang_code = 'en' AND ptyt.lang_code = 'en' ");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve message: " . $e->getMessage());
        }
    }

    public function getByIdFr($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * 
            FROM projects p 
            LEFT JOIN projects_translations pt ON p.id_project = pt.id_project
            LEFT JOIN project_type pty ON pty.id_project_type = p.id_project_type
            JOIN project_type_translations ptyt ON pty.id_project_type = ptyt.id_project_type
            WHERE p.id_project = ? AND pt.lang_code = 'fr' AND ptyt.lang_code = 'fr' ");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve message: " . $e->getMessage());
        }
    }
}
