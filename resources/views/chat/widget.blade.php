<div x-data="chatbot()" x-cloak class="fixed top-6 right-6 z-50">
    <!-- Chat Window -->
    <div x-show="open" x-transition.opacity class="w-96 max-w-[95vw] h-[520px] bg-white rounded-2xl shadow-2xl ring-1 ring-gray-200 flex flex-col overflow-hidden">
        <div class="relative" style="background-image: linear-gradient(90deg, var(--brand-green-dark), var(--brand-green));">
            <div class="text-white px-4 py-3 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3h9m-9 3h6M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold">MOE ICT Assistant</div>
                        <div class="text-xs text-white/80">Ask for help or search the knowledge base</div>
                    </div>
                </div>
                <button @click="open=false" class="text-white/90 hover:text-white" aria-label="Close chat">✕</button>
            </div>
            <div class="absolute bottom-0 left-0 w-24 h-1" style="background-color: var(--brand-gold);"></div>
        </div>

        <div class="flex-1 p-4 space-y-3 overflow-y-auto bg-gray-50" x-ref="log">
            <template x-for="m in messages" :key="m.id">
                <div>
                    <div :class="m.role==='user' ? 'justify-end' : 'justify-start'" class="flex">
                        <div :class="m.role==='user' ? 'bg-[var(--brand-green)] text-black' : 'bg-white text-gray-800 ring-1 ring-gray-200'" class="max-w-[85%] px-3 py-2 rounded-xl">
                            <div x-text="m.content"></div>
                            <template x-if="m.articles && m.articles.length">
                                <ul class="mt-2 list-disc list-inside text-sm text-[var(--brand-green)]">
                                    <template x-for="a in m.articles" :key="a.url">
                                        <li><a :href="a.url" class="underline" target="_blank" rel="noopener" x-text="a.title"></a></li>
                                    </template>
                                </ul>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            <template x-if="loading">
                <div class="flex items-center gap-2 text-gray-500 text-sm">
                    <span class="inline-flex rounded-full w-2 h-2 bg-gray-400 animate-pulse"></span>
                    <span><i>loading response…</i></span>
                </div>
            </template>
            <template x-if="error">
                <div class="text-red-600 text-sm" x-text="error"></div>
            </template>
        </div>

        <form @submit.prevent="send" class="p-3 border-t bg-white flex gap-2 items-center">
            <input x-model="draft" class="flex-1 border-2 border-[var(--brand-green)] rounded-lg px-3 py-3 text-lg focus:outline-none focus:ring-2 focus:ring-[var(--brand-gold)] text-black placeholder-black" placeholder="Describe your issue or question…" />
            <button :disabled="sending" class="px-6 py-3 text-lg font-semibold rounded-lg shadow border-2 border-[var(--brand-gold)] bg-[var(--brand-gold)] text-[var(--brand-gray)] hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-[var(--brand-green)] transition" style="min-width:100px;" type="submit">
                <span x-show="!sending">Send</span>
                <span x-show="sending">Sending…</span>
            </button>
        </form>
    </div>

    <!-- FAB Button -->
    <button x-show="!open" @click="open=true" class="flex items-center gap-2 px-5 py-3 rounded-full shadow-2xl border-2 border-[var(--brand-gold)] bg-yellow-200 text-[var(--brand-gray)] font-semibold text-lg hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-[var(--brand-green)] transition" style="background-color: #fffbe6;">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
        </svg>
        <span>Help</span>
    </button>
</div>

<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function chatbot() {
    return {
        open: false,
        draft: '',
        sending: false,
        loading: false,
        error: '',
        messages: [
            { id: 1, role: 'assistant', content: 'Hello! I can help you find solutions or log a new ticket. What do you need assistance with?', articles: [] }
        ],
        push(role, content, articles = []) {
            const id = Date.now() + Math.random();
            this.messages.push({ id, role, content, articles });
            this.$nextTick(() => { this.$refs.log.scrollTop = this.$refs.log.scrollHeight; });
        },
        async send() {
            const text = (this.draft || '').trim();
            if (!text || this.sending) return;
            this.error = '';
            this.push('user', text);
            this.draft = '';
            this.sending = true;
            this.loading = true;
            try {
                const res = await fetch('{{ route('chat.message') }}', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: text })
                });
                if (!res.ok) {
                    const body = await res.text();
                    throw new Error('Request failed: ' + res.status + ' ' + body);
                }
                const data = await res.json();
                const reply = data.reply || 'I could not find an answer. Please create a ticket.';
                const articles = Array.isArray(data.articles) ? data.articles : [];
                this.push('assistant', reply, articles);
            } catch (e) {
                console.error(e);
                this.error = 'Sorry, something went wrong. Please try again.';
            } finally {
                this.sending = false;
                this.loading = false;
            }
        }
    }
}
</script>
