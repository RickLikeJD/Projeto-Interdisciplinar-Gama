<?php
require_once '../gama/conexao.php';

if (!isset($conn) || $conn->connect_error) {
    $error_message = isset($conn) ? "Erro de conexão mysqli: " . htmlspecialchars($conn->connect_error) : "A conexão com o banco de dados (\$conn) não foi estabelecida ou é inválida.";
    echo "<p style='color:red;'><strong>Erro:</strong> " . $error_message . "</p>";
    return;
}

// Assume $nome_trilha_atual is set by the including page.
// For standalone testing, you might uncomment the line below:
// $nome_trilha_atual = "Trilha Exemplo"; // Example: Make sure this is set

if (!isset($nome_trilha_atual) || empty($nome_trilha_atual)) {
    echo "<p style='color:red;'><strong>Erro:</strong> O nome da trilha atual (\$nome_trilha_atual) não foi definido.</p>";
    // If this script is included, the parent script might handle exit.
    // If it's meant to be somewhat standalone, you might want an exit here.
    return;
}


// Processa exclusão
if (isset($_GET['delete_confirmed'])) { // Changed from 'delete' to avoid conflict if JS is off
    $id_delete = intval($_GET['delete_confirmed']);
    $sql_delete = "DELETE FROM tbAvaliacoes WHERE id = ? AND nome_trilha = ?";
    $stmt = $conn->prepare($sql_delete);
    if ($stmt) {
        $stmt->bind_param('is', $id_delete, $nome_trilha_atual);
        $stmt->execute();
        $stmt->close();
        // Redirect to the page without any query parameters after deletion
        echo "<script>window.location.href='" . strtok($_SERVER['REQUEST_URI'], '?') . "';</script>";
        exit;
    } else {
        echo "<p style='color:red;'><strong>Erro:</strong> Falha ao preparar a exclusão.</p>";
    }
}

// Processa edição
if (isset($_POST['edit_id'])) {
    $id_edit = intval($_POST['edit_id']);
    $feedback_edit = trim($_POST['feedback_edit'] ?? '');
    $estrelas_edit = intval($_POST['estrelas_edit'] ?? 0);

    if ($feedback_edit && $estrelas_edit >= 1 && $estrelas_edit <= 5) {
        $sql_edit = "UPDATE tbAvaliacoes SET feedback_texto = ?, estrelas = ? WHERE id = ? AND nome_trilha = ?";
        $stmt = $conn->prepare($sql_edit);
        if ($stmt) {
            $stmt->bind_param('siis', $feedback_edit, $estrelas_edit, $id_edit, $nome_trilha_atual);
            $stmt->execute();
            $stmt->close();
            echo "<script>window.location.href='" . strtok($_SERVER['REQUEST_URI'], '?') . "';</script>";
            exit;
        } else {
             echo "<p style='color:red;'><strong>Erro:</strong> Falha ao preparar a edição.</p>";
        }
    }
}

// Se recebeu um POST de novo comentário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['edit_id'])) {
    $feedback = trim($_POST['feedback'] ?? '');
    $estrelas = intval($_POST['estrelas'] ?? 0);

    if ($feedback && $estrelas >= 1 && $estrelas <= 5) {
        $sql_insert = "INSERT INTO tbAvaliacoes (nome_trilha, feedback_texto, estrelas, data_avaliacao)
                       VALUES (?, ?, ?, NOW())";
        $stmt_insert = $conn->prepare($sql_insert);
        if ($stmt_insert) {
            $stmt_insert->bind_param('ssi', $nome_trilha_atual, $feedback, $estrelas);
            $stmt_insert->execute();
            $stmt_insert->close();
            // Redirect to the same page to prevent form resubmission
            echo "<script>window.location.href='" . strtok($_SERVER['REQUEST_URI'], '?') . "';</script>";
            exit;
        } else {
            echo "<p style='color:red;'><strong>Erro:</strong> Falha ao preparar a inserção.</p>";
        }
    }
}

// Busca avaliações
$avaliacoes = [];
$sql = "SELECT id, feedback_texto, estrelas, data_avaliacao
        FROM tbAvaliacoes
        WHERE nome_trilha = ?
        ORDER BY data_avaliacao DESC, id DESC"; // Order by date first, then ID

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param('s', $nome_trilha_atual);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $avaliacoes[] = $row;
    }
    $stmt->close();
} else {
     echo "<p style='color:red;'><strong>Erro:</strong> Falha ao buscar avaliações.</p>";
}

