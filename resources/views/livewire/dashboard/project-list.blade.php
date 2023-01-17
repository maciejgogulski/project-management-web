<div class="py-2 sm:px-6 lg:px-8">
    <ul class="">
        @foreach($projects as $project)
            <li class="flex">
                <a class="rounded hover:bg-primary-200 text-left text-sm text-gray-900 font-light px-6 py-4 w-max"
                   href="{{ route('projects.show', [$project]) }}">  {{ $project->name }} </a>
            </li>
        @endforeach
    </ul>
</div>

