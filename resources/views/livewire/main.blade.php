<div>
<section class="flex flex-col items-center space-y-4 py-12">
            <h1 class="text-3xl font-bold">
              {{ $Welcome }}
            </h1>
            @if(session()->has('message'))
                <h3 class="bg-blue-400 font-bold mb-4 p-2 rounded text-center text-sm text-white">{{session('message')}}</h3>
            @endif

            <livewire:task/>
        </section>
</div>
