<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('about.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <x-nav-link
                        :href="route('endpoint.index')" :active="request()->routeIs('endpoint.index')">
                        {{ __('Endpoints') }}
                    </x-nav-link>

                    @if(request()->routeIs('about.create'))
                        <x-nav-link
                            :href="route('about.create')" :active="request()->routeIs('about.create')">
                            {{ __('About') }}
                        </x-nav-link>
                    @else
                        <x-nav-link
                            :href="route('about.create')" :active="request()->routeIs('about.edit')">
                            {{ __('About') }}
                        </x-nav-link>
                    @endif

                    @if(request()->routeIs('coverphoto.index'))
                        <x-nav-link :href="route('coverphoto.index')" :active="request()->routeIs('coverphoto.index')">
                            {{ __('Cover Photo') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('coverphoto.index')" :active="request()->routeIs('coverphoto.edit')">
                            {{ __('Cover Photo') }}
                        </x-nav-link>
                    @endif

                    @if(request()->routeIs('socialmedia.index'))
                        <x-nav-link :href="route('socialmedia.index')" :active="request()->routeIs('socialmedia.index')">
                            {{ __('Social Media') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('socialmedia.index')" :active="request()->routeIs('socialmedia.edit')">
                            {{ __('Social Media') }}
                        </x-nav-link>
                    @endif

                    @if(request()->routeIs('skill.index'))
                        <x-nav-link :href="route('skill.index')" :active="request()->routeIs('skill.index') ">
                            {{ __('Skills') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('skill.index')" :active="request()->routeIs('skill.edit') ">
                            {{ __('Skills') }}
                        </x-nav-link>
                    @endif

                    @if(request()->routeIs('project.index'))
                        <x-nav-link :href="route('project.index')" :active="request()->routeIs('project.index')">
                            {{ __('Projects') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('project.index')" :active="request()->routeIs('project.edit')">
                            {{ __('Projects') }}
                        </x-nav-link>
                    @endif

                    @if(request()->routeIs('externallink.index'))
                        <x-nav-link :href="route('externallink.index')" :active="request()->routeIs('externallink.index')">
                            {{ __('External Link') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('externallink.index')" :active="request()->routeIs('externallink.edit')">
                            {{ __('External Link') }}
                        </x-nav-link>
                    @endif

                    @if(request()->routeIs('technology.index'))
                        <x-nav-link :href="route('technology.index')" :active="request()->routeIs('technology.index')">
                            {{ __('Technology') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('technology.index')" :active="request()->routeIs('edit.index')">
                            {{ __('Technology') }}
                        </x-nav-link>
                    @endif

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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


            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('endpoint.index')" :active="request()->routeIs('endpoint.index')">
                {{ __('Endpoint') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">
                {{ __('About') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('coverphoto.index')" :active="request()->routeIs('coverphoto.index')">
                {{ __('Cover Photo') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('socialmedia.index')" :active="request()->routeIs('socialmedia.index')">
                {{ __('Social Media') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('skill.index')" :active="request()->routeIs('skill.index')">
                {{ __('Skills') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('project.index')" :active="request()->routeIs('project.index')">
                {{ __('Projects') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('externallink.index')" :active="request()->routeIs('externallink.index')">
                {{ __('External Link') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('technology.index')" :active="request()->routeIs('technology.index')">
                {{ __('Technology') }}
            </x-responsive-nav-link>


        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link
                    :href="route('logout')"
                     onclick="event.preventDefault();
                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>

        </div>
    </div>
</nav>
