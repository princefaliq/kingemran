<div class="collapse navbar-collapse justify-content-center" id="navbarNav">
    <ul class="navbar-nav alt-font text-uppercase">

        @foreach ($menusLeft->merge($menusRight) as $menu)
            @php $hasChildren = $menu->children->isNotEmpty(); @endphp

            <li class="nav-item {{ $hasChildren ? 'dropdown dropdown-with-icon' : '' }}">

                {{-- LINK --}}
                <a href="{{ $menu->url ?? '#' }}" class="nav-link">
                    {{ $menu->name }}
                </a>

                {{-- ICON DROPDOWN (WAJIB BIAR SAMA) --}}
                @if($hasChildren)
                    <i class="fa-solid fa-angle-down dropdown-toggle"
                       data-bs-toggle="dropdown"
                       role="button"
                       aria-expanded="false"></i>

                    <ul class="dropdown-menu">
                        @foreach($menu->children as $child)
                            <li>
                                <a href="{{ $child->url ?? '#' }}">
                                    {{ $child->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </li>
        @endforeach

    </ul>
</div>
