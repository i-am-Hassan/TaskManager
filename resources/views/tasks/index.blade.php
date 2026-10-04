@extends('layouts.app')

@section('title', 'My Tasks | TaskFlow')

@section('content')

    <header class="topbar">

        <div>
            <p class="welcome-text">
                Welcome back 👋
            </p>

            <h1>
                My Tasks
            </h1>
        </div>


        <div class="topbar-actions">

            <!-- Profile Button -->
            <a href="{{ route('profile') }}" class="profile-top-btn">
                <i class="fa-regular fa-user"></i>
                Profile
            </a>


            <!-- Add Task Button -->
            <a href="{{ route('tasks.create') }}" class="add-task-btn">
                <i class="fa-solid fa-plus"></i>
                Add Task
            </a>

        </div>

    </header>


    @if (session('success'))
        <div class="success-message">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>
    @endif


    @php

        $totalTasks = $tasks->count();

        $pendingTasks = $tasks->where('status', 'pending')->count();

        $completedTasks = $tasks->where('status', 'completed')->count();

    @endphp


    <!-- =====================================================
         STATISTICS
    ====================================================== -->

    <section class="stats-grid">


        <!-- Total Tasks -->
        <div class="stat-card">

            <div class="stat-card-top">

                <div class="stat-icon">

                    <i class="fa-solid fa-list"></i>

                </div>

                <span class="stat-label">
                    All Tasks
                </span>

            </div>


            <div class="stat-number">
                {{ $totalTasks }}
            </div>


            <p>
                Your total tasks
            </p>

        </div>


        <!-- Pending Tasks -->
        <div class="stat-card">

            <div class="stat-card-top">

                <div class="stat-icon pending-icon">

                    <i class="fa-solid fa-clock"></i>

                </div>

                <span class="stat-label">
                    Pending
                </span>

            </div>


            <div class="stat-number">
                {{ $pendingTasks }}
            </div>


            <p>
                Tasks waiting to finish
            </p>

        </div>


        <!-- Completed Tasks -->
        <div class="stat-card">

            <div class="stat-card-top">

                <div class="stat-icon completed-icon">

                    <i class="fa-solid fa-check"></i>

                </div>

                <span class="stat-label">
                    Completed
                </span>

            </div>


            <div class="stat-number">
                {{ $completedTasks }}
            </div>


            <p>
                Tasks you completed
            </p>

        </div>

    </section>


    <!-- =====================================================
         TASK LIST
    ====================================================== -->

    <section class="tasks-section">


        <!-- Section Header -->
        <div class="section-header">

            <div>

                <h2>
                    Task List
                </h2>

                <p>
                    Manage and track your current tasks.
                </p>

            </div>


            <!-- Search -->
            <div class="task-search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text" id="taskSearch" placeholder="Search tasks...">

            </div>

        </div>


        <!-- Filters -->
        <div class="filter-bar">

            <button type="button" class="filter-btn active" data-filter="all">
                All
            </button>


            <button type="button" class="filter-btn" data-filter="pending">
                Pending
            </button>


            <button type="button" class="filter-btn" data-filter="completed">
                Completed
            </button>

        </div>


        @if ($tasks->count() > 0)


            <!-- Task List -->
            <div class="task-list" id="taskList">

                @foreach ($tasks as $task)
                    <div class="task-item" data-status="{{ $task->status }}" data-title="{{ strtolower($task->title) }}">


                        <!-- Task Information -->
                        <div class="task-main">


                            <!-- Status Circle -->
                            <div
                                class="task-check
                            {{ $task->status === 'completed' ? 'completed' : '' }}">

                                @if ($task->status === 'completed')
                                    <i class="fa-solid fa-check"></i>
                                @endif

                            </div>


                            <!-- Task Content -->
                            <div class="task-content">


                                <h3 class="{{ $task->status === 'completed' ? 'task-completed' : '' }}">
                                    {{ $task->title }}
                                </h3>


                                @if ($task->description)
                                    <p>
                                        {{ $task->description }}
                                    </p>
                                @endif


                                <div class="task-meta">

                                    <span>

                                        <i class="fa-regular fa-calendar"></i>

                                        @if ($task->due_date)
                                            {{ $task->due_date->format('d M Y') }}
                                        @else
                                            No due date
                                        @endif

                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- Task Actions -->
                        <div class="task-actions">


                            <!-- Status -->
                            @if ($task->status === 'completed')
                                <span class="status completed">
                                    Completed
                                </span>
                            @else
                                <span class="status pending">
                                    Pending
                                </span>
                            @endif


                            <!-- View -->
                            <a href="{{ route('tasks.show', $task) }}" class="icon-btn" title="View task">

                                <i class="fa-solid fa-eye"></i>

                            </a>


                            <!-- Edit -->
                            <a href="{{ route('tasks.edit', $task) }}" class="icon-btn" title="Edit task">

                                <i class="fa-solid fa-pen"></i>

                            </a>


                            <!-- Delete -->
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this task?');">

                                @csrf

                                @method('DELETE')

                                <button type="submit" class="icon-btn delete-btn" title="Delete task">

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>


                        </div>

                    </div>
                @endforeach

            </div>


            <!-- No Search Results -->
            <div id="noSearchResults" class="empty-state" style="display: none;">

                <div class="empty-icon">

                    <i class="fa-solid fa-magnifying-glass"></i>

                </div>


                <h3>
                    No tasks found
                </h3>


                <p>
                    Try a different search term.
                </p>

            </div>
        @else
            <!-- No Tasks -->
            <div class="empty-state">

                <div class="empty-icon">

                    <i class="fa-solid fa-clipboard-list"></i>

                </div>


                <h3>
                    No tasks yet
                </h3>


                <p>
                    Create your first task and start getting things done.
                </p>


                <a href="{{ route('tasks.create') }}" class="add-task-btn">

                    <i class="fa-solid fa-plus"></i>

                    Create First Task

                </a>

            </div>

        @endif

    </section>

@endsection


@section('scripts')

    <script>
        const searchInput =
            document.getElementById('taskSearch');

        const taskItems =
            document.querySelectorAll('.task-item');

        const filterButtons =
            document.querySelectorAll('.filter-btn');

        const noSearchResults =
            document.getElementById('noSearchResults');


        let currentFilter = 'all';


        function filterTasks() {
            const searchValue = searchInput ?
                searchInput.value.toLowerCase().trim() :
                '';


            let visibleTasks = 0;


            taskItems.forEach(task => {

                const status =
                    task.dataset.status;

                const title =
                    task.dataset.title;


                const matchesSearch =
                    title.includes(searchValue);


                const matchesFilter =
                    currentFilter === 'all' ||
                    status === currentFilter;


                if (
                    matchesSearch &&
                    matchesFilter
                ) {

                    task.style.display = 'flex';

                    visibleTasks++;

                } else {

                    task.style.display = 'none';

                }

            });


            if (noSearchResults) {

                noSearchResults.style.display =
                    visibleTasks === 0 ?
                    'block' :
                    'none';

            }

        }


        if (searchInput) {

            searchInput.addEventListener(
                'input',
                filterTasks
            );

        }


        filterButtons.forEach(button => {

            button.addEventListener(
                'click',
                function() {

                    filterButtons.forEach(btn => {

                        btn.classList.remove(
                            'active'
                        );

                    });


                    this.classList.add(
                        'active'
                    );


                    currentFilter =
                        this.dataset.filter;


                    filterTasks();

                }
            );

        });
    </script>

@endsection
