@extends('layouts.app')

@section('title', 'Profile | TaskFlow')

@section('content')

    <header class="topbar">

        <div>
            <p class="welcome-text">
                Account
            </p>

            <h1>
                My Profile
            </h1>
        </div>

        <a href="{{ route('tasks.index') }}" class="secondary-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Tasks
        </a>

    </header>


    <section class="profile-section">

        <div class="profile-header">

            <div class="profile-avatar">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <div>

                <h2>
                    {{ $user->name }}
                </h2>

                <p>
                    {{ $user->email }}
                </p>

            </div>

        </div>


        <div class="details-divider"></div>


        <div class="profile-details">

            <div class="profile-detail">

                <div class="profile-detail-icon">
                    <i class="fa-regular fa-user"></i>
                </div>

                <div>
                    <span>
                        FULL NAME
                    </span>

                    <strong>
                        {{ $user->name }}
                    </strong>
                </div>

            </div>


            <div class="profile-detail">

                <div class="profile-detail-icon">
                    <i class="fa-regular fa-envelope"></i>
                </div>

                <div>
                    <span>
                        EMAIL ADDRESS
                    </span>

                    <strong>
                        {{ $user->email }}
                    </strong>
                </div>

            </div>


            <div class="profile-detail">

                <div class="profile-detail-icon">
                    <i class="fa-regular fa-calendar"></i>
                </div>

                <div>
                    <span>
                        REGISTERED ON
                    </span>

                    <strong>
                        {{ $user->created_at->format('d F Y') }}
                    </strong>
                </div>

            </div>


            <div class="profile-detail">

                <div class="profile-detail-icon">
                    <i class="fa-solid fa-list-check"></i>
                </div>

                <div>
                    <span>
                        MY TASKS
                    </span>

                    <strong>
                        {{ $taskCount }} {{ $taskCount == 1 ? 'Task' : 'Tasks' }}
                    </strong>
                </div>

            </div>

        </div>


        <div class="profile-actions">

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button type="submit" class="profile-logout-btn">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Logout from TaskFlow
                </button>

            </form>

        </div>

    </section>

@endsection
