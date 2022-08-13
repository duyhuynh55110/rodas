<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link">
        <img src="{{ assetAdmin('img/AdminLTELogo.png') }}" width="33" height="33" alt="Admin Console" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Console</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                @foreach($groups as $group)
                    {{-- Group label --}}
                    <li class="nav-item menu-open  mb-2">
                        <a href="javascript:void(0);" class="nav-link">
                            <i class="nav-icon {{ $group['icon'] }}"></i>
                            <p> {{ $group['group_label'] }} </p>
                        </a>
                    </li>

                    @foreach ($group['items'] as $side)
                        {{-- Check router active --}}
                        @php
                            $sideActive = checkActiveSidebarItem($side);
                            $url = isset($side['route']) ? routeAdmin($side['route']) : 'javascript:void(0);';
                            $itemsFlg = (isset($side['items']) && !empty($side['items']));
                        @endphp

                        <li class="nav-item {{ $sideActive['status'] ? 'menu-open' : '' }}">
                            <a href="{{ $url }}" class="nav-link {{ $sideActive['status'] ? 'active' : '' }}">
                                <i class="nav-icon {{ $side['icon'] ?? null }}"></i>
                                <p>
                                    {{ $side['label'] }}
                                    @if ($itemsFlg)
                                    <i class="right fas fa-angle-left"></i>
                                    @endif
                                </p>
                            </a>

                            {{-- SideBar Items --}}
                            @if ($itemsFlg)
                                <ul class="nav nav-treeview">
                                    @foreach($side['items'] as $key => $item)
                                        @php
                                            $url = isset($item['route']) ? routeAdmin($item['route']) : 'javascript:void(0);';
                                        @endphp
                                        <li class="nav-item">
                                            <a href="{{ $url }}" class="nav-link  pl-4 {{ $sideActive['itemKey'] === $key ? 'active' : '' }}">
                                                @if(isset($item['icon']))
                                                    <i class="far {{ $item['icon'] }}"></i>
                                                @endif
                                                <p>{{ $item['label'] }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
