@extends('layouts.admin.app')

@section('content')
<div class="flex rounded shadow-md px-2 py-1 mb-2 bg-white items-center">
  <div class="flex-grow text-xl font-bold py-1">Add a new product </div>
</div>

<div class="rounded mb-3">
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-2">

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 my-2 rounded relative" role="alert">
      <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <form method="POST" action="{{route('product.update', $encryptedId)}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mx-auto grid lg:grid-cols-12 ">

        <!-- Left side with input image -->
        <div class="lg:col-span-3 p-4">
          <!-- You can replace 'your-image-path.jpg' with the actual path of your image -->
          <div class="mb-2">
            <img id="productImgUploadPreview" src="{{ Storage::url('images/products/preview.jpg') }}" alt="preview image" style="max-width: 100%;">
          </div>
          <input name="productImg" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="productImgUpload" type="file">
        </div>

        <!-- Right side with input -->
        <div class="lg:col-span-9 p-4">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-2">
            <div class="sm:col-span-2">
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
              <input type="text" name="name" id="name" value="{{ old('name') ? old('name') : $product->title }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Product name">
              @error('name')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
            <div class="w-full">
              <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
              <input type="number" name="price" id="price" value="{{ old('price') ? old('price') : $product->price }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999">
              @error('price')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
            <div class="w-full">
              <label for="color" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Color</label>
              <input type="text" name="color" id="color" value="{{ old('color') ? old('color') : $product->colors }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Product Color">
            </div>
            <div>
              <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
              <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option selected disabled>Select category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}" {{ old('category', $product->category_id) == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                @endforeach
              </select>
              @error('category')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
            <div class="sm:col-span-2">
              <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
              <textarea id="description" name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here">{{ old('description') ? old('description') : $product->description }}</textarea>
            </div>
          </div>

          <div class="w-full flex justify-end mt-2">
            <a href="{{ route('product.index') }}" class="bg-gray-500 me-2 hover:bg-gray-700 text-white py-2 px-4 rounded h-full">
              Back
            </a>
            <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded h-full">
              Save
            </button>
          </div>

        </div>

      </div>
    </form>

  </div>
</div>

@endsection

@section('jsScript')
@vite(['resources/js/product.js'])
@endsection