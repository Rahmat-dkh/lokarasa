<?php

namespace App\Livewire;

use Livewire\Component;

class ChatWidget extends Component
{
    // isOpen handled by AlpineJS client-side
    public $messages = [];
    public $messageInput = '';

    public function mount()
    {
        // Initial bot greeting
        $this->messages[] = [
            'type' => 'bot',
            'text' => 'Halo! Selamat datang di Lokarasa, pusat kuliner nusantara dan oleh-oleh asli Indonesia. 🇮🇩 Ada yang bisa kami bantu?',
            'time' => now()->setTimezone('Asia/Jakarta')->format('H:i')
        ];
    }

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function sendMessage($text = null)
    {
        // If text passed via argument (from Alpine), use it. Otherwise use property.
        $input = $text ?? $this->messageInput;

        if (trim($input) === '') {
            return;
        }

        // User Message
        $this->messages[] = [
            'type' => 'user',
            'text' => $input,
            'time' => now()->setTimezone('Asia/Jakarta')->format('H:i')
        ];

        $userMsg = $input;
        $this->messageInput = ''; // Clear property too just in case

        // Simulate Bot Typing/Reply
        // In a real app, this would call an API.
        // For now, we simulate a delay then reply.
        $this->dispatch('scroll-chat');

        // Use a simple logic for dummy replies
        $reply = $this->getBotReply($userMsg);

        // Add Bot Reply after delay (simulated by frontend or next request, 
        // but for Livewire simple implementation we add it immediately or 
        // we could use sleep() but that pauses server. 
        // Better: We add it now.)

        $this->messages[] = [
            'type' => 'bot',
            'text' => $reply,
            'time' => now()->setTimezone('Asia/Jakarta')->format('H:i')
        ];

        $this->dispatch('scroll-chat');
    }

    private function getBotReply($msg)
    {
        $msg = strtolower($msg);

        // Product & Price
        if (str_contains($msg, 'harga') || str_contains($msg, 'biaya') || str_contains($msg, 'mahal') || str_contains($msg, 'price')) {
            return 'Harga kami sangat bersahabat karena diambil langsung dari UMKM kuliner. Range harga mulai Rp 5.000 (Snack/Cemilan) hingga paket oleh-oleh premium.';
        }

        if (str_contains($msg, 'produk') || str_contains($msg, 'jual') || str_contains($msg, 'barang') || str_contains($msg, 'menu') || str_contains($msg, 'katalog')) {
            return 'Kami menyajikan berbagai kelezatan Nusantara! Mulai dari camilan kering (keripik, emping), sambal khas daerah, hingga kue tradisional dan bahan masakan lokal.';
        }

        // Shipping
        if (str_contains($msg, 'kirim') || str_contains($msg, 'ongkir') || str_contains($msg, 'kurir') || str_contains($msg, 'antar') || str_contains($msg, 'pengiriman')) {
            return 'Kami melayani pengiriman ke seluruh pelosok Indonesia via JNE, J&T, dan SiCepat. Untuk area lokal, bisa pakai GoSend/GrabExpress.';
        }

        // Location & Contact
        if (str_contains($msg, 'lokasi') || str_contains($msg, 'alamat') || str_contains($msg, 'toko') || str_contains($msg, 'posisi') || str_contains($msg, 'kota')) {
            return 'Mitra UMKM kuliner kami tersebar di seluruh Indonesia. Kantor utama Lokarasa berada di Purworejo, Jawa Tengah, tapi pengiriman dilakukan langsung dari daerah asal kuliner tersebut agar tetap fresh.';
        }

        if (str_contains($msg, 'wa') || str_contains($msg, 'whatsapp') || str_contains($msg, 'nomor') || str_contains($msg, 'hubungi') || str_contains($msg, 'telepon')) {
            return 'Boleh, untuk respon cepat bisa WA Admin kami di 0812-3456-7890. Atau klik tombol "Beli Langsung via WA" di halaman produk.';
        }

        // Operational
        if (str_contains($msg, 'jam') || str_contains($msg, 'buka') || str_contains($msg, 'tutup') || str_contains($msg, 'operasional')) {
            return 'Toko Online kami buka 24 Jam! Tapi untuk Admin chat standby Senin-Sabtu jam 08.00 - 20.00 WIB.';
        }

        // Payment
        if (str_contains($msg, 'bayar') || str_contains($msg, 'rekening') || str_contains($msg, 'transfer') || str_contains($msg, 'cod') || str_contains($msg, 'dana') || str_contains($msg, 'ovo')) {
            return 'Pembayaran mudah! Bisa Transfer Bank (BCA, BRI), E-Wallet (Dana, OVO), atau QRIS. Kami juga support COD untuk wilayah tertentu.';
        }

        // Promo/Reseller
        if (str_contains($msg, 'promo') || str_contains($msg, 'diskon') || str_contains($msg, 'code') || str_contains($msg, 'voucher')) {
            return 'Ada promo Gratis Ongkir untuk pembelian minimal Rp 50.000 khusus produk makanan ringat! Cek banner di halaman depan ya.';
        }

        if (str_contains($msg, 'reseller') || str_contains($msg, 'dropship') || str_contains($msg, 'mitra') || str_contains($msg, 'bantuan')) {
            return 'Kami membuka peluang kemitraan untuk membantu UMKM naik kelas. Chat WA admin dengan ketik "GABUNG MITRA" ya!';
        }

        // Greetings
        if (str_contains($msg, 'halo') || str_contains($msg, 'hai') || str_contains($msg, 'pagi') || str_contains($msg, 'siang') || str_contains($msg, 'sore') || str_contains($msg, 'malam') || str_contains($msg, 'assalamualaikum')) {
            return 'Halo! Selamat datang di Lokarasa. Mari lestarikan cita rasa Nusantara! 🇮🇩 Produk kuliner apa yang sedang Anda cari?';
        }

        if (str_contains($msg, 'terima kasih') || str_contains($msg, 'makasih') || str_contains($msg, 'thanks') || str_contains($msg, 'ok') || str_contains($msg, 'sip') || str_contains($msg, 'mantap')) {
            return 'Sama-sama! Terima kasih sudah mendukung UMKM Indonesia. Ditunggu orderannya ya! 😊';
        }

        // Default
        return 'Maaf, saya bot asisten virtual. Bisa diperjelas pertanyaannya? Misalnya "Produk apa yang dijual?" atau "Berapa ongkir ke Surabaya?".';
    }

    public function render()
    {
        return view('livewire.chat-widget');
    }
}
