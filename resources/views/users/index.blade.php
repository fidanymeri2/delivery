<x-app-layout>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 1rem;
            display: flex;
            flex-wrap: wrap; /* Allow columns to wrap on smaller screens */
            gap: 2rem; /* Space between columns */
        }
        .settings {
            max-width: 1200px;
            margin: auto;
            padding: 1rem;
        }
        .column {
            flex: 1; /* Flexible columns */
            min-width: 300px; /* Ensure columns don't get too narrow */
            background-color: #ffffff;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            font-size: 1.5rem;
            color: #2854C5;
            margin: 1rem 0;
        }

        a {
            text-decoration: none;
            color: #2854C5;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }

        thead {
            background-color: #2854C5;
            color: white;
        }

        th, td {
            padding: 0.75rem;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            text-transform: uppercase;
            font-weight: 600;
            font-size: 0.875rem;
        }

        tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #e6f7ff;
        }

        button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e60000;
        }

        .actions a {
            margin-right: 0.5rem;
        }

        .actions form {
            display: inline;
        }

        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 0.75rem;
            margin: 1rem 0;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-align: center;
            font-size: 0.875rem;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-info {
            background-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
        <div class="settings">
        <x-button>
            <a href="{{ route('settings.index') }}" class="text-white no-underline hover:no-underline"><i class='fas fa-angle-left'></i> Settings</a>
        </x-button>
        </div>  
    <div class="container">
        
        <div class="column">
            <h1>Users</h1>
            <x-button>
                <a href="{{ route('register') }}" class="text-white no-underline hover:no-underline">Create New User</a>
            </x-button>

            @if (session('success'))
                <p class="success-message">{{ session('success') }}</p>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="actions">
                                    <!-- <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a> -->
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> </a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No Users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $users->appends(['waiter_page' => request('waiter_page')])->links() }}
            </div>
        </div>

        <div class="column">
            <h1>Waiters</h1>
            <x-button>
                <a href="{{ route('waiters.create') }}" class="text-white no-underline hover:no-underline">Create New Waiter</a>
            </x-button>

            @if (session('success'))
                <p class="success-message">{{ session('success') }}</p>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Pin Code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($waiters as $waiter)
                            <tr>
                                <td>{{ $waiter->name }}</td>
                                <td>{{ $waiter->pin_code }}</td>
                                <td class="actions">
                                    <!-- <a href="{{ route('waiters.show', $waiter) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a> -->
                                    <a href="{{ route('waiters.edit', $waiter) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> </a>
                                    <form action="{{ route('waiters.destroy', $waiter) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No Waiters found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $waiters->appends(['user_page' => request('user_page')])->links() }}

            </div>
        </div>
    </div>
</x-app-layout>
