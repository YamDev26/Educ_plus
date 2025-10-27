<ul class="metismenu" id="menu">
    <li class="{{ request()->routeIs('dashboard') ? 'mm-active' : '' }}">
        <a href="{{ route('dashboard') }}">
            <div class="parent-icon">
                <i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow {{ request()->is('param/*') ? 'mm-active' : '' }}">
            <div class="parent-icon">
                <i class="lni lni-cogs"></i>
            </div>
            <div class="menu-title">Paramètres</div>
        </a>
        <ul>
            <li class="{{ request()->is('param/cutting/*') ? 'mm-active' : '' }}">
                <a href="{{ route('cutting.index') }}"><i class='bx bx-radio-circle'></i>Cutting</a>
            </li>
            <li class="{{ request()->is('param/school_year/*') ? 'mm-active' : '' }}">
                <a href="{{ route('year.index') }}"><i class='bx bx-radio-circle'></i>School Year</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow {{ request()->is('config/*') ? 'mm-active' : '' }}">
            <div class="parent-icon">
                <i class="bx bx-slider"></i>
            </div>
            <div class="menu-title">Configurations</div>
        </a>
        <ul>
            <li class="{{ request()->is('config/level/*') ? 'mm-active' : '' }}">
                <a href="{{ route('level.index') }}"><i class='bx bx-radio-circle'></i>Level</a>
            </li>
            <li class="{{ request()->is('config/slot_time/*') ? 'active' : '' }}">
                <a href="{{ route('slot.index') }}"><i class='bx bx-radio-circle'></i>Slot time</a>
            </li>
            <li class="{{ request()->is('config/school/*') ? 'mm-active' : '' }}"> 
                <a href="{{ route('school.index') }}"><i class='bx bx-radio-circle'></i>School</a>
            </li>
        </ul>
    </li>
</ul>