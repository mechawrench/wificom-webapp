<div>
    <div class="flex justify-center pt-3 btn h-screen pt-10">
    @php
        $version = file_get_contents(base_path('GIT_COMMIT_TAG_VERSION'));
    @endphp
            Git Version: {{$version}}
    </div>
</div>
