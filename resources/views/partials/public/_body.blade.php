<div id="loading">
    @include('partials.dashboard._body_loader')
</div>
<main class="main-content">
    @include('partials.public._body_header')
    
    <div class="conatixner-fluid content-inner">
    {{ $slot }}
    </div>
    
    @include('partials.public._body_footer')
</main>
@include('partials.dashboard._scripts')
