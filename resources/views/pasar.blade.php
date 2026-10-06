<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>PasarPagi.id - Pre-Order Bahan Segar H-1</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-tap-highlight-color: transparent; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 pb-28 md:pb-12 antialiased selection:bg-emerald-500 selection:text-white"
      x-data="pasarApp()" 
      x-init="initApp()">

    <!-- Header Navigation -->
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 h-16 sm:h-20 flex items-center justify-between gap-3">
            
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-600 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-md shadow-emerald-200">
                    🥬
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-lg font-extrabold text-slate-900">Pasar<span class="text-emerald-600">Pagi</span></span>
                        <span class="text-[10px] bg-amber-100 text-amber-800 font-extrabold px-2 py-0.5 rounded-full">PRE-ORDER H-1</span>
                    </div>
                    <p class="text-[11px] text-slate-500 font-medium flex items-center gap-1">
                        <i data-lucide="clock" class="w-3 h-3 text-emerald-600"></i> Ambil / Kirim Besok Pagi
                    </p>
                </div>
            </div>

            <!-- Search Bar (Desktop) -->
            <div class="hidden md:block flex-1 max-w-md">
                <div class="relative">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" x-model="searchQuery" placeholder="Cari bahan, bumbu, atau paket resep..." 
                           class="w-full bg-slate-100 border border-slate-200 rounded-2xl pl-10 pr-4 py-2 text-xs focus:bg-white focus:ring-2 focus:ring-emerald-500 outline-none transition">
                </div>
            </div>

            <!-- Header Action -->
            <button @click="toggleCart()" class="hidden md:flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-2xl text-xs font-bold transition shadow-lg shadow-emerald-200">
                <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                <span>Keranjang</span>
                <span class="bg-white text-emerald-700 text-[11px] font-black px-2 py-0.5 rounded-full" x-text="totalItemCount">0</span>
            </button>
        </div>

        <!-- Search Bar (Mobile View) -->
        <div class="px-4 pb-3 md:hidden">
            <div class="relative">
                <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" x-model="searchQuery" placeholder="Cari cabai, dada ayam, paket resep..." 
                       class="w-full bg-slate-100 border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-7xl mx-auto px-4 py-4 md:py-8 space-y-6">

        <!-- Banner Konsep Operasional H-1 & Timer Cut-off -->
        <div class="bg-gradient-to-r from-slate-900 via-emerald-950 to-slate-900 text-white rounded-3xl p-5 sm:p-6 shadow-xl border border-emerald-800/40 relative overflow-hidden">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 relative z-10">
                <div class="space-y-1.5 max-w-2xl">
                    <div class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-400/30 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Konsep Pesan Hari Ini, Jemput/Antar Besok
                    </div>
                    <h1 class="text-xl sm:text-2xl font-black leading-tight">
                        Pesanan Dikunci Malam Ini, <span class="text-emerald-400">Belanja Segar Subuh Besok.</span>
                    </h1>
                    <p class="text-xs text-slate-300">
                        Tim personal shopper kami akan belanja ke pasar induk saat subuh sesuai pesananmu. Dijamin segar & tidak ada barang sisa kemarin!
                    </p>
                </div>

                <!-- Countdown Timer Box -->
                <div class="bg-white/10 backdrop-blur-md border border-white/15 p-3.5 rounded-2xl flex items-center justify-between lg:justify-end gap-4 shrink-0">
                    <div>
                        <span class="text-[10px] uppercase tracking-wider text-slate-300 block font-semibold">Sisa Waktu Order Hari Ini</span>
                        <span class="text-xs text-amber-300 font-bold">Batas Cut-off 21:00 WIB</span>
                    </div>
                    <div class="text-lg font-black tracking-widest bg-emerald-600 px-3 py-1.5 rounded-xl text-white shadow" x-text="countdownText">
                        00:00:00
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Category Tabs -->
        <div class="flex gap-2 overflow-x-auto pb-1 hide-scrollbar">
            <template x-for="cat in categories" :key="cat.id">
                <button @click="activeCategory = cat.id" 
                        :class="activeCategory === cat.id ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'"
                        class="px-4 py-2.5 rounded-2xl text-xs font-bold whitespace-nowrap transition flex items-center gap-1.5">
                    <span x-text="cat.icon"></span>
                    <span x-text="cat.name"></span>
                </button>
            </template>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5">
            <template x-for="product in filteredProducts" :key="product.id">
                <div class="bg-white p-3 sm:p-4 rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="relative h-28 sm:h-36 bg-slate-50 rounded-xl sm:rounded-2xl flex items-center justify-center text-4xl sm:text-5xl mb-3 overflow-hidden">
                            <span x-text="product.image"></span>
                            <template x-if="product.tag">
                                <span class="absolute top-2 left-2 bg-emerald-500 text-white text-[9px] sm:text-[10px] font-black px-2 py-0.5 rounded-full uppercase" x-text="product.tag"></span>
                            </template>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider" x-text="product.categoryName"></span>
                        <h3 class="font-bold text-slate-900 text-xs sm:text-sm line-clamp-1 mt-0.5" x-text="product.name"></h3>
                        <p class="text-[11px] text-slate-400 line-clamp-2 mt-1" x-text="product.description"></p>
                    </div>
                    <div class="mt-3 pt-2 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400" x-text="'/' + product.unit"></span>
                            <p class="font-black text-emerald-600 text-sm sm:text-base" x-text="formatRupiah(product.price)"></p>
                        </div>
                        <button @click="openModal(product)" class="bg-emerald-600 text-white p-2 rounded-xl text-xs font-bold hover:bg-emerald-700 transition active:scale-95 shadow-sm">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </main>

    <!-- Floating Mobile Bottom Bar -->
    <div class="fixed bottom-0 inset-x-0 z-30 bg-white/90 backdrop-blur-lg border-t border-slate-200 p-3 md:hidden">
        <div class="flex items-center justify-between gap-3 max-w-md mx-auto">
            <div>
                <span class="text-[10px] text-slate-400 font-bold block">Total Est. Belanja</span>
                <span class="text-base font-black text-emerald-600" x-text="formatRupiah(totalPrice)">Rp 0</span>
            </div>
            <button @click="toggleCart()" class="bg-emerald-600 text-white px-5 py-2.5 rounded-2xl font-bold text-xs flex items-center gap-2 shadow-lg shadow-emerald-200">
                <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                <span>Lihat Keranjang</span>
                <span class="bg-white text-emerald-700 text-[10px] font-black px-2 py-0.5 rounded-full" x-text="totalItemCount">0</span>
            </button>
        </div>
    </div>

    <!-- Modal Custom Note/Request -->
    <div x-show="isModalOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4" 
         style="display: none;">
        
        <div @click.away="closeModal()" class="bg-white rounded-3xl p-6 max-w-sm w-full space-y-4 shadow-2xl">
            <div class="flex items-center justify-between border-b pb-3">
                <h3 class="font-bold text-slate-900 text-sm" x-text="'Request Olahan: ' + (selectedProduct ? selectedProduct.name : '')"></h3>
                <button @click="closeModal()" class="text-slate-400 hover:text-slate-600"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Catatan Olahan / Pemotongan:</label>
                <textarea x-model="tempNote" rows="3" placeholder="Contoh: Potong jadi 12 bagian, buang kepala, pilih yang tidak terlalu pedas..." class="w-full bg-slate-100 border border-slate-200 rounded-2xl p-3 text-xs focus:bg-white focus:ring-2 focus:ring-emerald-500 outline-none"></textarea>
            </div>
            <button @click="confirmAddToCart()" class="w-full bg-emerald-600 text-white font-extrabold py-3 rounded-2xl text-xs shadow-md shadow-emerald-200">
                + Tambahkan ke Keranjang
            </button>
        </div>
    </div>

    <!-- Drawer / Bottom Sheet Checkout -->
    <div x-show="isCartOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm" 
         style="display: none;">
        
        <div @click.away="toggleCart()" class="absolute right-0 bottom-0 md:top-0 w-full md:max-w-md bg-white rounded-t-3xl md:rounded-l-3xl p-6 shadow-2xl space-y-5 max-h-[90vh] md:max-h-full overflow-y-auto">
            
            <div class="flex items-center justify-between border-b pb-3">
                <div class="flex items-center gap-2">
                    <i data-lucide="shopping-cart" class="w-5 h-5 text-emerald-600"></i>
                    <h2 class="font-extrabold text-slate-900 text-base">Rincian Order H-1</h2>
                </div>
                <button @click="toggleCart()" class="text-slate-400 hover:text-slate-600"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>

            <!-- List Item Keranjang -->
            <div class="space-y-3 min-h-[100px]">
                <template x-if="cart.length === 0">
                    <p class="text-center text-slate-400 text-xs py-8">Keranjang belanjaan masih kosong.</p>
                </template>
                <template x-for="(item, index) in cart" :key="index">
                    <div class="bg-slate-50 p-3 rounded-2xl border border-slate-200/60 text-xs space-y-1">
                        <div class="flex justify-between font-bold text-slate-800">
                            <span x-text="item.name"></span>
                            <span x-text="formatRupiah(item.price * item.qty)"></span>
                        </div>
                        <template x-if="item.note">
                            <p class="text-[10px] text-amber-800 bg-amber-50 p-1.5 rounded-lg border border-amber-200" x-text="'Request: ' + item.note"></p>
                        </template>
                        <div class="flex items-center justify-between pt-1">
                            <span class="text-slate-400 text-[10px]" x-text="formatRupiah(item.price) + ' x ' + item.qty"></span>
                            <div class="flex items-center gap-2">
                                <button @click="updateQty(index, -1)" class="w-5 h-5 bg-white border rounded font-bold flex items-center justify-center text-xs">-</button>
                                <span class="font-bold" x-text="item.qty"></span>
                                <button @click="updateQty(index, 1)" class="w-5 h-5 bg-emerald-600 text-white rounded font-bold flex items-center justify-center text-xs">+</button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Form Opsi Layanan Penjemputan / Pengiriman -->
            <div class="space-y-3 border-t pt-4">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Tanggal Ambil / Kirim (Besok)</label>
                    <input type="text" x-model="tomorrowDateFormatted" readonly class="w-full bg-slate-100 border border-slate-200 rounded-xl p-2.5 text-xs font-bold text-emerald-700 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Metode Pengambilan</label>
                    <select x-model="fulfillmentMethod" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-xs font-semibold outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="pickup">Self Pick-up (Jemput Mandiri di Pos Pasar)</option>
                        <option value="delivery">Kurir Pasar (Diantar ke Rumah)</option>
                    </select>
                </div>

                <template x-if="fulfillmentMethod === 'pickup'">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Lokasi Titik Jemput (Pick-up Point)</label>
                        <select x-model="pickupPoint" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-xs font-semibold outline-none focus:ring-2 focus:ring-emerald-500">
                            <option value="Pos Utama Pasar Kebayoran">Pos Utama Pasar Kebayoran (Stand B12)</option>
                            <option value="Hub Pick-up Bintaro Sektor 3">Hub Pick-up Bintaro Sektor 3</option>
                            <option value="Drop Point Kebon Jeruk">Drop Point Kebon Jeruk</option>
                        </select>
                    </div>
                </template>

                <template x-if="fulfillmentMethod === 'delivery'">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Alamat Pengiriman Lengkap</label>
                        <textarea x-model="deliveryAddress" rows="2" placeholder="Tuliskan nama jalan, nomor rumah, dan patokan..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-xs outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
                    </div>
                </template>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Jam Tiba / Penjemputan Besok</label>
                    <select x-model="timeSlot" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-xs font-semibold outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="06.00 - 07.00 WIB">06.00 - 07.00 WIB (Pagi Awal)</option>
                        <option value="07.00 - 08.00 WIB">07.00 - 08.00 WIB</option>
                        <option value="08.00 - 09.00 WIB">08.00 - 09.00 WIB</option>
                    </select>
                </div>
            </div>

            <!-- Ringkasan Biaya -->
            <div class="bg-slate-50 p-4 rounded-2xl space-y-1.5 text-xs border">
                <div class="flex justify-between text-slate-500">
                    <span>Subtotal Bahan</span>
                    <span class="font-bold text-slate-800" x-text="formatRupiah(subtotalPrice)">Rp 0</span>
                </div>
                <div class="flex justify-between text-slate-500">
                    <span x-text="fulfillmentMethod === 'pickup' ? 'Biaya Packing & Titip Pos' : 'Ongkir Kurir Pasar'"></span>
                    <span class="font-bold text-slate-800" x-text="formatRupiah(serviceFee)">Rp 0</span>
                </div>
                <div class="flex justify-between border-t pt-2 text-sm font-black text-slate-900">
                    <span>Total Bayar Besok</span>
                    <span class="text-emerald-600" x-text="formatRupiah(grandTotal)">Rp 0</span>
                </div>
            </div>

            <!-- Tombol Submit WhatsApp -->
            <button @click="sendWhatsApp()" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold py-3.5 rounded-2xl shadow-lg shadow-emerald-200 flex items-center justify-center gap-2 text-xs transition active:scale-98">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>KIRIM ORDER PRE-ORDER KE WA</span>
            </button>
        </div>
    </div>

    <!-- Alpine.js Application Logic -->
    <script>
        function pasarApp() {
            return {
                adminWhatsApp: "6281234567890", // Ganti dengan nomor Admin/Kurir
                searchQuery: "",
                activeCategory: "all",
                isCartOpen: false,
                isModalOpen: false,
                selectedProduct: null,
                tempNote: "",
                
                // Form State
                fulfillmentMethod: "pickup",
                pickupPoint: "Pos Utama Pasar Kebayoran",
                deliveryAddress: "",
                timeSlot: "06.00 - 07.00 WIB",
                tomorrowDateFormatted: "",
                countdownText: "00:00:00",

                categories: [
                    { id: "all", name: "Semua Produk", icon: "🔥" },
                    { id: "paket", name: "Paket Resep Masak", icon: "🍲" },
                    { id: "lauk", name: "Daging & Protein", icon: "🥩" },
                    { id: "sayur", name: "Sayuran Segar", icon: "🥦" },
                    { id: "bumbu", name: "Bumbu Dapur", icon: "🧄" }
                ],

                products: [
                    { id: 1, category: "paket", categoryName: "Paket Resep", name: "Paket Sayur Asem Jakarta", description: "Jagung, Melinjo, Labu Siam, Kacang Panjang, Nangka + Bumbu Racik Asem.", price: 15000, unit: "porsi 4 orang", image: "🥣", tag: "Siap Masak" },
                    { id: 2, category: "paket", categoryName: "Paket Resep", name: "Paket Sayur Sop Komplit", description: "Wortel, Kentang, Kol, Daun Bawang, Seledri + Bumbu Bawang Halus.", price: 16500, unit: "porsi 4 orang", image: "🍲", tag: "Praktis" },
                    { id: 3, category: "lauk", categoryName: "Protein", name: "Dada Ayam Fillet Segar", description: "Kemasan hampa udara. Bebas lemak & siap dipotong sesuai request.", price: 28000, unit: "500 Gram", image: "🍗", tag: "Best Seller" },
                    { id: 4, category: "lauk", categoryName: "Protein", name: "Udang Vaname Segar Subuh", description: "Tangkapan segar harian. Bisa request buang kepala & kupas kulit.", price: 42000, unit: "500 Gram", image: "🦐", tag: null },
                    { id: 5, category: "sayur", categoryName: "Sayuran", name: "Brokoli Hijau Super", description: "Bonggol padat hijau segar tanpa ulat.", price: 12000, unit: "350 Gram", image: "🥦", tag: null },
                    { id: 6, category: "bumbu", categoryName: "Bumbu Dapur", name: "Bawang Merah Brebes", description: "Kondisi kering sempurna, siap dikupas bersih.", price: 14000, unit: "250 Gram", image: "🧅", tag: null },
                    { id: 7, category: "bumbu", categoryName: "Bumbu Dapur", name: "Cabai Rawit Merah Petik", description: "Cabai rawit segar pedas tanpa tangkai.", price: 18000, unit: "250 Gram", image: "🌶️", tag: null }
                ],

                cart: [],

                initApp() {
                    this.calculateTomorrowDate();
                    this.startCountdown();
                    this.$nextTick(() => { lucide.createIcons(); });
                },

                calculateTomorrowDate() {
                    const today = new Date();
                    const tomorrow = new Date(today);
                    tomorrow.setDate(tomorrow.getDate() + 1);

                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    this.tomorrowDateFormatted = tomorrow.toLocaleDateString('id-ID', options);
                },

                startCountdown() {
                    const updateTimer = () => {
                        const now = new Date();
                        const cutoff = new Date();
                        cutoff.setHours(21, 0, 0, 0); // Cutoff Jam 21.00 WIB

                        if (now > cutoff) {
                            cutoff.setDate(cutoff.getDate() + 1);
                        }

                        const diff = cutoff - now;
                        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                        this.countdownText = 
                            `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                    };

                    updateTimer();
                    setInterval(updateTimer, 1000);
                },

                get filteredProducts() {
                    return this.products.filter(p => {
                        const matchCat = this.activeCategory === 'all' || p.category === this.activeCategory;
                        const matchSearch = p.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || 
                                           p.description.toLowerCase().includes(this.searchQuery.toLowerCase());
                        return matchCat && matchSearch;
                    });
                },

                openModal(product) {
                    this.selectedProduct = product;
                    this.tempNote = "";
                    this.isModalOpen = true;
                },

                closeModal() {
                    this.isModalOpen = false;
                },

                confirmAddToCart() {
                    const existing = this.cart.find(i => i.id === this.selectedProduct.id && i.note === this.tempNote);
                    if (existing) {
                        existing.qty++;
                    } else {
                        this.cart.push({
                            id: this.selectedProduct.id,
                            name: this.selectedProduct.name,
                            price: this.selectedProduct.price,
                            qty: 1,
                            note: this.tempNote
                        });
                    }
                    this.closeModal();
                },

                updateQty(index, change) {
                    this.cart[index].qty += change;
                    if (this.cart[index].qty <= 0) {
                        this.cart.splice(index, 1);
                    }
                },

                toggleCart() {
                    this.isCartOpen = !this.isCartOpen;
                },

                get subtotalPrice() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                },

                get serviceFee() {
                    if (this.cart.length === 0) return 0;
                    return this.fulfillmentMethod === 'pickup' ? 5000 : 15000;
                },

                get grandTotal() {
                    return this.subtotalPrice + this.serviceFee;
                },

                get totalItemCount() {
                    return this.cart.reduce((sum, item) => sum + item.qty, 0);
                },

                formatRupiah(num) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num);
                },

                sendWhatsApp() {
                    if (this.cart.length === 0) return alert('Keranjang belanja masih kosong!');
                    if (this.fulfillmentMethod === 'delivery' && !this.deliveryAddress.trim()) {
                        return alert('Mohon lengkapi alamat pengiriman!');
                    }

                    let msg = `*ORDER PRE-ORDER H-1 (PASARPAGI.ID)*\n`;
                    msg += `-----------------------------------\n`;
                    msg += `📅 *Tanggal Ambil/Kirim:* ${this.tomorrowDateFormatted}\n`;
                    msg += `⏰ *Jam Tiba/Jemput:* ${this.timeSlot}\n`;
                    msg += `🚚 *Metode:* ${this.fulfillmentMethod === 'pickup' ? 'Self Pick-up' : 'Delivery Kurir'}\n`;
                    
                    if (this.fulfillmentMethod === 'pickup') {
                        msg += `📍 *Titik Jemput:* ${this.pickupPoint}\n`;
                    } else {
                        msg += `📍 *Alamat Kirim:* ${this.deliveryAddress}\n`;
                    }

                    msg += `\n*RINCIAN BELANJAAN:* \n`;
                    this.cart.forEach((item, i) => {
                        msg += `${i + 1}. *${item.name}* (${item.qty}x)\n`;
                        if (item.note) msg += `   _Catatan Request: ${item.note}_\n`;
                    });

                    msg += `\n-----------------------------------\n`;
                    msg += `Subtotal Bahan: ${this.formatRupiah(this.subtotalPrice)}\n`;
                    msg += `${this.fulfillmentMethod === 'pickup' ? 'Biaya Titip/Packing' : 'Ongkos Kirim'}: ${this.formatRupiah(this.serviceFee)}\n`;
                    msg += `*TOTAL TAGIHAN: ${this.formatRupiah(this.grandTotal)}*\n\n`;
                    msg += `Halo admin, mohon dikonfirmasi pesanan saya untuk dibelanjakan subuh besok ya!`;

                    window.open(`https://wa.me/${this.adminWhatsApp}?text=${encodeURIComponent(msg)}`, '_blank');
                }
            }
        }
    </script>
</body>
</html>