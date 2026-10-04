<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $task->title }} | TaskFlow</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}">
</head>

<body>

    <div class="app-wrapper">

        <!-- Sidebar -->
        <aside class="sidebar">

            <div class="brand">
                <div class="brand-icon">
                    <i class="fa-solid fa-check-double"></i>
                </div>

                <div>
                    <h4>TaskFlow</h4>
                    <span>Task Manager</span>
                </div>
            </div>

            <nav class="sidebar-nav">

                <a href="{{ route('tasks.index') }}" class="nav-link">
                    <i class="fa-solid fa-grid-2"></i>
                    <span>Overview</span>
                </a>

                <a href="{{ route('tasks.index') }}" class="nav-link">
                    <i class="fa-solid fa-list-check"></i>
                    <span>My Tasks</span>
                </a>

                <a href="{{ route('tasks.create') }}" class="nav-link">
                    <i class="fa-solid fa-plus"></i>
                    <span>New Task</span>
                </a>

            </nav>

            <div class="sidebar-bottom">

                <div class="sidebar-info">
                    <i class="fa-solid fa-lightbulb"></i>

                    <div>
                        <strong>Stay productive</strong>
                        <p>Focus on one task at a time.</p>
                    </div>
                </div>

            </div>

        </aside>


        <!-- Main Content -->
        <main class="main-content">

            <header class="topbar">

                <div>
                    <p class="welcome-text">Task Management</p>
                    <h1>Task Details</h1>
                </div>

                <a href="{{ route('tasks.index') }}" class="secondary-btn">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back to Tasks
                </a>

            </header>


            <!-- Task Details Card -->
            <section class="details-section">

                <div class="details-top">

                    <div class="details-title-area">

                        <div
                            class="details-check
                        {{ $task->status === 'completed' ? 'completed' : '' }}">

                            @if ($task->status === 'completed')
                                <i class="fa-solid fa-check"></i>
                            @endif

                        </div>

                        <div>
                            <p class="details-label">TASK</p>

                            <h2 class="{{ $task->status === 'completed' ? 'task-completed' : '' }}">
                                {{ $task->title }}
                            </h2>
                        </div>

                    </div>


                    @if ($task->status === 'completed')
                        <span class="status completed">
                            <i class="fa-solid fa-check me-1"></i>
                            Completed
                        </span>
                    @else
                        <span class="status pending">
                            <i class="fa-solid fa-clock me-1"></i>
                            Pending
                        </span>
                    @endif

                </div>


                <div class="details-divider"></div>


                <!-- Description -->
                <div class="details-item">

                    <div class="details-icon">
                        <i class="fa-solid fa-align-left"></i>
                    </div>

                    <div class="details-content">

                        <span>DESCRIPTION</span>

                        @if ($task->description)
                            <p>{{ $task->description }}</p>
                        @else
                            <p class="muted-text">
                                No description provided.
                            </p>
                        @endif

                    </div>

                </div>


                <!-- Due Date -->
                <div class="details-item">

                    <div class="details-icon">
                        <i class="fa-regular fa-calendar"></i>
                    </div>

                    <div class="details-content">

                        <span>DUE DATE</span>

                        @if ($task->due_date)
                            <p>
                                {{ $task->due_date->format('d F Y') }}
                            </p>
                        @else
                            <p class="muted-text">
                                No due date set.
                            </p>
                        @endif

                    </div>

                </div>


                <!-- Created Date -->
                <div class="details-item">

                    <div class="details-icon">
                        <i class="fa-regular fa-clock"></i>
                    </div>

                    <div class="details-content">

                        <span>CREATED</span>

                        <p>
                            {{ $task->created_at->format('d F Y, h:i A') }}
                        </p>

                    </div>

                </div>


                <!-- Updated Date -->
                <div class="details-item">

                    <div class="details-icon">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </div>

                    <div class="details-content">

                        <span>LAST UPDATED</span>

                        <p>
                            {{ $task->updated_at->format('d F Y, h:i A') }}
                        </p>

                    </div>

                </div>


                <!-- Actions -->
                <div class="details-actions">

                    <a href="{{ route('tasks.edit', $task) }}" class="save-task-btn">
                        <i class="fa-solid fa-pen"></i>
                        Edit Task
                    </a>


                    <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this task?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="danger-btn">
                            <i class="fa-solid fa-trash"></i>
                            Delete Task
                        </button>

                    </form>

                </div>

            </section>


            <footer class="footer">
                TaskFlow • Built with Laravel
            </footer>

        </main>

    </div>

</body>

</html>

