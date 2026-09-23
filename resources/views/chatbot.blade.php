    @extends('layouts')

    @section('content')
    <style>
        body {
            background: linear-gradient(135deg, #1f4037, #99f2c8);
            min-height: 100vh;
        }

        .chat-card {
            max-width: 850px;
            margin: auto;
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
            overflow: hidden;
            animation: fadeIn 0.9s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(25px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .chat-header {
            background: linear-gradient(45deg, #0f2027, #203a43);
            color: #fff;
            padding: 16px 20px;
            font-weight: 600;
            font-size: 18px;
        }

        .chat-window {
            height: 420px;
            overflow-y: auto;
            padding: 18px;
            background: #f9fafb;
        }

        .message {
            margin-bottom: 14px;
            display: flex;
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .message.user { justify-content: flex-end; }
        .message.bot  { justify-content: flex-start; }

        .bubble {
            max-width: 75%;
            padding: 10px 14px;
            border-radius: 14px;
            font-size: 14px;
            line-height: 1.5;
            white-space: pre-wrap;
        }

        .user .bubble {
            background: #198754;
            color: #fff;
            border-bottom-right-radius: 4px;
        }

        .bot .bubble {
            background: #e5e7eb;
            color: #111;
            border-bottom-left-radius: 4px;
        }

        .chat-input {
            padding: 15px;
            background: #fff;
            border-top: 1px solid #e5e7eb;
        }

        .send-btn {
            border-radius: 50px;
            padding: 10px 22px;
        }

        .lang-select {
            border-radius: 50px;
        }
    </style>

    <div class="container py-5">
        <div class="card chat-card">
            <div class="chat-header text-center">
                🕌 Ask the Soulful Deen Bot
                <div style="font-size:13px;font-weight:400;">
                    Authentic Islamic guidance | English & Urdu
                </div>
            </div>

            <div id="chat-window" class="chat-window"></div>

            <div class="chat-input">
                <div class="d-flex gap-2 align-items-center">
                    <select id="lang" class="form-select lang-select" style="width:130px">
                        <option value="en">English</option>
                        <option value="ur">Urdu</option>
                    </select>

                    <input id="user-input" class="form-control rounded-pill"
                        placeholder="Ask your Islamic question..." autocomplete="off">

                    <button id="send-btn" class="btn btn-success send-btn">
                        Send
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        const sendBtn = document.getElementById('send-btn');
        const input = document.getElementById('user-input');
        const chatWindow = document.getElementById('chat-window');
        const langSelect = document.getElementById('lang');

        function appendMessage(role, text){
            const wrapper = document.createElement('div');
            wrapper.className = 'message ' + (role === 'user' ? 'user' : 'bot');

            const bubble = document.createElement('div');
            bubble.className = 'bubble';
            bubble.textContent = text;

            wrapper.appendChild(bubble);
            chatWindow.appendChild(wrapper);
            chatWindow.scrollTop = chatWindow.scrollHeight;
            return wrapper;
        }

        async function sendMessage(){
            const message = input.value.trim();
            if(!message) return;

            appendMessage('user', message);
            input.value = '';
            sendBtn.disabled = true;

            const typingBubble = appendMessage('bot', 'Typing...');

            try {
                const res = await fetch('/api/chat/ask', {
                    method: 'POST',
                    headers: {
                        'Content-Type':'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        message,
                        lang: langSelect.value
                    })
                });

                const data = await res.json().catch(() => ({}));
                typingBubble.remove();

                if (!res.ok) {
                    const errMsg = data.message || 'Something went wrong. Please try again.';
                    appendMessage('bot', errMsg);
                    return;
                }

                appendMessage('bot', data.reply || 'No response received');

            } catch (e) {
                typingBubble.remove();
                appendMessage('bot', 'Server error. Please try again.');
            } finally {
                sendBtn.disabled = false;
            }
        }

        sendBtn.addEventListener('click', sendMessage);

        input.addEventListener('keyup', e => {
            if(e.key === 'Enter') sendMessage();
        });
    });
    </script>
    @endpush