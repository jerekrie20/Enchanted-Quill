<div
    x-data="{ show: false, message: '' }"
    x-init="
        $watch('message', value => {
            if (value) {
                show = true;
                setTimeout(() => show = false, 3000);
            }
        });
    "
    x-effect="
        let livewireMessage = @entangle('successMessage');
        if (livewireMessage) {
            message = livewireMessage; // Extract the string value
        }
    "
    x-show="show"
    x-transition:enter="animate-slideIn"
    x-transition:leave="animate-slideOut"
    class="fixed top-5 right-5 bg-green-500 text-white text-sm font-medium py-2 px-4 rounded shadow-md"
    style="display: none;"
>
    <span x-text="message"></span>
</div>
