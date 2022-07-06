
@extends('layout')
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="tab-content">
                    <h3 class="my-3">Liste des categories</h3>
                        <a href="{{ route('categories.create')}}" class="my-3 px-4 py-2 bg-indigo-500 no-underline outline-none rounded text-white shadow-md shadow-indigo-200 font-medium hover:bg-indigo-600">Ajouter</a>
                    <div id="nav-tab-card" class="my-3 relative overflow-x-auto shadow-lg shadow-indigo-200 sm:rounded-lg">
                        @if(session()->get('success'))
                          <div class="alert alert-success">
                            {{ session()->get('success') }}
                          </div><br />
                        @endif
                        <!-- Tableau -->
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">#</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3 sm:text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr class="border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{$category->id}}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{$category->name}}</td>
                                    <td class="px-6 py-4 flex items-center justify-end">
                                        <a href="{{ route('categories.show', $category->id)}}" class="mx-2 px-2 py-1 bg-emerald-500 no-underline outline-none rounded text-white shadow-lg shadow-emerald-200 font-medium hover:bg-emerald-600">Voir</a>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="mx-2 px-2 py-1 bg-indigo-500 no-underline outline-none rounded text-white shadow-lg shadow-indigo-200 font-medium hover:bg-indigo-600">Editer</a>
                                        <form class="m-0 mx-2 px-2 py-1 bg-red-500 no-underline outline-none rounded text-white shadow-lg shadow-red-200 font-medium hover:bg-red-600" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Supprimer</button>
                                         </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- Fin du Tableau -->
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endsection
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

