<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Modal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/feedback.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen overflow-hidden">

    <div class="background-image"></div>

    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-40">

        <div class="modal-content bg-white p-6 sm:p-8 rounded-lg shadow-2xl w-full max-w-md transform transition-all">
            <div class="mb-6 text-center">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Compartilhe Seu Feedback!</h2>
                <p class="text-gray-600 mt-1 text-sm sm:text-base">Adoraríamos ouvir sua opinião sobre nosso site.</p>
            </div>

            <form id="feedbackForm">
                <div class="mb-6">
                    <label for="feedbackText" class="block text-sm font-medium text-gray-700 mb-1">Seu Comentário:</label>
                    <textarea id="feedbackText" name="feedbackText" rows="5"
                        class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-150 ease-in-out placeholder-gray-400"
                        placeholder="Deixe seu comentário aqui..."></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 px-4 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                    Enviar Feedback
                </button>
            </form>

            <div id="successMessage" class="hidden mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md text-center">
                <p class="font-semibold">Obrigado!</p>
                <p>Seu feedback foi enviado com sucesso.</p>
            </div>
             <div id="errorMessage" class="hidden mt-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md text-center">
                <p class="font-semibold">Oops!</p>
                <p>Ocorreu um erro ao enviar seu feedback. Tente novamente.</p>
            </div>
        </div>
    </div>

    <script src="script.js" defer></script>
</body>
</html>