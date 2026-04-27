<div class="collapse navbar-collapse justify-content-between" id="navbarNav">

    {{-- LEFT --}}
    <ul class="navbar-nav navbar-left justify-content-end alt-font">
        @foreach ($menusLeft as $menu)
            @php $hasChildren = $menu->children->isNotEmpty(); @endphp

            <li class="nav-item {{ $hasChildren ? 'dropdown dropdown-with-icon-style02' : '' }}">
                <a href="{{ $menu->url ?? '#' }}"
                   class="nav-link"
                   @if($hasChildren) data-bs-toggle="dropdown" @endif>
                    {{ $menu->name }}
                </a>

                @if($hasChildren)
                    <ul class="dropdown-menu">
                        @foreach($menu->children as $child)
                            <li>
                                <a href="{{ $child->url ?? '#' }}">{{ $child->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>

    {{-- RIGHT --}}
    <ul class="navbar-nav navbar-right justify-content-start alt-font">
        @foreach ($menusRight as $menu)
            @php $hasChildren = $menu->children->isNotEmpty(); @endphp

            <li class="nav-item {{ $hasChildren ? 'dropdown dropdown-with-icon-style02' : '' }}">
                <a href="{{ $menu->url ?? '#' }}"
                   class="nav-link"
                   @if($hasChildren) data-bs-toggle="dropdown" @endif>
                    {{ $menu->name }}
                </a>

                @if($hasChildren)
                    <ul class="dropdown-menu">
                        @foreach($menu->children as $child)
                            <li>
                                <a href="{{ $child->url ?? '#' }}">{{ $child->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>

</div>
