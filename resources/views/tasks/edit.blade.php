<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Task | TaskFlow</title>

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
                    <h1>Edit Task</h1>
                </div>

                <a href="{{ route('tasks.show', $task) }}" class="secondary-btn">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back to Task
                </a>

            </header>


            <!-- Edit Task Card -->
            <section class="form-section">

                <div class="form-header">

                    <div class="form-header-icon">
                        <i class="fa-solid fa-pen"></i>
                    </div>

                    <div>
                        <h2>Update task</h2>

                        <p>
                            Make changes to your task details below.
                        </p>
                    </div>

                </div>


                @if ($errors->any())

                    <div class="validation-message">

                        <div class="validation-title">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            Please fix the following errors:
                        </div>

                        <ul>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif


                <form action="{{ route('tasks.update', $task) }}" method="POST" class="task-form">

                    @csrf
                    @method('PUT')


                    <!-- Title -->
                    <div class="form-group">

                        <label for="title">
                            Task Title
                        </label>

                        <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}"
                            placeholder="Enter task title" class="@error('title') input-error @enderror" required>

                        @error('title')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <!-- Description -->
                    <div class="form-group">

                        <label for="description">
                            Description
                            <span class="optional">(Optional)</span>
                        </label>

                        <textarea id="description" name="description" rows="5" placeholder="Add some details about this task..."
                            class="@error('description') input-error @enderror">{{ old('description', $task->description) }}</textarea>

                        @error('description')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <!-- Due Date -->
                    <div class="form-group">

                        <label for="due_date">
                            Due Date
                            <span class="optional">(Optional)</span>
                        </label>

                        <input type="date" id="due_date" name="due_date"
                            value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                            class="@error('due_date') input-error @enderror">

                        @error('due_date')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <!-- Status -->
                    <div class="form-group">

                        <label for="status">
                            Task Status
                        </label>

                        <select id="status" name="status" class="@error('status') input-error @enderror" required>

                            <option value="pending" {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="completed"
                                {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                        </select>

                        @error('status')
                            <span class="field-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <!-- Buttons -->
                    <div class="form-actions">

                        <a href="{{ route('tasks.show', $task) }}" class="cancel-btn">
                            Cancel
                        </a>

                        <button type="submit" class="save-task-btn">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save Changes
                        </button>

                    </div>

                </form>

            </section>


            <footer class="footer">
                TaskFlow • Built with Laravel
            </footer>

        </main>

    </div>

</body>

</html>
