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
            $maxOrderQuery = $this->db->prepare('SELECT MAX(`order`) as max_order FROM project');
            $maxOrderQuery->execute();
            $row = $maxOrderQuery->fetch();

            $max_order = $row['max_order'] ?? 0;
            $next_order = $max_order + 1;

            $req = "INSERT INTO project (project_date, id_project_type, `order`) VALUES (?, ?, ?)";
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
            $req = "INSERT INTO project_translations (id_project,project_name,project_info,lang_code) VALUES (?,?,?,?)";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$id, $name, $info, $lang]);
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function update1($date, $type, $project)
    {
        try {
            $req = "UPDATE project SET project_date = ?, id_project_type = ? WHERE id_project = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$date, $type, $project]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function update2($name, $info, $project, $lang)
    {
        try {
            $req = "UPDATE project_translations SET project_name = ?, project_info = ? WHERE id_project = ? AND lang_code = ?";
            $stmt = $this->db->prepare($req);
            $success = $stmt->execute([$name, $info, $project, $lang]);
            $affectedRows = $stmt->rowCount();
            return $affectedRows;
        } catch (PDOException $e) {
            error_log("Error in update2: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $req = "UPDATE project SET deleted = 1 WHERE id_project = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$id]);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Unable to delete project: " . $e->getMessage());
        }
    }


    public function getAllFrench()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM project p LEFT JOIN project_translations pt ON p.id_project = pt.id_project WHERE lang_code = 'fr' ");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getAllFrenchND()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM project p LEFT JOIN project_translations pt ON p.id_project = pt.id_project WHERE lang_code = 'fr' and deleted = 0 ORDER BY p.order ASC");
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
            FROM project p 
            LEFT JOIN project_translations pt ON pt.id_project = p.id_project
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
                "SELECT * FROM project p
                JOIN project_type pty ON pty.id_project_type = p.id_project_type
                LEFT JOIN project_type_translations ptt ON ptt.id_project_type = p.id_project_type AND ptt.lang_code = ?
                LEFT JOIN images i ON i.id_project = p.id_project
                LEFT JOIN project_translations pt ON pt.id_project = p.id_project AND pt.lang_code = ?
                ORDER BY p.order ASC;"
            );
            $stmt->execute([$lang, $lang]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getAllOnlineByOrderNotDeleted($lang)
    {
        try {
            $stmt = $this->db->prepare(
                "SELECT * FROM project p
                JOIN project_type pty ON pty.id_project_type = p.id_project_type
                LEFT JOIN project_type_translations ptt ON ptt.id_project_type = p.id_project_type AND ptt.lang_code = ?
                LEFT JOIN images i ON i.id_project = p.id_project
                LEFT JOIN project_translations pt ON pt.id_project = p.id_project AND pt.lang_code = ?
                WHERE p.online = 1 AND p.deleted = 0
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
            $stmt = $this->db->prepare("SELECT * FROM project p LEFT JOIN project_translations pt ON p.id_project = pt.id_project WHERE p.id_project = ? AND lang_code = 'fr'");
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
            FROM project p 
            LEFT JOIN project_translations pt ON p.id_project = pt.id_project
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
            FROM project p 
            LEFT JOIN project_translations pt ON p.id_project = pt.id_project
            LEFT JOIN project_type pty ON pty.id_project_type = p.id_project_type
            JOIN project_type_translations ptyt ON pty.id_project_type = ptyt.id_project_type
            WHERE p.id_project = ? AND pt.lang_code = 'fr' AND ptyt.lang_code = 'fr' ");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve message: " . $e->getMessage());
        }
    }

    public function getImage($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM images WHERE id_project = ? ");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Unable to get the project's image: " . $e->getMessage());
        }
    }

    public function setImage($image, $id)
    {

        try {
            $this->db->beginTransaction();
            $checkQuery = $this->db->prepare('SELECT image FROM images WHERE id_project = ?');
            $checkQuery->execute([$id]);
            $existingImage = $checkQuery->fetch();

            if ($existingImage) {
                $oldImagePath = $existingImage['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $updateQuery = $this->db->prepare('UPDATE images SET image = ? WHERE id_project = ?');
                $result = $updateQuery->execute([$image, $id]);
            } else {
                $req = $this->db->prepare('INSERT INTO images (image, id_project) VALUES (?, ?)');
                $result = $req->execute([$image, $id]);
            }
            $this->db->commit();
            return $result;
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

    public function deleteImage($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM images WHERE id_project = ? ");
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception("Unable to delete the project's image : " . $e->getMessage());
        }
    }

    public function online($id, $online)
    {
        try {
            $req = "UPDATE project SET online = ? WHERE id_project = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$online, $id]); // Corrected the order of parameters
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }  
    
    public function updateOrder($data) {
        foreach ($data as $item) {
            $query = "UPDATE project SET `order` = :order WHERE id_project = :id";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':order', $item['order'], PDO::PARAM_INT);
            $statement->bindValue(':id', $item['id'], PDO::PARAM_INT);

            if (!$statement->execute()) {
                throw new Exception("Error updating item with ID: " . $item['id']);
            }
        }
        return "Order updated successfully.";
    }
}
