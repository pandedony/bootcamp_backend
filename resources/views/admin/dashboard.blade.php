@extends('layouts.admin.app')

@section('content')
<div class="flex rounded shadow-md px-2 py-1 mb-2 bg-white items-center">
  <div class="flex-grow text-xl font-bold py-1">Dashboard</div>
</div>

<div class="grid grid-cols-12 gap-4 mb-4">
  <div class="md:col-span-4 col-span-12 rounded-lg bg-white p-6 shadow-md">
    <p class="font-normal text-gray-700 dark:text-gray-400">Jumlah Product</p>
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$productTotal}}</h5>
  </div>
  <div class="md:col-span-4 col-span-12 rounded-lg bg-white p-6 shadow-md">
    <p class="font-normal text-gray-700 dark:text-gray-400">Jumlah Order</p>
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">500</h5>
  </div>
  <div class="md:col-span-4 col-span-12 rounded-lg bg-white p-6 shadow-md">
    <p class="font-normal text-gray-700 dark:text-gray-400">Total Penjualan</p>
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Rp. 5.000.000</h5>
  </div>
</div>

@endsection