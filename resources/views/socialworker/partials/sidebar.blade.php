<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li >
            <a {{{ (Request::is('socialworker/dashboard') ? 'class=active' : '') }}} href="{{url('/socialworker/dashboard')}}"><i class="icon-home mr-10"></i>Dashboard</a>
        </li>
        <li>
            <a {{{ (Request::is('socialworker/register') ? 'class=active' : '') }}} href="{{url('/socialworker/register')}}"><i class="icon-note mr-10"></i>Register a Senior Citizen</a>
        </li>
        <li>
            <a {{{ (Request::is('socialworker/MedicineHistory') ? 'class=active' : '') }}} href="{{url('/socialworker/MedicineHistory')}}"><i class="icon-list mr-10"></i>Medicine History</a>
        </li>
        <li>
            <a {{{ (Request::is('socialworker/InactiveList') ? 'class=active' : '') }}} href="{{url('/socialworker/InactiveList')}}"><i class="icon-user mr-10"></i>Inactive Seniors List</a>
        </li>
    </ul>
</div>