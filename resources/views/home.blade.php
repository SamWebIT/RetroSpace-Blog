<x-app-layout meta-title="RetroSpace Blog" meta-description="Free read & write space for everyone">

    <div class="container max-w-5xl mx-auto py-6">
        <div class="mt-8 mb-16 md:text-sm">
            <blockquote cite="https://bigthink.com/starts-with-a-bang/einstein-famous-quote-misunderstood/"
                class="text-lg italic text-center">
                <p class="pb-4 text-gray-500 hover:text-gray-800 transition-all duration-300">"Imagination is more
                    important than knowledge.
                    Knowledge is limited. Imagination encircles the world."</p>
                <footer class="text-sm font-extrabold">—Albert Einstein, <cite>Big Think</cite></footer>
            </blockquote>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 bg-white shadow p-4">
            <!-- Latest Post -->
            <div class="col-span-2">
                <h2
                    class="text-lg sm:text-xl font-extrabold text-gray-700 uppercase pb-1 border-b-2 border-gray-700 mb-3">
                    Latest Post
                </h2>

                @if ($latestPost)
                    <x-post-item :post="$latestPost" />
                @endif
            </div>

            <!-- Popular 3 post -->
            <div>
                <h2
                    class="text-lg sm:text-xl font-extrabold text-gray-700 uppercase pb-1 border-b-2 border-gray-700 mb-3">
                    Popular Posts
                </h2>
                @foreach ($popularPosts as $post)
                    <div class="grid grid-cols-4 gap-2 mb-4">
                        <a href="{{ route('view', $post) }}" class="pt-1">
                            <img src="{{ $post->getThumbnail() }}" alt="{{ $post->title }}" />
                        </a>
                        <div class="col-span-3">
                            <a href="{{ route('view', $post) }}">
                                <h3 class="uppercase whitespace-nowrap font-bold truncate pb-1">{{ $post->title }}</h3>
                            </a>
                            <div class="flex gap-2 mb-2">
                                @foreach ($post->categories as $category)
                                    <a href="{{ route('by-category', $category) }}"
                                        class="bg-blue-700 hover:bg-blue-500 text-white p-1 rounded text-xs font-bold uppercase">
                                        {{ $category->title }}
                                    </a>
                                @endforeach
                            </div>
                            <div class="text-xs">
                                {{ $post->shortBody(10) }}
                            </div>
                            <a href="{{ route('view', $post) }}"
                                class="uppercase text-gray-800 hover:text-gray-500 font-bold text-xs">Continue
                                Reading <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Search section -->
        <div class="w-full bg-white shadow flex flex-col my-4 p-6 mb-8">
            <div class="mb-6">
                <h2 class="text-lg sm:text-xl text-center font-extrabold text-gray-700 uppercase pb-1 border-b-2 border-gray-700 mb-3"
                    id="search">
                    Search contents
                </h2>
                <p>
                    <span class="mr-2">Search by Category:</span>
                    @foreach ($categories as $category)
                        <a href="{{ route('by-category', $category) }}"
                            class="hover:bg-blue-700  text-blue-700 hover:text-white rounded py-2 px-4 font-bold">{{ $category->title }}</a>
                    @endforeach
                </p>
            </div>
            <form method="get" action="{{ route('search') }}" value="{{ request()->get('q') }}">
                <input name="q"
                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 font-medium outline-none transition-all duration-300"
                    style="min-width: 2.5rem;"
                    onfocus="this.style.minWidth = '10rem'; this.parentNode.classList.add('focus-within:shadow-outline'); this.parentNode.classList.add('focus-within:border-blue-500');"
                    onblur="if(this.value=='') { this.style.minWidth = '2.5rem'; this.parentNode.classList.remove('focus-within:shadow-outline'); this.parentNode.classList.remove('focus-within:border-blue-500');}"
                    placeholder="Type an hit enter to search anything" />
            </form>
        </div>

        <!-- Recommended posts -->
        <div class="mb-8">
            <h2 class="text-lg sm:text-xl font-extrabold text-gray-700 uppercase pb-1 border-b-2 border-gray-700 mb-3">
                Recommended Posts
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                @foreach ($recommendedPosts as $post)
                    <x-post-item :post="$post" :show-author="false" />
                @endforeach
            </div>
        </div>

        <!-- Latest Categories -->
        @foreach ($categories as $category)
            <div>
                <h2
                    class="text-lg sm:text-xl font-extrabold text-gray-700 uppercase pb-1 border-b-2 border-gray-700 mb-3">
                    Category /
                    <a href="{{ route('by-category', $category) }}" class="text-blue-700 hover:text-blue-500">
                        {{ $category->title }} <i class="fas fa-arrow-right"></i>
                    </a>
                </h2>

                <div class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        @foreach ($category->publishedPosts()->limit(3)->get() as $post)
                            <x-post-item :post="$post" :show-author="false" />
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</x-app-layout>
