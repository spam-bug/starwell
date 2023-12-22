
@persist('toasts')
    <div
        class="absolute top-4 right-4 space-y-4 z-50"
        x-data="{
            toasts: [],
            add: function (toast) {
                if (this.toasts.length > 2) {
                    this.remove(this.toasts[0].id);
                }

                toast.id = this.toasts.length + 1;

                toast.timer = setTimeout(() => {
                    this.remove(toast.id);
                }, 5000);

                this.toasts.push(toast);
            },
            remove: function (id) {
                this.toasts = this.toasts.filter((toast) => toast.id !== id);
            }
        }"
        x-on:toast.window="add($event.detail)"
    >
        <template x-for="toast in toasts">
            <div class="flex items-center gap-4 justify-between bg-green-100 border border-green-300 rounded p-4 text-green-800 overflow-hidden">
                <p x-text="toast.message"></p>

                <button class="flex items-center" x-on:click="remove(toast.id)">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </template>
    </div>
@endpersist
