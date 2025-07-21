<x-app-layout>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            color: #333;
            margin: 0;
            padding: 0;
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
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 1rem;
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
            text-align: center; /* Center-align table data */
            border-bottom: 1px solid #ddd;
            text-align: center; 

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
    text-decoration: none; /* Ensures no underline by default */
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

        
        @media (max-width: 768px) {
            .container {
                padding: 0.5rem;
            }

            table {
                font-size: 0.875rem;
            }

            th, td {
                padding: 0.5rem;
            }

            .actions {
                flex-direction: column;
            }
        }
    </style>

    <div class="container">
        <x-button>
            <a href="{{ route('extra-categories.create') }}" class="text-white no-underline hover:no-underline">Create New Extra Category</a>
        </x-button>

        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif

        <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="sortable-extra-categories">
            @forelse ($extraCategories as $category)
                <tr data-id="{{ $category->id }}">
                    <td>{{ $category->name }}</td>
                    <td class="actions">
                        <a href="{{ route('extra-categories.show', $category) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('extra-categories.edit', $category) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('extra-categories.destroy', $category) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No Extra Categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $extraCategories->links() }}
</div>

    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
$(function() {
    $("#sortable-extra-categories").sortable({
        update: function(event, ui) {
            var sortedIDs = $(this).sortable('toArray', { attribute: 'data-id' });
            $.ajax({
                url: '{{ route("extra-categories.sort") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    order: sortedIDs
                },
                success: function(response) {
                    console.log('Order updated successfully:', response);
                    alert('Order updated successfully!');
                },
                error: function(xhr, status, error) {
                    console.error('An error occurred:', xhr.responseText);
                    alert('Failed to update order. Error: ' + xhr.responseText);
                }
            });
        }
    });
    $("#sortable-extra-categories").disableSelection();
});
</script>

