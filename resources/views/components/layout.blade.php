<!doctype html>

<title>RentNow</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    html {
        scroll-behavior: smooth;
    }
</style>

@auth
  @cannot('verified')
    <x-top-alert />
  @endcannot
@endauth

<body {{$attributes}} style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                @auth
                    {{-- <x-dropdown>
                        <x-slot name="trigger"> --}}
                            {{-- <button class="text-xs font-bold uppercase">Welcome, {{ auth()->user()->forename }}!</button>   --}}
                        {{-- </x-slot> --}}
                        <div class="fgap-4">
                            <div class="sm:flex sm:gap-4">
                              @can('admin')
                                <a
                                  class="mr-6 rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600 transition hover:text-teal-600/75 sm:block"
                                  href="/admin/applications/landlords"
                                >
                                  Admin Panel
                                </a>
                              @endcan
                              @can('landlord')
                                <a
                                  class="mr-6 rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600 transition hover:text-teal-600/75 sm:block"
                                  href="/dashboard/properties"
                                >
                                  Your Properties
                                </a>
                              @else
                                @can('verified')
                                  @cannot('admin')
                                  <a
                                    class="mr-6 rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600 transition hover:text-teal-600/75 sm:block"
                                    href="/apply"
                                  >
                                    Apply
                                  </a>
                                @endcan
                                @endcannot
                              @endcan

                              
                              <a
                                href="#"
                                x-data="{}"
                                @click.prevent="document.querySelector('#logout-form').submit()"
                                class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-medium text-white"
                              >
                              Logout
                              </a>

                              <form id="logout-form" method="POST" action="/logout" class="hidden">
                                @csrf
                              </form>

                            </div>
                        </div>
                        {{-- @can('admin')
                            <x-dropdown-item href="/admin/posts" :active="request()->is('admin/posts')">Dashboard</x-dropdown-item>
                            <x-dropdown-item href="/admin/posts/create" :active="request()->is('admin/posts/create')">New Post</x-dropdown-item>
                        @endcan                                                          --}}

                        {{-- <x-dropdown-item href="#" x-data="{}" @click.prevent="document.querySelector('#logout-form').submit()">Log Out</x-dropdown-item> --}}

                        {{-- <form id="logout-form" method="POST" action="/logout" class="hidden">
                            @csrf
                        </form>
                    </x-dropdown> --}}
                @else
                    <a
                      class="mr-6 rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600 transition hover:text-teal-600/75 sm:block"
                      href="/register"
                    >
                      Register
                    </a>
                    <a
                      href="/login"
                      class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-medium text-white"
                    >
                    Login
                    </a>
                @endauth
            </div>

        </nav>

        {{ $slot }}
    </section>

    @if(!request()->is('apply') && !request()->is('admin*') && !request()->is('dashboard*'))
      <footer aria-label="Site Footer" class="bg-white">
          <div class="max-w-screen-xl px-4 pt-16 pb-8 mx-auto sm:px-6 lg:px-8 lg:pt-24">

            @auth
              @if (is_null(auth()->user()->apps))
              <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-5xl">
                  List Your Property
                </h2>
          
                <p class="max-w-sm mx-auto mt-4 text-gray-500">
                  Got a property you want to rent? But don't want to pay estate agent fees? List your property here and get directly talking with your future tenant!
                </p>
                
                @can('landlord')
                  <a
                    href="/dashboard/properties"
                    class="inline-block px-12 py-3 mt-8 text-sm font-medium text-indigo-600 border border-indigo-600 rounded-full hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:bg-indigo-500"
                  >
                    Get Started
                  </a>
                @else
                  <a
                    href="/apply"
                    class="inline-block px-12 py-3 mt-8 text-sm font-medium text-indigo-600 border border-indigo-600 rounded-full hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:bg-indigo-500"
                  >
                    Get Started
                  </a>
                @endcan

              </div>
              @endif
            @endauth
            
            <div
              class="pt-8 mt-16 border-t border-gray-100 sm:flex sm:items-center sm:justify-between lg:mt-24"
            >
              <nav aria-label="Footer Navigation - Support">
                <ul class="flex flex-wrap justify-center gap-4 text-xs lg:justify-end">
                  <li>
                    <a href="#" class="text-gray-500 transition hover:opacity-75">
                      Terms & Conditions
                    </a>
                  </li>
        
                  <li>
                    <a href="#" class="text-gray-500 transition hover:opacity-75">
                      Privacy Policy
                    </a>
                  </li>
        
                  <li>
                    <a href="#" class="text-gray-500 transition hover:opacity-75">
                      Cookies
                    </a>
                  </li>
                </ul>
              </nav>
        
              <ul class="flex justify-center gap-6 mt-8 sm:mt-0 lg:justify-end">
                <li>
                  <a
                    href="https://github.com/lAdam7"
                    rel="noreferrer"
                    target="_blank"
                    class="text-gray-700 transition hover:opacity-75"
                  >
                    <span class="sr-only">GitHub</span>
        
                    <svg
                      class="w-6 h-6"
                      fill="currentColor"
                      viewBox="0 0 24 24"
                      aria-hidden="true"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </a>
                </li>
        
                
              </ul>
            </div>
          </div>
        </footer>
      @endif
      
      <x-flash />
</body>
