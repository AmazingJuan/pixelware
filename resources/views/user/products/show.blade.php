@extends('layouts.app')

@section('content')
    <section class="max-w-5xl mx-auto py-16 px-4">
        <div class="flex flex-col md:flex-row gap-12 bg-slate-800 rounded-2xl shadow-2xl p-8">
            <!-- Product Images -->
            <div class="md:w-1/2 flex flex-col items-center justify-center">
                <div
                    class="w-full aspect-w-4 aspect-h-3 bg-slate-900 rounded-xl overflow-hidden flex items-center justify-center mb-4">
                    {{-- Aqui ira el carrusel o la imagen principal con JS --}}
                    <div id="product-image-gallery" class="w-full h-72 flex items-center justify-center">
                        {{-- Imagen principal --}}
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="md:w-1/2 flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-cyan-400 mb-4 drop-shadow-lg">
                        {{ $viewData['product']->getName() }}
                    </h1>
                    <p class="text-lg text-slate-300 mb-6">
                        {{ $viewData['product']->getDescription() }}
                    </p>
                    <div class="flex items-center gap-4 mb-6">
                        <span
                            class="text-2xl font-extrabold text-cyan-400">${{ $viewData['product']->getFormattedPriceAttribute() }}</span>
                        <span class="text-sm px-3 py-1 rounded-full bg-cyan-900 text-cyan-200 font-semibold">
                            {{ $viewData['product']->getCategory() }}
                        </span>
                    </div>
                    <div class="mb-6">
                        <span class="font-semibold text-slate-400">@lang('products.fields.stock'):</span>
                        @if ($viewData['product']->getStock() > 0)
                            <span class="text-green-400 font-bold">{{ $viewData['product']->getStock() }}</span>
                        @else
                            <span class="text-red-400 font-bold">@lang('products.fields.out_of_stock')</span>
                        @endif
                    </div>
                    <div class="mb-8">
                        <h2 class="text-lg font-bold text-cyan-300 mb-2">@lang('products.fields.specs')</h2>
                        @if (!empty($viewData['product']->getFormattedSpecsAttribute()))
                            <ul class="list-disc list-inside text-slate-200 space-y-1">
                                @foreach ($viewData['product']->getFormattedSpecsAttribute() as $specName => $specValue)
                                    <li>
                                        <span class="font-semibold">{{ $specName }}:</span>
                                        <span>{{ $specValue }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-slate-400 italic">@lang('products.fields.no_specs')</div>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <button
                        class="w-full sm:w-auto px-8 py-3 bg-cyan-500 hover:bg-cyan-400 text-white font-semibold rounded-lg shadow transition text-lg">
                        @lang('products.actions.buy')
                    </button>
                    <a href="{{ route('products.index') }}"
                        class="w-full sm:w-auto px-8 py-3 bg-slate-700 hover:bg-slate-600 text-cyan-200 font-semibold rounded-lg shadow transition text-lg text-center">
                        @lang('products.actions.back')
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
