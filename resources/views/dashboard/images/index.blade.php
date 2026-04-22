<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="btn btn-danger">
                {{ __('app.back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <img src="{{ asset($userImage) }}" alt="User Image"
                    class="w-full h-auto shadow-lg rounded-lg border border-gray-100">
                <img src="{{ asset($companyImage) }}" alt="Company Image"
                    class="w-full h-auto shadow-lg rounded-lg border border-gray-100">
            </div>
        </div>
    </div>

    <div class="pt-2 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('generate-pdf') }}" class="btn btn-info">
                {{ __('app.generatePDF') }}</a>
        </div>
    </div>
</x-app-layout>