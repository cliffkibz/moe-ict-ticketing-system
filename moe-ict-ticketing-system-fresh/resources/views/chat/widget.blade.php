<div x-data="chatbot()" class="fixed bottom-6 right-6 z-50">
    <div x-show="open" class="w-80 h-96 bg-white rounded-xl shadow-lg ring-1 ring-gray-200 flex flex-col overflow-hidden">
        <div class="bg-blue-600 text-white p-3 flex items-center justify-between">
            <div class="font-semibold">MOE ICT Assistant</div>
            <button @click="open=false">✕</button>
        </div>
        <div class="flex-1 p-3 space-y-2 overflow-y-auto" x-ref="log">
            <template x-for="m in messages" :key="m.id">
                <div :class="m.role==='user' ? 'text-right' : 'text-left'">
                    <div :class="m.role==='user' ? 'inline-block bg-blue-600 text-white' : 'inline-block bg-gray-100'" class="px-3 py-2 rounded">
                        <span x-text="m.content"></span>
                    </div>
                </div>
            </template>
        </div>
        <form @submit.prevent="send" class="p-3 border-t flex gap-2">
            <input x-model="draft" class="flex-1 border rounded px-3 py-2" placeholder="Ask a question..." />
            <button class="bg-blue-600 text-white px-3 py-2 rounded">Send</button>
        </form>
    </div>
    <button x-show="!open" @click="open=true" class="bg-blue-600 text-white px-4 py-3 rounded-full shadow-lg">
        Chat
    </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function chatbot() {
    return {
        open: false,
        messages: [],
        draft: '',
        send() {
            const text = this.draft.trim();
            if (!text) return;
            this.messages.push({ id: Date.now(), role: 'user', content: text });
            this.draft = '';
            fetch('{{ url('/chat/message') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: text })
            })
            .then(r => r.json())
            .then(data => {
                const bullets = (data.articles || []).map(a => `\n• ${a.title}`).join('');
                this.messages.push({ id: Date.now()+1, role: 'assistant', content: data.reply + bullets });
                this.$nextTick(() => {
                    this.$refs.log.scrollTop = this.$refs.log.scrollHeight;
                });
            })
            .catch(() => {
                this.messages.push({ id: Date.now()+1, role: 'assistant', content: 'Sorry, something went wrong.' });
            })
        }
    }
}
</script>
