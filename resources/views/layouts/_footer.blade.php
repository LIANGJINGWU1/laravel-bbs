{{-- _footer.blade  から--}}
<footer class="footer">
    <div class="container">
        <p class="float-start">
            &copy; <a href="{{ $settings['site_url']->value ?? env('APP_URL') }}" target="_blank">Liang</a>デザインとコーディング<span
                style="color: #e27575;font-size: 14px;">❤</span>
        </p>
        <p class="float-end"><a href="mailto:{{ $settings['admin_email']->value ?? '' }}">お問い合わせ</a></p>
    </div>
</footer>
{{--_footer.blade まで--}}
