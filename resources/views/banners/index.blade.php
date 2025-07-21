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
            max-width: 800px;
            margin: 2rem auto;
            padding: 1rem;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            font-size: 1.5rem;
            color: #2854C5;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .button-group {
            margin-top: 1rem;
        }

        .button-group a {
            background-color: #2854C5;
            color: white;
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1rem;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }

        .button-group a:hover {
            background-color: #1d3b8b;
        }

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: #2854C5;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
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
            <a href="{{ route('settings.index') }}" class="text-white no-underline hover:no-underline"><i class='fas fa-angle-left'></i> {{ __('banners.settings') }}</a>
        </x-button>
    <x-button>
            <a href="{{ route('banners.create') }}">{{ __('banners.create') }}</a>
    </x-button>

        @if ($banners->isEmpty())
            <p>{{ __('banners.no_banners_found') }}</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>{{ __('banners.image') }}</th>
                        <th>{{ __('banners.title') }}</th> 
                        <th>{{ __('banners.description') }}</th>
                        <th>{{ __('banners.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                        <tr>
                        <td>
                                <img src="{{ asset('storage/banners/' . $banner->image_url) }}" alt="Banner Image" style="max-width: 150px; height: auto;">
                        </td>
                      
                        <td style="text-align: left;">{{ $banner->title }}</td>
                        <td style="text-align: left;">{{ $banner->description }}</td>
                           
                            
                            <td>
                                <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-primary btn-sm" title="{{ __('banners.edit') }}"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('{{ __('banners.confirm_delete') }}')" class="btn btn-danger btn-sm" title="{{ __('banners.delete') }}"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

       

        <a href="{{ route('dashboard') }}" class="back-link">{{ __('banners.back_to_dashboard') }}</a>
    </div>
</x-app-layout>
