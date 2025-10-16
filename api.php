<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(204);
  exit;
}


$dsn = "mysql:host=localhost;dbname=sua_base;charset=utf8mb4";
$user = "seu_usuario";
$pass = "sua_senha";

try {
  $pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(["success" => false, "message" => "Erro de conexão: " . $e->getMessage()]);
  exit;
}


function respond($status, $payload) {
  http_response_code($status);
  echo json_encode($payload, JSON_UNESCAPED_UNICODE);
  exit;
}


function normaliza_periodo($texto) {
  if ($texto === null) return null;
  $t = trim($texto);
 
  $map = [
    'manha' => 'Manhã', 'manhã' => 'Manhã', 'morning' => 'Manhã',
    'tarde' => 'Tarde', 'afternoon' => 'Tarde',
    'noite' => 'Noite', 'night' => 'Noite'
  ];
  $semAcento = iconv('UTF-8', 'ASCII//TRANSLIT', mb_strtolower($t, 'UTF-8'));
  if (isset($map[$semAcento])) return $map[$semAcento];
  
  $tLower = mb_strtolower($t, 'UTF-8');
  if ($tLower === 'manhã' || $tLower === 'manha') return 'Manhã';
  if ($tLower === 'tarde') return 'Tarde';
  if ($tLower === 'noite') return 'Noite';
  return $t; 
}


