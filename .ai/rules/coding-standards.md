# Mandatory Coding Standards — Ahmad Portfolio

Terapkan aturan berikut untuk SELURUH proses development proyek Laravel 13 ini, termasuk setiap file baru dan file yang dimodifikasi:

1. Setiap file source code maksimal 300 baris, tanpa pengecualian.
2. Jika sebuah file mulai mendekati 300 baris, lakukan refactoring dengan memisahkan tanggung jawab ke beberapa file atau komponen.
3. Jangan pernah menuliskan CSS atau JavaScript langsung di dalam file Blade.
4. Dilarang menggunakan inline `<style>`, `<script>`, `style=""`, `onclick`, `onchange`, atau inline event handler lainnya di Blade.
5. Semua CSS custom harus berada di `resources/css/` dengan struktur modular.
6. Semua JavaScript harus berada di `resources/js/` dengan modul yang dipisahkan berdasarkan fitur.
7. Gunakan Vite untuk memuat CSS dan JavaScript.
8. Blade hanya digunakan untuk HTML, komponen, directive Blade, serta class utility Tailwind CSS.
9. Gunakan komponen Blade reusable dan hindari duplikasi markup.
10. Gunakan prinsip Separation of Concerns, DRY, dan maintainable architecture.
11. Jangan membuat satu file besar yang menangani banyak fitur sekaligus.
12. Setelah melakukan perubahan, periksa panjang setiap file kode yang dibuat atau dimodifikasi, serta jalankan validasi Laravel dan frontend yang relevan.

