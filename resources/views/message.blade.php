<div class="max-w-3xl mx-auto mt-4">
    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded relative shadow-sm" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <button type="button" class="absolute top-0 right-0 mt-2 mr-2 text-green-500 hover:text-green-800" onclick="this.parentElement.remove()">
                &times;
            </button>
        </div>
    @endif

    <!-- Error Message -->
    @if (session('error'))
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded relative shadow-sm" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
            <button type="button" class="absolute top-0 right-0 mt-2 mr-2 text-red-500 hover:text-red-800" onclick="this.parentElement.remove()">
                &times;
            </button>
        </div>
    @endif
</div>
