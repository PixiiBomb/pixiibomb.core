<div class="container my-5">
    <div class="row conversation-container">

        <div class="col-12" id="loading">
            <div class="d-flex flex-wrap gap-4 align-items-center">
                <div class="loader-orbit" aria-label="Loading">
                    <span></span>
                </div>
            </div>
        </div>

        <div class="col-12" id="conversation"></div>

        <div class="col-12">
            <form id="chat-form">
                @csrf
                <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-file-earmark-text"></i>
                        </span>
                    <input type="text"
                           class="form-control"
                           placeholder="Ask anything..."
                           id="message"
                           name="message" required>
                    <span class="input-group-text">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </span>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    const form = document.getElementById('chat-form');
    const uin = document.getElementById('message');
    const conversation = document.getElementById('conversation');
    const csrfToken = document.querySelector('input[name="_token"]').value;
    const token = @json(auth()->user()->createToken('chatbot')->plainTextToken);
    const loading = document.getElementById('loading');

    let conversationId = null;

    showLoading(false);

    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        showLoading(true);

        const payload = {
            message: uin.value,
            timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
            conversation_id: conversationId,
        };

        userMessage(payload.message, false);
        let div = createResponseDiv();

        try {
            const response = await fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`,
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify(payload),
            });

            if (!response.ok) {
                const errorText = await response.text();
                errorMessage(errorText || 'Request failed.');
                console.error(errorText);
                showLoading(false);
                return;
            }

            let markdown = '';

            const reader = response.body.getReader();
            const decoder = new TextDecoder();

            while (true) {
                const { value, done } = await reader.read();

                if (done) {
                    break;
                }

                markdown += decoder.decode(value, { stream: true });
                botMessage(markdown, div);
            }

            showLoading(false);
        } catch (error) {
            errorMessage('Something went wrong. Check the console.');
            console.error(error);
            showLoading(false);
        }
    });

    function showLoading(isLoading) {
        if (isLoading) {
            loading.classList.add('show');
        } else {
            loading.classList.remove('show');
        }
    }

    function userMessage(message) {
        const container = document.createElement('div');
        container.className = 'user-container';

        const div = document.createElement('div');
        div.className = 'uin';
        div.textContent = message;

        container.append(div);
        conversation.append(container);
    }

    function botMessage(message, div) {
        div.innerHTML = DOMPurify.sanitize(marked.parse(message));
    }

    function errorMessage(message) {
        const div = document.createElement('div');
        div.className = 'alert alert-danger';
        div.innerHTML = message;
        conversation.append(div);
    }

    function createResponseDiv() {
        const container = document.createElement('div');
        container.className = 'chatbot-container';
        conversation.append(container);
        return container;
    }

</script>

<script src="https://cdn.jsdelivr.net/npm/dompurify/dist/purify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
