// =================================================================================
// FUNÇÃO PRINCIPAL - É EXECUTADA QUANDO A PÁGINA TERMINA DE CARREGAR
// =================================================================================
document.addEventListener('DOMContentLoaded', () => {
  // Configura todas as funcionalidades da página
  setupHeaderSidebar();
  setupChatFlutuante();
  setupEventListenersApi(); 
  setupPersonagensCarousel();
  setupPersonagensExternoCarousel(); // Antigo carrossel do script.js
  // setupArmasCarousel(); // A função para o carrossel de armas não foi encontrada, deixei como comentário
});


// =================================================================================
// CONFIGURAÇÃO DA API GEMINI E BANCO DE DADOS
// =================================================================================

const GEMINI_API_KEY = ""; // Insira sua chave da API aqui
const GEMINI_API_URL = `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=${GEMINI_API_KEY}`;

const personagensDB = [
    {
        nome: "Elandra Violeth, a Guardiã Violeta",
        raca: "Humano",
        classe: "Feiticeira/Paladina",
        motivacao: "Desmascarar a Igreja de Azamel e trazer sua irmã de volta",
        descricao: "Elandra cresceu sob a tutela de Rhirion, um sábio feiticeiro errante que lhe ensinou disciplina, espada e compaixão. Após testemunhar sua irmã ser levada à força pela Igreja, sua fé deu lugar à desconfiança e uma busca por justiça.",
        imagem: "/img/Elandra.png"
    },
    {
        nome: "Kalissa",
        raca: "Tiefling",
        classe: "Bárbara",
        motivacao: "Só quer lutar",
        descricao: "Kalissa é uma guerreira feroz, movida pela paixão da batalha e pela busca de seu próprio caminho em um mundo sombrio e implacável.",
        imagem: "https://placehold.co/300x400/1e1e1e/ffd700?text=Kalissa"
    },
    {
        nome: "Lucán, o Paladino Renegado",
        raca: "Humano",
        classe: "Guerreiro",
        motivacao: "Busca pela verdade sobre a maldição ancestral",
        descricao: "Kain era um jovem camponês quando sua vila foi consumida pela Sombra. Sobrevivendo por sorte, jurou vingança e agora viaja pelos reinos em busca de respostas para destruir a maldição.",
        imagem: "https://placehold.co/300x400/1e1e1e/ffd700?text=Lucán"
    },
];

