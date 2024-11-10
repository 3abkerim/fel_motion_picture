<?php

class About
{
    private $db;
    private $title;
    private $main;
    private $order;



    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function save()
    {
        try {
            $req = "INSERT INTO `about_us` (title,about_us,order) VALUES (?,?,?)";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$this->title, $this->main, $this->order]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }
    public function getAll($lang)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM about_us ab LEFT JOIN about_us_translations abt ON ab.id_about_us = abt.id_about_us AND ab.qsn = 0 AND abt.lang_code = ?");
            $stmt->execute([$lang]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getqsn($lang)
    {
        try {
            $stmt = $this->db->prepare("SELECT abt.about_us FROM about_us ab JOIN about_us_translations abt ON ab.id_about_us = abt.id_about_us AND ab.qsn = 1 AND abt.lang_code = ?");
            $stmt->execute([$lang]);
            $result = $stmt->fetch();
            return $result['about_us'];
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getByIdAndLang($id, $lang)
    {
        try {
            $req = "SELECT * FROM about_us a LEFT JOIN about_us_translations at on a.id_about_us = at.id_about_us WHERE a.id_about_us = ? and at.lang_code = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$id, $lang]);
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Unable to get project_type: " . $e->getMessage());
        }
    }

    /**
     * Save the service and return the newly inserted service ID.
     * @throws Exception
     */
    public function save1()
    {
        try {
            $maxOrderQuery = $this->db->prepare('SELECT MAX(`order`) as max_order FROM about_us');
            $maxOrderQuery->execute();
            $row = $maxOrderQuery->fetch();

            $max_order = $row['max_order'] ?? 0;
            $next_order = $max_order + 1;

            $req = "INSERT INTO about_us (`order`) VALUES (?)";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$next_order]);

            // Return the ID of the newly inserted service
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Unable to save service: " . $e->getMessage());
            throw new Exception("Unable to save service.");
        }
    }

    /**
     * Save service translation for a given language.
     * @throws Exception
     */
    public function save2($id_about_us, $lang_code, $title, $about_us)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO about_us_translations (id_about_us, lang_code, title, about_us) VALUES (?, ?, ?, ?)");
            $stmt->execute([$id_about_us, $lang_code, $title, $about_us]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Unable to save about_us_translations: " . $e->getMessage());
            throw new Exception("Unable to save about_us_translations.");
        }
    }

    public function getAllByOrder($lang)
    {
        try {
            $stmt = $this->db->prepare("
                SELECT a.*, at.title, at.about_us 
                FROM about_us a 
                LEFT JOIN about_us_translations at ON a.id_about_us = at.id_about_us AND at.lang_code = ? 
                WHERE a.deleted = 0
                ORDER BY a.`order`
            ");
            $stmt->execute([$lang]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve about_us by order: " . $e->getMessage());
        }
    }

    public function update2($title, $about_us, $id, $lang)
    {
        try {
            $req = "UPDATE about_us_translations SET title = ?, about_us = ? WHERE id_about_us = ? AND lang_code = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$title, $about_us, $id, $lang]);
            $affectedRows = $stmt->rowCount();
            return $affectedRows;
        } catch (PDOException $e) {
            error_log("Error in update about us element: " . $e->getMessage());
            return false;
        }
    }


    public function delete($id)
    {
        try {
            $req = "UPDATE about_us SET deleted = 1 WHERE id_about_us = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$id]);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Unable to delete about us element: " . $e->getMessage());
        }
    }

    public function updateOrder($data) {
        foreach ($data as $item) {
            $query = "UPDATE about_us SET `order` = :order WHERE id_about_us = :id";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':order', $item['order'], PDO::PARAM_INT);
            $statement->bindValue(':id', $item['id'], PDO::PARAM_INT);

            if (!$statement->execute()) {
                throw new Exception("Error updating item order with ID: " . $item['id']);
            }
        }
        return "Order updated successfully.";
    }

}
