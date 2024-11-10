<?php

class HomeImages
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function updateImageOrder($data)
    {
        try {
            foreach ($data as $item) {
                var_dump($data);
                $query = 'UPDATE images_home SET ordre = :order WHERE id_image = :id';
                $statement = $this->db->prepare($query);

                $statement->bindValue(':order', $item['order'], PDO::PARAM_INT);
                $statement->bindValue(':id', $item['id'], PDO::PARAM_INT);

                if ($statement->execute()) {
                    echo "Successfully updated image with ID: " . $item['id'] . " to order: " . $item['order'] . "\n";
                } else {
                    echo "Error updating image with ID: " . $item['id'] . "\n";
                    print_r($statement->errorInfo());
                }
            }
            return "Image order updated successfully.";
        } catch (Exception $e) {
            echo "Failed to update image order: " . $e->getMessage();
            return false;
        }
    }

    function insertImageWithOrder($image)
    {
        try {
            $db = $this->db;
            $db->beginTransaction();

            $maxOrderQuery = $db->prepare('SELECT MAX(`ordre`) as max_order FROM images_home');
            $maxOrderQuery->execute();
            $row = $maxOrderQuery->fetch();

            $max_order = $row['max_order'] ?? 0;
            $newOrder = $max_order + 1;

            $insertHomeQuery = $db->prepare('INSERT INTO images_home (`ordre`, `deleted`) VALUES (?, ?)');
            $insertHomeQuery->execute([$newOrder, 0]);
            $idImagesHome = $db->lastInsertId();

            $insertImageQuery = $db->prepare('INSERT INTO images (image, id_images_home) VALUES (?, ?)');
            $result = $insertImageQuery->execute([$image, $idImagesHome]);

            $db->commit();

            return $result;
        } catch (Exception $e) {
            $db->rollBack();
            echo "Failed: " . $e->getMessage();
            return false;
        }
    }

    public function getAllByOrderNotDeleted()
    {
        try {
            $stmt = $this->db->prepare("SELECT ih.id_image,ih.ordre,ih.deleted,i.image FROM images_home ih JOIN images i ON ih.id_image = i.id_images_home WHERE ih.deleted = 0 ORDER BY ih.ordre ASC");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $req = "UPDATE images_home SET deleted = 1 WHERE id_image = ?";
            $stmt = $this->db->prepare($req);
            $stmt->execute([$id]);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Unable to delete image : " . $e->getMessage());
        }
    }

}
