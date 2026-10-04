@extends('layouts.app')

@section('title', 'Notifications | TaskFlow')

@section('content')

    <header class="topbar">

        <div>
            <p class="welcome-text">
                Activity
            </p>

            <h1>
                Notifications
            </h1>
        </div>

        <div class="topbar-actions">

            <a href="{{ route('tasks.index') }}" class="secondary-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Tasks
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


    <section class="notifications-section">

        <div class="notifications-header">

            <div>

                <h2>
                    Recent Activity
                </h2>

                <p>
                    Keep track of what's happening in your TaskFlow account.
                </p>

            </div>


            @if (auth()->user()->unreadNotifications->count() > 0)
                <form action="{{ route('notifications.readAll') }}" method="POST">

                    @csrf

                    <button type="submit" class="mark-read-btn">
                        <i class="fa-solid fa-check-double"></i>
                        Mark all as read
                    </button>

                </form>
            @endif

        </div>


        @if ($notifications->count() > 0)

            <div class="notification-list">

                @foreach ($notifications as $notification)
                    @php

                        $data = $notification->data;

                        $action = $data['action'] ?? 'updated';

                        $message = $data['message'] ?? 'You have a new notification.';

                        $taskTitle = $data['task_title'] ?? 'Task';

                        $isUnread = is_null($notification->read_at);

                    @endphp


                    <div
                        class="notification-item
                    notification-{{ $action }}
                    {{ $isUnread ? 'unread' : '' }}">


                        <!-- Notification Icon -->
                        <div class="notification-icon">

                            @if ($action === 'created')
                                <i class="fa-solid fa-plus"></i>
                            @elseif($action === 'completed')
                                <i class="fa-solid fa-circle-check"></i>
                            @elseif($action === 'deleted')
                                <i class="fa-solid fa-trash-can"></i>
                            @else
                                <i class="fa-solid fa-pen"></i>
                            @endif

                        </div>


                        <!-- Notification Content -->
                        <div class="notification-content">

                            <div class="notification-title-row">

                                <div>

                                    @if ($action === 'created')
                                        <span class="notification-type created">
                                            Task Created
                                        </span>
                                    @elseif($action === 'completed')
                                        <span class="notification-type completed">
                                            Task Completed
                                        </span>
                                    @elseif($action === 'deleted')
                                        <span class="notification-type deleted">
                                            Task Deleted
                                        </span>
                                    @else
                                        <span class="notification-type updated">
                                            Task Updated
                                        </span>
                                    @endif

                                </div>


                                @if ($isUnread)
                                    <span class="unread-dot"></span>
                                @endif

                            </div>


                            <h3>
                                {{ $taskTitle }}
                            </h3>


                            <p>
                                {{ $message }}
                            </p>


                            <span class="notification-time">

                                <i class="fa-regular fa-clock"></i>

                                {{ $notification->created_at->diffForHumans() }}

                            </span>

                        </div>


                        @if ($isUnread)
                            <div class="notification-status">
                                New
                            </div>
                        @else
                            <div class="notification-status read">
                                Read
                            </div>
                        @endif

                    </div>
                @endforeach

            </div>
        @else
            <div class="empty-state">

                <div class="empty-icon">

                    <i class="fa-regular fa-bell"></i>

                </div>

                <h3>
                    No notifications yet
                </h3>

                <p>
                    Your task activity will appear here.
                </p>

            </div>

        @endif

    </section>

@endsection
