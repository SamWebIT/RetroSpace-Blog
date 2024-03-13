<x-app-layout :meta-title="'RetroSpace Blog - ' . $category->title" :meta-description="'Posts filtered by category ' . $category->title">
    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        <section class="w-full md:w-2/3  px-3">
            <div class="flex flex-col items-center">
                <h2 class="w-full text-lg sm:text-xl text-gray-700 uppercase pb-1 border-b-2 border-gray-700 mb-3">
                    Category / <span class="font-extrabold">{{ $category->title }}</span>
                </h2>
                @foreach ($posts as $post)
                    <x-post-item :post="$post" />
                @endforeach
            </div>
            {{ $posts->links() }}
        </section>

        <!-- Sidebar Section -->
        <x-sidebar />

    </div>
</x-app-layout>
