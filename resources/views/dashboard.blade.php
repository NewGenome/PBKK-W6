<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        {{ __('My Agentic AI Projects') }}
                    </h3>

                    @if ($projects->isEmpty())
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ __('You have no projects yet.') }}
                        </p>
                    @else
                        <div class="space-y-4">
                            @foreach ($projects as $project)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                    <div class="flex items-start justify-between gap-4">
                                        <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $project->judul }}
                                        </h4>
                                        <span class="shrink-0 text-xs font-medium px-2 py-1 rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                            {{ $project->tema_agent }}
                                        </span>
                                    </div>

                                    @if ($project->deskripsi)
                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $project->deskripsi }}
                                        </p>
                                    @endif

                                    <p class="mt-3 text-xs text-gray-400 dark:text-gray-500">
                                        {{ __('Created') }}: {{ $project->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>