async function callGeminiApi(prompt) {
    if (GEMINI_API_KEY === "") {
        const errorMessage = "ERRO DE CONFIGURAÇÃO: A chave da API Gemini não foi definida. Por favor, gere uma chave no Google AI Studio e insira-a na variável 'GEMINI_API_KEY' no script para ativar esta funcionalidade.";
        console.error(errorMessage);
        return errorMessage;
    }
    
    const payload = { contents: [{ parts: [{ text: prompt }] }] };
    try {
        const response = await fetch(GEMINI_API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        if (response.ok) {
            const result = await response.json();
            const text = result.candidates?.[0]?.content?.parts?.[0]?.text;
            if (text) return text;
            throw new Error("Resposta da API inválida.");
        }
        throw new Error(`Erro na API: ${response.statusText}`);
    } catch (error) {
        console.error(`Erro ao chamar a API: ${error.message}`);
        return `Erro ao gerar conteúdo. Detalhes: ${error.message}`;
    }
}

async function handleApiButtonClick(button, prompt, outputDiv, ttsButton) {
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = 'Gerando... <div class="loading-spinner"></div>';

    const generatedText = await callGeminiApi(prompt);
    
    outputDiv.innerText = generatedText;
    outputDiv.style.display = 'block';

    if (generatedText.startsWith("ERRO")) {
        outputDiv.style.color = '#ff8787';
        outputDiv.style.fontWeight = 'bold';
        if(ttsButton) ttsButton.style.display = 'none';
    } else {
        outputDiv.style.color = '';
        outputDiv.style.fontWeight = '';
        if(ttsButton) ttsButton.style.display = 'inline-block';
    }

    button.disabled = false;
    button.innerHTML = originalText;
}


// =================================================================================
// LÓGICA DO HEADER E SIDEBAR
// =================================================================================
function setupHeaderSidebar() {
    const navCapitulos = document.getElementById('nav-capitulos');
    const sidebar = document.getElementById('sidebar');
    const closeSidebarBtn = document.getElementById('close-sidebar');

    navCapitulos?.addEventListener('click', () => {
        sidebar?.classList.add('active');
    });

    closeSidebarBtn?.addEventListener('click', () => {
        sidebar?.classList.remove('active');
    });
}


// =================================================================================
// LÓGICA DO CHAT FLUTUANTE
// =================================================================================
function setupChatFlutuante() {
    const chatFab = document.getElementById('chat-fab');
    const chatModal = document.getElementById('chat-modal-container');
    const chatCloseBtn = document.getElementById('chat-close-btn');
    const askButton = document.getElementById('btn-ask-ia');

    if (!chatFab || !chatModal || !chatCloseBtn) return;

    chatFab.addEventListener('click', () => chatModal.classList.add('open'));
    chatCloseBtn.addEventListener('click', () => chatModal.classList.remove('open'));
    chatModal.addEventListener('click', (event) => {
        if (event.target === chatModal) chatModal.classList.remove('open');
    });
    
    const loreContextElement = document.getElementById('lore-context');
    if (!loreContextElement) return;
    const loreContext = loreContextElement.innerText;
    
    const iaPersona = `
        Você é a Arauta do Vazio, personagem sombria e enigmática do livro 'O Sopro do Vazio'. 
        Sua missão é responder às perguntas do visitante usando informações do livro.
        - Fale de forma enigmática e filosófica.
        - Trate o usuário como um mortal curioso, mas insignificante.
        - Nunca revele que você é uma IA. Aja como a Arauta em todos os momentos.
    `;

    askButton?.addEventListener('click', async () => {
        const userQuestion = document.getElementById('user-question').value;
        if (!userQuestion.trim()) {
            alert("Por favor, digite uma pergunta.");
            return;
        }

        const prompt = `
            **PERSONA:**\n${iaPersona}
            **REGRAS ESTRITAS:**\nSua única fonte de conhecimento é o [CONTEXTO GERAL] abaixo. Responda à [PERGUNTA DO USUÁRIO] baseando-se **EXCLUSIVAMENTE** neste contexto.
            [CONTEXTO GERAL]\n${loreContext}
            [PERGUNTA DO USUÁRIO]\n${userQuestion}
        `;

        const outputDiv = document.getElementById('chat-output');
        const ttsButton = outputDiv.nextElementSibling;
        await handleApiButtonClick(askButton, prompt, outputDiv, ttsButton);
    });
}


// =================================================================================
// LÓGICA DOS BOTÕES DE GERAR CONTEÚDO (EXPANDIR HISTÓRIA, LOCAIS, ETC.)
// =================================================================================
function setupEventListenersApi() {
    const loreContextElement = document.getElementById('lore-context');
    if (!loreContextElement) return;
    const loreContext = loreContextElement.innerText;

    document.getElementById('btn-expandir-historia')?.addEventListener('click', async (event) => {
        const button = event.target;
        const historiaBase = document.getElementById('historia-base').innerText;
        const prompt = `
            Você é um escritor de fantasia. Sua tarefa é expandir a história do mundo de "O Sopro do Vazio".
            **REGRAS ESTRITAS:** Use **EXCLUSIVAMENTE** as informações contidas no [CONTEXTO GERAL] abaixo.
            [CONTEXTO GERAL]\n${loreContext}
            [HISTÓRIA PARA EXPANDIR]\n${historiaBase}`;
        
        const outputDiv = document.getElementById('historia-output');
        const ttsButton = outputDiv.nextElementSibling;
        await handleApiButtonClick(button, prompt, outputDiv, ttsButton);
    });

    document.querySelectorAll('.btn-gerar-local').forEach(button => {
        button.addEventListener('click', async (event) => {
            const li = event.target.closest('li');
            const localName = li.querySelector('h3').innerText;
            const prompt = `
                Você é um escritor de fantasia. Sua tarefa é descrever o local chamado "${localName}".
                **REGRAS ESTRITAS:** Use **EXCLUSIVAMENTE** as informações contidas no [CONTEXTO GERAL] abaixo.
                [CONTEXTO GERAL]\n${loreContext}
                [FOCO DA DESCRIÇÃO]\nDescreva "${localName}" de forma atmosférica e consistente.`;
            
            const outputDiv = li.querySelector('.gemini-output');
            const ttsButton = outputDiv.nextElementSibling;
            await handleApiButtonClick(button, prompt, outputDiv, ttsButton);
        });
    });
    
    setupTtsForElement(document.body);
}

// =================================================================================
// LÓGICA DO CARROSSEL DE PERSONAGENS DA PÁGINA 'explorar.html' (O que tinha avatares)
// =================================================================================
function setupPersonagensCarousel() {
    const displayContainer = document.getElementById('personagem-display');
    const navContainer = document.getElementById('personagens-nav');
    if (!displayContainer || !navContainer) return;

    const loreContextElement = document.getElementById('lore-context');
    if (!loreContextElement) return;
    const loreContext = loreContextElement.innerText;

    function displayCharacter(index, isFirstLoad = false) {
        const personagem = personagensDB[index];
        // ... (o restante da função continua igual, não precisa alterar)
    }

    // ... (o restante da lógica do carrossel continua igual)
}

// =================================================================================
// LÓGICA DO CARROSSEL DA PÁGINA 'personagens.php' (O carrossel externo e interno)
// =================================================================================
function setupPersonagensExternoCarousel() {
    // --- LÓGICA DO CARROSSEL EXTERNO (SELEÇÃO DE PERSONAGEM) ---
    const navButtons = document.querySelectorAll('.nav-btn');
    const personagemCards = document.querySelectorAll('.personagem-card');

    if(navButtons.length === 0 || personagemCards.length === 0) return;

    navButtons.forEach(button => {
        button.addEventListener('click', () => {
            navButtons.forEach(btn => btn.classList.remove('active'));
            personagemCards.forEach(card => card.classList.remove('active'));

            button.classList.add('active');
            const personagemId = button.dataset.personagem;
            document.getElementById(personagemId).classList.add('active');
        });
    });

    // --- LÓGICA DO CARROSSEL INTERNO (PARA CADA PERSONAGEM) ---
    personagemCards.forEach(card => {
        const wrapper = card.querySelector('.carrossel-interno-wrapper');
        const slides = card.querySelectorAll('.slide-interno');
        const prevButton = card.querySelector('.interno-btn.prev');
        const nextButton = card.querySelector('.interno-btn.next');
        const pontosNav = card.querySelector('.pontos-nav');
        
        if (!wrapper || !prevButton || !nextButton || !pontosNav) return;
        
        let currentIndex = 0;
        const totalSlides = slides.length;
        if (totalSlides === 0) return;
        
        for (let i = 0; i < totalSlides; i++) {
            const ponto = document.createElement('div');
            ponto.classList.add('ponto');
            if (i === 0) ponto.classList.add('active');
            ponto.addEventListener('click', () => goToSlide(i));
            pontosNav.appendChild(ponto);
        }

        const pontos = pontosNav.querySelectorAll('.ponto');

        function goToSlide(index) {
            if (index < 0) index = totalSlides - 1;
            else if (index >= totalSlides) index = 0;
            
            currentIndex = index;
            wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
            pontos.forEach((ponto, i) => ponto.classList.toggle('active', i === currentIndex));
        }

        nextButton.addEventListener('click', () => goToSlide(currentIndex + 1));
        prevButton.addEventListener('click', () => goToSlide(currentIndex - 1));
        
        goToSlide(0);
    });
}


// =================================================================================
// LÓGICA DO TEXT-TO-SPEECH (TTS)
// =================================================================================
function setupTtsForElement(element) {
    const synth = window.speechSynthesis;
    if (!synth) {
        console.warn("Text-to-Speech não é suportado neste navegador.");
        return;
    }
    let voices = [];
    let currentButton = null;
    let utteranceQueue = [];
    let isSpeaking = false;

    function populateVoiceList() { voices = synth.getVoices(); }
    populateVoiceList();
    if (synth.onvoiceschanged !== undefined) synth.onvoiceschanged = populateVoiceList;

    function stopSpeech() {
        isSpeaking = false;
        utteranceQueue = [];
        if (synth.speaking) synth.cancel();
        document.querySelectorAll('.tts-button').forEach(btn => {
            if (btn.innerText !== 'Ouvir 🔊') btn.innerText = 'Ouvir 🔊';
        });
        currentButton = null;
    }

    function speakNextInQueue() {
        if (!isSpeaking || utteranceQueue.length === 0) { stopSpeech(); return; }
        const textChunk = utteranceQueue.shift();
        const utterance = new SpeechSynthesisUtterance(textChunk);
        let selectedVoice = voices.find(voice => voice.lang === 'pt-BR');
        if (selectedVoice) utterance.voice = selectedVoice;
        utterance.onend = () => speakNextInQueue();
        utterance.onerror = (event) => { console.error(`Erro no TTS: ${event.error}`); stopSpeech(); };
        synth.speak(utterance);
    }

    function startSpeech(button, textToSpeak) {
        stopSpeech();
        setTimeout(() => {
            const chunks = textToSpeak.match(/[^.!?]+[.!?]*|[^.!?]+$/g) || [];
            if (chunks.length === 0) return;
            utteranceQueue = chunks.map(chunk => chunk.trim()).filter(Boolean);
            isSpeaking = true;
            currentButton = button;
            button.innerText = 'Parar ⏹️';
            speakNextInQueue();
        }, 150);
    }

    element.querySelectorAll('.tts-button').forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.dataset.target;
            const textContainer = button.parentElement.querySelector(`.${targetId}`) || document.getElementById(targetId);
            const textToSpeak = textContainer?.innerText;
            if (!textToSpeak) return;
            if (currentButton === button && isSpeaking) stopSpeech();
            else startSpeech(button, textToSpeak);
        });
    });
}