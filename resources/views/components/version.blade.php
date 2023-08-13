<div>
    <div class="flex justify-center pt-3 btn h-screen pt-10 text-xs">
        @php
            if (file_exists(base_path('GIT_COMMIT_TAG_VERSION'))) {
                $version = file_get_contents(base_path('GIT_COMMIT_TAG_VERSION'));
            } else {
                $version = "Dirty State";
            }
        @endphp
        Version Control - {{$version}}
    </div>
</div>
