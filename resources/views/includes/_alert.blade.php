
<div class="col-md-6 col-xxl-6 offset-xxl-3">
    @if (session('msg') && session('str') == 'success')
    <div class="alert alert-success border-0 d-flex align-items-center" role="alert">
        <div class="bg-success me-3 icon-item">
            <svg class="svg-inline--fa fa-check-circle fa-w-16 text-white fs-7" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                <path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
            </svg>
        </div>
        <p class="mb-0 flex-1" style="font-size: 14px">{{ session('msg') }}</p>
        <button class="btn-close" style="font-size: 10px" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('msg') && session('str') == 'danger')
    <div class="alert alert-danger border-0 d-flex align-items-center" role="alert">
            <div class="bg-danger me-3 icon-item"><svg class="svg-inline--fa fa-times-circle fa-w-16 text-white fs-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"></path>
            </svg>
        </div>
        <p class="mb-0 flex-1" style="font-size: 14px">{{ session('msg') }}</p>
        <button class="btn-close" style="font-size: 10px" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>