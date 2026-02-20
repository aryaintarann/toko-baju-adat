@extends('layouts.app')

@section('title', 'Checkout - Toko Baju Adat Bali')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <h1 class="font-display text-3xl font-bold text-warm-900 mb-8">Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="lg:flex lg:gap-8">
                {{-- Customer Info --}}
                <div class="lg:w-7/12 mb-8 lg:mb-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-warm-100 p-6 md:p-8">
                        <h2 class="font-display text-xl font-bold text-warm-900 mb-6">Informasi Pengiriman</h2>
                        <p class="text-warm-500 text-sm mb-6 -mt-4">Tidak perlu login! Isi data di bawah untuk menyelesaikan
                            pesanan.</p>

                        <div class="space-y-5">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-warm-700 mb-1.5">Nama
                                    Lengkap <span class="text-accent-500">*</span></label>
                                <input type="text" name="customer_name" id="customer_name"
                                    value="{{ old('customer_name') }}" required
                                    class="w-full bg-warm-50 border border-warm-200 rounded-xl px-4 py-3 text-warm-900 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all @error('customer_name') border-accent-500 @enderror"
                                    placeholder="Nama penerima">
                                @error('customer_name')
                                    <p class="text-accent-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="customer_email" class="block text-sm font-medium text-warm-700 mb-1.5">Email
                                    <span class="text-accent-500">*</span></label>
                                <input type="email" name="customer_email" id="customer_email"
                                    value="{{ old('customer_email') }}" required
                                    class="w-full bg-warm-50 border border-warm-200 rounded-xl px-4 py-3 text-warm-900 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all @error('customer_email') border-accent-500 @enderror"
                                    placeholder="email@contoh.com">
                                @error('customer_email')
                                    <p class="text-accent-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-warm-700 mb-1.5">No.
                                    Telepon <span class="text-accent-500">*</span></label>
                                <input type="text" name="customer_phone" id="customer_phone"
                                    value="{{ old('customer_phone') }}" required
                                    class="w-full bg-warm-50 border border-warm-200 rounded-xl px-4 py-3 text-warm-900 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all @error('customer_phone') border-accent-500 @enderror"
                                    placeholder="08xx-xxxx-xxxx">
                                @error('customer_phone')
                                    <p class="text-accent-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="customer_address" class="block text-sm font-medium text-warm-700 mb-1.5">Alamat
                                    Lengkap <span class="text-accent-500">*</span></label>
                                <textarea name="customer_address" id="customer_address" rows="3" required
                                    class="w-full bg-warm-50 border border-warm-200 rounded-xl px-4 py-3 text-warm-900 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all @error('customer_address') border-accent-500 @enderror"
                                    placeholder="Jalan, No. Rumah, RT/RW">{{ old('customer_address') }}</textarea>
                                @error('customer_address')
                                    <p class="text-accent-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Destination Search --}}
                            <div class="relative">
                                <label for="destination_search" class="block text-sm font-medium text-warm-700 mb-1.5">Cari Kecamatan/Kota <span class="text-accent-500">*</span></label>
                                <input type="text" id="destination_search"
                                    class="w-full bg-warm-50 border border-warm-200 rounded-xl px-4 py-3 text-warm-900 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all"
                                    placeholder="Ketik nama kecamatan atau kota..." autocomplete="off">
                                <input type="hidden" name="destination_id" id="destination_id" required>
                                
                                {{-- Results Dropdown --}}
                                <ul id="destination_results" 
                                    class="absolute z-10 w-full bg-white border border-warm-200 rounded-xl shadow-lg mt-1 max-h-60 overflow-y-auto hidden">
                                </ul>
                                <p id="search_loading" class="text-xs text-warm-500 mt-1 hidden">Mencari...</p>
                            </div>

                            {{-- Courier Selection --}}
                            <div>
                                <label for="courier" class="block text-sm font-medium text-warm-700 mb-1.5">Kurir Pengiriman
                                    <span class="text-accent-500">*</span></label>
                                <select name="courier" id="courier" required disabled
                                    class="w-full bg-warm-50 border border-warm-200 rounded-xl px-4 py-3 text-warm-900 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all disabled:opacity-50">
                                    <option value="">Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS Indonesia</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="sicepat">SiCepat</option>
                                    <option value="jnt">J&T</option>
                                </select>
                            </div>

                            <div id="shipping_services_container" class="hidden">
                                <label class="block text-sm font-medium text-warm-700 mb-1.5">Layanan Pengiriman <span
                                        class="text-accent-500">*</span></label>
                                <div id="shipping_services" class="space-y-2">
                                    <!-- Services computed via JS -->
                                </div>
                            </div>

                            <input type="hidden" name="shipping_service" id="shipping_service">
                            <input type="hidden" name="shipping_cost" id="shipping_cost" value="0">

                            <div>
                                <label for="notes" class="block text-sm font-medium text-warm-700 mb-1.5">Catatan
                                    (opsional)</label>
                                <textarea name="notes" id="notes" rows="2"
                                    class="w-full bg-warm-50 border border-warm-200 rounded-xl px-4 py-3 text-warm-900 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all"
                                    placeholder="Catatan tambahan untuk pesanan">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="lg:w-5/12">
                    <div class="bg-white rounded-2xl shadow-sm border border-warm-100 p-6 sticky top-24">
                        <h2 class="font-display text-xl font-bold text-warm-900 mb-4">Ringkasan Pesanan</h2>

                        <div class="divide-y divide-warm-100">
                            @foreach($cartItems as $item)
                                <div class="py-3 flex justify-between items-center gap-3">
                                    <div class="min-w-0">
                                        <p class="font-medium text-warm-900 text-sm truncate">{{ $item['product']->name }}</p>
                                        <p class="text-xs text-warm-500">{{ $item['quantity'] }}x @
                                            {{ $item['product']->formatted_price }}</p>
                                    </div>
                                    <span class="font-semibold text-warm-900 text-sm shrink-0">Rp
                                        {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t-2 border-warm-200 mt-4 pt-4 space-y-2">
                            <div class="flex justify-between items-center text-sm text-warm-600">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm text-warm-600">
                                <span>Ongkir</span>
                                <span id="shipping_cost_display">Rp 0</span>
                            </div>
                            <div class="flex justify-between items-center pt-2 border-t border-warm-100">
                                <span class="text-lg font-bold text-warm-900">Total</span>
                                <span class="text-2xl font-bold text-primary-700" id="total_display">Rp
                                    {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full mt-6 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white py-3.5 rounded-xl font-semibold transition-all shadow-lg hover:shadow-primary-500/40 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Buat Pesanan
                        </button>

                        <p class="text-xs text-warm-400 text-center mt-3">Dengan menekan tombol di atas, Anda menyetujui
                            pemesanan ini.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const destinationSearch = document.getElementById('destination_search');
            const destinationId = document.getElementById('destination_id');
            const destinationResults = document.getElementById('destination_results');
            const searchLoading = document.getElementById('search_loading');
            const courierSelect = document.getElementById('courier');
            const shippingServicesContainer = document.getElementById('shipping_services_container');
            const shippingServices = document.getElementById('shipping_services');
            const shippingCostInput = document.getElementById('shipping_cost');
            const shippingServiceInput = document.getElementById('shipping_service');
            const shippingCostDisplay = document.getElementById('shipping_cost_display');
            const totalDisplay = document.getElementById('total_display');
            const baseTotal = {{ $total }};
            let debounceTimer;

            // Debounce Function
            function debounce(func, delay) {
                return function() {
                    const context = this;
                    const args = arguments;
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => func.apply(context, args), delay);
                }
            }

            // Perform Search
            function performSearch(query) {
                if (query.length < 3) {
                    destinationResults.classList.add('hidden');
                    return;
                }

                searchLoading.classList.remove('hidden');
                destinationResults.classList.add('hidden');

                fetch(`{{ route("api.regions.search") }}?q=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        searchLoading.classList.add('hidden');
                        destinationResults.innerHTML = '';
                        
                        if (data.length > 0) {
                            destinationResults.classList.remove('hidden');
                            data.forEach(item => {
                                const li = document.createElement('li');
                                li.className = 'px-4 py-2 hover:bg-warm-50 cursor-pointer text-sm text-warm-700 border-b border-warm-50 last:border-0';
                                // Komerce API structure: label usually contains full string
                                // Or construct from subdistrict_name, city_name, province_name
                                const label = item.label || `${item.subdistrict_name}, ${item.city_name}, ${item.province_name}`;
                                li.textContent = label;
                                li.onclick = () => selectDestination(item.id, label);
                                destinationResults.appendChild(li);
                            });
                        }
                    })
                    .catch(error => {
                        searchLoading.classList.add('hidden');
                        console.error('Search error:', error);
                    });
            }

            // Select Destination
            function selectDestination(id, label) {
                destinationId.value = id;
                destinationSearch.value = label;
                destinationResults.classList.add('hidden');
                courierSelect.disabled = false;
                
                // Reset shipping if destination changed
                resetShipping();
                if (courierSelect.value) {
                    calculateShipping();
                }
            }

            // Input Event Listener
            destinationSearch.addEventListener('input', debounce(function(e) {
                performSearch(e.target.value);
            }, 500));

            // Hide dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!destinationSearch.contains(e.target) && !destinationResults.contains(e.target)) {
                    destinationResults.classList.add('hidden');
                }
            });

            // On Courier Change
            courierSelect.addEventListener('change', function () {
                if (this.value && destinationId.value) {
                    calculateShipping();
                } else {
                    shippingServicesContainer.classList.add('hidden');
                    resetShipping();
                }
            });

            function calculateShipping() {
                shippingServices.innerHTML = '<p class="text-sm text-warm-500 animate-pulse">Menghitung ongkir...</p>';
                shippingServicesContainer.classList.remove('hidden');

                fetch('{{ route("api.shipping.cost") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        destination: destinationId.value,
                        courier: courierSelect.value
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        shippingServices.innerHTML = '';
                        // Komerce structure? ShippingService returns costs array.
                        // Assuming ShippingService returns standard array of costs.
                        if (data && data.length > 0) {
                            data.forEach((service, index) => {
                                const cost = service.cost[0].value;
                                const etd = service.cost[0].etd; // Komerce might use 'etd' or 'estimated_days'
                                const formattedCost = new Intl.NumberFormat('id-ID').format(cost);
                                
                                // Normalize service name
                                const serviceName = service.service; // e.g. "REG", "OKE"
                                const description = service.description || serviceName;

                                const div = document.createElement('div');
                                div.className = 'flex items-center p-3 border border-warm-200 rounded-lg cursor-pointer hover:border-primary-500 transition-colors';
                                div.innerHTML = `
                                    <input type="radio" name="shipping_option" id="service_${index}" value="${cost}" 
                                        class="text-primary-600 focus:ring-primary-500" onchange="updateTotal(${cost}, '${serviceName}')">
                                    <label for="service_${index}" class="ml-3 flex-1 flex justify-between cursor-pointer">
                                        <span class="block text-sm font-medium text-warm-900">${serviceName} (${description})</span>
                                        <span class="block text-sm text-warm-500">Rp ${formattedCost} <span class="text-xs text-warm-400">(${etd} hari)</span></span>
                                    </label>
                                `;
                                shippingServices.appendChild(div);
                            });
                        } else {
                            shippingServices.innerHTML = '<p class="text-sm text-accent-500">Tidak ada layanan pengiriman tersedia.</p>';
                        }
                    })
                    .catch(error => {
                        shippingServices.innerHTML = '<p class="text-sm text-accent-500">Gagal memuat ongkir.</p>';
                        console.error('Error:', error);
                    });
            }

            window.updateTotal = function (cost, serviceName) {
                shippingCostInput.value = cost;
                shippingServiceInput.value = serviceName;
                shippingCostDisplay.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(cost);
                totalDisplay.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(baseTotal + cost);
            }

            function resetShipping() {
                shippingCostInput.value = 0;
                shippingServiceInput.value = '';
                shippingCostDisplay.textContent = 'Rp 0';
                totalDisplay.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(baseTotal);
                shippingServicesContainer.classList.add('hidden');
                // Uncheck radios
                document.querySelectorAll('input[name="shipping_option"]').forEach(el => el.checked = false);
            }
        });
    </script>
@endsection