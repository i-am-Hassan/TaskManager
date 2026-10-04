<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'TaskFlow')
    </title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}">

</head>


<body>


    <div class="app-wrapper">


        <!-- =====================================================
         SIDEBAR
    ====================================================== -->

        <aside class="sidebar">


            <!-- Brand -->
            <div class="brand">

                <div class="brand-icon">

                    <i class="fa-solid fa-check-double"></i>

                </div>


                <div>

                    <h4>
                        TaskFlow
                    </h4>

                    <span>
                        Task Manager
                    </span>

                </div>

            </div>


            <!-- Main Navigation -->
            <nav class="sidebar-nav">


                <!-- Overview -->
                <a href="{{ route('tasks.index') }}"
                    class="nav-link {{ request()->routeIs('tasks.index') ? 'active' : '' }}">

                    <i class="fa-solid fa-table-cells-large"></i>

                    <span>
                        Overview
                    </span>

                </a>


                <!-- My Tasks -->
                <a href="{{ route('tasks.index') }}"
                    class="nav-link {{ request()->routeIs('tasks.show', 'tasks.edit') ? 'active' : '' }}">

                    <i class="fa-solid fa-list-check"></i>

                    <span>
                        My Tasks
                    </span>

                </a>


                <!-- New Task -->
                <a href="{{ route('tasks.create') }}"
                    class="nav-link {{ request()->routeIs('tasks.create') ? 'active' : '' }}">

                    <i class="fa-solid fa-plus"></i>

                    <span>
                        New Task
                    </span>

                </a>


                <!-- Notifications -->
                <a href="{{ route('notifications.index') }}"
                    class="nav-link notification-nav-link {{ request()->routeIs('notifications.*') ? 'active' : '' }}">

                    <i class="fa-regular fa-bell"></i>

                    <span>
                        Notifications
                    </span>


                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <span class="notification-count">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    @endif

                </a>

            </nav>


            <!-- =================================================
             USER AREA
        ================================================== -->

            <div class="sidebar-bottom">


                <!-- User Information -->
                <div class="sidebar-user">

                    <div class="user-avatar">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>


                    <div class="sidebar-user-info">

                        <strong>
                            {{ auth()->user()->name }}
                        </strong>

                        <span>
                            {{ auth()->user()->email }}
                        </span>

                    </div>

                </div>


                <!-- Profile -->
                <a href="{{ route('profile') }}"
                    class="profile-sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}">

                    <i class="fa-regular fa-user"></i>

                    <span>
                        Profile
                    </span>

                </a>


                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button type="submit" class="logout-sidebar-btn">

                        <i class="fa-solid fa-arrow-right-from-bracket"></i>

                        <span>
                            Logout
                        </span>

                    </button>

                </form>

            </div>

        </aside>


        <!-- =====================================================
         MAIN CONTENT
    ====================================================== -->

        <main class="main-content">

            @yield('content')


            <footer class="footer">

                TaskFlow • Built with Laravel

            </footer>

        </main>

    </div>


    @yield('scripts')


</body>

</html>
