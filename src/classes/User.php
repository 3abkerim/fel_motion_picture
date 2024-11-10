<?php
class User
{
    private $db;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $admin;
    private $key_people;
    private $deleted;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->mdp = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function setKeyPeople($key_people)
    {
        $this->key_people = $key_people;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    public function save()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO users (nom, prenom, email, mdp, admin, key_people, deleted) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $this->nom,
                $this->prenom,
                $this->email,
                $this->mdp,
                $this->admin,
                $this->key_people,
                $this->deleted
            ]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Unable to save user: " . $e->getMessage());
            throw new Exception("Unable to save user.");
        }
    }
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `users`");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getAdmins()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `admin` = 1");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function authenticate($email, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `email` = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['mdp'])) {
                return $user;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            throw new Exception("Unable to authenticate user: " . $e->getMessage());
        }
    }

    public function isAdmin($email)
    {
        try {
            $stmt = $this->db->prepare("SELECT `admin` FROM `users` WHERE `email` = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            return $user && $user['admin'] == 1;
        } catch (PDOException $e) {
            throw new Exception("Unable to check admin status: " . $e->getMessage());
        }
    }

    public function getKeyPeople($lang)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `users` 
            LEFT JOIN `images` ON users.id_user = images.id_key_people 
            LEFT JOIN `users_translations` ON users_translations.id_user = users.id_user
            WHERE users.key_people = 1 AND users_translations.lang_code = ?");
            $stmt->execute([$lang]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }

    public function getAllNotDeleted()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `deleted` = 0");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve messages: " . $e->getMessage());
        }
    }


    public function getById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `id_user` = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Unable to user id: " . $e->getMessage());
        }
    }

    public function isUserExists($email): bool
    {
        try {
            $rawSql = "SELECT `email` FROM `users` WHERE `email` = ?";
            $stmt = $this->db->prepare($rawSql);
            $stmt->execute([$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result !== false;
        } catch (PDOException $e) {
            throw new Exception("Unable to retrieve user: " . $e->getMessage());
        }
    }

    public function createUser($nom, $prenom, $email, $mdp)
    {
        try {
            $rawSql = "INSERT INTO `users` (nom, prenom, email, mdp) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($rawSql);
            $stmt->execute([$nom, $prenom, $email, $mdp]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Unable to create user: " . $e->getMessage());
        }
    }
}
