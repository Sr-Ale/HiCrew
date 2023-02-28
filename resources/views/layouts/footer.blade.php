<div class="fixed bottom-0 start-0" style="z-index: 100; width: 100%; background-color: {{$color_primary}}">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my border-top">
        <div class="col-md-4 d-flex align-items-center">
            <span class="mb-3 mb-md-0 text-muted">&nbsp © <?php echo date("Y"); ?> Copyright {{$va_name}} <a class="text-white" href="https://diazro.es/">Operating with HiCrew!</a></span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            @if($va_facebook!='')
            <li class="ms-3"><a class="text-muted" href="{{$va_facebook}}"><i class="fab fa-facebook-f"></i></a></li>
            @endif
            @if($va_twitter!='')
            <li class="ms-3"><a class="text-muted" href="{{$va_twitter}}"><i class="fab fa-twitter"></i></a></li>
            @endif
            @if($va_tiktok!='')
            <li class="ms-3"><a class="text-muted" href="{{$va_tiktok}}"><i class="fab fa-tiktok"></i></a></li>
            @endif
            @if($va_instagram!='')
            <li class="ms-3"><a class="text-muted" href="{{$va_instagram}}"><i class="fab fa-instagram"></i></a></li>
            @endif
            @if($va_discord!='')
            <li class="ms-3"><a class="text-muted" href="{{$va_discord}}"><i class="fab fa-discord"></i></a></li>
            @endif
        </ul>
    </footer>
</div>
