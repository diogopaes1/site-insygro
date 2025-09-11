document.addEventListener('DOMContentLoaded', () => {
    const chatWindow = document.getElementById('chat-window');
    const chatbotIcon = document.getElementById('chatbot-icon');
    const chatBody = document.getElementById('chat-body');
    const chatInput = document.getElementById('chat-input');
    const sendBtn = document.getElementById('send-btn');

    // --- Lógica para abrir e fechar o chat ---
    chatbotIcon.addEventListener('click', () => {
        chatWindow.classList.toggle('open');
    });

    // --- Lógica de envio de mensagem ---
    sendBtn.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    function sendMessage() {
        const userMessage = chatInput.value.trim();
        if (userMessage === '') return;

        addMessageToChat('user', userMessage);
        chatInput.value = '';
        
        setTimeout(() => {
            getAIResponse(userMessage);
        }, 500);
    }

    function addMessageToChat(sender, message) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('chat-message', sender);
        messageElement.textContent = message;
        chatBody.appendChild(messageElement);
        chatBody.scrollTop = chatBody.scrollHeight;
        return messageElement;
    }

    // --- Lógica da API (CORRIGIDA PARA CHAMAR O PROXY PHP) ---
    async function getAIResponse(userMessage) {
        const typingIndicator = addMessageToChat('bot', 'Synapse está digitando...');
        typingIndicator.classList.add('typing');

        const proxyUrl = '/api/groq-proxy.php';

        try {
            const response = await fetch(proxyUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json' // <-- ADICIONE ESTA LINHA
                },
                body: JSON.stringify({ message: userMessage }) 
            });

            const data = await response.json();

            if (!response.ok) {
                // Se o servidor retornou um erro (como 400 ou 500), exibe a mensagem de erro do PHP
                throw new Error(data.error || 'Erro desconhecido do servidor.');
            }
            
            // A resposta da Groq vem dentro da propriedade 'choices'
            const botResponse = data.choices[0]?.message?.content.trim();
            
            typingIndicator.textContent = botResponse;
            typingIndicator.classList.remove('typing');

        } catch (error) {
            console.error("Erro ao contatar a IA via proxy:", error);
            typingIndicator.textContent = "Desculpe, estou com um problema de conexão. Por favor, tente novamente mais tarde ou contate-nos diretamente.";
            typingIndicator.classList.remove('typing');
        }
    }

    // Adiciona a mensagem de boas-vindas inicial
    addMessageToChat('bot', 'Olá! Eu sou o Synapse, assistente virtual da Insygro. Como posso ajudar você hoje?');
});
