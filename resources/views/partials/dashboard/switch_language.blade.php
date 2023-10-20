<li class="nav-item dropdown">
    <a href="#" class="search-toggle nav-link" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <img src="{{asset('images/Flag/flag-' .  app()->getLocale() . '.png')}}" class="img-fluid rounded-circle"
            style="height: 30px; min-width: 30px; width: 30px;">
        <span class="bg-primary"></span>
    </a>
    <div class="p-0 sub-drop dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
        <div class="m-0 border-0 shadow-none card">
            <div class="p-0 ">
                <ul class="p-0 list-group list-group-flush">
                    <li class="iq-sub-card list-group-item"><a class="p-0" onclick="languageSwitch('pt')"><img
                                src="{{asset('images/Flag/flag-pt.png')}}" alt="img-flaf" class="img-fluid me-2"
                                style="width: 15px;height: 15px;min-width: 15px;">Português</a></li>
                    <li class="iq-sub-card list-group-item"><a class="p-0" onclick="languageSwitch('en')"><img
                                src="{{asset('images/Flag/flag-en.png')}}" alt="img-flaf" class="img-fluid me-2"
                                style="width: 15px;height: 15px;min-width: 15px;">English</a></li>
                </ul>
            </div>
        </div>
    </div>
</li>
<script>
    function languageSwitch(language) {
        const token = '{{ csrf_token() }}';
        fetch('{{ route('language.switch') }}?language=' + language, {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": token
                }
            })
            .then(response => {
                return response.json();
            })
            .then(json => {
                location.reload()
            })
            .catch(error => console.error(error));
    }
</script>