$editing_avaliacao = null;
if (isset($_GET['edit'])) {
    $id_editando = intval($_GET['edit']);
    foreach ($avaliacoes as $a) {
        if ($a['id'] == $id_editando) {
            $editing_avaliacao = $a;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Avaliações - <?php echo htmlspecialchars($nome_trilha_atual); ?></title>
    <style>
        body {
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', 'Roboto', sans-serif;
        }

        .container-avaliacoes {
            max-width: 700px;
            margin: 40px auto;
            padding: 25px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .container-avaliacoes h2, .container-avaliacoes h3 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .avaliacao-item {
            background: #fafafa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #eaeaea;
            transition: box-shadow 0.3s;
        }

        .avaliacao-item:hover {
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
        }

        .avaliacao-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .avaliacao-estrelas {
            color: #ffc107; /* Gold for stars */
            font-weight: bold;
            font-size: 1.1em;
        }
         .avaliacao-estrelas .star-empty {
            color: #ccc; /* Lighter color for empty stars */
        }

        .avaliacao-data {
            color: #888;
            font-size: 0.9em;
        }

        .avaliacao-texto {
            color: #444;
            /* font-style: italic; */ /* Removed italic for better readability */
            line-height: 1.6;
            font-size: 1em;
            word-wrap: break-word; /* Ensure long words don't break layout */
        }

        .sem-avaliacoes {
            text-align: center;
            color: #777;
            padding: 20px;
            background: #fefefe;
            border-radius: 8px;
            border: 1px dashed #ccc;
        }

        /* Formulário */
        .form-avaliacao {
            background: #f8f9fa; /* Slightly different background */
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 25px; /* Increased padding */
            margin-top: 30px;
        }
        .form-avaliacao label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        .form-avaliacao textarea,
        .form-avaliacao select {
            width: 100%;
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
            border: 1px solid #ced4da; /* Softer border color */
            border-radius: 8px;
            padding: 12px; /* Increased padding */
            font-size: 1em;
            margin-bottom: 15px; /* Increased margin */
        }
        .form-avaliacao textarea {
             height: 120px; /* Increased height */
             resize: vertical;
        }


        .form-avaliacao button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px; /* Increased padding */
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 500; /* Bolder text */
            transition: background-color 0.3s, box-shadow 0.2s;
            margin-right: 10px; /* Space between buttons */
        }

        .form-avaliacao button:hover {
            background-color: #0056b3;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .form-avaliacao a.cancel-button { /* Style for cancel link in form */
            display: inline-block;
            background-color:#6c757d;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1em;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        .form-avaliacao a.cancel-button:hover {
            background-color: #545b62;
        }


        .botoes {
            margin-top: 15px; /* Increased margin */
            display: flex; /* Align buttons in a row */
            gap: 10px; /* Space between buttons */
        }

        .botoes a, .botoes button { /* Common styling for action buttons */
            padding: 8px 14px; /* Slightly larger padding */
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-size: 0.95em; /* Slightly larger font */
            border: none;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.2s;
        }
        .botoes a:hover, .botoes button:hover {
            opacity: 0.85;
            transform: translateY(-1px); /* Subtle lift effect */
        }

        .botoes .editar {
            background-color: #ffc107; /* Yellow for edit */
            color: #212529; /* Darker text for yellow bg */
        }
         .botoes .editar:hover {
            background-color: #e0a800;
        }

        .botoes .excluir { /* Specific class for delete button if needed, otherwise direct link styling */
            background-color: #dc3545; /* Red for delete */
             color: white;
        }
        .botoes .excluir:hover {
            background-color: #c82333;
        }

        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.6); /* Black w/ opacity */
            padding-top: 60px;
            align-items: center; /* For flex centering */
            justify-content: center; /* For flex centering */
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto; /* 15% from the top and centered for non-flex */
            padding: 25px 30px;
            border: 1px solid # E0E0E0;
            border-radius: 10px;
            width: 90%; /* Could be more mobile-friendly */
            max-width: 350px; /* Max width */
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            text-align: center;
            position: relative; /* For potential close button positioning */
        }
        .modal-content img {
        }
        .modal-content p {
            font-size: 1.1em;
            color: #333;
            margin-bottom: 25px;
        }
        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 15px; /* Space between modal buttons */
        }
        .modal-buttons button {
            padding: 10px 25px;
            border-radius: 6px;
            font-size: 1em;
            cursor: pointer;
            border: none;
            transition: background-color 0.2s, transform 0.2s;
        }
        .modal-buttons button:hover {
            transform: translateY(-1px);
        }
        #confirmDeleteBtn {
            background-color: #dc3545;
            color: white;
        }
        #confirmDeleteBtn:hover {
            background-color: #c82333;
        }
        #cancelDeleteBtn {
            background-color: #6c757d;
            color: white;
        }
        #cancelDeleteBtn:hover {
            background-color: #5a6268;
        }

    </style>
</head>
<body>

