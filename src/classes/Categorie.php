<?php
class Categorie
{
    private $db;
    private $project_type;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function save1()
    {
        try {
            $req = "INSERT INTO project_type (id_project_type) VALUES (NULL)";
            $stmt = $this->db->prepare($req);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Unable to insert into project_type: " . $e->getMessage());
        }
    }
    public function save2($id_project, $lang_code, $project_type)
    {
        try {
            $req = "INSERT INTO project_type_translations (id_project_type, lang_code, project_type) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$id_project, $lang_code, $project_type]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Unable to insert into project_type_translations: " . $e->getMessage());
        }
    }
    public function edit($project_type, $id_project, $lang_code)
    {
        try {
            $req = "UPDATE project_type_translations SET project_type = ? WHERE id_project_type = ? AND lang_code = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$project_type, $id_project, $lang_code]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception("Unable to insert into project_type_translations: " . $e->getMessage());
        }
    }
    public function getAll()
    {
        try {
            $req = "SELECT * FROM project_type pt LEFT JOIN project_type_translations ptt on pt.id_project_type = ptt.id_project_type WHERE pt.deleted = 0 AND ptt.lang_code = 'fr'";
            $stmt = $this->db->prepare($req);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve categories: " . $e->getMessage());
        }
    }
    public function getById($id)
    {
        try {
            $req = "SELECT * FROM project_type pt LEFT JOIN project_type_translations ptt on pt.id_project_type = ptt.id_project_type WHERE pt.id_project_type = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Unable to get project_type: " . $e->getMessage());
        }
    }

    public function getByIdAndLang($id, $lang)
    {
        try {
            $req = "SELECT * FROM project_type pt LEFT JOIN project_type_translations ptt on pt.id_project_type = ptt.id_project_type WHERE pt.id_project_type = ? and ptt.lang_code = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$id, $lang]);
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Unable to get project_type: " . $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $req = "UPDATE project_type SET deleted = 1 WHERE id_project_type = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$id]);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Unable to delete project_type: " . $e->getMessage());
        }
    }
}
