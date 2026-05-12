<x-app-layout>

    <div class="max-w-3xl mx-auto p-6">

        {{-- Header --}}
        <div class="mb-6">

            <h1 class="text-3xl font-bold text-gray-800">
                Edit Layer
            </h1>

            <p class="text-gray-500 mt-2">
                Update CLT layer specification.
            </p>

        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-sm
                    border border-gray-100 p-6">

            <form action="{{ route('layers.update', $layer) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Layup --}}
                <div class="mb-5">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Layup

                    </label>

                    <select name="layup_id"
                            class="w-full border border-gray-300
                                   rounded-xl p-3">

                        @foreach ($layups as $layup)

                            <option value="{{ $layup->id }}"
                                {{ $layer->layup_id == $layup->id ? 'selected' : '' }}>

                                {{ $layup->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Layer Order --}}
                <div class="mb-5">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Layer Order

                    </label>

                    <input type="number"
                           name="layer_order"
                           value="{{ old('layer_order', $layer->layer_order) }}"
                           class="w-full border border-gray-300
                                  rounded-xl p-3">

                </div>

                {{-- Thickness --}}
                <div class="mb-5">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Thickness

                    </label>

                    <input type="number"
                           step="0.01"
                           name="thickness"
                           value="{{ old('thickness', $layer->thickness) }}"
                           class="w-full border border-gray-300
                                  rounded-xl p-3">

                </div>

                {{-- Width --}}
                <div class="mb-5">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Width

                    </label>

                    <input type="number"
                           step="0.01"
                           name="width"
                           value="{{ old('width', $layer->width) }}"
                           class="w-full border border-gray-300
                                  rounded-xl p-3">

                </div>

                {{-- Angle --}}
                <div class="mb-8">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Angle

                    </label>

                    <input type="number"
                           step="0.01"
                           name="angle"
                           value="{{ old('angle', $layer->angle) }}"
                           class="w-full border border-gray-300
                                  rounded-xl p-3">

                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3">

                    <a href="{{ route('layers.index') }}"
                       class="px-5 py-3 rounded-xl
                              border border-gray-300
                              text-gray-700 hover:bg-gray-50
                              transition">

                        Cancel

                    </a>

                    <button
                        class="bg-blue-600 hover:bg-blue-700
                               text-white px-5 py-3
                               rounded-xl font-medium
                               transition">

                        Update Layer

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>