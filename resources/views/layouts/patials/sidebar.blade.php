 <aside class="main-sidebar sidebar-dark-primary bg-sidebar elevation-4">
     <a href="index3.html" class="brand-link bg-color-secondary">
         <img src="{{ asset('heart.svg') }}" alt="myCare Logo" class="brand-image" style="opacity: .8">
        <strong> <span class="brand-text font-weight-light text-bold">{{ config('app.name') }}</span></strong>
     </a>
     <div class="sidebar mt-4">
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <x-navs.side-nav-link class="nav-link text-white" href="{{ route('app.dashboard-main') }}" :active="request()->routeIs('app.dashboard-main')">
                    📈
                    <p>Dashboard</p>
                </x-nav-link>
                <x-navs.side-nav-link class="nav-link" href="{{ route('patient.list') }}" :active="request()->routeIs('patient.list')">
                    <i class="fas fa-users"></i>
                    <p>LIste de patient</p>
                </x-nav-link>
             </ul>
         </nav>

     </div>

 </aside>
