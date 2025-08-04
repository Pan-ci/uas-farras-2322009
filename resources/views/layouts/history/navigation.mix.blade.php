<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
        <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="sidebarMenuLabel">HR Management</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
            </div>
            <!--
            <svg class="bi"><use xlink:href="#file-earmark"/></svg>
            <svg class="bi"><use xlink:href="#graph-up"/></svg>
            <svg class="bi"><use xlink:href="#people"/></svg>
            <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
            <svg class="bi"><use xlink:href="#puzzle"/></svg>
            <svg class="bi"><use xlink:href="#people"/></svg>
            <svg class="bi"><use xlink:href="#plus-circle"/></svg>
            <svg class="bi"><use xlink:href="#door-closed"/></svg>
            -->
            <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                @role('admin|seller')
                <ul class="nav flex-column">
                    <li class="nav-item">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link d-flex align-items-center gap-2" aria-current="page">
                        <svg class="bi"><use xlink:href="#house-fill"/></svg>  
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    </li>
                    <li class="nav-item">
                    <x-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.index')" class="nav-link d-flex align-items-center gap-2" aria-current="page">
                        <svg class="bi"><use xlink:href="#house-fill"/></svg>    
                        {{ __('Transactions') }}
                    </x-nav-link>
                    </li>
                    <li class="nav-item">
                    <x-nav-link :href="route('customers.index')" :active="request()->routeIs('customers.index')" class="nav-link d-flex align-items-center gap-2" aria-current="page">
                        <svg class="bi"><use xlink:href="#house-fill"/></svg>    
                        {{ __('Customers') }}
                    </x-nav-link>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                    <span>Database</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                    </a>
                </h6>
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" class="nav-link d-flex align-items-center gap-2" aria-current="page">
                        <svg class="bi"><use xlink:href="#house-fill"/></svg>    
                        {{ __('Products') }}
                    </x-nav-link>
                    </li>
                    <li class="nav-item">
                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')" class="nav-link d-flex align-items-center gap-2" aria-current="page">
                        <svg class="bi"><use xlink:href="#house-fill"/></svg>    
                        {{ __('Categories') }}
                    </x-nav-link>
                    </li>
                    @can('manage users')
                    <li class="nav-item">
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')" class="nav-link d-flex align-items-center gap-2" aria-current="page">
                        <svg class="bi"><use xlink:href="#house-fill"/></svg>    
                        {{ __('Users') }}
                    </x-nav-link>
                    </li>
                    @endcan
                </ul>
                @endrole
                <hr class="my-3">

                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                    <div class="nav-link d-flex align-items-center gap-2">{{ Auth::user()->name }}</div>
                    </li>
                    <li class="nav-item">
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="nav-link d-flex align-items-center gap-2" aria-current="page">
                        <svg class="bi"><use xlink:href="#house-fill"/></svg>    
                        {{ __('Profile') }}
                    </x-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="nav-link d-flex align-items-center gap-2">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