<div class="container-avaliacoes">
    <h2>Avaliações para: <?php echo htmlspecialchars($nome_trilha_atual); ?> 📝</h2>

    <?php if (count($avaliacoes) > 0): ?>
        <?php foreach ($avaliacoes as $avaliacao): ?>
            <div class="avaliacao-item" id="avaliacao-<?php echo $avaliacao['id']; ?>">
                <div class="avaliacao-header">
                    <span class="avaliacao-estrelas">
                        <?php
                        $num_estrelas = (int)$avaliacao['estrelas'];
                        for ($i = 1; $i <= 5; $i++) {
                            echo ($i <= $num_estrelas) ? '⭐' : '<span class="star-empty">☆</span>';
                        }
                        ?>
                        (<?php echo $num_estrelas; ?>/5)
                    </span>
                    <span class="avaliacao-data">
                        <?php
                        try {
                            $data_obj = new DateTime($avaliacao['data_avaliacao']);
                            // Adjust timezone if your DB is in UTC and you want local time
                            // $data_obj->setTimezone(new DateTimeZone('America/Sao_Paulo'));
                            echo $data_obj->format('d/m/Y H:i');
                        } catch (Exception $e) {
                            echo htmlspecialchars($avaliacao['data_avaliacao']); // Fallback
                        }
                        ?>
                    </span>
                </div>
                <p class="avaliacao-texto">
                    "<?php echo nl2br(htmlspecialchars($avaliacao['feedback_texto'])); ?>"
                </p>

                <div class="botoes">
                    <a class="editar" href="<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>?edit=<?php echo $avaliacao['id']; ?>#form-title">Editar</a>
                    <a class="excluir delete-link" href="?delete_confirmed=<?php echo $avaliacao['id']; ?>" data-id="<?php echo $avaliacao['id']; ?>">Excluir</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="sem-avaliacoes">Ainda não há avaliações para "<?php echo htmlspecialchars($nome_trilha_atual); ?>". Seja o primeiro a avaliar!</p>
    <?php endif; ?>

    <div class="form-avaliacao">
        <h3 id="form-title">
            <?php echo ($editing_avaliacao) ? 'Editando Avaliação:' : 'Deixe sua avaliação:'; ?>
        </h3>
        <form method="post" action="<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>">
            <?php if ($editing_avaliacao): ?>
                <input type="hidden" name="edit_id" value="<?php echo $editing_avaliacao['id']; ?>">
            <?php endif; ?>

            <div>
                <label for="estrelas_form">Nota:</label>
                <select name="<?php echo ($editing_avaliacao) ? 'estrelas_edit' : 'estrelas'; ?>" id="estrelas_form" required>
                    <?php if (!$editing_avaliacao): ?>
                        <option value="" disabled selected>Escolha...</option>
                    <?php endif; ?>
                    <?php for ($s = 5; $s >= 1; $s--): ?>
                        <option value="<?php echo $s; ?>" <?php if ($editing_avaliacao && $editing_avaliacao['estrelas'] == $s) echo 'selected'; ?>>
                            <?php echo $s; ?> <?php echo str_repeat('⭐', $s); ?> -
                            <?php
                                switch ($s) {
                                    case 5: echo "Excelente"; break;
                                    case 4: echo "Muito bom"; break;
                                    case 3: echo "Bom"; break;
                                    case 2: echo "Regular"; break;
                                    case 1: echo "Ruim"; break;
                                }
                            ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div>
                <label for="feedback_form">Comentário:</label>
                <textarea name="<?php echo ($editing_avaliacao) ? 'feedback_edit' : 'feedback'; ?>" id="feedback_form"
                          placeholder="Escreva aqui seu comentário..." required><?php if ($editing_avaliacao) echo htmlspecialchars($editing_avaliacao['feedback_texto']); ?></textarea>
            </div>
            
            <button type="submit">
                <?php echo ($editing_avaliacao) ? 'Salvar Alterações' : 'Enviar Avaliação'; ?>
            </button>
            <?php if ($editing_avaliacao): ?>
                <a href="<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>" class="cancel-button">Cancelar Edição</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<div id="deleteConfirmModal" class="modal">
  <div class="modal-content">
    <span style="font-size: 50px; display: block; margin-bottom:15px;"></span> <p>Tem certeza que deseja excluir esta avaliação?</p>
    <div class="modal-buttons">
      <button id="confirmDeleteBtn">Sim, Excluir</button>
      <button id="cancelDeleteBtn">Cancelar</button>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('deleteConfirmModal');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        let deleteUrl = ''; // To store the URL for deletion

        document.querySelectorAll('.delete-link').forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault(); // Stop the link from navigating immediately
                deleteUrl = this.href;  // Get the URL from the link's href
                modal.style.display = 'flex'; // Show the modal (use flex for centering)
            });
        });

        confirmDeleteBtn.addEventListener('click', function () {
            if (deleteUrl) {
                window.location.href = deleteUrl; // Proceed with deletion
            }
        });

        cancelDeleteBtn.addEventListener('click', function () {
            modal.style.display = 'none'; // Hide the modal
            deleteUrl = ''; // Clear the URL
        });

        // Close modal if user clicks outside of the modal content
        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.style.display = 'none';
                deleteUrl = '';
            }
        });

        // Handle "edit" link to scroll to the form
        <?php if (isset($_GET['edit'])): ?>
        const formTitle = document.getElementById('form-title');
        if(formTitle) {
            formTitle.scrollIntoView({ behavior: 'smooth' });
        }
        <?php endif; ?>

    });
</script>

</body>
</html>