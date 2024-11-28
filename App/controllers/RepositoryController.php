<?php

namespace App\Controllers;

use Framework\Database;
use App\Controllers\ErrorController;

class RepositoryController {
  protected $db;

  public function __construct() {
    $config = require basePath("config/db.php");
    $this->db = new Database($config);
  }

  public function index() {
    $sort = "DESC";
    $page = 1;
    $limit = 5;

    $search = $_GET['search'] ?? '';

    if (isset($_GET['sort'])) {
      $sort = $_GET['sort'] === "ascending" ? "ASC" : "DESC";
    }

    if (isset($_GET["page"])) {
      $page = $_GET["page"];
    }

    $offset = ($page - 1) * $limit;

    $sql = "SELECT * FROM research
            WHERE title LIKE :search OR author LIKE :search
            ORDER BY created_at {$sort}
            LIMIT 5 OFFSET {$offset}";

    $research = $this->db->query($sql, ['search' => $search])->fetchAll();
    $count = $this->db->query("SELECT COUNT(*) as total FROM research")->fetch();

    $totalPages =  ceil((int) $count->total / $limit);

    loadView("repositories/index", [
      "research" => $research,
      "count" => $count,
      "sort" => $sort,
      "page" => $page,
      "totalPages" => $totalPages,
      "search" => $search,
    ]);
  }

  public function show($params) {
    $id = $params['id'] ?? '';

    $params = ['id' => $id];

    $research = $this->db->query("SELECT * FROM research WHERE id = :id", $params)->fetch();

    if (!$research) {
      ErrorController::notFound("Research not found");
      return;
    }

    loadView("repositories/show", ["research" => $research]);
  }
}