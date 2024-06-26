 <!-- sidebar menu area start -->
 @php
     $usr = Auth::guard('admin')->user();
 @endphp
 <div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="text-white">Ticketing System</h2>
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                    @if ($usr->can('dashboard.view'))
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Roles & Permissions
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.roles.create') || Route::is('admin.roles.index') || Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.roles.index')  || Route::is('admin.roles.edit') ? 'active' : '' }}"><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
                            @endif
                            @if ($usr->can('role.create'))
                                <li class="{{ Route::is('admin.roles.create')  ? 'active' : '' }}"><a href="{{ route('admin.roles.create') }}">Create Role</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif


                    @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                            Admins
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') || Route::is('admin.admins.edit') || Route::is('admin.admins.show') ? 'in' : '' }}">

                            @if ($usr->can('admin.view'))
                                <li class="{{ Route::is('admin.admins.index')  || Route::is('admin.admins.edit') ? 'active' : '' }}"><a href="{{ route('admin.admins.index') }}">All Admins</a></li>
                            @endif

                            @if ($usr->can('admin.create'))
                                <li class="{{ Route::is('admin.admins.create')  ? 'active' : '' }}"><a href="{{ route('admin.admins.create') }}">Create Admin</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('event.create') || $usr->can('event.view') ||  $usr->can('event.edit') ||  $usr->can('event.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Events
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.events.create') || Route::is('admin.events.index') || Route::is('admin.events.edit') || Route::is('admin.events.show') ? 'in' : '' }}">
                            @if ($usr->can('event.view'))
                                <li class="{{ Route::is('admin.events.index')  || Route::is('admin.events.edit') ? 'active' : '' }}"><a href="{{ route('admin.events.index') }}">All Events</a></li>
                            @endif
                            @if ($usr->can('event.create'))
                                <li class="{{ Route::is('admin.events.create')  ? 'active' : '' }}"><a href="{{ route('admin.events.create') }}">Create Event</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('ticket.create') || $usr->can('ticket.view') ||  $usr->can('ticket.edit') ||  $usr->can('ticket.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Tickets
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.tickets.create') || Route::is('admin.tickets.index') || Route::is('admin.tickets.edit') || Route::is('admin.tickets.show') ? 'in' : '' }}">
                            @if ($usr->can('ticket.view'))
                                <li class="{{ Route::is('admin.tickets.index')  || Route::is('admin.tickets.edit') ? 'active' : '' }}"><a href="{{ route('admin.tickets.index') }}">All Tickets</a></li>
                            @endif
                            @if ($usr->can('ticket.create'))
                                <li class="{{ Route::is('admin.tickets.create')  ? 'active' : '' }}"><a href="{{ route('admin.tickets.create') }}">Create Tickets</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('transaction.create') || $usr->can('transaction.view') ||  $usr->can('transaction.edit') ||  $usr->can('transaction.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Transactions
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.transactions.create') || Route::is('admin.transactions.index') || Route::is('admin.transactions.edit') || Route::is('admin.transactions.show') ? 'in' : '' }}">
                            @if ($usr->can('transaction.view'))
                                <li class="{{ Route::is('admin.transactions.index')  || Route::is('admin.transactions.edit') ? 'active' : '' }}"><a href="{{ route('admin.transactions.index') }}">All Transactions</a></li>
                            @endif
                            @if ($usr->can('transaction.create'))
                                <li class="{{ Route::is('admin.transactions.create')  ? 'active' : '' }}"><a href="{{ route('admin.transactions.create') }}">Create Transactions</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('report.view') ||  $usr->can('report.generate'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Reports
                        </span></a>
                        <ul class="collapse {{Route::is('admin.reports.index') || Route::is('admin.reports.pdf') ? 'in' : '' }}">
                            @if ($usr->can('report.view'))
                                <li class="{{ Route::is('admin.reports.index')  || Route::is('admin.reports.pdf') ? 'active' : '' }}"><a href="{{ route('admin.reports.index') }}">All Reports</a></li>
                            @endif
                            @if ($usr->can('report.generate'))
                                <li class="{{ Route::is('admin.reports.pdf')  ? 'active' : '' }}"><a href="{{ route('admin.reports.pdf') }}">Export Data</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->
