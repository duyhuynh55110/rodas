<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @hasSection('title')
                    <h1>@yield('title')</h1>
                @endif
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @php
                        $breadcrumbs = getCurrentBreadcrumbs();
                    @endphp

                    @if(!empty($breadcrumbs))
                        @foreach($breadcrumbs['items'] as $k => $breadcrumb)
                        @php
                            $url = isset($breadcrumb['route']) ? routeAdmin($breadcrumb['route']) : false;
                        @endphp

                        @if ($k < count($breadcrumbs['items']) - 1)
                            <li class="breadcrumb-item"><a href="{{ $url }}">{{ $breadcrumb['title'] }}</a></li>
                        @else
                            <li class="breadcrumb-item active">{{ $breadcrumb['title'] }}</li>
                        @endif
                        
                        @endforeach
                    @endif

                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @if (session('status'))
                    @php
                        $statusType = 'success';
                        if (session('status_type')) {
                            $statusType = session('status_type');
                        }
                    @endphp
                <div class="callout callout-{{ $statusType }}">
                    <p class="text-{{ $statusType }}">{{ session('status') }}</p>
                </div>
            @endif
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
            @if ($errors->any())
            <div class="callout callout-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</section>
