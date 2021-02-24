<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                {{ date('Y') }} © {{ $global_site->title ?? 'Web Portal' }}.
            </div>
            <div class="col-sm-6">
                {{--<div class="text-sm-right d-none d-sm-block">
                    <div class="float-right d-none d-sm-inline">
                        <span id="currentTime"></span>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
</footer>