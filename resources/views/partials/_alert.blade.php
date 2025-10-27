
<div class="alert">
    <!-- Alert Success -->
    @if (session('msg') && session('str') == 'success')
    <div class="alert bg-success border-0 alert-dismissible fade show py-1">
        <div class="d-flex align-items-center">
            <div class="font-35 text-white"><i class="bx bxs-check-circle"></i>
            </div>
            <div class="ms-3">
                <div class="text-white">{{ session('msg') }}</div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Alert Danger -->
    @if (session('msg') && session('str') == 'danger')
    <div class="alert  bg-danger border-0 alert-dismissible fade show py-1">
        <div class="d-flex align-items-center">
            <div class="font-35 text-white"><i class="bx bxs-message-square-x"></i>
            </div>
            <div class="ms-3">
                <div class="text-white">{{ session('msg') }}</div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Alert Info -->
    @if (session('msg') && session('str') == 'info')
    <div class="alert bg-info border-0 alert-dismissible fade show py-1">
        <div class="d-flex align-items-center">
            <div class="font-35 text-white"><i class="bx bx-info-square"></i>
            </div>
            <div class="ms-3">
                <div class="text-white">{{ session('msg') }}</div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <!-- Alert Warning -->
    @if (session('msg') && session('str') == 'warning')
    <div class="alert bg-warning border-0 alert-dismissible fade show py-1">
        <div class="d-flex align-items-center">
            <div class="font-35 text-white"><i class="bx bx-info-circle"></i>
            </div>
            <div class="ms-3">
                <div class="text-white">{{ session('msg') }}</div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>