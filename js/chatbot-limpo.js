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

    // --- Lógica da API (VERSÃO FINAL E FUNCIONAL) ---
    async function getAIResponse(userMessage) {
        const typingIndicator = addMessageToChat('bot', 'Synapse está digitando...');
        typingIndicator.classList.add('typing');

        try {
            console.log('Enviando mensagem:', userMessage);

            const response = await fetch('api/groq-proxy.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: userMessage })
            });

            console.log('Status da resposta:', response.status);

            if (!response.ok) {
                const errorData = await response.json().catch(() => ({}));
                console.error('Erro HTTP:', response.status, errorData);
                throw new Error(`Erro do servidor: ${response.status}`);
            }

            const data = await response.json();
            console.log('Resposta completa:', data);

            // Extrai a resposta do chatbot
            let botResponse;
            
            if (data.success && data.choices && data.choices[0] && data.choices[0].message) {
                botResponse = data.choices[0].message.content;
            } else if (data.choices && data.choices[0] && data.choices[0].message) {
                botResponse = data.choices[0].message.content;
            } else if (data.error) {
                throw new Error(data.error);
            } else {
                throw new Error('Formato de resposta inesperado');
            }
            
            typingIndicator.textContent = botResponse.trim();
            typingIndicator.classList.remove('typing');

        } catch (error) {
            console.error("Erro detalhado:", error);
            typingIndicator.textContent = "Desculpe, estou temporariamente indisponível. Tente novamente em alguns instantes.";
            typingIndicator.classList.remove('typing');
        }
    }

    // Adiciona a mensagem de boas-vindas inicial
    addMessageToChat('bot', 'Olá! Eu sou o Synapse, assistente virtual da Insygro. Como posso ajudar você hoje?');
});
