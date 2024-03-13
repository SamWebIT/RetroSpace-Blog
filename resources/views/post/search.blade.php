<x-app-layout>
    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        <section class="w-full px-3">
            <div class="flex flex-col">
                <h2 class="text-xl font-semiblod w-full border-b-2 pb-4 mb-4">
                    Search result "<span class="font-bold">{{ request()->get('q') }}</span>"
                </h2>
                @if ($hasResults)
                    <p class="mb-4">Total search results: <span class="font-bold">{{ $totalCount }}</span></p>
                    @foreach ($posts as $post)
                        <div>
                            <a href="{{ route('view', $post) }}">
                                <h3 class="text-blue-700 hover:text-blue-500 font-bold text-lg sm:text-xl mb-2 visited:text-purple-700">
                                    {!! str_replace(
                                        request()->get('q'),
                                        '<span class="bg-yellow-300">' . request()->get('q') . '</span>',
                                        $post->title,
                                    ) !!}
                                </h3>
                            </a>
                            <div>
                                {!! str_replace(
                                    request()->get('q'),
                                    '<span class="bg-yellow-300">' . request()->get('q') . '</span>',
                                    $post->shortBody(),
                                ) !!}
                            </div>
                        </div>
                        <hr class="my-4">
                    @endforeach
                @else
                    <!-- if search not found -->
                    <p>No result found, go back to
                        <a href="{{ route('home') }}" class="font-bold text-blue-700 hover:text-blue-500">
                             Home page
                        </a>
                    </p>
                    <hr class="my-4">
                @endif
            </div>

            {{ $posts->links() }}
        </section>
    </div>
</x-app-layout>
