<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle ?: 'RetroSpace Blog' }}</title>
    <meta name="author" content="SamFisherLY">
    <meta name="description" content="{{ $metaDescription }}">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        @keyframes searchAnimation {
            0% {
                width: 2.5rem;
            }

            100% {
                width: 10rem;
            }
        }
    </style>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-50 font-family-karla">

    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl lg:text-6xl"
                href="{{ route('home') }}">
                RetroSpace Blog
            </a>
            <p class="text-gray-600">
                {!! \App\Models\TextWidget::getContent('header') !!}
            </p>
        </div>
    </header>

    <!-- Topic Nav -->
    <nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
        <div class="block sm:hidden">
            <a href="#"
                class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
                @click="open = !open">
                <i class="fa fa-bars"></i> Menu <i :class="open ? 'fa-chevron-down' : 'fa-chevron-up'"
                    class="fas ml-2"></i>
            </a>
        </div>
        <div :class="open ? 'block' : 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
            <div
                class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-between font-bold uppercase mt-0 px-6 py-2">
                <div>
                    <a href="{{ route('home') }}"
                        class="hover:bg-gray-900 hover:text-white rounded py-2 px-4 mx-2">Home</a>
                    <a href="{{ route('about-page') }}"
                        class="hover:bg-gray-900 hover:text-white rounded py-2 px-4 mx-2">About us</a>
                    <a href="{{ route('contact-page') }}"
                        class="hover:bg-gray-900 hover:text-white rounded py-2 px-4 mx-2">Contact us</a>
                    <a href="{{ route('agreement-page') }}"
                        class="hover:bg-gray-900 hover:text-white rounded py-2 px-4 mx-2">Agreement</a>
                </div>
                <div class="flex items-center">
                    <!-- Search Nav -->
                    <form method="get" action="{{ route('search') }}" value="{{ request()->get('q') }}">
                        <input type="text" id="search-navbar" name="q"
                            class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 placeholder:text-gray-400 placeholder:font-extralight outline-none transition-all duration-300"
                            placeholder="Quick search...">
                    </form>

                    <!-- Login -->
                    @auth
                        <div class="flex sm:items-center sm:ml-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="hover:bg-gray-900 hover:text-white flex items-center rounded py-2 px-4 mx-2">
                                        <div> {{ Auth::user()->name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hover:bg-gray-600 hover:text-white rounded py-2 px-4 mx-2">
                            Login</a>
                        <a href="{{ route('register') }}" class="bg-gray-600 text-white rounded py-2 px-4 mx-2">
                            Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>


    <div class="container mx-auto flex flex-wrap py-6">
        {{ $slot }}
    </div>

    <footer class="w-full border-t bg-white pb-12 pt-8">
        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6 text-sm font-bold">
                <a href="{{ route('about-page') }}" class="uppercase px-3">About Us</a>
                <a href="{{ route('contact-page') }}" class="uppercase px-3">Contact Us</a>
                <a href="{{ route('agreement-page') }}" class="uppercase px-3">Agreement</a>
            </div>
            <div class="uppercase pb-6">&copy; RetroSpace.com</div>
        </div>
    </footer>

    <!-- Back to top button -->
    <button id="to-top-button" onclick="goToTop()" title="Go To Top"
        class="hidden fixed z-50 bottom-10 right-10 p-4 border-0 w-14 h-14 rounded-full shadow-md bg-gray-600 hover:bg-gray-700 text-white text-lg font-semibold transition-colors duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path d="M12 4l8 8h-6v8h-4v-8H4l8-8z" />
        </svg>
        <span class="sr-only">Go to top</span>
    </button>

    <!-- Javascript -->
    <script type="text/javascript">
        // To top button
        // Get the 'to top' button element by ID
        var toTopButton = document.getElementById("to-top-button");

        // Check if the button exists
        if (toTopButton) {

            // On scroll event, toggle button visibility based on scroll position
            window.onscroll = function() {
                if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
                    toTopButton.classList.remove("hidden");
                } else {
                    toTopButton.classList.add("hidden");
                }
            };

            // Function to scroll to the top of the page smoothly
            window.goToTop = function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            };
        }

        // Delete Modal
        window.openModal = function(modalId) {
            document.getElementById(modalId).style.display = 'block'
            document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
        }

        window.closeModal = function(modalId) {
            document.getElementById(modalId).style.display = 'none'
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
        }

        // Close all modals when press ESC
        document.onkeydown = function(event) {
            event = event || window.event;
            if (event.keyCode === 27) {
                document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
                let modals = document.getElementsByClassName('modal');
                Array.prototype.slice.call(modals).forEach(i => {
                    i.style.display = 'none'
                })
            }
        };

        // Search
        var toggleBtn = document.getElementById('toggle');
        var collapseMenu = document.getElementById('collapseMenu');

        function handleClick() {
            if (collapseMenu.style.display === 'block') {
                collapseMenu.style.display = 'none';
            } else {
                collapseMenu.style.display = 'block';
            }
        }

        toggleBtn.addEventListener('click', handleClick);
    </script>

    @livewireScripts
</body>

</html>
