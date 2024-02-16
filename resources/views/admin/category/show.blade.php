@extends('layouts.admin.app')

@section('content')
<div class="flex rounded shadow-md px-2 py-1 mb-2 bg-white items-center">
  <div class="flex-grow text-xl font-bold py-1">Category show </div>
</div>

<div class="rounded mb-3">
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-2">

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 my-2 rounded relative" role="alert">
      <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif
    <div class="w-full">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category Name</label>
      <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Category name" value="{{ $category->name }}" disabled>
      @error('name')
      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="w-full flex justify-end mt-2">
      <a href="{{ route('category.index') }}" class="bg-gray-500 me-2 hover:bg-gray-700 text-white py-2 px-4 rounded h-full">
        Back
      </a>
      <a href="{{ route('category.edit', $encryptedId) }}" class="bg-blue-700 hover:bg-blue-900 text-white py-2 px-4 rounded h-full">
        Edit
      </a>
    </div>


  </div>
</div>

@endsection

@section('jsScript')
@vite(['resources/js/product.js'])
@endsection