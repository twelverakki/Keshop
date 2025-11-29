
<div>
    <div class="relative aspect-square bg-gray-50 rounded-lg flex justify-center items-center overflow-hidden">

        <span class="absolute top-3 right-3 bg-white text-gray-800 text-xs font-medium px-3 py-1 rounded-full shadow-md">
            {{$product->category->shortName}}
        </span>

        <img src="{{$product->image}}" alt="CCTV Maling" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
    </div>

    <div class="rounded-xl overflow-hidden pt-4 transition duration-300">
        <h3 class="text-xl font-bold text-gray-900 mb-1">{{$product->shortName}}</h3>

        <div class="flex justify-between mb-2">
            <div class="flex flex-1 items-center align-middle">
                <span class="text-yellow-500 mr-2">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.247l6.565-.955L10 0l2.948 6.292 6.565.955-4.758 4.638 1.123 6.545z"/>
                    </svg>
                </span>
                <span class="text-sm leading-normal text-gray-500 font-medium">4.8 (120)</span>
            </div>

             <span class="text-end flex-1 text-xl font-bold text-gray-900">Rp {{$product->price}}</span>
        </div>


        <div class="text-sm flex space-x-3">
            <button class="flex-1 px-4 py-3 text-gray-900 font-semibold border border-gray-300 rounded-full hover:bg-gray-100 transition duration-150">
                Add to Chart
            </button>

            <button class="flex-1 px-4 py-3 bg-black text-white font-semibold rounded-full hover:bg-gray-700 transition duration-150">
                Buy Now
            </button>
        </div>
    </div>
</div>