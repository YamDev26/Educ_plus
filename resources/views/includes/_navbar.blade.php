<ul class="metismenu" id="menu">
    <li class="{{ request()->routeIs('dashboard') ? 'mm-active' : '' }}">
        <a href="{{ route('dashboard') }}">
            <div class="parent-icon">
                <i class="bx bx-category" style="font-size: 17px"></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>
    <li class="{{ request()->is('evaluated/*') ? 'mm-active' : '' }}">
        <a href="{{ route('evaluated.index') }}">
            <div class="parent-icon">
                <i class="fadeIn animated lni lni-blackboard" style="font-size: 16px"></i>
            </div>
            <div class="menu-title" style="font-size: 16px">Evaluations</div> 
        </a>
    </li>
    <li class="{{ request()->is('conduite/*') ? 'mm-active' : '' }}">
        <a href="{{ route('conduite.index') }}">
            <div class="parent-icon">
                <i class="lni lni-bolt-alt" style="font-size: 19px"></i>
            </div>
            <div class="menu-title" style="font-size: 16px">Conduites</div> 
        </a>
    </li>
    <li class="{{ request()->is('moyenne/*') ? 'mm-active' : '' }}">
        <a href="{{ route('moyenne.index') }}">
            <div class="parent-icon">
                <i class="fadeIn animated bx bx-minus-back" style="font-size: 20px"></i>
            </div>
            <div class="menu-title" style="font-size: 16px">Moyennes</div> 
        </a>
    </li>
    <li class="{{ request()->is('resultat/*') ? 'mm-active' : '' }}">
        <a href="{{ route('resultat.index') }}">
            <div class="parent-icon">
                <i class="lni lni-certificate" style="font-size: 19px"></i>
            </div>
            <div class="menu-title" style="font-size: 16px">Resultats</div> 
        </a>
    </li>
    <li class="{{ request()->is('inscription/*') ? 'mm-active' : '' }}">
        <a href="{{ route('inscription.index') }}">
            <div class="parent-icon">
                <i class="fadeIn animated bx bx-layer-plus" style="font-size: 21px"></i>
            </div>
            <div class="menu-title" style="font-size: 16px">Inscriptions</div> 
        </a>
    </li>
    <li class="{{ request()->is('classe/*') ? 'mm-active' : '' }}">
        <a href="{{ route('classe.index') }}">
            <div class="parent-icon">
                <i class="fadeIn animated lni lni-apartment" style="font-size: 14px"></i>
            </div>
            <div class="menu-title" style="font-size: 16px">Classes</div> 
        </a>
    </li>
    <li class="{{ request()->is('student/*') ? 'mm-active' : '' }}">
        <a href="{{ route('student.index') }}">
            <div class="parent-icon">
                <i class="lni lni-graduation" style="font-size: 18px"></i>
            </div>
            <div class="menu-title" style="font-size: 16px">Students</div> 
        </a>
    </li>
    <li class="#">
        <a href="#">
            <div class="parent-icon">
                <i class="lni lni-users" style="font-size: 18px"></i>
            </div>
            <div class="menu-title" style="font-size: 16px">Users</div> 
        </a>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow {{ request()->is('param/*') ? 'mm-active' : '' }}" title="Paramètre">
            <div class="parent-icon">
                <i class="fadeIn animated lni lni-cog" style="font-size: 16px"></i>
            </div>
            <div class="menu-title" style="font-size: 16px">Parametres</div>
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
        <a href="javascript:;" class="has-arrow {{ request()->is('config/*') ? 'mm-active' : '' }}" title="Configuration">
            <div class="parent-icon">
                <i class="fadeIn animated bx bx-hive" style="font-size: 19px"></i>
            </div>
            <div class="menu-title" style="font-size: 16px">Configurations</div>
        </a>
        <ul>
            <li class="{{ request()->is('config/level/*') ? 'mm-active' : '' }}">
                <a href="{{ route('level.index') }}"><i class='bx bx-radio-circle'></i>Discipline</a>
            </li>
            <li class="{{ request()->is('config/slot_time/*') ? 'mm-active' : '' }}">
                <a href="{{ route('slot.index') }}"><i class='bx bx-radio-circle'></i>Slot time</a>
            </li>
            <li class="{{ request()->is('config/school/*') ? 'mm-active' : '' }}"> 
                <a href="{{ route('school.index') }}"><i class='bx bx-radio-circle'></i>School</a>
            </li>
        </ul>
    </li>
</ul>