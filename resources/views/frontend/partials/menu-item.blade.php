<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav alt-font">
        @foreach ($menus as $menu)
            @php
                $hasChildren = $menu->children->isNotEmpty();
            @endphp

            <li class="nav-item {{ $hasChildren ? 'dropdown dropdown-with-icon-style02' : '' }}">

                {{-- Link utama --}}
                <a href="{{ $menu->url ?? '#' }}"
                   class="nav-link "
                   @if($hasChildren)
                       data-bs-toggle="dropdown"
                   aria-expanded="false"
                    @endif
                >
                    {{ $menu->name }}
                </a>

                {{-- Dropdown --}}
                @if($hasChildren)
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
