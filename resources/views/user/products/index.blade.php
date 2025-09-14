@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto py-16 px-4">
        <h2 class="text-4xl font-extrabold text-cyan-400 mb-12 text-center drop-shadow-lg">
            @lang('products.list.title')
        </h2>
        @if (!empty($viewData['products']))
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($viewData['products'] as $product)
                    <div
                        class="bg-slate-800 rounded-2xl shadow-xl flex flex-col hover:scale-105 hover:shadow-2xl transition-transform duration-200">
                        <div class="flex-1 flex flex-col p-6">
                            <h3 class="text-xl font-bold text-cyan-300 mb-2 truncate">{{ $product->getName() }}</h3>
                            <p class="text-slate-400 text-sm mb-4 line-clamp-3">{{ $product->getDescription() }}</p>
                            <div class="mt-auto flex items-center justify-between">
                                <span
                                    class="text-2xl font-extrabold text-cyan-400">${{ $product->getFormattedPriceAttribute() }}</span>
                                <a href="{{ route('products.show', $product->getId()) }}"
                                    class="inline-block px-4 py-2 bg-cyan-500 hover:bg-cyan-400 text-white font-semibold rounded-lg shadow transition text-sm">
                                    @lang('products.actions.view')
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-slate-800 rounded-xl shadow-lg p-12 text-center text-slate-400">
                @lang('products.list.empty')
            </div>
        @endif
    </section>
@endsection
