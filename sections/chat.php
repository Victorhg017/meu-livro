        <!-- LORE CONTEXT (necessário para as respostas do chatbot) -->
        <div id="lore-context" style="display: none;">
            **Mundo de "O Sopro do Vazio":**
            O mundo vive sob um silêncio antinatural após a queda de um meteoro. Este evento abriu uma cratera colossal, de onde emana uma praga chamada "O Vazio", manifestando-se em criaturas monstruosas e cultistas mascarados. A humanidade, em vez de pânico, adotou uma estranha apatia.

            **Facções Principais:**
            * **A Igreja de Azamel:** Publicamente, é a instituição que mantém a ordem no Reino de Auren. Secretamente, é uma organização corrupta que esconde segredos terríveis, realiza "iniciações" sinistras e está aliada às forças do Vazio. Seu símbolo é usado como uma marca de cicatriz por dissidentes. Um de seus líderes é um Capelão manipulador que se alia à Arauta do Vazio.
            * **O Vazio:** Uma força misteriosa e corruptora vinda da cratera. Seus servos incluem cultistas mascarados e uma poderosa entidade psíquica conhecida como a Arauta do Vazio, cujo objetivo é corromper heróis e trazer de volta seu "mestre".

            **Personagens Principais:**
            * **Elandra Violeth:** A protagonista. Uma feiticeira/paladina criada por um mago, mas forçada a seguir a doutrina da Igreja. Sua irmã foi raptada pela Igreja, e seu objetivo é expor e destruir a instituição.
            * **Kalissa:** Uma guerreira tiefling (bárbara) brutal, bela e que anseia por um verdadeiro desafio.
            * **Lukán:** Um paladino humano, estóico e pragmático.
            * **Korv (Sussurro Pálido):** Um monge silencioso e letal.
            * **Let:** Um bardo elfo, carismático e aparentemente covarde, mas que demonstra grande coragem quando necessário.
        </div>

        <!-- BOTÃO E MODAL DO CHAT FLUTUANTE (copiado de explorar.html) -->
        <button id="chat-fab" class="chat-fab" aria-label="Abrir chat com o Oráculo">IA</button>
    
        <div id="chat-modal-container" class="chat-modal-container">
            <div class="chat-modal-content">
                <div class="chat-modal-header">
                    <h2>Converse com o Oráculo</h2>
                    <button id="chat-close-btn" class="chat-close-btn" aria-label="Fechar chat">&times;</button>
                </div>
                <div class="chat-modal-body">
                    <div class="input-group">
                        <input type="text" id="user-question" placeholder="Pergunte qualquer coisa sobre o mundo..." />
                        <button id="btn-ask-ia" class="gemini-button">Perguntar ✨</button>
                    </div>
                    <div class="gemini-controls">
                        <div id="chat-output" class="gemini-output" style="display: none;"></div>
                        <button class="gemini-button tts-button" data-target="chat-output" style="display:none;">Ouvir 🔊</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="chat.js"></script>