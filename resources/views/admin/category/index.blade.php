@extends('layouts.admin.app')

@section('content')
<div class="flex rounded shadow-md px-2 py-1 mb-2 bg-white items-center">
  <div class="flex-grow text-xl font-bold py-1">Category</div>
  <a href="{{ route('category.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-4 rounded">
    Add Category
  </a>
</div>

<div class="rounded mb-3">
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-2">

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-2 py-1 my-2 rounded relative" role="alert">
      <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 my-2 rounded relative" role="alert">
      <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 category-datatable">

      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">
            No
          </th>
          <th scope="col" class="px-6 py-3">
            Name
          </th>
          <th scope="col" class="px-6 py-3">
            Action
          </th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td colspan="3" class="text-center">No data available</td>
        </tr>
      </tbody>

    </table>

  </div>
</div>

@endsection

@section('jsScript')
@vite(['resources/js/category.js'])
@endsection