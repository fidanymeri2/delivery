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
    }
    h1 {
        font-size: 1.5rem;
        color: #2854C5;
        margin: 1rem;
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
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    thead {
        background-color: #2854C5;
        color: white;
    }

    th, td {
        padding: 0.75rem;
        text-align: center;
        border-bottom: 1px solid #ddd;
        box-sizing: border-box; /* Ensures padding and border are included in element's total width and height */
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
        text-decoration: none;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        text-decoration: none; 
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        text-decoration: none; 
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
        -webkit-overflow-scrolling: touch;
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

    /* Specific rule for centering images in table cells */
    td img {
        display: inline-block;
        vertical-align: middle;
    }
</style>


    <div class="container">

      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>All Feedbacks</h1>
        <a href="{{ route('feedbacks.create') }}" class="btn btn-primary">Add Feedback</a>
    </div>

    @if($feedbacks->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Publish</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->id }}</td>
                        <td>{{ $feedback->rating }}</td>
                        <td>{{ $feedback->comment }}</td>
                        <td>{{ $feedback->publish ? 'Published' : 'Not Published' }}</td>
                        <td>
                            <a href="{{ route('feedbacks.edit', $feedback->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No feedback available.</p>
    @endif
    </div>
</x-app-layout>
