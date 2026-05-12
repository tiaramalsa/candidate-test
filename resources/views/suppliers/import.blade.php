<x-app-layout>

    <div class="max-w-3xl mx-auto p-6">

        {{-- Page Header --}}
        <div class="mb-6">

            <h1 class="text-3xl font-bold text-gray-800">
                Import Supplier Data
            </h1>

            <p class="text-gray-500 mt-2">
                Upload a JSON file containing supplier, layup,
                and layer data.
            </p>

        </div>

        {{-- Warning --}}
        <div class="bg-yellow-50 border border-yellow-200
                    text-yellow-700 rounded-2xl p-5 mb-6">

            <h3 class="font-semibold mb-2">
                Duplicate Data Detection
            </h3>

            <p class="text-sm leading-relaxed">

                If imported data already exists in the system,
                you can choose whether to update the existing data
                or keep the current data unchanged.

            </p>

        </div>

        {{-- Import Card --}}
        <div class="bg-white rounded-2xl shadow-sm
                    border border-gray-100 p-6">

            <form action="{{ route('suppliers.import') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                {{-- File Upload --}}
                <div class="mb-6">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        JSON File

                    </label>

                    <input type="file"
                           name="json_file"
                           class="w-full border border-gray-300
                                  rounded-xl p-3
                                  focus:ring-2 focus:ring-blue-500
                                  focus:border-blue-500">

                    <p class="text-sm text-gray-500 mt-2">
                        Upload a valid .json file
                    </p>

                </div>

                {{-- Duplicate Handling --}}
                <div class="mb-8">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Duplicate Data Handling

                    </label>

                    <select name="strategy"
                            class="w-full border border-gray-300
                                   rounded-xl p-3
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500">

                        <option value="overwrite">
                            Update existing data with imported data
                        </option>

                        <option value="skip">
                            Keep current data and ignore duplicates
                        </option>

                    </select>

                    <p class="text-sm text-gray-500 mt-2">

                        This option determines what happens
                        when imported data already exists.

                    </p>

                </div>

                {{-- Submit --}}
                <div class="flex items-center justify-end gap-3">

                    <a href="{{ route('suppliers.index') }}"
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

                        Import Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>