$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET': {
    $cod  = isset($_GET['cod'])  && $_GET['cod'] !== ''  ? $_GET['cod']  : null;
    $nome = isset($_GET['nome']) && $_GET['nome'] !== '' ? $_GET['nome'] : null;

    
    if ($cod !== null && $nome !== null) {
      respond(400, ["success" => false, "message" => "Envie apenas um parâmetro de busca: 'cod' OU 'nome'."]);
    }

  
    if ($cod !== null) {
      if (!ctype_digit((string)$cod)) {
        respond(400, ["success" => false, "message" => "Parâmetro 'cod' deve ser inteiro."]);
      }
      $st = $pdo->prepare("SELECT * FROM cursos WHERE cod = :cod");
      $st->execute([":cod" => (int)$cod]);
      $row = $st->fetch();
      if (!$row) {
        respond(404, ["success" => false, "message" => "Curso não encontrado para o código informado."]);
      }
      respond(200, ["success" => true, "data" => $row]);
    }

 
    if ($nome !== null) {
      $st = $pdo->prepare("SELECT * FROM cursos WHERE curso LIKE :nome");
      $st->execute([":nome" => "%{$nome}%"]);
      $rows = $st->fetchAll();
      if (!$rows) {
        respond(404, ["success" => false, "message" => "Nenhum curso encontrado para o nome especificado."]);
      }
      respond(200, ["success" => true, "data" => $rows]);
    }

  
    $st = $pdo->query("SELECT * FROM cursos ORDER BY cod DESC");
    $rows = $st->fetchAll();
    respond(200, ["success" => true, "data" => $rows]);
  }

  case 'POST': {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);

    if (!is_array($data)) {
      respond(400, ["success" => false, "message" => "JSON inválido."]);
    }

    $curso  = isset($data['curso'])  ? trim($data['curso'])  : null;
    $vagas  = isset($data['vagas'])  ? $data['vagas']        : null;
    $periodoRaw = isset($data['periodo']) ? $data['periodo'] : null;
    $periodo = normaliza_periodo($periodoRaw);

    $erros = [];

    
    if ($curso === null || $curso === '') {
      $erros['curso'] = "O campo 'curso' é obrigatório.";
    } elseif (!preg_match('/^[\p{L} ]+$/u', $curso)) {
      $erros['curso'] = "O campo 'curso' deve conter apenas letras e espaços (sem números ou símbolos).";
    }


    if ($vagas === null || $vagas === '') {
      $erros['vagas'] = "O campo 'vagas' é obrigatório.";
    } elseif (filter_var($vagas, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]) === false) {
      $erros['vagas'] = "O campo 'vagas' deve ser um número inteiro positivo.";
    } else {
      $vagas = (int)$vagas;
    }


    $permitidos = ['Manhã', 'Tarde', 'Noite'];
    if ($periodo === null || $periodo === '') {
      $erros['periodo'] = "O campo 'periodo' é obrigatório.";
    } elseif (!in_array($periodo, $permitidos, true)) {
      $erros['periodo'] = "O campo 'periodo' deve ser 'Manhã', 'Tarde' ou 'Noite'.";
    }

    if (!empty($erros)) {
      respond(400, ["success" => false, "message" => "Falha de validação.", "errors" => $erros]);
    }


    $st = $pdo->prepare("INSERT INTO cursos (curso, vagas, periodo) VALUES (:curso, :vagas, :periodo)");
    $st->execute([
      ":curso" => $curso,
      ":vagas" => $vagas,
      ":periodo" => $periodo
    ]);

    $novoId = (int)$pdo->lastInsertId();
    respond(201, ["success" => true, "message" => "Curso criado com sucesso.", "data" => [
      "cod" => $novoId,
      "curso" => $curso,
      "vagas" => $vagas,
      "periodo" => $periodo
    ]]);
  }

  case 'PUT': {

    $json = file_get_contents("php://input");
    $data = json_decode($json, true);
    if (!is_array($data)) respond(400, ["success" => false, "message" => "JSON inválido."]);

    if (!isset($data['cod']) || !ctype_digit((string)$data['cod'])) {
      respond(400, ["success" => false, "message" => "Informe 'cod' inteiro para atualizar."]);
    }

    $cod = (int)$data['cod'];

    
    $campos = [];
    $params = [":cod" => $cod];

    if (isset($data['curso'])) {
      $curso = trim($data['curso']);
      if ($curso === '' || !preg_match('/^[\p{L} ]+$/u', $curso)) {
        respond(400, ["success" => false, "message" => "Campo 'curso' inválido para atualização."]);
      }
      $campos[] = "curso = :curso";
      $params[":curso"] = $curso;
    }

    if (isset($data['vagas'])) {
      if (filter_var($data['vagas'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]) === false) {
        respond(400, ["success" => false, "message" => "Campo 'vagas' inválido para atualização."]);
      }
      $campos[] = "vagas = :vagas";
      $params[":vagas"] = (int)$data['vagas'];
    }

    if (isset($data['periodo'])) {
      $per = normaliza_periodo($data['periodo']);
      if (!in_array($per, ['Manhã','Tarde','Noite'], true)) {
        respond(400, ["success" => false, "message" => "Campo 'periodo' inválido para atualização."]);
      }
      $campos[] = "periodo = :periodo";
      $params[":periodo"] = $per;
    }

    if (empty($campos)) {
      respond(400, ["success" => false, "message" => "Nenhum campo válido enviado para atualizar."]);
    }

    $sql = "UPDATE cursos SET " . implode(", ", $campos) . " WHERE cod = :cod";
    $st = $pdo->prepare($sql);
    $st->execute($params);

    if ($st->rowCount() === 0) {
      respond(404, ["success" => false, "message" => "Curso não encontrado ou dados idênticos."]);
    }

    respond(200, ["success" => true, "message" => "Curso atualizado com sucesso."]);
  }

  case 'DELETE': {
    if (!isset($_GET['cod']) || !ctype_digit((string)$_GET['cod'])) {
      respond(400, ["success" => false, "message" => "Informe 'cod' inteiro para excluir."]);
    }
    $cod = (int)$_GET['cod'];
    $st = $pdo->prepare("DELETE FROM cursos WHERE cod = :cod");
    $st->execute([":cod" => $cod]);

    if ($st->rowCount() === 0) {
      respond(404, ["success" => false, "message" => "Curso não encontrado."]);
    }
    respond(200, ["success" => true, "message" => "Curso excluído com sucesso."]);
  }

  default:
    respond(405, ["success" => false, "message" => "Método não permitido."]);
}
