@foreach (['danger', 'warning', 'success', 'info'] as $message)
    @if(session()->has($message))
        <div class="flash-message">
            <p class="alert alert-{{ $message }}" id="message">
                {{ session()->get($message) }}
            </p>
        </div>
        <script>
            setTimeout(() => {
                const el = document.getElementById('message');
                /**
                 * @type {HTMLElement|null}
                 */
                if(el) el.style.display = 'none'
            }, 3000);
        </script>
    @endif
@endforeach
